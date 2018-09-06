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

        $today = date('Y-m-d H:i:s');
        $closest = \App\Round::where('date', '>', $today)->with('form', 'race', 'form.signs')->orderBy('date', 'asc')->first();

        $last = \App\Round::where('date', '<', $today)->with('race')->orderBy('date', 'desc')->first();
        $start_list_id = $last->startList->id;
        $klasy = $last->klasy($start_list_id);
        $random = $klasy->random();

        $promoted_race = \App\SiteInfo::where('name', 'promoted_race')->first();
        if($promoted_race){
            if($promoted_race->value == 'race'){
                $klasy = $last->race->klasy();
                $random = array_rand($klasy);
                $podium = $last->race->klasa_rank($random);
            }
            else
                $podium = $last->podium($start_list_id, $random);
        }
        else
            $podium = $last->podium($start_list_id, $random);

        return view('home', compact('news', 'promoted', 'closest', 'podium', 'random', 'promoted_race', 'last'));
    }

    public function podium($id)
    {
        $round = \App\Round::where('id', $id)->first();
        
        if($round && $round->startList){
            $start_list_id = $round->startList->id;
            $klasy = $round->klasy($start_list_id);

            return view('podium', compact('round', 'klasy', 'start_list_id'));
        }

        return back()->with('warning', 'Lista startowa nie istnieje');
    }

    public function roczna($id)
    {
        $race = \App\Race::where('id', $id)->first();
        
        if($race){
            $klasy = $race->klasy();
            return view('roczna', compact('race', 'klasy'));
        }

        return back()->with('warning', 'Lista startowa nie istnieje');
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
        $liveVideo = \App\SiteInfo::where('name', 'live_video')->first();

        return view('video', compact('liveVideo'));
    }

    public function wyniki()
    {
        $races = \App\Race::get();

        return view('wyniki', compact('races'));
    }

    public function dokumenty()
    {
        $docs = \App\Docs::get();
        $regulaminy = \App\Round::where('file_id', '!=', null)->get();

        return view('dokumenty', compact('docs', 'regulaminy'));
    }

    public function live_wyniki()
    {
        $liveWyniki = \App\SiteInfo::where('name', 'live_wyniki')->first();

        return view('live_wyniki', compact('liveWyniki'));
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
