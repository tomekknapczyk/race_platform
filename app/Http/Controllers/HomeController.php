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
        $this->middleware('auth');
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

        return view('dashboard', compact('forms', 'lists', 'races'));
    }

    public function startList($id)
    {
        $round = \App\Round::where('id', $id)->first();

        if($round){
            return view('list', compact('round'));
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

        if($race)
            return view('rank', compact('race'));

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

        return redirect()->back()->with('warning', 'Pilot nie istnieje');
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

        return redirect()->back()->with('warning', 'Samochód nie istnieje');
    }
}
