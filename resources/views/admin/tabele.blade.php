@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Tabele do transmisji
                    <button class="btn btn-sm btn-success float-right text-uppercase ml-2" data-toggle="modal" data-target="#newTable">Dodaj tabele</button>
                    <a class="btn btn-sm btn-primary float-right" href="{{ url('import_users') }}">Lista uczestników</a>
                </div>
                <div class="card-body">
                    @foreach($tabele as $tabela)
                        <div class="d-flex justify-content-start align-items-center flex-wrap">
                            <div class="col-sm-2">
                                {{ $tabela->name }}
                            </div>
                            <h6 class="m-0 col-sm-2">
                                {{ $tabela->subname }}
                            </h6>
                            <h6 class="m-0 col-sm-2">
                                @if($tabela->active)
                                    Aktywna
                                @endif
                            </h6>
                            <div class="col-sm-2">
                                <form action="{{ route('set_active_table') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="active" value="{{ $tabela->id }}">
                                    <button type="submit" class="btn btn-sm btn-primary">Ustaw jako aktywną</button>
                                </form>
                            </div>
                            <div class="col-sm-4 text-right">
                                <a href="{{ url('edycja_tabeli', $tabela->id) }}" class="btn btn-sm btn-info">Edytuj uczestników</a>
                                <button class="btn btn-sm btn-dark editBtn" data-toggle="modal" data-target="#editTable" 
                                    data-text='{"id":"{{ $tabela->id }}", "name":"{{ $tabela->name }}", "subname":"{{ $tabela->subname }}"}'
                                    >Edytuj</button>
                                <button class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteTable" data-id="{{ $tabela->id }}">Usuń</button>
                            </div>
                            <div class="col-sm-12 bg-dark mt-1">
                                <code>{{ url('tabela', $tabela->id) }}</code>
                                @if($tabela->active)
                                    <br>
                                    <code>{{ url('aktywna') }}</code>
                                @endif
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.newTable')
@include('admin.modals.editTable')
@include('admin.modals.deleteTable')
@endsection