<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SignForm;
use App\Sign;
use App\StartList;
use App\StartListItem;
use App\Exports\StartListExport;
use App\Exports\SignListExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

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
        $this->middleware('admin', ['except' => ['sign', 'signPress', 'editSignPress', 'accreditation_pdf', 'deleteSign', 'editSignUser', 'editSignPilot']]);
    }

    public function signFormStatus(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:sign_forms',
        ]);

        $form = SignForm::where('id', $request->id)->first();
        $form->active = $form->active?0:1;
        $form->save();

        return back()->with('success', 'Status został zmieniony');
    }

    public function sign(Request $request)
    {
        $this->validate($request, [
            'form_id' => 'required|exists:sign_forms,id',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'marka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'rok' => 'required|max:255',
            'nr_rej' => 'required|string|max:255',
            'ccm' => 'required|string|max:255',
            'klasa' => 'required',
            'oc' => 'required',
            'payment' => 'nullable|file|mimes:jpeg,png,pdf,jpg|max:3000',
        ]);

        $form = SignForm::where('id', $request->form_id)->first();
        $max = $form->round->max;
        $active = true;

        if($form->signs->where('active', 1)->count() >= $max)
            $active = false;

        if(auth()->user()->driver == 1)
            $sign = Sign::where('user_id', auth()->user()->id)->where('form_id', $request->form_id)->first();
        elseif(auth()->user()->driver == 0)
            $sign = Sign::where('pilot_id', auth()->user()->id)->where('form_id', $request->form_id)->first();
        
        if($sign)
            return back()->with('danger', 'Twoje zgłoszenie zostało już wysłane.');

        $sign = new Sign;
        $sign->form_id = $request->form_id;

        if(auth()->user()->driver == 1){
            if($request->pilot_uid){
                $pilot = \App\User::where('uid', $request->pilot_uid)->first();
                $sign->pilot_id = $pilot->id;
            }

            if($request->saved){
                $pilot = \App\User::where('uid', $request->saved)->first();
                $sign->pilot_id = $pilot->id;
            }
            $sign->user_id = auth()->user()->id;
            $sign->name = auth()->user()->profile->name;
            $sign->lastname = auth()->user()->profile->lastname;
            $sign->address = auth()->user()->profile->address;
            $sign->id_card = auth()->user()->profile->id_card;
            $sign->phone = auth()->user()->profile->phone;
            $sign->email = auth()->user()->email;
            $sign->driving_license = auth()->user()->profile->driving_license;

            $sign->pilot_name = $request->name;
            $sign->pilot_lastname = $request->lastname;
            $sign->pilot_address = $request->address;
            $sign->pilot_id_card = $request->id_card;
            $sign->pilot_phone = $request->phone;
            $sign->pilot_email = $request->email;
            $sign->pilot_driving_license = $request->driving_license;
            // $sign->pilot_oc = $request->oc;
            // $sign->pilot_nw = $request->nw;
        }
        elseif(auth()->user()->driver == 0){
            if($request->driver_uid){
                $driver = \App\User::where('uid', $request->driver_uid)->first();
                $sign->user_id = $driver->id;
            }

            if($request->saved){
                $driver = \App\User::where('uid', $request->saved)->first();
                $sign->user_id = $driver->id;
            }
            // $driver = \App\User::where('uid', $request->driver_uid)->first();
            // $sign->user_id = $driver->id;
            $sign->pilot_id = auth()->user()->id;
            $sign->pilot_name = auth()->user()->profile->name;
            $sign->pilot_lastname = auth()->user()->profile->lastname;
            $sign->pilot_address = auth()->user()->profile->address;
            $sign->pilot_id_card = auth()->user()->profile->id_card;
            $sign->pilot_phone = auth()->user()->profile->phone;
            $sign->pilot_email = auth()->user()->email;
            $sign->pilot_driving_license = auth()->user()->profile->driving_license;
            // $sign->pilot_oc = auth()->user()->profile->oc;
            // $sign->pilot_nw = auth()->user()->profile->nw;

            $sign->name = $request->name;
            $sign->lastname = $request->lastname;
            $sign->address = $request->address;
            $sign->id_card = $request->id_card;
            $sign->phone = $request->phone;
            $sign->email = $request->email;
            $sign->driving_license = $request->driving_license;
            // $sign->oc = $request->oc;
            // $sign->nw = $request->nw;
        }

        $sign->marka = $request->marka;
        $sign->model = $request->model;
        $sign->nr_rej = $request->nr_rej;
        $sign->ccm = $request->ccm;
        $sign->rok = $request->rok;
        $sign->turbo = $request->turbo;
        $sign->rwd = $request->rwd;
        $sign->klasa = $request->klasa;
        $sign->oc = $request->oc;
        $sign->nw = $request->nw;
        $sign->active = $active;
        $sign->position = $this->getMinPostion($request->form_id, $request->klasa) -1;

        if(isset($request->payment)){
            $path = $request->file('payment')->store('public/payments');
            $sign->payment = $path;
        }
        
        $sign->save();

        return back()->with('success', 'Zgłoszenie zostało wysłane');
    }

    public function editSignUser(Request $request)
    {
        $this->validate($request, [
            'form_id' => 'required|exists:sign_forms,id',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'marka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'rok' => 'required|max:255',
            'nr_rej' => 'required|string|max:255',
            'ccm' => 'required|string|max:255',
            'klasa' => 'required',
            'oc' => 'required',
            'payment' => 'nullable|file|mimes:jpeg,png,pdf,jpg|max:3000',
        ]);

        $form = SignForm::where('id', $request->form_id)->first();
        $max = $form->round->max;
        $active = true;

        if($form->signs->where('active', 1)->count() >= $max)
            $active = false;

        if(auth()->user()->driver == 1)
            $sign = Sign::where('user_id', auth()->user()->id)->where('form_id', $request->form_id)->first();
        elseif(auth()->user()->driver == 0)
            $sign = Sign::where('pilot_id', auth()->user()->id)->where('form_id', $request->form_id)->first();

        if(auth()->user()->driver == 1){
            if($request->pilot_uid){
                $pilot = \App\User::where('uid', $request->pilot_uid)->first();
                $sign->pilot_id = $pilot->id;
            }
            else if($request->saved){
                $pilot = \App\User::where('uid', $request->saved)->first();
                $sign->pilot_id = $pilot->id;
            }
            else{
                $sign->pilot_id = null;
            }
            $sign->pilot_name = $request->name;
            $sign->pilot_lastname = $request->lastname;
            $sign->pilot_address = $request->address;
            $sign->pilot_id_card = $request->id_card;
            $sign->pilot_phone = $request->phone;
            $sign->pilot_email = $request->email;
            $sign->pilot_driving_license = $request->driving_license;
        }
        elseif(auth()->user()->driver == 0){
            if($request->driver_uid){
                $driver = \App\User::where('uid', $request->driver_uid)->first();
                $sign->user_id = $driver->id;
            }

            if($request->saved){
                $driver = \App\User::where('uid', $request->saved)->first();
                $sign->user_id = $driver->id;
            }

            $sign->name = $request->name;
            $sign->lastname = $request->lastname;
            $sign->address = $request->address;
            $sign->id_card = $request->id_card;
            $sign->phone = $request->phone;
            $sign->email = $request->email;
            $sign->driving_license = $request->driving_license;
        }

        $sign->marka = $request->marka;
        $sign->model = $request->model;
        $sign->nr_rej = $request->nr_rej;
        $sign->ccm = $request->ccm;
        $sign->rok = $request->rok;
        $sign->turbo = $request->turbo;
        $sign->rwd = $request->rwd;
        $sign->klasa = $request->klasa;
        $sign->oc = $request->oc;
        $sign->nw = $request->nw;
        $sign->active = $active;

        if(isset($request->payment)){
            $path = $request->file('payment')->store('public/payments');
            $sign->payment = $path;
        }
        
        $sign->save();

        return back()->with('success', 'Zgłoszenie zostało zapisane');
    }

    public function editSignPilot(Request $request)
    {
        $this->validate($request, [
            'form_id' => 'required|exists:sign_forms,id',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'marka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'rok' => 'required|max:255',
            'nr_rej' => 'required|string|max:255',
            'ccm' => 'required|string|max:255',
            'klasa' => 'required',
            'oc' => 'required',
            'payment' => 'nullable|file|mimes:jpeg,png,pdf,jpg|max:3000',
        ]);

        $form = SignForm::where('id', $request->form_id)->first();
        $max = $form->round->max;
        $active = true;

        if($form->signs->where('active', 1)->count() >= $max)
            $active = false;

        if(auth()->user()->driver == 1)
            $sign = Sign::where('user_id', auth()->user()->id)->where('form_id', $request->form_id)->first();
        elseif(auth()->user()->driver == 0)
            $sign = Sign::where('pilot_id', auth()->user()->id)->where('form_id', $request->form_id)->first();

        if(auth()->user()->driver == 1){
            if($request->pilot_uid){
                $pilot = \App\User::where('uid', $request->pilot_uid)->first();
                $sign->pilot_id = $pilot->id;
            }
            else if($request->saved){
                $pilot = \App\User::where('uid', $request->saved)->first();
                $sign->pilot_id = $pilot->id;
            }
            else{
                $sign->pilot_id = null;
            }
            $sign->pilot_name = $request->name;
            $sign->pilot_lastname = $request->lastname;
            $sign->pilot_address = $request->address;
            $sign->pilot_id_card = $request->id_card;
            $sign->pilot_phone = $request->phone;
            $sign->pilot_email = $request->email;
            $sign->pilot_driving_license = $request->driving_license;
        }
        elseif(auth()->user()->driver == 0){
            if($request->driver_uid){
                $driver = \App\User::where('uid', $request->driver_uid)->first();
                $sign->user_id = $driver->id;
            }

            if($request->saved){
                $driver = \App\User::where('uid', $request->saved)->first();
                $sign->user_id = $driver->id;
            }

            $sign->name = $request->name;
            $sign->lastname = $request->lastname;
            $sign->address = $request->address;
            $sign->id_card = $request->id_card;
            $sign->phone = $request->phone;
            $sign->email = $request->email;
            $sign->driving_license = $request->driving_license;
        }

        $sign->marka = $request->marka;
        $sign->model = $request->model;
        $sign->nr_rej = $request->nr_rej;
        $sign->ccm = $request->ccm;
        $sign->rok = $request->rok;
        $sign->turbo = $request->turbo;
        $sign->rwd = $request->rwd;
        $sign->klasa = $request->klasa;
        $sign->oc = $request->oc;
        $sign->nw = $request->nw;
        $sign->active = $active;

        if(isset($request->payment)){
            $path = $request->file('payment')->store('public/payments');
            $sign->payment = $path;
        }
        
        $sign->save();

        return back()->with('success', 'Zgłoszenie zostało zapisane');
    }

    public function addSign(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:sign_forms',
            'driver_name' => 'required|string|max:255',
            'driver_lastname' => 'required|string|max:255',
            'driver_email' => 'required|string|max:255',
            'marka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'rok' => 'required|max:255',
            'nr_rej' => 'required|string|max:255',
            'ccm' => 'required|string|max:255',
            'klasa' => 'required',
            'oc' => 'required',
        ]);

        $form = SignForm::where('id', $request->id)->first();
        $max = $form->round->max;
        $active = true;

        if($form->signs->where('active', 1)->count() >= $max)
            $active = false;

        $sign = Sign::where('email', $request->driver_email)->where('form_id', $request->id)->first();
        
        if($sign)
            return back()->with('danger', 'Zgłoszenie dla danego uczestnika zostało już dodane');

        $sign = new Sign;
        $sign->form_id = $request->id;
        $sign->user_id = null;
        $sign->name = $request->driver_name;
        $sign->lastname = $request->driver_lastname;
        $sign->address = $request->driver_address;
        $sign->id_card = $request->driver_id_card;
        $sign->phone = $request->driver_phone;
        $sign->email = $request->driver_email;
        $sign->driving_license = $request->driver_driving_license;
        $sign->oc = $request->oc;
        $sign->nw = $request->nw;
        $sign->pilot_name = $request->name;
        $sign->pilot_lastname = $request->lastname;
        $sign->pilot_address = $request->address;
        $sign->pilot_id_card = $request->id_card;
        $sign->pilot_phone = $request->phone;
        $sign->pilot_email = $request->email;
        $sign->pilot_driving_license = $request->driving_license;
        // $sign->pilot_oc = $request->oc;
        // $sign->pilot_nw = $request->nw;
        $sign->marka = $request->marka;
        $sign->model = $request->model;
        $sign->nr_rej = $request->nr_rej;
        $sign->ccm = $request->ccm;
        $sign->rok = $request->rok;
        $sign->turbo = $request->turbo;
        $sign->rwd = $request->rwd;
        $sign->klasa = $request->klasa;
        if($request->advance)
            $sign->advance = floatval(str_replace(',', '.', $request->advance));
        $sign->active = $active;
        $sign->position = $this->getMinPostion($request->id, $request->klasa) -1;
        $sign->save();

        return back()->with('success', 'Zgłoszenie zostało dodane');
    }

    protected function getMinPostion($form, $klasa)
    {
        $min = Sign::where('form_id', $form)->where('klasa', $klasa)->min('position');

        return $min;
    }

    public function editSign(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:signs',
            'driver_name' => 'required|string|max:255',
            'driver_lastname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'marka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'rok' => 'required|max:255',
            'nr_rej' => 'required|string|max:255',
            'ccm' => 'required|string|max:255',
            'klasa' => 'required',
            'oc' => 'required',
        ]);

        $sign = Sign::where('id', $request->id)->first();

        $sign->name = $request->driver_name;
        $sign->lastname = $request->driver_lastname;
        $sign->address = $request->driver_address;
        $sign->id_card = $request->driver_id_card;
        $sign->phone = $request->driver_phone;
        $sign->email = $request->driver_email;
        $sign->driving_license = $request->driver_driving_license;
        $sign->oc = $request->oc;
        $sign->nw = $request->nw;
        $sign->pilot_name = $request->name;
        $sign->pilot_lastname = $request->lastname;
        $sign->pilot_address = $request->address;
        $sign->pilot_id_card = $request->id_card;
        $sign->pilot_phone = $request->phone;
        $sign->pilot_email = $request->email;
        $sign->pilot_driving_license = $request->driving_license;
        // $sign->pilot_oc = $request->oc;
        // $sign->pilot_nw = $request->nw;
        $sign->marka = $request->marka;
        $sign->model = $request->model;
        $sign->nr_rej = $request->nr_rej;
        $sign->ccm = $request->ccm;
        $sign->rok = $request->rok;
        $sign->turbo = $request->turbo;
        $sign->rwd = $request->rwd;
        $sign->klasa = $request->klasa;
        if($request->advance)
            $sign->advance = floatval(str_replace(',', '.', $request->advance));
        $sign->save();

        return back()->with('success', 'Zgłoszenie zostało zapisane');
    }

    public function cancelSign(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:signs',
        ]);

        $sign = Sign::where('id', $request->id)->first();
        $sign->active = false;
        $sign->save();

        return back()->with('success', 'Uczestnik został wykluczony');
    }

    public function deleteSign(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:signs',
        ]);

        if(!auth()->user()->admin){
            if(auth()->user()->driver == 1)
                Sign::where('id', $request->id)->where('user_id', auth()->user()->id)->delete();
            else if(auth()->user()->driver == 0)
                Sign::where('id', $request->id)->where('pilot_id', auth()->user()->id)->delete();
        }
        else{
            Sign::where('id', $request->id)->delete();
        }
        
        return back()->with('success', 'Zgłoszenie zostało usunięte');
    }

    public function enableSign(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:signs',
        ]);

        $sign = Sign::where('id', $request->id)->first();
        $form = $sign->form;
        $max = $form->round->max;

        if($form->signs->where('active', 1)->count() >= $max)
            return back()->with('danger', 'Uczestnik nie został dołączony do listy ponieważ osiągnięty jest limit miejsc.');

        $sign->active = true;
        $sign->save();

        return back()->with('success', 'Uczestnik został dołączony do listy');
    }

    public function signPress(Request $request)
    {
        $this->validate($request, [
            'round_id' => 'required|exists:rounds,id',
            'staff' => 'required'
        ]);

        if(auth()->user()->driver == 2 && auth()->user()->accreditation($request->round_id))
            return back()->with('danger', 'Twoje zgłoszenie zostało już wysłane.');

        foreach ($request->staff as $key => $value) {
            $accreditation = new \App\PressSign;
            $accreditation->user_id = auth()->user()->id;
            $accreditation->press_id = $key;
            $accreditation->round_id = $request->round_id;
            $accreditation->save();
        }

        return back()->with('success', 'Zgłoszenie zostało wysłane');
    }

    public function editSignPress(Request $request)
    {
        $this->validate($request, [
            'round_id' => 'required|exists:rounds,id',
        ]);

        \App\PressSign::where('user_id', auth()->user()->id)->where('round_id', $request->round_id)->delete();

        if($request->staff)
            foreach ($request->staff as $key => $value) {
                $accreditation = new \App\PressSign;
                $accreditation->user_id = auth()->user()->id;
                $accreditation->press_id = $key;
                $accreditation->round_id = $request->round_id;
                $accreditation->save();
            }

        return back()->with('success', 'Zgłoszenie zostało zapisane');
    }

    public function editSignPressAdmin(Request $request)
    {
        $this->validate($request, [
            'round_id' => 'required|exists:rounds,id',
            'user_id' => 'required|exists:users,id',
        ]);

        \App\PressSign::where('user_id', $request->user_id)->where('round_id', $request->round_id)->delete();

        if($request->staff)
            foreach ($request->staff as $key => $value) {
                $accreditation = new \App\PressSign;
                $accreditation->user_id = $request->user_id;
                $accreditation->press_id = $key;
                $accreditation->round_id = $request->round_id;
                $accreditation->save();
            }

        return back()->with('success', 'Zgłoszenie zostało zapisane');
    }

    public function getStaff(Request $request){
        $staff = \App\Press::where('user_id', $request->id)->get();

        return view('admin.getStaff', compact('staff'))->render();
    }

    public function accreditation_pdf($id){
        $round = \App\Round::where('id', $id)->first();
        $accreditations = \App\PressSign::where('user_id', auth()->user()->id)->where('round_id', $id)->get();
            
        $pdf = PDF::loadView('pdf.akredytacja', compact('accreditations', 'round'));
        
        return $pdf->download('akredytacja.pdf');
    }
    

    public function changeFormVisibility(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:sign_forms',
        ]);

        $form = SignForm::where('id', $request->id)->first();
        $form->visible = $form->visible?0:1;
        $form->save();

        foreach ($form->signs as $sign) {
            if($sign->user){
                if($sign->user->team())
                    $sign->team_id = $sign->user->team()->id;
                else
                    $sign->team_id = null;

                $sign->save();
            }
        }

        return back()->with('success', 'Status został zmieniony');
    }

    public function generateList(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:rounds',
        ]);

        $list = StartList::where('round_id', $request->id)->first();

        if($list)
            return back()->with('danger', 'Lista została już wygenerowana. Musisz pierwsze ją usunąć aby móc wygenerować nową listę.');

        $list = new StartList;
        $list->round_id = $request->id;
        $list->save();

        $form = SignForm::where('round_id', $request->id)->first();
        $form->active = false;
        $form->save();

        $round = \App\Round::where('id', $request->id)->first();
        $klasy = $round->signs()->sortBy('klasa')->pluck('klasa', 'klasa');

        $max = $round->signs()->count();

        if($max > $round->max)
            $max = $round->max;

        // foreach($klasy as $klasa){
        //     foreach($round->signs()->where('klasa', $klasa)->take($round->max) as $sign){
        //         $list_item = new StartListItem;
        //         $list_item->start_list_id = $list->id;
        //         $list_item->sign_id = $sign->id;
        //         $list_item->email = $sign->email;
        //         $list_item->klasa = $sign->klasa;
        //         $list_item->position = $max--;
        //         $list_item->save();
        //     }
        // }

        foreach($round->signs()->take($max) as $sign){          
            if($sign->user){
                if($sign->user->team())
                    $sign->team_id = $sign->user->team()->id;
                else
                    $sign->team_id = null;
                $sign->save();
            }

            $list_item = new StartListItem;
            $list_item->start_list_id = $list->id;
            $list_item->sign_id = $sign->id;
            $list_item->email = $sign->email;
            $list_item->klasa = $sign->klasa;
            $list_item->team_id = $sign->team_id;
            $list_item->position = $max--;
            $list_item->save();
        }

        return redirect()->route('list', $list->round_id);
    }

    public function deleteList(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:rounds',
        ]);
        
        $list = StartList::where('round_id', $request->id)->first();
        $id = $list->round->race->id;

        foreach($list->items as $item){
            $item->delete();
        }
        
        $list->delete();

        return redirect()->route('race', $id)->with('success', 'Lista została usunięta');
    }

    public function updatePosition(Request $request)
    {
        $this->validate($request, [
            'order' => 'required',
        ]);

        $max = count($request->order);

        foreach ($request->order as $order) {
            $sign = Sign::where('id', $order)->first();
            $sign->position = $max--;
            $sign->save();
        }

        return 'ok';
    }

    public function saveRank(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:rounds',
        ]);

        $round = \App\Round::where('id', $request->id)->first();

        foreach ($round->startPositions($round->startList->id) as $position) {
            $position->points = 0;
            if($request->rank[$position->id])
                $position->points = $this->getPoints($request->rank[$position->id]);
            $position->save();
        }

        return back()->with('success', 'Miejsca zostały zapisane');
    }

    protected function getPoints($rank)
    {
        switch ($rank) {
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
                return 0;
                break;
        }
    }

    public function makeFile(Request $request)
    {   
        $this->validate($request, [
            'id' => 'required|exists:rounds',
            'items' => 'required',
        ]);

        $round = \App\Round::where('id', $request->id)->first();

        if(!$round->startList)
            return back()->with('error', 'Lista startowa jest niedostępna.');

        if($round)
            return Excel::download(new StartListExport($round->id, $request->items), 'startlist.xlsx');

        return back()->with('error', 'Runda nie istnieje');
    }

    public function makeFileSign(Request $request)
    {   
        $this->validate($request, [
            'id' => 'required|exists:rounds',
            'items' => 'required',
        ]);

        $round = \App\Round::where('id', $request->id)->first();

        if($round)
            return Excel::download(new SignListExport($round->id, $request->items), 'signlist.xlsx');

        return back()->with('error', 'Runda nie istnieje');
    }
}