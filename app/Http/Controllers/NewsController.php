<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\News;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'showAll']]);
        $this->middleware('admin', ['except' => ['show', 'showAll']]);
    }

    public function index()
    {
        $news = News::latest()->with('file')->get();

        return view('admin.news', compact('news'));
    }

    public function show($id)
    {
        $news = News::where('id', $id)->with('file')->first();

        if(!$news)
            back();

        return view('news', compact('news'));
    }

    public function showAll()
    {
        $news = News::latest()->with('file')->paginate(12);

        return view('newsAll', compact('news'));
    }

    public function new()
    {
        return view('admin.addPost');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'text' => 'required',
            'photo' => 'nullable|mimes:jpeg,bmp,png',
        ]);

        if(isset($request->id))
            $post = News::where('id', $request->id)->first();
        else
            $post = new News;

        $post->title = $request->title;
        $post->text = $request->text;

        if($request->photo){
            $photo = \App\File::where('id', $post->file_id)->first();
            if($photo){
                \Storage::delete('public/post/'.$photo->path);
                $photo->delete();
            }

            $file = $request->photo;
            $originalName = $file->getClientOriginalName();
            $name = $file->hashName();
            $path = 'public/post/';

            \Storage::put($path, $file);

            $storeFile = new \App\File();
            $storeFile->name = $originalName;
            $storeFile->path = $name;
            $storeFile->save();

            $post->file_id = $storeFile->id;
        }

        if($request->deletePhoto){
            $photo = \App\File::where('id', $post->file_id)->first();
            if($photo){
                \Storage::delete('public/post/'.$photo->path);
                $photo->delete();
            }

            $post->file_id = null;
        }

        $post->save();

        return redirect(url('editPost', $post->id))->with('success', 'Aktualność została zapisana');
    }

    public function edit($id)
    {
        $post = News::where('id', $id)->first();

        if(!$post)
            return back()->with('danger', 'Brak aktualności o podanym id');

        return view('admin.editPost', compact('post'));
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:news',
        ]);

        $post = News::where('id', $request->id)->first();
            
            if($post->file_id){
                $photo = \App\File::where('id' ,$post->file_id)->first();
                if($photo){
                    \Storage::delete('public/post/'.$photo->path);
                    $photo->delete();
                }
            }

            $post->delete();
            return back()->with('success', 'Aktualność została usunięta');

        return back()->with('warning', 'Aktualność nie istnieje');
    }
}
