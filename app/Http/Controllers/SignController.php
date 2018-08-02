<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SignForm;

class SignController extends Controller
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

    public function signFormStatus(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:sign_forms',
        ]);

        $form = SignForm::where('id', $request->id)->first();
        $form->active = $form->active?0:1;
        $form->save();

        return redirect()->back()->with('success', 'Status został zmieniony');
    }
}
