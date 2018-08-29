<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Partner;

class PartnerController extends Controller
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

    public function index()
    {
        $partners = Partner::with('file')->get();

        return view('admin.partners', compact('partners'));
    }

    public function new()
    {
        return view('admin.addPartner');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'photo' => 'nullable|mimes:jpeg,bmp,png',
        ]);

        if(isset($request->id))
            $partner = Partner::where('id', $request->id)->first();
        else
            $partner = new Partner;

        $partner->name = $request->name;
        $partner->url = $request->url;
        $partner->promoted = isset($request->promoted)?1:0;

        if($request->photo){
            $photo = \App\File::where('id', $partner->file_id)->first();
            if($photo){
                \Storage::delete('public/partner/'.$photo->path);
                $photo->delete();
            }

            $file = $request->photo;
            $originalName = $file->getClientOriginalName();
            $name = $file->hashName();
            $path = 'public/partner/';

            \Storage::put($path, $file);

            $storeFile = new \App\File();
            $storeFile->name = $originalName;
            $storeFile->path = $name;
            $storeFile->save();

            $partner->file_id = $storeFile->id;
        }

        $partner->save();

        return redirect(url('editPartner', $partner->id))->with('success', 'Partner został zapisany');
    }

    public function edit($id)
    {
        $partner = Partner::where('id', $id)->first();

        if(!$partner)
            return back()->with('danger', 'Brak partnera o podanym id');

        return view('admin.editPartner', compact('partner'));
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:partners',
        ]);

        $partner = Partner::where('id', $request->id)->first();
            
        if($partner->file_id){
            $photo = \App\File::where('id' ,$partner->file_id)->first();
            if($photo){
                \Storage::delete('public/partner/'.$photo->path);
                $photo->delete();
            }
        }

        $partner->delete();
        return back()->with('success', 'Partner został usunięty');
    }
}
