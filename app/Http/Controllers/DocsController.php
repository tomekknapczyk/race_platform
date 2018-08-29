<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Docs;

class DocsController extends Controller
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
        $docs = Docs::with('file')->get();

        return view('admin.docs', compact('docs'));
    }

    public function new()
    {
        return view('admin.addDoc');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'file' => 'mimes:pdf,txt,doc',
        ]);

        if(isset($request->id))
            $doc = Docs::where('id', $request->id)->first();
        else
            $doc = new Docs;

        $doc->name = $request->name;

        if($request->file){
            $file = \App\File::where('id', $doc->file_id)->first();
            if($file){
                \Storage::delete('public/docs/'.$file->path);
                $file->delete();
            }

            $file = $request->file;
            $originalName = $file->getClientOriginalName();
            $name = $file->hashName();
            $path = 'public/docs/';

            \Storage::put($path, $file);

            $storeFile = new \App\File();
            $storeFile->name = $originalName;
            $storeFile->path = $name;
            $storeFile->save();

            $doc->file_id = $storeFile->id;
        }

        $doc->save();

        return redirect(url('editDoc', $doc->id))->with('success', 'Dokument został zapisany');
    }

    public function edit($id)
    {
        $doc = Docs::where('id', $id)->first();

        if(!$doc)
            return back()->with('danger', 'Brak dokumentu o podanym id');

        return view('admin.editDoc', compact('doc'));
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:docs',
        ]);

        $doc = Docs::where('id', $request->id)->first();
            
        if($doc->file_id){
            $file = \App\File::where('id' ,$doc->file_id)->first();
            if($file){
                \Storage::delete('public/docs/'.$file->path);
                $file->delete();
            }
        }

        $doc->delete();
        
        return back()->with('success', 'Dokument został usunięty');
    }
}
