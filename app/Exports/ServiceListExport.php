<?php

namespace App\Exports;

use App\SignForm;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class ServiceListExport implements FromView, ShouldAutoSize
{   
    protected $round_id;
    protected $items;

    public function __construct(int $round_id)
    {
        $this->round_id = $round_id;
    }

    public function view(): View
    {
        $items = \App\Service::where('round_id', $this->round_id)->with('sign', 'partner')->orderBy('sign_id', 'asc')->get();

        $collection = [];

        foreach ($items as $item) {
            if(!array_key_exists($item->sign_id, $collection)){
                $collection[$item->sign_id]['item'] = $item->sign;
                $collection[$item->sign_id]['partners'] = [];
                $collection[$item->sign_id]['partners'][] = $item;
            }
            else{
                $collection[$item->sign_id]['partners'][] = $item;
            }
        }
        
        return view('export.serviceList', [
            'collection' => $collection
        ]);
    }
}
