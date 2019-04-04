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
        if($partners->count())
            $promoted = $partners->where('promoted',1)->random();

        $today = date('Y-m-d H:i:s');

        $closest = \App\Round::where('date', '>', $today)->with('form', 'race', 'form.signs')->orderBy('date', 'asc')->first();
        $last = \App\Round::where('date', '<', $today)->with('race')->orderBy('date', 'desc')->first();
        
        $promoted_race = \App\SiteInfo::where('name', 'promoted_race')->first();
        $podium = null;
        $random = null;
        if($last && $last->startList){
            $start_list_id = $last->startList->id;
            $klasy = $last->klasy($start_list_id);
            $random = $klasy->random();

            if($promoted_race){
                if($promoted_race->value == 'race'){
                    $klasy = $last->race->klasy();
                    if(count($klasy)){
                        $random = array_rand($klasy);
                        $random = $klasy[$random];
                        $podium = $last->race->klasa_rank($random);
                    }
                    else{
                        $podium = $last->podium($start_list_id, $random);
                    }
                }
                else
                    $podium = $last->podium($start_list_id, $random);
            }
            else
                $podium = $last->podium($start_list_id, $random);
        }

        return view('home', compact('news', 'promoted', 'closest', 'podium', 'random', 'promoted_race', 'last'));
    }

    public function podium($id)
    {
        $round = \App\Round::where('id', $id)->first();
        
        if($round && $round->startList){
            $start_list_id = $round->startList->id;
            $klasy = $round->klasy($start_list_id)->toArray();

            // $order = array('k4', 'k7', 'k3', 'k2', 'k1', 'k6', 'k5');
            $order = explode(',', $round->order);

            usort($klasy, function ($a, $b) use ($order) {
              $pos_a = array_search($a, $order);
              $pos_b = array_search($b, $order);
              return $pos_a - $pos_b;
            });

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
        $users = \App\User::where('admin', 0)->where('active', 1)->where('driver', 1)->with('profile', 'profile.file', 'laurel_first', 'laurel_second', 'laurel_third', 'laurels')->get();

        return view('drivers', compact('users'));
    }

    public function pilots()
    {
        $pilots = \App\User::where('admin', 0)->where('active', 1)->where('driver', 0)->with('profile', 'profile.file', 'laurel_first', 'laurel_second', 'laurel_third', 'laurels')->get();

        return view('pilots-list', compact('pilots'));
    }

    public function driver($id, $name = null)
    {
        $user = \App\User::where('admin', 0)->where('active', 1)->where('id', $id)->where('driver', 1)->with('profile', 'profile.file', 'pilots', 'pilots.file', 'cars', 'cars.file', 'races', 'races.sign', 'races.startList', 'races.startList.round', 'races.startList.round.race')->first();

        if(!$user)
            return back()->with('danger', 'Kierowca nie istnieje');

        return view('driver', compact('user'));
    }

    public function pilot($id, $name = null)
    {
        $user = \App\User::where('admin', 0)->where('active', 1)->where('id', $id)->where('driver', 0)->with('profile', 'profile.file', 'races', 'races.sign', 'races.startList', 'races.startList.round', 'races.startList.round.race')->first();

        if(!$user)
            return back()->with('danger', 'Pilot nie istnieje');

        return view('pilot', compact('user'));
    }

    public function video()
    {
        $liveVideo = \App\SiteInfo::where('name', 'live_video')->first();

        return view('video', compact('liveVideo'));
    }

    public function wyniki()
    {
        $races = \App\Race::with('rounds', 'rounds.startList')->latest()->get();

        return view('wyniki_over', compact('races'));

        // Na obecny sezon
        // return view('wyniki_over');
    }

    public function regulamin()
    {
        $regulamin = \App\SiteInfo::where('name', 'terms')->first();

        return view('regulamin', compact('regulamin'));
    }

    public function policy()
    {
        $policy = \App\SiteInfo::where('name', 'policy')->first();

        return view('policy', compact('policy'));
    }

    public function dokumenty()
    {
        $docs = \App\Docs::with('file')->get();
        $race = \App\Race::where('active', 1)->with('rounds', 'rounds.file', 'forms', 'forms.round', 'forms.round.race')->first();
        $regulaminy = null;
        $forms = null;
        if($race){
            $regulaminy = $race->rounds->where('file_id', '!=', null);
            $forms = $race->forms->where('visible', 1);
        }

        return view('dokumenty', compact('docs', 'regulaminy', 'forms'));
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
        $round = \App\Round::where('id', $id)->with('race')->first();

        if($round){
            $start_list_id = $round->startList->id;
            
            $ukonczyli = [];
            $osy = $round->osy->count();

            foreach ($round->startPositions($start_list_id) as $key => $value) {                
                if($value->result->count() == $osy)
                    $ukonczyli[] = $value->sign_id;
            }
            $endPositions = $round->results->whereIn('sign_id', $ukonczyli)->load('sign.user.profile.file', 'sign.car.file');
            $is_someone = $endPositions->count();
            $class = $endPositions->sortBy('klasa')->pluck('klasa', 'klasa')->toArray();

            $order = explode(',', $round->order);

            usort($class, function ($a, $b) use ($order) {
              $pos_a = array_search($a, $order);
              $pos_b = array_search($b, $order);
              return $pos_a - $pos_b;
            });

            $teams = [];

            foreach ($endPositions as $result) {
                if($result->sign->team){
                    if(!in_array($result->sign->team, $teams))
                        $teams[] = $result->sign->team;
                }
            }

            foreach ($teams as $key => $team) {
                $results = $team->round_results($id);
                if($results['rounds']){
                    $team['points'] = $results;
                }
                else{
                    unset($teams[$key]);
                }
            }

            usort($teams, array($this, "compare"));

            $accreditations = \App\PressSign::where('round_id', $round->id)->get()->groupBy('user_id');
            
            return view('wyniki_runda', compact('round', 'is_someone', 'class', 'start_list_id', 'endPositions', 'teams', 'accreditations'));
        }

        return back()->with('warning', 'Lista startowa nie istnieje');
    }

    public function compare($a, $b)
    {
       return ($a['points']< $b['points']);
    }

    public function rank_frame(Request $request)
    {
        $path = $request->path;
        $name = $request->name;

        return view('rank_frame', compact('path', 'name'));
    }

    public function media()
    {
        $media = \App\User::where('admin', 0)->where('driver', 2)->where('active', 1)->get();

        $race = \App\Race::where('active', 1)->first();

        $accreditations = [];

        foreach ($race->rounds as $round) {
            $accreditations[$round->id] = $round->accreditations;
        }

        return view('media', compact('media', 'accreditations', 'race'));
    }

    public function redakcja($id)
    {
        $user = \App\User::where('admin', 0)->where('active', 1)->where('id', $id)->where('driver', 2)->with('profile', 'profile.file', 'staff')->first();

        if(!$user)
            return back()->with('danger', 'Redakcja nie istnieje');

        return view('redakcja', compact('user'));
    }

    public function akredytacje($id)
    {
        $round = \App\Round::where('id', $id)->with('race')->first();

        if($round){
            $accreditations = \App\PressSign::where('round_id', $round->id)->get()->groupBy('user_id');

            return view('akredytacje', compact('accreditations', 'round'));
        }

        return back()->with('warning', 'Runda nie istnieje');
    }

    public function comparsion(Request $request)
    {
        $this->validate($request, [
            'round'    => 'required|exists:rounds,id',
            'compare1' => 'required|exists:signs,id',
            'compare2' => 'required|exists:signs,id'
        ]);

        $round = \App\Round::where('id', $request->round)->first();
        $c1 = \App\Sign::where('id', $request->compare1)->with('osDataFull')->first();
        $c2 = \App\Sign::where('id', $request->compare2)->with('osDataFull')->first();
        $c3 = null;
        if(isset($request->compare3))
            $c3 = \App\Sign::where('id', $request->compare3)->with('osDataFull')->first();

        $oesy = [];

        foreach ($round->osy as $key => $os) {
            $oesy[$key] = [];
            $oesy[$key]['os_id'] = $os->id;
            $oesy[$key]['brutto'] = 0;
            $oesy[$key]['penalty'] = 0;
            $oesy[$key]['reaction'] = 0;
            $oesy[$key]['speed'] = 0;
            $oesy[$key]['leading_lose'] = 0;
            $oesy[$key]['total_rank'] = 0;

            if($c1->osDataFull->where('os_id', $os->id)->first()){
                $oesy[$key]['c1']['brutto'] = $c1->osDataFull->where('os_id', $os->id)->first()->brutto;
                $oesy[$key]['c1']['penalty'] = $c1->osDataFull->where('os_id', $os->id)->first()->penalty;
                $oesy[$key]['c1']['reaction'] = $c1->osDataFull->where('os_id', $os->id)->first()->reaction;
                $oesy[$key]['c1']['speed'] = $c1->osDataFull->where('os_id', $os->id)->first()->speed;
                $oesy[$key]['c1']['leading_lose'] = $c1->osDataFull->where('os_id', $os->id)->first()->leading_lose;
                if($c1->os_rank($os->id) == '-') 
                    $oesy[$key]['c1']['total_rank'] = 0;
                else
                    $oesy[$key]['c1']['total_rank'] = $c1->os_rank($os->id);

                $oesy[$key]['brutto'] = $oesy[$key]['c1']['brutto'];
                $oesy[$key]['penalty'] = $oesy[$key]['c1']['penalty'];
                $oesy[$key]['reaction'] = ($oesy[$key]['c1']['reaction']>0)?$oesy[$key]['c1']['reaction']:0;
                $oesy[$key]['speed'] = $oesy[$key]['c1']['speed'];
                $oesy[$key]['leading_lose'] = $oesy[$key]['c1']['leading_lose'];
                $oesy[$key]['total_rank'] = $oesy[$key]['c1']['total_rank'];
            }

            if($c2->osDataFull->where('os_id', $os->id)->first()){
                $oesy[$key]['c2']['brutto'] = $c2->osDataFull->where('os_id', $os->id)->first()->brutto;
                $oesy[$key]['c2']['penalty'] = $c2->osDataFull->where('os_id', $os->id)->first()->penalty;
                $oesy[$key]['c2']['reaction'] = $c2->osDataFull->where('os_id', $os->id)->first()->reaction;
                $oesy[$key]['c2']['speed'] = $c2->osDataFull->where('os_id', $os->id)->first()->speed;
                $oesy[$key]['c2']['leading_lose'] = $c2->osDataFull->where('os_id', $os->id)->first()->leading_lose;
                if($c2->os_rank($os->id) == '-') 
                    $oesy[$key]['c2']['total_rank'] = 0;
                else
                    $oesy[$key]['c2']['total_rank'] = $c2->os_rank($os->id);

                if($c1->osDataFull->where('os_id', $os->id)->first()){
                    $oesy[$key]['brutto'] = min($oesy[$key]['c1']['brutto'], $oesy[$key]['c2']['brutto']);
                    $oesy[$key]['penalty'] = min($oesy[$key]['c1']['penalty'], $oesy[$key]['c2']['penalty']);
                    $oesy[$key]['reaction'] = min(($oesy[$key]['c1']['reaction']>0)?$oesy[$key]['c1']['reaction']:9999, ($oesy[$key]['c2']['reaction']>0)?$oesy[$key]['c2']['reaction']:9999);
                    $oesy[$key]['speed'] = max($oesy[$key]['c1']['speed'], $oesy[$key]['c2']['speed']);
                    $oesy[$key]['leading_lose'] = min($oesy[$key]['c1']['leading_lose'], $oesy[$key]['c2']['leading_lose']);
                    $oesy[$key]['total_rank'] = min(array_diff(array($oesy[$key]['c1']['total_rank'], $oesy[$key]['c2']['total_rank']), array(null)));
                }
                else{
                    $oesy[$key]['brutto'] = $oesy[$key]['c2']['brutto'];
                    $oesy[$key]['penalty'] = $oesy[$key]['c2']['penalty'];
                    $oesy[$key]['reaction'] = ($oesy[$key]['c2']['reaction']>0)?$oesy[$key]['c2']['reaction']:0;
                    $oesy[$key]['speed'] = $oesy[$key]['c2']['speed'];
                    $oesy[$key]['leading_lose'] = $oesy[$key]['c2']['leading_lose'];
                    $oesy[$key]['total_rank'] = $oesy[$key]['c2']['total_rank'];
                }
            }

            if($c3){
                if($c3->osDataFull->where('os_id', $os->id)->first()){
                    $oesy[$key]['c3']['brutto'] = $c3->osDataFull->where('os_id', $os->id)->first()->brutto;
                    $oesy[$key]['c3']['penalty'] = $c3->osDataFull->where('os_id', $os->id)->first()->penalty;
                    $oesy[$key]['c3']['reaction'] = $c3->osDataFull->where('os_id', $os->id)->first()->reaction;
                    $oesy[$key]['c3']['speed'] = $c3->osDataFull->where('os_id', $os->id)->first()->speed;
                    $oesy[$key]['c3']['leading_lose'] = $c3->osDataFull->where('os_id', $os->id)->first()->leading_lose;
                    if($c3->os_rank($os->id) == '-')
                        $oesy[$key]['c3']['total_rank'] = 0;
                    else
                        $oesy[$key]['c3']['total_rank'] = $c3->os_rank($os->id);

                    if($c1->osDataFull->where('os_id', $os->id)->first() && $c2->osDataFull->where('os_id', $os->id)->first()) {
                        $oesy[$key]['brutto'] = min($oesy[$key]['c1']['brutto'], $oesy[$key]['c2']['brutto'], $oesy[$key]['c3']['brutto']);
                        $oesy[$key]['penalty'] = min($oesy[$key]['c1']['penalty'], $oesy[$key]['c2']['penalty'], $oesy[$key]['c3']['penalty']);
                        $oesy[$key]['reaction'] = min(($oesy[$key]['c1']['reaction']>0)?$oesy[$key]['c1']['reaction']:9999, ($oesy[$key]['c2']['reaction']>0)?$oesy[$key]['c2']['reaction']:9999, ($oesy[$key]['c3']['reaction']>0)?$oesy[$key]['c3']['reaction']:9999);
                        $oesy[$key]['speed'] = max($oesy[$key]['c1']['speed'], $oesy[$key]['c2']['speed'], $oesy[$key]['c3']['speed']);
                        $oesy[$key]['leading_lose'] = min($oesy[$key]['c1']['leading_lose'], $oesy[$key]['c2']['leading_lose'], $oesy[$key]['c3']['leading_lose']);
                        $oesy[$key]['total_rank'] = min(array_diff(array($oesy[$key]['c1']['total_rank'], $oesy[$key]['c2']['total_rank'], $oesy[$key]['c3']['total_rank']), array(null)));
                    }
                    elseif($c1->osDataFull->where('os_id', $os->id)->first()){
                        $oesy[$key]['brutto'] = min($oesy[$key]['c1']['brutto'], $oesy[$key]['c3']['brutto']);
                        $oesy[$key]['penalty'] = min($oesy[$key]['c1']['penalty'], $oesy[$key]['c3']['penalty']);
                        $oesy[$key]['reaction'] = min(($oesy[$key]['c1']['reaction']>0)?$oesy[$key]['c1']['reaction']:9999, ($oesy[$key]['c3']['reaction']>0)?$oesy[$key]['c3']['reaction']:9999);
                        $oesy[$key]['speed'] = max($oesy[$key]['c1']['speed'], $oesy[$key]['c3']['speed']);
                        $oesy[$key]['leading_lose'] = min($oesy[$key]['c1']['leading_lose'], $oesy[$key]['c3']['leading_lose']);
                        $oesy[$key]['total_rank'] = min(array_diff(array($oesy[$key]['c1']['total_rank'], $oesy[$key]['c3']['total_rank']), array(null)));
                    }
                    elseif($c2->osDataFull->where('os_id', $os->id)->first()){
                        $oesy[$key]['brutto'] = min($oesy[$key]['c2']['brutto'], $oesy[$key]['c3']['brutto']);
                        $oesy[$key]['penalty'] = min($oesy[$key]['c2']['penalty'], $oesy[$key]['c3']['penalty']);
                        $oesy[$key]['reaction'] = min(($oesy[$key]['c2']['reaction']>0)?$oesy[$key]['c2']['reaction']:9999, ($oesy[$key]['c3']['reaction']>0)?$oesy[$key]['c3']['reaction']:9999);
                        $oesy[$key]['speed'] = max($oesy[$key]['c2']['speed'], $oesy[$key]['c3']['speed']);
                        $oesy[$key]['leading_lose'] = min($oesy[$key]['c2']['leading_lose'], $oesy[$key]['c3']['leading_lose']);
                        $oesy[$key]['total_rank'] = min(array_diff(array($oesy[$key]['c2']['total_rank'], $oesy[$key]['c3']['total_rank']), array(null)));
                    }
                    else{
                        $oesy[$key]['brutto'] = $oesy[$key]['c3']['brutto'];
                        $oesy[$key]['penalty'] = $oesy[$key]['c3']['penalty'];
                        $oesy[$key]['reaction'] = ($oesy[$key]['c3']['reaction']>0)?$oesy[$key]['c3']['reaction']:0;
                        $oesy[$key]['speed'] = $oesy[$key]['c3']['speed'];
                        $oesy[$key]['leading_lose'] = $oesy[$key]['c3']['leading_lose'];
                        $oesy[$key]['total_rank'] = $oesy[$key]['c3']['total_rank'];
                    }
                }
            }
        }

        return view('comparsion', compact('round', 'c1', 'c2', 'c3', 'oesy'));
    }
}
