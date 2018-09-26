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
                    <form method="POST" action="{{ route('saveTableUsers') }}" id="saveTableUsers">
                        @csrf
                        <input type="hidden" name="id" value="{{ $tabela->id }}">
                        <input type="hidden" name="items" id="file_items">

                        <div class="row">
                            <div class="col-sm-6">
                                <h4>Wybrani uczestnicy:</h4>
                                <div class="bg-dark p-2 rounded mb-5 d-flex justify-content-start align-items-center flex-wrap" id="items">
                                    @foreach($tabela->items as $item)
                                        <div class="btn btn-block btn-sm btn-light m-2 shadow btn-move text-left" data-id="{{ $item->user->id }}">{{ $item->user->nr }} :: {{ $item->user->name }} :: {{ $item->user->car }}</div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <h4>Uczestnicy do wyboru:</h4>
                                <div class="bg-dark p-2 rounded mb-5 d-flex justify-content-start align-items-center flex-wrap" id="dropdown">
                                    @foreach($niewykorzystani as $item)
                                        <div class="btn btn-block btn-sm btn-light m-2 shadow btn-move text-left" data-id="{{ $item->id }}">{{ $item->nr }} :: {{ $item->name }} :: {{ $item->car }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-info btn-block" id="saveTable">
                                    Zapisz listę
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection