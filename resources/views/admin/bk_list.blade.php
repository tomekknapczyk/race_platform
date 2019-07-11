@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ url('races') }}" class="text-white">Rajdy</a> : Lista
                    </div>
                    <div>
                        <div class="btn-group">
                            <form method="POST" action="{{ route('makeFileBk') }}">
                                @csrf
                                <input type="hidden" name="drivers" value="{{ $ids }}">
                                <button type="submit" class="btn btn-info btn-block">
                                    Generuj plik
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="lista"> 
                        @foreach($drivers as $driver)
                            <div class="row justify-content-between align-items-center flex-wrap py-2">
                                <h6 class="m-0 col-4">
                                    {{ $driver->name }} {{ $driver->lastname }} 
                                </h6>
                                <h6 class="m-0 col-3">
                                    {{ $driver->marka }} {{ $driver->model }}
                                </h6>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection