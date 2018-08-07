<?php

namespace App\Exports;

use App\StartList;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class StartListExport implements FromView, ShouldAutoSize
{   
    protected $round_id;
    protected $items;

    public function __construct(int $round_id, $items)
    {
        $this->round_id = $round_id;
        $this->items = explode(',', $items);
    }

    public function view(): View
    {
        $round = \App\Round::where('id', $this->round_id)->first();
        $list = StartList::where('round_id', $this->round_id)->first();
        
        return view('export.startlist', [
            'list' => $list,
            'round' => $round,
            'items' => $this->items,
        ]);
    }
}
