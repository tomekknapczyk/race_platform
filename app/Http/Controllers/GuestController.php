<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $news = \App\News::latest()->with('file')->take(4)->get();
        $promoted = null;

        $partners = \App\Partner::where('promoted',1)->get();
        if($partners)
            $promoted = $partners->where('promoted',1)->random();

        $today = date('Y-m-d');
        $closest = \App\Round::whereDate('date', '>', $today)->orderBy('date', 'asc')->first();

        $last = \App\Round::whereDate('date', '<', $today)->orderBy('date', 'desc')->first();
        $start_list_id = $last->startList->id;
        $klasy = $last->klasy($start_list_id);
        $random = $klasy->random();
        $podium = $last->podium($start_list_id, $random);

        return view('home', compact('news', 'promoted', 'closest', 'podium', 'random'));
    }


    public function drivers()
    {
        $users = \App\User::where('admin', 0)->with('driver', 'driver.file')->get();

        return view('drivers', compact('users'));
    }

    public function driver($id)
    {
        $user = \App\User::where('admin', 0)->where('id', $id)->with('driver', 'driver.file', 'pilots', 'pilots.file', 'cars', 'cars.file', 'races', 'races.sign', 'races.startList', 'races.startList.round', 'races.startList.round.race')->first();

        if(!$user)
            return back()->with('danger', 'Kierowca nie istnieje');

        return view('driver', compact('user'));
    }

    public function video()
    {
        return view('video');
    }

    public function wyniki()
    {
        $races = \App\Race::get();

        return view('wyniki', compact('races'));
    }

    public function dokumenty()
    {
        $docs = \App\Docs::get();

        return view('dokumenty', compact('docs'));
    }

    public function live_wyniki()
    {
        return view('live_wyniki');
    }

    public function terminarz()
    {
        $today = date('Y-m-d');
        $rounds = \App\Round::whereDate('date', '>', $today)->with('race')->orderBy('date', 'asc')->get();

        return view('terminarz', compact('rounds'));
    }

    public function runda($id)
    {
        $round = \App\Round::where('id', $id)->first();

        if($round){
            $start_list_id = $round->startList->id;
            $is_someone = $round->endPositions($start_list_id)->count();
            $class = $round->klasy($start_list_id);
            
            return view('wyniki_runda', compact('round', 'is_someone', 'class', 'start_list_id'));
        }

        return back()->with('warning', 'Lista startowa nie istnieje');
    }
}
