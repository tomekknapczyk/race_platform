<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Race;
use App\Round;
use App\SignForm;

class RaceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function races()
    {
        $races = Race::get();
        return view('admin.races', compact('races'));
    }

    public function saveRace(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        if(isset($request->id))
            $race = Race::where('id', $request->id)->first();
        else
            $race = new Race;

        $race->name = $request->name;
        $race->save();

        return redirect()->back()->with('success', 'Rajd został zapisany');
    }

    public function deleteRace(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:races',
        ]);

        Race::where('id', $request->id)->delete();

        return redirect()->back()->with('success', 'Rajd został usunięty');
    }

    public function race($id)
    {
        $race = Race::where('id', $id)->first();

        if($race)
            return view('admin.race', compact('race'));

        return back()->with('warning', 'Rajd nie istnieje');
    }

    public function saveRound(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'termin' => 'required|string|max:255',
        ]);

        if(isset($request->id)){
            $round = Round::where('id', $request->id)->first();
        }
        else{
            $round = new Round;
            $round->race_id = $request->race_id;
        }

        $round->name = $request->name;
        $round->termin = $request->termin;
        $round->save();

        if(!isset($request->id)){
            $form = new SignForm;
            $form->round_id = $round->id;
            $form->save();
        }

        return redirect()->back()->with('success', 'Runda została zapisana');
    }

    public function deleteRound(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:rounds',
        ]);

        Round::where('id', $request->id)->delete();

        return redirect()->back()->with('success', 'Runda została usunięta');
    }

    public function round($id)
    {
        $round = Round::where('id', $id)->first();

        if($round)
            return view('admin.round', compact('round'));

        return back()->with('warning', 'Runda nie istnieje');
    }
}
