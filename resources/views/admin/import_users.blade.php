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
                            <h6 class="m-0 col-sm-4">
                                {{ $user->name }}
                            </h6>
                            <h6 class="m-0 col-sm-4">
                                {{ $user->car }}
                            </h6>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection