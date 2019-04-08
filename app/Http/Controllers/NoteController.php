<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
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
        $notes = Note::latest()->get();

        return view('admin.notes', compact('notes'));
    }

    public function show($id)
    {
        $note = Note::where('id', $id)->first();

        if(!$note)
            back();

        return view('note', compact('note'));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
        ]);

        if(isset($request->id))
            $note = Note::where('id', $request->id)->first();
        else
            $note = new Note;

        $note->text = $request->text;

        $note->save();

        return back()->with('success', 'Komunikat zapisany');
    }

    public function edit($id)
    {
        $note = Note::where('id', $id)->first();

        if(!$note)
            return back()->with('danger', 'Brak komunikatu o podanym id');

        return view('admin.editNote', compact('note'));
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:notes',
        ]);

        Note::where('id', $request->id)->delete();

        return back()->with('success', 'Komunikat usunięty');
    }

    public function clearNotes()
    {
        $notes = Note::get();
        foreach ($notes as $note) {
            $note->delete();
        }

        return back()->with('success', 'Wszystkie komunikaty zostały usunięte');
    }
}
