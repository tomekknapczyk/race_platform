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

        return back()->with('success', 'Rajd został zapisany');
    }

    public function deleteRace(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:races',
        ]);

        Race::where('id', $request->id)->delete();

        return back()->with('success', 'Rajd został usunięty');
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
            'date' => 'required|max:255',
            'max' => 'required|numeric',
        ]);

        if(isset($request->id)){
            $round = Round::where('id', $request->id)->first();
        }
        else{
            $round = new Round;
            $round->race_id = $request->race_id;
        }

        $round->name = $request->name;
        $round->date = $request->date;
        $round->max = $request->max;

        if($request->price)
            $round->price = floatval(str_replace(',', '.', $request->price));

        if($request->advance)
            $round->advance = floatval(str_replace(',', '.', $request->advance));

        if($request->terms){
            $terms = \App\File::where('id',$round->file_id)->first();
            if($terms){
                \Storage::delete('public/terms/'.$terms->path);
                $terms->delete();
            }

            $file = $request->terms;
            $originalName = $file->getClientOriginalName();
            $name = $file->hashName();
            $path = 'public/terms/';

            \Storage::put($path, $file);

            $storeFile = new \App\File();
            $storeFile->name = $originalName;
            $storeFile->path = $name;
            $storeFile->save();

            $round->file_id = $storeFile->id;
        }

        if($request->deleteFile){
            $photo = \App\File::where('id',$round->file_id)->first();
            if($photo){
                \Storage::delete('public/terms/'.$photo->path);
                $photo->delete();
            }

            $round->file_id = null;
        }

        $round->save();

        if(!isset($request->id)){
            $form = new SignForm;
            $form->round_id = $round->id;
            $form->save();
        }

        return back()->with('success', 'Runda została zapisana');
    }

    public function deleteRound(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:rounds',
        ]);

        Round::where('id', $request->id)->delete();

        return back()->with('success', 'Runda została usunięta');
    }

    public function round($id)
    {
        $round = Round::where('id', $id)->first();

        if($round->startList)
            return redirect()->route('race', $round->race_id)->with('info', 'Lista zgłoszeń jest niedostępna ponieważ została wygenerowana lista startowa.');

        if($round){
            $klasy = $round->signs()->sortBy('klasa')->pluck('klasa', 'klasa');
            $max = $round->max;
            $drivers = 0;
            $active = true;
            $class = [];

            foreach ($round->signs() as $key => $sign) {
                $drivers++;

                if($drivers > $max)
                    $active = false;

                $class[$sign->klasa][$key]['sign'] = $sign;
                $class[$sign->klasa][$key]['active'] = $active;
            }

            return view('admin.round', compact('round', 'klasy', 'class'));
        }

        return back()->with('warning', 'Runda nie istnieje');
    }

    public function list($id)
    {
        $round = Round::where('id', $id)->first();

        if(!$round->startList)
            return redirect()->route('race', $round->race_id)->with('info', 'Lista startowa jest niedostępna ponieważ nie została wygenerowana.');

        if($round){
            return view('admin.list', compact('round'));
        }

        return back()->with('warning', 'Runda nie istnieje');
    }
}
