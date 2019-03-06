<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Driver;
use App\Pilot;
use App\Car;
use App\User;

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

    public function list()
    {
        $users = User::where('admin', 0)->with('profile', 'laurel_first', 'laurel_second', 'laurel_third', 'profile.file', 'pilots', 'pilots.file', 'cars', 'cars.file')->get();

        return view('admin.drivers', compact('users'));
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

    public function regenerateUid(Request $request)
    {
        \App\SavedId::where('uid', auth()->user()->uid)->delete();
        auth()->user()->uid = $this->generate_uid();
        auth()->user()->save();

        return redirect()->back()->with('success', 'Id zostało zmienione');
    }

    public function driverProfile()
    {
        return view('driver-profile');
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
            // 'oc' => 'required|string|max:255',
            // 'nw' => 'nullable|string|max:255',
            'photo' => 'nullable|mimes:jpeg,bmp,png',
        ]);

        if(auth()->user()->admin)
            $driver = Driver::where('id', $request->id)->first();
        else{
            $driver = Driver::where('user_id', auth()->user()->id)->first();

            if(!$driver){
                $driver = new Driver;
                $driver->user_id = auth()->user()->id;
            }
        }

        $driver->name = $request->name;
        $driver->lastname = $request->lastname;
        $driver->address = $request->address;
        $driver->id_card = $request->id_card;
        $driver->phone = $request->phone;
        $driver->driving_license = $request->driving_license;
        // $driver->oc = $request->oc;
        // $driver->nw = $request->nw;
        $driver->show_name = isset($request->showName)?1:0;
        $driver->show_lastname = isset($request->showLastname)?1:0;
        $driver->show_email = isset($request->showEmail)?1:0;
        $driver->desc = $request->text;

        if($request->photo){
            $photo = \App\File::where('id',$driver->file_id)->first();
            if($photo){
                \Storage::delete('public/driver/'.$photo->path);
                \Storage::delete('public/driver/thumb/'.$photo->path);
                $photo->delete();
            }

            $file = $request->photo;
            $originalName = $file->getClientOriginalName();
            $name = $file->hashName();
            $path = 'public/driver/';

            \Storage::put($path, $file);

            $pathThumbnail = $file->hashName('public/driver/thumb');
            $thumbnail = \Image::make($file);
            $thumb = $thumbnail->widen(600, function ($constraint) {
                                    $constraint->upsize();
                                })->encode('jpg', 95);
            \Storage::put($pathThumbnail, (string) $thumb->encode());

            $storeFile = new \App\File();
            $storeFile->name = $originalName;
            $storeFile->path = $name;
            $storeFile->save();

            $driver->file_id = $storeFile->id;
        }

        if($request->deletePhoto){
            $photo = \App\File::where('id',$driver->file_id)->first();
            if($photo){
                \Storage::delete('public/driver/'.$photo->path);
                \Storage::delete('public/driver/thumb/'.$photo->path);
                $photo->delete();
            }

            $driver->file_id = null;
        }

        $driver->save();

        return redirect()->back()->with('success', 'Profil został zapisany');
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
            // 'oc' => 'nullable|string|max:255',
            // 'nw' => 'nullable|string|max:255',
            'photo' => 'nullable|mimes:jpeg,bmp,png'
        ]);

        if(auth()->user()->admin)
            $pilot = Pilot::where('id', $request->id)->first();
        else{
            if(isset($request->id)){
                $pilot = Pilot::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
            }
            else{
                $pilot = new Pilot;
                $pilot->user_id = auth()->user()->id;
            }
        }

        $pilot->name = $request->name;
        $pilot->lastname = $request->lastname;
        $pilot->address = $request->address;
        $pilot->id_card = $request->id_card;
        $pilot->phone = $request->phone;
        $pilot->email = $request->email;
        $pilot->driving_license = $request->driving_license;
        // $pilot->oc = $request->oc;
        // $pilot->nw = $request->nw;
        $pilot->show_name = isset($request->showName)?1:0;
        $pilot->show_lastname = isset($request->showLastname)?1:0;
        $pilot->show_email = isset($request->showEmail)?1:0;

        if($request->photo){
            $photo = \App\File::where('id',$pilot->file_id)->first();
            if($photo){
                \Storage::delete('public/pilot/'.$photo->path);
                \Storage::delete('public/pilot/thumb/'.$photo->path);
                $photo->delete();
            }

            $file = $request->photo;
            $originalName = $file->getClientOriginalName();
            $name = $file->hashName();
            $path = 'public/pilot/';

            \Storage::put($path, $file);

            $pathThumbnail = $file->hashName('public/pilot/thumb');
            $thumbnail = \Image::make($file);
            $thumb = $thumbnail->widen(600, function ($constraint) {
                                    $constraint->upsize();
                                })->encode('jpg', 95);
            \Storage::put($pathThumbnail, (string) $thumb->encode());

            $storeFile = new \App\File();
            $storeFile->name = $originalName;
            $storeFile->path = $name;
            $storeFile->save();

            $pilot->file_id = $storeFile->id;
        }

        if($request->deletePhoto){
            $photo = \App\File::where('id',$pilot->file_id)->first();
            if($photo){
                \Storage::delete('public/pilot/'.$photo->path);
                \Storage::delete('public/pilot/thumb/'.$photo->path);
                $photo->delete();
            }

            $pilot->file_id = null;
        }

        $pilot->save();

        return redirect()->back()->with('success', 'Profil został zapisany');
    }

    public function deletePilot(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:pilots',
        ]);

        $pilot = Pilot::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
        
        if($pilot){
            
            if($pilot->file_id){
                $photo = \App\File::where('id',$pilot->file_id)->first();
                if($photo){
                    \Storage::delete('public/pilot/'.$photo->path);
                    \Storage::delete('public/pilot/thumb/'.$photo->path);
                    $photo->delete();
                }
            }

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
            'photo' => 'nullable|mimes:jpeg,bmp,png',
            'oc' => 'required',
            'silnik' => 'required|nullable',
        ]);

        if(auth()->user()->admin)
            $car = Car::where('id', $request->id)->first();
        else{
            if(isset($request->id)){
                $car = Car::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
            }
            else{
                $car = new Car;
                $car->user_id = auth()->user()->id;
            }
        }
       
        $car->marka = $request->marka;
        $car->model = $request->model;
        $car->rok = $request->rok;
        $car->nr_rej = $request->nr_rej;
        $car->ccm = $request->ccm;
        $car->oc = $request->oc;
        $car->nw = $request->nw;
        $car->turbo = false;
        $car->rwd = false;
        $car->diesel = $request->silnik;
        if(isset($request->turbo))
            $car->turbo = true;
        if(isset($request->rwd))
            $car->rwd = true;

        if($request->photo){
            $photo = \App\File::where('id',$car->file_id)->first();
            if($photo){
                \Storage::delete('public/car/'.$photo->path);
                \Storage::delete('public/car/thumb/'.$photo->path);
                $photo->delete();
            }

            $file = $request->photo;
            $originalName = $file->getClientOriginalName();
            $name = $file->hashName();
            $path = 'public/car/';

            \Storage::put($path, $file);

            $pathThumbnail = $file->hashName('public/car/thumb');
            $thumbnail = \Image::make($file);
            $thumb = $thumbnail->widen(250, function ($constraint) {
                                    $constraint->upsize();
                                })->encode('jpg', 95);
            \Storage::put($pathThumbnail, (string) $thumb->encode());

            $storeFile = new \App\File();
            $storeFile->name = $originalName;
            $storeFile->path = $name;
            $storeFile->save();

            $car->file_id = $storeFile->id;
        }

        if($request->deletePhoto){
            $photo = \App\File::where('id',$car->file_id)->first();
            if($photo){
                \Storage::delete('public/car/'.$photo->path);
                \Storage::delete('public/car/thumb/'.$photo->path);
                $photo->delete();
            }

            $car->file_id = null;
        }

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
            if($car->file_id){
                $photo = \App\File::where('id',$car->file_id)->first();
                if($photo){
                    \Storage::delete('public/car/'.$photo->path);
                    \Storage::delete('public/car/thumb/'.$photo->path);
                    $photo->delete();
                }
            }

            $car->delete();
            return redirect()->back()->with('success', 'Samochód został usunięty');
        }

        return redirect()->back()->with('warning', 'Samochód nie istnieje');
    }

    protected function generate_uid()
    {
        $uid = str_random(10);

        $exist = User::where('uid', $uid)->first();

        if($exist)
            $uid = $this->generate_uid();

        return $uid;
    }

    public function banUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:users',
        ]);

        $user = User::where('id', $request->id)->first();
        $user->active = 0;
        $user->save();

        return redirect()->back()->with('success', 'Użytkownik został zablokowany');
    }

    public function unbanUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:users',
        ]);

        $user = User::where('id', $request->id)->first();
        $user->active = 1;
        $user->save();

        return redirect()->back()->with('success', 'Użytkownik został odblokowany');
    }

    public function deleteProfile(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:users',
        ]);

        $user = User::where('id', $request->id)->first();

        if($user->profile){
            $photo = \App\File::where('id',$user->profile->file_id)->first();
            if($photo){
                \Storage::delete('public/driver/'.$photo->path);
                \Storage::delete('public/driver/thumb/'.$photo->path);
                $photo->delete();
            }
            $user->profile->delete();
        }

        $pilot = Pilot::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
        
        if($user->pilots){
            foreach ($user->pilots as $pilot) {
                if($pilot->file_id){
                    $photo = \App\File::where('id',$pilot->file_id)->first();
                    if($photo){
                        \Storage::delete('public/pilot/'.$photo->path);
                        \Storage::delete('public/pilot/thumb/'.$photo->path);
                        $photo->delete();
                    }
                }

                $pilot->delete();
            }
        }
        
        if($user->cars){
            foreach ($user->cars as $car) {
                if($car->file_id){
                    $photo = \App\File::where('id',$car->file_id)->first();
                    if($photo){
                        \Storage::delete('public/car/'.$photo->path);
                        \Storage::delete('public/car/thumb/'.$photo->path);
                        $photo->delete();
                    }
                }

                $car->delete();
            }
        }

        $user->delete();

        return back()->with('success', 'Użytkownik został usunięty');
    }

    public function addLaurel(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:users',
            'place' => 'required',
            'klasa' => 'required',
            'year' => 'required',
        ]);

        $laurel = new \App\Laurel;
        $laurel->user_id = $request->id;
        $laurel->place = $request->place;
        $laurel->klasa = $request->klasa;
        $laurel->year = $request->year;
        $laurel->save();

        return back()->with('success', 'Laur został dodany');
    }

    public function deleteLaurel(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:laurels',
        ]);

        $laurel = \App\Laurel::where('id', $request->id)->delete();

        return back()->with('success', 'Laur został usunięty');
    }
}