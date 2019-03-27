@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center overflow-auto">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <a href="{{ url('races') }}" class="text-white">Rajdy</a> : <a href="{{ url('race', $round->race->id) }}" class="text-white">{{ $round->race->name }}</a> : {{ $round->name }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="border-top p-3">
                        @foreach($round->osy as $os)
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <strong class="col-md-2">OS {{ $loop->iteration }}</strong>
                                <strong class="col-md-2">{{ $os->length }}km</strong>
                                <strong class="col-md-2"><a href="{{ url('public/os', $os->path) }}" target="_blank">Zobacz plik</a></strong>
                                <strong class="col-md-2">Ilość załóg: {{ optional($os->items)->count() }}</strong>
                                <div>
                                    <button class="btn btn-sm btn-info editBtn" data-toggle="modal" data-target="#editOs" data-text='{"id":"{{ $os->id }}", "length":"{{ $os->length }}"}'>Edytuj</button>
                                    <button class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteOs" data-id="{{ $os->id }}">Usuń</button>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>

                    <div class="p-3 bg-white">
                        <h3>Dodaj odcinek</h3>
                        <form method="POST" action="{{ route('saveOs') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $round->id }}">
                            
                            <div class="row align-items-center justify-content-around flex-wrap">
                                <div class="form-group col-12 col-sm-6">
                                    <label for="length">Długość odcinka w km (np. 22.5)</label>
                                    <input type="text" name="length" class="form-control" required=""> 
                                    @if ($errors->has('length'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('length') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group col-12 col-sm-6">
                                    <label for="results">Plik z wynikami</label>
                                    <input type="file" name="results" class="form-control" required="">
                                    @if ($errors->has('results'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('results') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Dodaj odcinek
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.modals.deleteOs')
@include('admin.modals.editOs')
@endsection