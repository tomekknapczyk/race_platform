<?php

namespace App\Exports;

use App\SignForm;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class SignListExport implements FromView, ShouldAutoSize
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
        $list = SignForm::where('round_id', $this->round_id)->first();

        $klasy = $round->signs()->sortBy('klasa')->pluck('klasa', 'klasa')->toArray();

        $order = explode(',', $round->order);

        usort($klasy, function ($a, $b) use ($order) {
          $pos_a = array_search($a, $order);
          $pos_b = array_search($b, $order);
          return $pos_a - $pos_b;
        });

        $max = $round->max;
        $drivers = 0;
        $class = [];

        foreach ($round->signs() as $key => $sign) {
            $drivers++;

            if($drivers <= $max)
                $class[$sign->klasa][$key]['sign'] = $sign;
        }
        
        return view('export.signlist', [
            'class' => $class,
            'klasy' => $klasy,
            'round' => $round,
            'items' => $this->items,
        ]);
    }
}
