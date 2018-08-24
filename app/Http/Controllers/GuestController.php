<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $news = \App\News::latest()->take(4)->get();

        $partners = \App\Partner::get();
        $promoted = null;

        if($partners && $partners->where('promoted',1)->count())
            $promoted = $partners->where('promoted',1)->random();

        return view('home', compact('news', 'partners', 'promoted'));
    }
}
