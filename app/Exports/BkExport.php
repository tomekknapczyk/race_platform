<?php

namespace App\Exports;

use App\SignForm;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class BkExport implements FromView, ShouldAutoSize
{   
    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function view(): View
    {
        return view('export.bk', [
            'drivers' => $this->items
        ]);
    }
}
