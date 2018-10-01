@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    <a href="{{ route('tables') }}" class="text-white">Tabele do transmisji</a> : 
                    Uczestnicy
                    <div class="float-right">
                        <form action="{{ route('clear_import_users') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Wyczyść listę</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($users as $user)
                        <div class="d-flex justify-content-start align-items-center flex-wrap">
                            <div class="col-sm-2">
                                {{ $user->nr }}
                            </div>
                            <h6 class="m-0 col-sm-3">
                                {{ $user->name }}
                            </h6>
                            <h6 class="m-0 col-sm-3">
                                {{ $user->pilot }}
                            </h6>
                            <h6 class="m-0 col-sm-2">
                                {{ $user->car }}
                            </h6>
                            <div class="col-sm-2">
                                <button class="btn btn-sm btn-link editBtn" data-toggle="modal" data-target="#editUser"
                                    data-text='{"id":"{{ $user->id }}", "nr":"{{ $user->nr }}", "name":"{{ $user->name }}", "pilot":"{{ $user->pilot }}", "car":"{{ $user->car }}"}'>
                                    Edytuj
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteUser" data-id="{{ $user->id }}">Usuń</button>
                            </div>
                        </div>
                        <hr>
                    @endforeach

                    @if(!$users->count())
                        <h4>Wgraj plik z uczestnikami</h4>
                        <form method="POST" action="{{ route('import_users') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="lista">Lista csv</label>
                                <input type="file" name="lista" class="form-control">
                                @if ($errors->has('lista'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lista') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                Zapisz
                            </button>
                        </form>
                    @endif

                    <h4 class="mt-5">Dodaj uczestnika</h4>
                    <form method="POST" action="{{ route('add_import_users') }}">
                        @csrf

                        <div class="row align-items-end">
                            <div class="col-1">
                                <div class="form-group m-0">
                                    <label for="nr">Numer</label>
                                    <input type="text" name="nr" class="form-control" required="">
                                    @if ($errors->has('nr'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('nr') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group m-0">
                                    <label for="name">Kierowca</label>
                                    <input type="text" name="name" class="form-control" required="">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group m-0">
                                    <label for="pilot">Pilot</label>
                                    <input type="text" name="pilot" class="form-control">
                                    @if ($errors->has('pilot'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('pilot') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group m-0">
                                    <label for="car">Samochód</label>
                                    <input type="text" name="car" class="form-control" required="">
                                    @if ($errors->has('car'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('car') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Zapisz
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.editUser')
@include('admin.modals.deleteUser')
@endsection