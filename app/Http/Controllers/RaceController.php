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
            'year' => 'required|numeric',
        ]);

        if(isset($request->id)){
            $race = Race::where('id', $request->id)->first();
            $race->minTeam = $request->minTeam;
        }
        else{
            $race = new Race;
            $race->minTeam = 3;
        }

        $race_active = Race::where('active', 1)->first();

        if($race_active)
            $race->active = 0;
        else
            $race->active = 1;

        if(isset($request->active)){
            $races = Race::where('id', '!=', $race->id)->get();

            foreach ($races as $a_race) {
                $a_race->active = 0;
                $a_race->save();
            }

            $race->active = 1;
        }

        $race->name = $request->name;
        $race->year = $request->year;
        if(isset($request->complete)){
            $race->generateLaurels();
            $race->complete = 1;
        }
        else
            $race->complete = 0;
        $race->save();

        return back()->with('success', 'Rajd został zapisany');
    }

    public function deleteRace(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:races',
        ]);

        $race = Race::where('id', $request->id)->first();

        foreach ($race->lists as $list) {
            foreach ($list->items as $item) {
                $item->delete();
            }

            $list->delete();
        }

        foreach ($race->forms as $form) {
            foreach ($form->signs as $item) {
                $item->delete();
            }

            $form->delete();
        }

        foreach ($race->rounds as $round) {
            $round->delete();
        }

        $race->delete();

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
            'sign_date' => 'required',
            'date' => 'required',
            'max' => 'required|numeric',
            'order' => 'required',
            'section.*.name' => 'required',
        ]);

        if(isset($request->id)){
            $round = Round::where('id', $request->id)->first();
        }
        else{
            $round = new Round;
            $round->race_id = $request->race_id;
        }

        $round->name = $request->name;
        $round->sub_name = $request->sub_name;
        $round->details = $request->details;
        $round->date = $request->date.":00";
        $round->sign_date = $request->sign_date.":00";
        $round->max = $request->max;
        $round->order = $request->order;

        $round->length = $request->length;
        $round->special_length = $request->special_length;
        $round->driveway_length = $request->driveway_length;
        $round->desc = $request->desc;
        $round->serwis = $request->serwis;

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


        if($request->poster){
            $poster = \App\File::where('id',$round->poster_id)->first();
            if($poster){
                \Storage::delete('public/posters/'.$poster->path);
                $poster->delete();
            }

            $file = $request->poster;
            $originalName = $file->getClientOriginalName();
            $name = $file->hashName();
            $path = 'public/posters/';

            \Storage::put($path, $file);

            $storeFile = new \App\File();
            $storeFile->name = $originalName;
            $storeFile->path = $name;
            $storeFile->save();

            $round->poster_id = $storeFile->id;
        }

        if($request->deletePoster){
            $poster = \App\File::where('id',$round->poster_id)->first();
            if($poster){
                \Storage::delete('public/posters/'.$poster->path);
                $poster->delete();
            }

            $round->poster_id = null;
        }

        if($request->map){
            $map = \App\File::where('id',$round->map_id)->first();
            if($map){
                \Storage::delete('public/maps/'.$map->path);
                $map->delete();
            }

            $file = $request->map;
            $originalName = $file->getClientOriginalName();
            $name = $file->hashName();
            $path = 'public/maps/';

            \Storage::put($path, $file);

            $storeFile = new \App\File();
            $storeFile->name = $originalName;
            $storeFile->path = $name;
            $storeFile->save();

            $round->map_id = $storeFile->id;
        }

        if($request->deleteMap){
            $map = \App\File::where('id',$round->map_id)->first();
            if($map){
                \Storage::delete('public/maps/'.$map->path);
                $map->delete();
            }

            $round->map_id = null;
        }

        $round->save();

        if(!isset($request->id)){
            $form = new SignForm;
            $form->round_id = $round->id;
            $form->save();
        }

        if($request->section){
            // dd($request->section);
            foreach ($request->section as $key => $value) {
                
                $section = \App\Section::where('id', $key)->first();
                if(!$section){
                    $section = new \App\Section();
                    $section->round_id = $round->id;
                }

                $section->name = $value['name'];
                $section->length = $value['length'];

                if(isset($value['map']) && $value['map']){
                    $map = \App\File::where('id',$section->map_id)->first();

                    if($map){
                        \Storage::delete('public/maps/'.$map->path);
                        $map->delete();
                    }

                    $file = $value['map'];
                    $originalName = $file->getClientOriginalName();
                    $name = $file->hashName();
                    $path = 'public/maps/';

                    \Storage::put($path, $file);

                    $storeFile = new \App\File();
                    $storeFile->name = $originalName;
                    $storeFile->path = $name;
                    $storeFile->save();

                    $section->map_id = $storeFile->id;
                }

                if(isset($value['deleteMap']) && $value['deleteMap']){
                    $map = \App\File::where('id',$section->map_id)->first();
                    if($map){
                        \Storage::delete('public/maps/'.$map->path);
                        $map->delete();
                    }

                    $section->map_id = null;
                }

                $section->save();

                if(isset($value['delete']) && $value['delete']){
                    $map = \App\File::where('id',$section->map_id)->first();
                    if($map){
                        \Storage::delete('public/maps/'.$map->path);
                        $map->delete();
                    }

                    $section->delete();
                }
            }
        }

        return redirect()->route('editRound', $round->id)->with('success', 'Runda została zapisana');
    }

    public function deleteRound(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:rounds',
        ]);

        $round = Round::where('id', $request->id)->first();
        
        foreach ($round->form->signs as $item) {
            $item->delete();
        }
        $round->form->delete();

        if($round->startList){
            foreach ($round->startList->items as $item) {
                $item->delete();
            }

            $round->startList->delete();
        }

        if($round->sections){
            foreach ($round->sections as $section) {

                $map = \App\File::where('id',$section->map_id)->first();
                if($map){
                    \Storage::delete('public/maps/'.$map->path);
                    $map->delete();
                }

                $section->delete();
            }
        }

        if($round->poster){
            $poster = \App\File::where('id',$round->poster_id)->first();
            if($poster){
                \Storage::delete('public/posters/'.$poster->path);
                $poster->delete();
            }
        }

        if($round->map){
            $map = \App\File::where('id',$round->map_id)->first();
            if($map){
                \Storage::delete('public/maps/'.$map->path);
                $map->delete();
            }
        }

        if($round->file_id){
            $terms = \App\File::where('id',$round->file_id)->first();
            if($terms){
                \Storage::delete('public/terms/'.$terms->path);
                $terms->delete();
            }
        }

        $round->delete();

        return back()->with('success', 'Runda została usunięta');
    }

    public function round($id)
    {
        $round = Round::where('id', $id)->with('race', 'race.lists', 'startList')->first();

        if($round->startList)
            return redirect()->route('race', $round->race_id)->with('info', 'Lista zgłoszeń jest niedostępna ponieważ została wygenerowana lista startowa.');

        if($round){
            $signs = $round->signs();
            $signsAll = $round->signsAll();
            $klasy = $signsAll->sortBy('klasa')->pluck('klasa', 'klasa')->toArray();

            // $order = array('k4', 'k7', 'k3', 'k2', 'k1', 'k6', 'k5');
            $order = explode(',', $round->order);

            usort($klasy, function ($a, $b) use ($order) {
              $pos_a = array_search($a, $order);
              $pos_b = array_search($b, $order);
              return $pos_a - $pos_b;
            });


            $canceled = $round->canceled();

            return view('admin.round', compact('signs', 'klasy', 'round', 'canceled'));
        }

        return back()->with('warning', 'Runda nie istnieje');
    }

    public function accreditations($id)
    {
        $round = Round::where('id', $id)->with('race')->first();

        if($round){
            $accreditations = \App\PressSign::where('round_id', $round->id)->get()->groupBy('user_id');

            return view('admin.accreditations', compact('accreditations', 'round'));
        }

        return back()->with('warning', 'Runda nie istnieje');
    }

    public function editRound($id)
    {
        $round = Round::where('id', $id)->first();

        if($round){
            $id = \App\Section::whereRaw('id = (select max(`id`) from sections)')->pluck('id')->first() + 1;

            return view('admin.editRound', compact('round', 'id'));
        }

        return back()->with('warning', 'Runda nie istnieje');
    }

    public function newRound($id)
    {
        $race = Race::where('id', $id)->first();

        if($race){
            $id = \App\Section::whereRaw('id = (select max(`id`) from sections)')->pluck('id')->first() + 1;

            return view('admin.newRound', compact('race', 'id'));
        }

        return back()->with('warning', 'Rajd nie istnieje');
    }

    public function list($id)
    {
        $round = Round::where('id', $id)->with('startList', 'race')->first();

        if(!$round->startList)
            return redirect()->route('race', $round->race_id)->with('info', 'Lista startowa jest niedostępna ponieważ nie została wygenerowana.');

        if($round){
            $start_list_id = $round->startList->id;
            $startPositions = $round->startPositions($start_list_id);
            $is_someone = $startPositions->count();
            $class = $startPositions->sortBy('klasa')->pluck('klasa', 'klasa')->toArray();

            // $order = array('k4', 'k7', 'k3', 'k2', 'k1', 'k6', 'k5');
            $order = explode(',', $round->order);

            usort($class, function ($a, $b) use ($order) {
              $pos_a = array_search($a, $order);
              $pos_b = array_search($b, $order);
              return $pos_a - $pos_b;
            });

            return view('admin.list', compact('round','is_someone', 'class', 'start_list_id', 'startPositions'));
        }

        return back()->with('warning', 'Runda nie istnieje');
    }
    
    public function addSection(Request $request){
        $id = $request->id;
        return view('admin.addSection', compact('id'))->render();
    }
    
}
