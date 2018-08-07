<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SignForm;
use App\Sign;
use App\StartList;
use App\StartListItem;
use App\Exports\StartListExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $this->middleware('admin', ['except' => ['sign']]);
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
        ]);

        $sign = Sign::where('user_id', auth()->user()->id)->where('form_id', $request->form_id)->first();
        
        if($sign)
            return back()->with('danger', 'Twoje zgłoszenie zostało już wysłane.');

        $sign = new Sign;
        $sign->form_id = $request->form_id;
        $sign->user_id = auth()->user()->id;
        $sign->name = auth()->user()->driver->name;
        $sign->lastname = auth()->user()->driver->lastname;
        $sign->address = auth()->user()->driver->address;
        $sign->id_card = auth()->user()->driver->id_card;
        $sign->phone = auth()->user()->driver->phone;
        $sign->email = auth()->user()->email;
        $sign->driving_license = auth()->user()->driver->driving_license;
        $sign->oc = auth()->user()->driver->oc;
        $sign->nw = auth()->user()->driver->nw;
        $sign->pilot_name = $request->name;
        $sign->pilot_lastname = $request->lastname;
        $sign->pilot_address = $request->address;
        $sign->pilot_id_card = $request->id_card;
        $sign->pilot_phone = $request->phone;
        $sign->pilot_email = $request->email;
        $sign->pilot_driving_license = $request->driving_license;
        $sign->pilot_oc = $request->oc;
        $sign->pilot_nw = $request->nw;
        $sign->marka = $request->marka;
        $sign->model = $request->model;
        $sign->nr_rej = $request->nr_rej;
        $sign->ccm = $request->ccm;
        $sign->rok = $request->rok;
        $sign->turbo = $request->turbo;
        $sign->rwd = $request->rwd;
        $sign->klasa = $request->klasa;
        $sign->save();

        return back()->with('success', 'Zgłoszenie zostało wysłane');
    }

    public function addSign(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:sign_forms',
            'driver_name' => 'required|string|max:255',
            'driver_lastname' => 'required|string|max:255',
            'driver_email' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'marka' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'rok' => 'required|max:255',
            'nr_rej' => 'required|string|max:255',
            'ccm' => 'required|string|max:255',
            'klasa' => 'required',
        ]);

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
        $sign->oc = $request->driver_oc;
        $sign->nw = $request->driver_nw;
        $sign->pilot_name = $request->name;
        $sign->pilot_lastname = $request->lastname;
        $sign->pilot_address = $request->address;
        $sign->pilot_id_card = $request->id_card;
        $sign->pilot_phone = $request->phone;
        $sign->pilot_email = $request->email;
        $sign->pilot_driving_license = $request->driving_license;
        $sign->pilot_oc = $request->oc;
        $sign->pilot_nw = $request->nw;
        $sign->marka = $request->marka;
        $sign->model = $request->model;
        $sign->nr_rej = $request->nr_rej;
        $sign->ccm = $request->ccm;
        $sign->rok = $request->rok;
        $sign->turbo = $request->turbo;
        $sign->rwd = $request->rwd;
        $sign->klasa = $request->klasa;
        $sign->save();

        return back()->with('success', 'Zgłoszenie zostało dodane');
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
        ]);

        $sign = Sign::where('id', $request->id)->first();

        $sign->name = $request->driver_name;
        $sign->lastname = $request->driver_lastname;
        $sign->address = $request->driver_address;
        $sign->id_card = $request->driver_id_card;
        $sign->phone = $request->driver_phone;
        $sign->email = $request->driver_email;
        $sign->driving_license = $request->driver_driving_license;
        $sign->oc = $request->driver_oc;
        $sign->nw = $request->driver_nw;
        $sign->pilot_name = $request->name;
        $sign->pilot_lastname = $request->lastname;
        $sign->pilot_address = $request->address;
        $sign->pilot_id_card = $request->id_card;
        $sign->pilot_phone = $request->phone;
        $sign->pilot_email = $request->email;
        $sign->pilot_driving_license = $request->driving_license;
        $sign->pilot_oc = $request->oc;
        $sign->pilot_nw = $request->nw;
        $sign->marka = $request->marka;
        $sign->model = $request->model;
        $sign->nr_rej = $request->nr_rej;
        $sign->ccm = $request->ccm;
        $sign->rok = $request->rok;
        $sign->turbo = $request->turbo;
        $sign->rwd = $request->rwd;
        $sign->klasa = $request->klasa;
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
        
        Sign::where('id', $request->id)->delete();

        return back()->with('success', 'Uczestnik został usunięty');
    }

    public function enableSign(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:signs',
        ]);

        $sign = Sign::where('id', $request->id)->first();
        $sign->active = true;
        $sign->save();

        return back()->with('success', 'Uczestnik został dołączony do listy');
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

        $max = $round->signs()->count();

        foreach ($round->signs() as $key => $sign) {
            $list_item = new StartListItem;
            $list_item->start_list_id = $list->id;
            $list_item->sign_id = $sign->id;
            $list_item->email = $sign->email;
            $list_item->klasa = $sign->klasa;
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

        foreach($list->items() as $item){
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

        foreach ($round->startPositions() as $position) {
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

        if($round){
            return Excel::download(new StartListExport($round->id, $request->items), 'startlist.xlsx');
        }

        return back()->with('error', 'Runda nie istnieje');
    }
}