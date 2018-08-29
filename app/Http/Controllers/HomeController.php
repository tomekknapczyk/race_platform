<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['rank', 'startList']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->admin)
            return view('admin.dashboard');
        
        $forms = \App\SignForm::where('active', 1)->get();

        $lists = \App\StartList::latest()->get();

        $races = \App\Race::latest()->get();


        return view('dashboard', compact('forms', 'lists', 'races', 'closest'));
    }

    public function startList($id)
    {
        $round = \App\Round::where('id', $id)->first();

        if($round){
            $start_list_id = $round->startList->id;
            $is_someone = $round->startPositions($start_list_id)->count();
            $class = $round->klasy($start_list_id);
            
            return view('startList', compact('round', 'is_someone', 'class', 'start_list_id'));
        }

        return back()->with('warning', 'Lista startowa nie istnieje');
    }

    public function signList($id)
    {
        $round = \App\Round::where('id', $id)->first();

        if($round){
            $signs = $round->signs();
            $klasy = $signs->sortBy('klasa')->pluck('klasa', 'klasa');
            $max = $round->max;
            $drivers = 0;
            $class = [];

            foreach ($signs as $key => $sign) {
                $drivers++;

                if($drivers <= $max)
                    $class[$sign->klasa][$key]['sign'] = $sign;
            }

            return view('signList', compact('round', 'klasy', 'class'));
        }

        return back()->with('warning', 'Lista startowa nie istnieje');
    }

    public function register_form($id)
    {
        $form = \App\SignForm::where('id', $id)->first();

        if($form){
            $data = $form->signs->where('user_id', auth()->user()->id)->first();
            $pdf = PDF::loadView('pdf.form', compact('data', 'form'));
            return $pdf->download('formularz.pdf');
        }

        return back()->with('warning', 'Lista nie istnieje');
    }

    public function rank($id)
    {
        $race = \App\Race::where('id', $id)->first();
        $klasy = $race->klasy();
        $race_id = $id;
        if($race)
            return view('rank', compact('race', 'klasy', 'race_id'));

        return back()->with('warning', 'Rajd nie istnieje');
    }

    public function getKlasa(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:cars',
        ]);

        $car = \App\Car::where('id', $request->id)->first();

        if($car->turbo)
            return '<option value="k4">K4</option>';

        if($car->rwd)
            if($car->ccm < 800)
                return '<option value="k5">Fiat 126p z silnikiem markowym</option><option value="k7">K7</option>';
            else
                return '<option value="k7">K7</option>';

        if($car->ccm <= 1400)
            return '<option value="k1">K1</option><option value="k6">Fiat SC i CC z silnikiem do poj. 1242 cm3 8v</option>';

        if($car->ccm <= 1600)
            return '<option value="k2">K2</option>';

        if($car->ccm <= 2000)
            return '<option value="k3">K3</option>';

        return '<option value="k4">K4</option>';
    }

    public function getPilot(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:pilots',
        ]);

        $pilot = \App\Pilot::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
        
        if($pilot){
            return response()->json($pilot);
        }

        return back()->with('warning', 'Pilot nie istnieje');
    }

    public function getCar(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:cars',
        ]);

        $car = \App\Car::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
        
        if($car){
            return response()->json($car);
        }

        return back()->with('warning', 'Samochód nie istnieje');
    }

    public function banner()
    {
        $banner = \App\SiteInfo::where('name', 'banner')->first();

        return view('admin.banner', compact('banner'));
    }

    public function saveBanner(Request $request)
    {
        $banner = \App\SiteInfo::where('name', 'banner')->first();

        if(!$banner){
            $banner = new \App\SiteInfo;
            $banner->name = 'banner';
        }

        $banner->active = isset($request->showBanner)?1:0;
        $banner->value = $request->info;

        $banner->save();

        return back()->with('success', 'Komunikat został zapisany');
    }

    public function contactInfo()
    {
        $contactFirstName = \App\SiteInfo::where('name', 'kontakt_first_name')->first();
        $contactFirstTel = \App\SiteInfo::where('name', 'kontakt_first_tel')->first();
        $contactSecondName = \App\SiteInfo::where('name', 'kontakt_second_name')->first();
        $contactSecondTel = \App\SiteInfo::where('name', 'kontakt_second_tel')->first();
        $contactEmail= \App\SiteInfo::where('name', 'kontakt_email')->first();

        return view('admin.contactInfo', compact('contactFirstName', 'contactFirstTel', 'contactSecondName', 'contactSecondTel', 'contactEmail'));
    }

    public function saveInfo(Request $request)
    {
        $contactFirstName = \App\SiteInfo::where('name', 'kontakt_first_name')->first();
        $contactFirstTel = \App\SiteInfo::where('name', 'kontakt_first_tel')->first();
        $contactSecondName = \App\SiteInfo::where('name', 'kontakt_second_name')->first();
        $contactSecondTel = \App\SiteInfo::where('name', 'kontakt_second_tel')->first();
        $contactEmail= \App\SiteInfo::where('name', 'kontakt_email')->first();

        if(!$contactFirstName){
            $contactFirstName = new \App\SiteInfo;
            $contactFirstName->name = 'kontakt_first_name';
        }
        $contactFirstName->value = $request->kontakt_first_name;
        $contactFirstName->save();

        if(!$contactFirstTel){
            $contactFirstTel = new \App\SiteInfo;
            $contactFirstTel->name = 'kontakt_first_tel';
        }
        $contactFirstTel->value = $request->kontakt_first_tel;
        $contactFirstTel->save();

        if(!$contactSecondName){
            $contactSecondName = new \App\SiteInfo;
            $contactSecondName->name = 'kontakt_second_name';
        }
        $contactSecondName->value = $request->kontakt_second_name;
        $contactSecondName->save();

        if(!$contactSecondTel){
            $contactSecondTel = new \App\SiteInfo;
            $contactSecondTel->name = 'kontakt_second_tel';
        }
        $contactSecondTel->value = $request->kontakt_second_tel;
        $contactSecondTel->save();

        if(!$contactEmail){
            $contactEmail = new \App\SiteInfo;
            $contactEmail->name = 'kontakt_email';
        }
        $contactEmail->value = $request->kontakt_email;
        $contactEmail->save();

        return back()->with('success', 'Dane zostały zapisane');
    }
}
