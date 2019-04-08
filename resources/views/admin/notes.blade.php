@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Komunikaty live

                    <a class="btn btn-sm btn-danger float-right" href="{{ url('clearNotes') }}">Usuń wszystkie komunikaty</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('saveNote') }}" class="mb-5">
                        @csrf
                        <div class="row justify-content-around align-items-end bg-white
                        py-3">
                            <div class="col-sm-7">
                                <div class="form-group mb-0">
                                    <input type="text" name="text" class="form-control" placeholder="Dodaj komunikat">
                                    {{-- <textarea name="text" class="form-control" rows="3"></textarea> --}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Dodaj
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            
                        </div>
                    </form>

                    @foreach($notes as $note)
                        <div class="d-flex justify-content-start align-items-center flex-wrap">
                            <div class="col-sm-2 text-center">
                                {{ $note->created_at->format('Y-m-d H:i:s') }}
                            </div>
                            <div class="col-sm-8">
                                {{ strip_tags($note->text) }}
                            </div>
                            <div class="col-sm-2 text-right">
                                {{-- <a href="{{ url('editNote', $note->id) }}" class="btn btn-sm btn-info">Edytuj</a> --}}
                                <button class="btn btn-sm btn-info editBtn" data-toggle="modal" data-target="#editNote" data-text='{"id":"{{ $note->id }}", "text":"{{ $note->text }}"}'>Edytuj</button>
                                <button class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteNote" data-id="{{ $note->id }}">Usuń</button>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.deleteNote')
@include('admin.modals.editNote')
@endsection