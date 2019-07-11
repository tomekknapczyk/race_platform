<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Race;
use App\Round;
use App\SignForm;
use App\Exports\BkExport;
use Maatwebsite\Excel\Facades\Excel;

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

    public function bk($id)
    {
        $race = Race::where('id', $id)->first();

        if($race)
            return view('admin.bk', compact('race'));

        return back()->with('warning', 'Rajd nie istnieje');
    }

    public function show_bk(Request $request)
    {
        $this->validate($request, [
            'round' => 'required',
        ]);

        $list_id = \App\StartList::whereIn('round_id', $request->round)->pluck('id');

        $items = \App\StartListItem::whereIn('start_list_id', $list_id)->groupBy('email')->get();

        foreach ($items as $key => $item) {
            $list_items = \App\StartListItem::where('email', $item->email)->whereIn('start_list_id', $list_id)->count();
            if($list_items != count($request->round))
                $items->forget($key);
        }

        $drivers = [];

        foreach ($items as $key => $driver) {
            $sign_ids = \App\StartListItem::where('email', $driver->email)->whereIn('start_list_id', $list_id)->pluck('sign_id');
            $model = null;
            $marka = null;
            $nr_rej = null;
            $ok = true;

            $signs = \App\Sign::whereIn('id', $sign_ids)->get();

            foreach ($signs as $sign) {
                if(null != $model){
                    if($sign->model != $model || $sign->marka != $marka || $sign->nr_rej != $nr_rej)
                        $ok = false;
                }
                else{
                    $model = $sign->model;
                    $marka = $sign->marka;
                    $nr_rej = $sign->nr_rej;
                }
            }

            if(!$ok)
                $items->forget($key);
            else
                $drivers[] = $sign;
        }

        $ids = implode(array_pluck($drivers, 'id'), ',');

        return view('admin.bk_list', compact('drivers', 'ids'));
    }

    public function makeFileBk(Request $request)
    {   
        $this->validate($request, [
            'drivers' => 'required',
        ]);

        $drivers = explode(",", $request->drivers);

        $signs = \App\Sign::whereIn('id', $drivers)->get();

        return Excel::download(new BkExport($signs), 'lista.xlsx');
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

    public function osy($id)
    {
        $round = Round::where('id', $id)->with('race')->first();

        if(!$round->startList)
            return redirect()->route('race', $round->race_id)->with('info', 'Lista os-ów jest niedostępna ponieważ nie została wygenerowana lista startowa.');

        if($round)
            return view('admin.osy', compact('round'));

        return back()->with('warning', 'Runda nie istnieje');
    }

    public function saveOs(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:rounds',
            'length' => 'required|string|max:255',
            'results' => 'required|file|max:10000',
        ]);

        $round = Round::where('id', $request->id)->first();
        $length = floatval(str_replace(',', '.', $request->length));

        $file = $request->results;
        $originalName = $file->getClientOriginalName();
        $name = $file->hashName();
        $path = 'public/os/';

        \Storage::put($path, $file);

        $os = new \App\Os;
        $os->round_id = $round->id;
        $os->length = $length;
        $os->path = $name;
        $os->save();

        $this->processResults($os);

        $this->updatePlaces($round);

        $this->updateTotalSpeed($round);

        return back()->with('success', 'Os został dodany');
    }

    public function processResults(\App\Os $os)
    {
        if (($handle = fopen('public/os/'.$os->path, "r")) !== FALSE) {
          while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $sign_id = $data[17];
            $netto = $this->preprocessTime($data[9]);
            $penalty = $this->preprocessTime($data[10]);
            $brutto = $this->preprocessTime($data[11]);
            $leading_lose = $this->preprocessTime($data[12]);
            $next_lose = $this->preprocessTime($data[13]);
            $reaction = floatval(str_replace(',', '.', $data[16]));
            
            $sign = \App\Sign::where('id', $sign_id)->first();
            if($sign){
                $result = new \App\OsData;
                $result->os_id = $os->id;
                $result->sign_id = $sign_id;
                $result->netto = $netto;
                $result->penalty = $penalty;
                $result->brutto = $brutto;
                $result->leading_lose = $leading_lose;
                $result->next_lose = $next_lose;
                $result->reaction = $reaction;
                $result->speed = $this->calcSpeed($os->length, $this->timeToSecs($netto));
                $result->netto_s = $this->timeToSecs($netto);
                $result->penalty_s = $this->timeToSecs($penalty);
                $result->brutto_s = $this->timeToSecs($brutto);
                $result->leading_lose_s = $this->timeToSecs($leading_lose);
                $result->klasa = $sign->klasa;
                $result->save();
            }
          }
          fclose($handle);
        }
    }

    protected function calcSpeed($length, $time)
    {
        $s = $time;

        $speed = $length * 3600/$s;
        return $speed;
    }

    protected function preprocessTime($time)
    {
        $new = str_replace(',', '.', $time);

        if(substr_count($time,":") == 1)
            return '00:'.$new;

        return $new;
    }

    public function updatePlaces(Round $round)
    {
        $signs = [];
        $osy = $round->osy->count();

        foreach ($round->osy as $os) {
            foreach ($os->items as $item) {
                if(!array_key_exists($item->sign_id, $signs)){
                    $signs[$item->sign_id]['os'] = 1;
                    $signs[$item->sign_id]['sign'] = $item->sign;
                    $signs[$item->sign_id]['brutto'] = $this->timeToSecs($item->brutto);
                    $signs[$item->sign_id]['penalty'] = $this->timeToSecs($item->penalty);
                    $signs[$item->sign_id]['netto'] = $this->timeToSecs($item->netto);
                    $signs[$item->sign_id]['leading_lose'] = $this->timeToSecs($item->leading_lose);
                }
                else{
                    $signs[$item->sign_id]['os']++;
                    $signs[$item->sign_id]['brutto'] += $this->timeToSecs($item->brutto);
                    $signs[$item->sign_id]['penalty'] += $this->timeToSecs($item->penalty);
                    $signs[$item->sign_id]['netto'] += $this->timeToSecs($item->netto);
                    $signs[$item->sign_id]['leading_lose'] += $this->timeToSecs($item->leading_lose);
                }
            }
        }

        \App\RoundResult::where('round_id', $round->id)->delete();

        foreach ($signs as $key => $value) {
            if($value['os'] == $osy){ 
                $result = new \App\RoundResult;
                $result->round_id = $round->id;
                $result->sign_id = $key;
                $result->netto = $this->secsToTime($value['netto']);
                $result->penalty = $this->secsToTime($value['penalty']);
                $result->brutto = $this->secsToTime($value['brutto']);
                $result->leading_lose = $this->secsToTime($value['leading_lose']);
                $result->netto_s = $value['netto'];
                $result->penalty_s = $value['penalty'];
                $result->brutto_s = $value['brutto'];
                $result->leading_lose_s = $value['leading_lose'];
                $result->klasa = $value['sign']->klasa;
                $result->save();
            }
        }

        $lista = \App\StartListItem::where('start_list_id', $round->startList->id)->get();
        foreach ($lista as $value) {
            $value->points = 0;
            $value->save();
        };

        foreach ($round->results->groupBy('klasa') as $key => $value) {
            $place = 1;
            foreach ($value->take(8) as $value) {
                $star_list_item = \App\StartListItem::where('sign_id', $value->sign_id)->first();
                $star_list_item->points = $this->placeToPoints($place);
                $star_list_item->save();
                $place++;
            }
        };
    }

    public function placeToPoints($place)
    {
        switch ($place) {
            case 1:
                return 10;
                break;
            case 2:
                return 8;
                break;
            case 3:
                return 6;
                break;
            case 4:
                return 5;
                break;
            case 5:
                return 4;
                break;
            case 6:
                return 3;
                break;
            case 7:
                return 2;
                break;
            case 8:
                return 1;
                break;
            default:
                return '-';
                break;
        }
    }

    protected function timeToSecs($time)
    {
        if($time){
            $time = explode(".", $time);
            $miliseconds = $time[1];

            $time = explode(":", $time[0]);

            $total_sec = $time[0] * 3600 + $time[1] * 60 + $time[2];
            $total = $total_sec.".".$miliseconds;

            return (float)$total;
        }
        return 0;
    }

    protected function secsToTime($time)
    {
        if($time){
            $time = explode(".", number_format((float)$time, 2, '.', ''));
            $miliseconds = sprintf("%02d", $time[1]);

            $h = sprintf("%02d", floor($time[0]/3600));
            $i = sprintf("%02d", floor($time[0]/60%60));
            $s = sprintf("%02d", floor($time[0]%60));

            $total = $h.":".$i.":".$s.".".$miliseconds;

            return $total;
        }
        return 0;
    }

    public function deleteOs(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:os',
        ]);

        $os = \App\Os::where('id', $request->id)->first();

        foreach ($os->items as $item) {
            $item->delete();
        }

        \Storage::delete('public/os/'.$os->path);
        $round = $os->round;
        $os->delete();

        $this->updatePlaces($round);

        $this->updateTotalSpeed($round);

        return back()->with('success', 'Os został usunięty');
    }

    public function updateOs(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:os',
        ]);
        $length = floatval(str_replace(',', '.', $request->length));

        $os = \App\Os::where('id', $request->id)->first();
        $os->length = $length;
        $os->save();

        $this->updateSpeed($os);
        $this->updateTotalSpeed($os->round);

        return back()->with('success', 'Os został zapisany');
    }

    protected function updateSpeed(\App\Os $os)
    {
        foreach ($os->items as $item) {
            $speed = $this->calcSpeed($os->length, $this->timeToSecs($item->netto));
            $item->speed = $speed;
            $item->save();
        }
    }

    protected function updateTotalSpeed(Round $round)
    {
        $length = 0;
        $signs = [];

        foreach ($round->osy as $os) {
            $length += $os->length;

            foreach ($os->items as $item) {
                if(!array_key_exists($item->sign_id, $signs)){
                    $signs[$item->sign_id] = $this->timeToSecs($item->netto);
                }
                else{
                    $signs[$item->sign_id] += $this->timeToSecs($item->netto);
                }
            }
        }

        foreach ($signs as $key => $value) {
            $result = \App\RoundResult::where('round_id', $round->id)->where('sign_id', $key)->first();
            if($result){
                $speed = $this->calcSpeed($length, $value);

                $result->speed = $speed;
                $result->save();
            }
        }
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
    

    public function service($id)
    {
        $round = Round::where('id', $id)->first();

        if($round){
            $items = \App\Service::where('round_id', $round->id)->with('sign', 'partner')->orderBy('sign_id', 'asc')->get();

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

            return view('admin.service', compact('collection', 'round'));
        }

        return back()->with('warning', 'Runda nie istnieje');
    }   
}
