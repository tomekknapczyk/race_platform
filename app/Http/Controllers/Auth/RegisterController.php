<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\AccountVerification;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|confirmed',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'accepted',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $confirmation_code = str_random(30);

        $user = User::create([
            'login' => $data['name'],
            'email' => $data['email'],
            'password' =>  Hash::make($data['password']),
            'confirmation_code' => $confirmation_code,
        ]);

        \Mail::to($data['email'])->send(new AccountVerification($confirmation_code));

        return $user;
    }

    public function confirm($confirmation_code)
    {   

        if(!$confirmation_code)
        {
            return redirect('/')->with('danger', 'Konto nie zostało aktywowane, brak kodu aktywującego.');
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if (!$user)
            return redirect('/')->with('info', 'Konto zostało już aktywowane lub podany kod jest nieprawidłowy.');

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        $this->guard()->login($user);

        return redirect('/')->with('success', 'Konto zostało aktywowane.');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        event(new Registered($user));

        return redirect('/')->with('success', 'Na podany adres email została wysłany link aktywujący konto. Prosimy o potwierdzenie adresu');
    }
}
