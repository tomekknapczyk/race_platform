<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Mail\AccountVerification;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, User $user)
    {
        if($user->confirmed){
            if($user->active)
                return redirect()->intended($this->redirectPath());
            else{
                $this->logout($request);
                return redirect('/')->with('warning', 'Twóje konto zostało zablokowane. Prosimy o kontakt z administracją serwisu.');
            }
        }
        else
        {
            $this->logout($request);
            
            \Mail::to($user->email)->send(new AccountVerification($user->confirmation_code));
            return redirect('/')->with('warning', 'Twój adres email nie został potwierdzony. Kod został ponownie wysłany.');
        }
    }
}
