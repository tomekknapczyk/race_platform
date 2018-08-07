<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Driver;
use App\Pilot;
use App\Car;

class UserController extends Controller
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


    public function settings()
    {
        return view('settings');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password))
            return redirect()->back()->withInput()->withErrors('Złe hasło');
        
        auth()->user()->password = Hash::make($request->password);
        auth()->user()->save();

        return redirect()->back()->with('success', 'Hasło zostało zmienione');
    }

    public function driverProfile()
    {
        return view('driver-profile');
    }

    public function pilotProfile()
    {
        return view('pilot-profile');
    }

    public function car()
    {
        return view('car');
    }

    public function pilots()
    {
        return view('pilots');
    }

    public function cars()
    {
        return view('cars');
    }

    public function saveDriver(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|max:500',
            'id_card' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'driving_license' => 'required|string|max:255',
            'oc' => 'required|string|max:255',
            'nw' => 'nullable|string|max:255',
        ]);

        $driver = Driver::where('user_id', auth()->user()->id)->first();

        if(!$driver){
            $driver = new Driver;
            $driver->user_id = auth()->user()->id;
        }

        $driver->name = $request->name;
        $driver->lastname = $request->lastname;
        $driver->address = $request->address;
        $driver->id_card = $request->id_card;
        $driver->phone = $request->phone;
        $driver->driving_license = $request->driving_license;
        $driver->oc = $request->oc;
        $driver->nw = $request->nw;

        $driver->save();

        return redirect()->back()->with('success', 'Profil kierowcy został zapisany');
    }

    public function savePilot(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'nullable|max:500',
            'id_card' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'driving_license' => 'nullable|string|max:255',
            'oc' => 'nullable|string|max:255',
            'nw' => 'nullable|string|max:255',
        ]);

        if(isset($request->id)){
            $pilot = Pilot::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
        }
        else{
            $pilot = new Pilot;
            $pilot->user_id = auth()->user()->id;
        }

        $pilot->name = $request->name;
        $pilot->lastname = $request->lastname;
        $pilot->address = $request->address;
        $pilot->id_card = $request->id_card;
        $pilot->phone = $request->phone;
        $pilot->email = $request->email;
        $pilot->driving_license = $request->driving_license;
        $pilot->oc = $request->oc;
        $pilot->nw = $request->nw;

        $pilot->save();

        return redirect()->back()->with('success', 'Profil pilota został zapisany');
    }

    public function deletePilot(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:pilots',
        ]);

        $pilot = Pilot::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
        
        if($pilot){
            $pilot->delete();
            return redirect()->back()->with('success', 'Pilot został usunięty');
        }

        return redirect()->back()->with('warning', 'Pilot nie istnieje');
    }

    public function saveCar(Request $request)
    {
        $this->validate($request, [
            'marka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'rok' => 'required|max:255',
            'nr_rej' => 'required|string|max:255',
            'ccm' => 'required|string|max:255',
        ]);

        if(isset($request->id)){
            $car = Car::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
        }
        else{
            $car = new Car;
            $car->user_id = auth()->user()->id;
        }
       
        $car->marka = $request->marka;
        $car->model = $request->model;
        $car->rok = $request->rok;
        $car->nr_rej = $request->nr_rej;
        $car->ccm = $request->ccm;
        $car->turbo = false;
        $car->rwd = false;
        if(isset($request->turbo))
            $car->turbo = true;
        if(isset($request->rwd))
            $car->rwd = true;
        $car->save();

        return redirect()->back()->with('success', 'Samochód został zapisany');
    }

    public function deleteCar(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:cars',
        ]);

        $car = Car::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
        
        if($car){
            $car->delete();
            return redirect()->back()->with('success', 'Samochód został usunięty');
        }

        return redirect()->back()->with('warning', 'Samochód nie istnieje');
    }
}