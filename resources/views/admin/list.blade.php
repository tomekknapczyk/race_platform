@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center overflow-auto">
        <div class="col-md-12">
            <div class="card border-dark fixed-width">
                <div class="card-header bg-yellow d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ url('races') }}" class="text-white">Rajdy</a> : <a href="{{ url('race', $round->race->id) }}" class="text-white">{{ $round->race->name }}</a> : {{ $round->name }}
                    </div>
                    <div>
                        <div class="btn-group">
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#makeFile">Generuj plik</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteList">Usuń listę startową</button>
                            <a href="{{ url('races') }}" class="btn btn btn-success" onclick="event.preventDefault(); document.getElementById('save-rank').submit();">Zapisz miejsca</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="text-center mt-4 mb-3 text-uppercase">Lista startowa</h2>
                    @if($is_someone)
                        <form id="save-rank" action="{{ route('saveRank') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $round->id }}">
                            @foreach($class as $klasa)
                                <h2 class="text-center mt-4 mb-3 text-uppercase">..:: {{ $klasa }} ::..</h2>
                                <div class="lista"> 
                                    @foreach($startPositions->where('klasa', $klasa) as $position)
                                        <div class="row justify-content-between align-items-center flex-wrap py-2">
                                            <h6 class="m-0 col-1">
                                                {{ $loop->iteration }}.
                                            </h6>
                                            <h6 class="m-0 col-4">
                                                {{ $position->sign->name }} {{ $position->sign->lastname }}<br>
                                                <small><strong>Pilot:</strong> {{ $position->sign->pilot_name }} {{ $position->sign->pilot_lastname }}</small>
                                            </h6>
                                            <h6 class="m-0 col-3">
                                                {{ $position->sign->marka }} {{ $position->sign->model }} - {{ $position->sign->ccm }}ccm<br>
                                                <small>{{ $position->sign->rok }}r. @if($position->sign->turbo) / <strong>Turbo</strong> @endif @if($position->sign->rwd) / <strong>RWD</strong> @endif</small>
                                            </h6>
                                            <h6 class="m-0 col-2">
                                                Miejsce {{ $position->rank() }}
                                            </h6>
                                            <h6 class="m-0 col-2">
                                                <select name="rank[{{ $position->id }}]" class="form-control" id="rank_{{ $position->id }}">
                                                    <option value="0" selected="">Brak</option>
                                                    <option value="1" @if($position->rank() == 1) selected="" @endif>1</option>
                                                    <option value="2" @if($position->rank() == 2) selected="" @endif>2</option>
                                                    <option value="3" @if($position->rank() == 3) selected="" @endif>3</option>
                                                    <option value="4" @if($position->rank() == 4) selected="" @endif>4</option>
                                                    <option value="5" @if($position->rank() == 5) selected="" @endif>5</option>
                                                    <option value="6" @if($position->rank() == 6) selected="" @endif>6</option>
                                                    <option value="7" @if($position->rank() == 7) selected="" @endif>7</option>
                                                    <option value="8" @if($position->rank() == 8) selected="" @endif>8</option>
                                                </select>
                                            </h6>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.deleteList')
@include('admin.modals.makeFile')
@endsection