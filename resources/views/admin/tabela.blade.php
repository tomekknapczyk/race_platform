@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    <a href="{{ route('tables') }}" class="text-white">Tabele do transmisji</a> : {{ $tabela->name }}
                </div>
                <div class="card-body">
                    <h3>{{ $tabela->name }}</h3>
                    <h4>{{ $tabela->subname }}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <form method="POST" action="{{ route('saveTableUsers') }}" id="saveTableUsers">
                                @csrf
                                <input type="hidden" name="id" value="{{ $tabela->id }}">
                                <input type="hidden" name="items" id="file_items">

                                <h4>Uczestnicy na liście:</h4>
                                <div class="bg-info p-4 rounded mb-5 d-flex justify-content-start align-items-center flex-wrap" id="items">
                                    @foreach($tabela->items as $item)
                                        <div class="btn btn-block btn-sm btn-light m-2 shadow btn-move text-left" data-id="{{ $item->user->id }}">{{ $item->user->nr }} :: {{ $item->user->name }} :: {{ $item->user->pilot }} :: {{ $item->user->car }}</div>
                                    @endforeach
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-info btn-block" id="saveTable">
                                            Zapisz listę
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <form method="POST" action="{{ route('addTableUsers') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $tabela->id }}">
                                <h4>
                                    Uczestnicy do wyboru:
                                    <button class="btn btn-primary btn-sm select_all mb-3 float-right">zaznacz / odznacz wszystkich</button>
                                </h4>

                                <div class="bg-dark p-4 rounded mb-5 d-flex w-100 justify-content-start align-items-center flex-wrap" id="dropdown">
                                    @foreach($niewykorzystani as $item)
                                        <div class="btn btn-block btn-sm btn-light m-2 shadow btn-move text-left" data-id="{{ $item->id }}">
                                            <div class="checkbox">
                                                <input type="checkbox" id="multiadd_{{ $item->id }}"  name="multiadd[{{ $item->id }}]" value="1"> 
                                                <label for="multiadd_{{ $item->id }}">{{ $item->nr }} :: {{ $item->name }} :: {{ $item->pilot }} :: {{ $item->car }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-dark btn-block" id="saveTable">
                                            << Dodaj uczestników
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
</div>
@endsection