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

    public function saveDriver(Request $request)
    {
        $this->validate($request, [
            'name' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'address' => 'nullable|max:500',
            'id_card' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'driving_license' => 'nullable|string|max:255',
            'oc' => 'nullable|string|max:255',
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
        $driver->email = $request->email;
        $driver->driving_license = $request->driving_license;
        $driver->oc = $request->oc;
        $driver->nw = $request->nw;

        $driver->save();

        return redirect()->back()->with('success', 'Profil kierowcy został zapisany');
    }

    public function savePilot(Request $request)
    {
        $this->validate($request, [
            'name' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'address' => 'nullable|max:500',
            'id_card' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'driving_license' => 'nullable|string|max:255',
            'oc' => 'nullable|string|max:255',
            'nw' => 'nullable|string|max:255',
        ]);

        $pilot = Pilot::where('user_id', auth()->user()->id)->first();

        if(!$pilot){
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
}
