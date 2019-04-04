<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tabela;
use App\import_user;
use App\tabela_user;

class TabelaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['active', 'show']]);
        $this->middleware('admin', ['except' => ['active', 'show']]);
    }

    public function index()
    {
        $tabele = tabela::get();

        return view('admin.tabele', compact('tabele'));
    }

    public function active()
    {
        $tabela = tabela::where('active', 1)->first();

        if(!$tabela)
            return back()->with('danger', 'brak aktywnej tabeli');

        return view('tabela', compact('tabela'));
    }

    public function show($id)
    {
        $tabela = tabela::where('id', $id)->first();

        if(!$tabela)
            return back()->with('danger', 'brak tabeli z podanym id');

        return view('tabela', compact('tabela'));
    }

    public function edycja_tabeli($id)
    {
        $tabela = tabela::where('id', $id)->first();
        
        if(!$tabela)
            return back()->with('danger', 'złe id tabeli');

        $users = import_user::get();

        $wykorzystani = $tabela->items->pluck('user_id')->toArray();
        $niewykorzystani = $users->whereNotIn('id', $wykorzystani);

        return view('admin.tabela', compact('tabela', 'niewykorzystani'));
    } 

    public function users()
    {
        $users = import_user::get();
        return view('admin.import_users', compact('users'));
    }

    public function clear_import_users()
    {
        $users = import_user::get();
        foreach($users as $user)
            $user->delete();

        $table_users = tabela_user::get();
        foreach($table_users as $user)
            $user->delete();

        return back();
    }

    public function import_users(Request $request)
    {
        $this->validate($request, [
            'lista' => 'required',
        ]);

        $file = $request->lista;

        $handle = fopen($file->getRealPath(), "r");

        while ($csvLine = fgetcsv($handle, 1000, ",")) {
            $user = new import_user;
            $user->nr = $csvLine[0];
            $user->name = $csvLine[1] . ' ' . $csvLine[2];
            $user->pilot = $csvLine[3] . ' ' . $csvLine[4];
            $user->car = $csvLine[5];
            $user->save();
        }

        return back();
    }

    public function edit_user(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:import_users',
            'nr' => 'required',
            'name' => 'required',
            'car' => 'required'
        ]);        

        $user = import_user::where('id', $request->id)->first();
        $user->nr = $request->nr;
        $user->name = $request->name;
        $user->pilot = $request->pilot;
        $user->car = $request->car;

        $user->save();

        return back();
    }

    public function delete_user(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:import_users',
        ]);        

        $user = import_user::where('id', $request->id)->first();
        tabela_user::where('user_id', $user->id)->delete();
        $user->delete();

        return back();
    }

    public function add_import_users(Request $request)
    {
        $this->validate($request, [
            'nr' => 'required',
            'name' => 'required',
            'car' => 'required',
        ]);

        $user = new import_user;
        $user->nr = $request->nr;
        $user->name = $request->name;
        $user->pilot = $request->pilot;
        $user->car = $request->car;
        $user->save();

        return back();
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        if(isset($request->id))
            $table = tabela::where('id', $request->id)->first();
        else
            $table = new tabela;

        $table->name = $request->name;
        $table->subname = $request->subname;
        $table->save();

        return back();
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:tabelas',
        ]);

        $tabela = tabela::where('id', $request->id)->first();
        
        foreach ($tabela->items as $item) {
            $item->delete();
        }
        $tabela->delete();

        return back();
    }

    public function set_active_table(Request $request)
    {
        $this->validate($request, [
            'active' => 'required|exists:tabelas,id',
        ]);
        
        $tabele = tabela::get();

        foreach ($tabele as $tabela) {
            if($tabela->id != $request->active)
                $tabela->active = 0;
            else
                $tabela->active = 1;

            $tabela->save();
        }

        return back();
    }

    public function saveTableUsers(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:tabelas',
        ]);

        $items = explode(',', $request->items);
        tabela_user::where('tabela_id', $request->id)->delete();

        $i = 1;

        foreach ($items as $item) {
            $tabela_user = new tabela_user;
            $tabela_user->tabela_id = $request->id;
            $tabela_user->user_id = $item;
            $tabela_user->order = $i++;
            $tabela_user->save();
        }

        return back();
    }

    public function addTableUsers(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:tabelas',
        ]);

        $i = tabela_user::where('tabela_id', $request->id)->max('order') + 1;

        foreach ($request->multiadd as $key => $item) {
            $tabela_user = new tabela_user;
            $tabela_user->tabela_id = $request->id;
            $tabela_user->user_id = $key;
            $tabela_user->order = $i++;
            $tabela_user->save();
        }

        return back();
    }
}
