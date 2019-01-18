@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Nie należysz do żadnego teamu
                    <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#newTeam">Stwórz team</button>
                </div>
                <div class="card-body">
                    @if(auth()->user()->team_requests->count())
                    <h3>Twoje zaproszenia do teamów</h3>
                        <hr>
                        @foreach(auth()->user()->team_requests as $request)
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h4 class="col-md-6 m-0">{{ $request->team->title }}</h4>
                                <div class="col-md-6 text-right">
                                    <button class="btn btn-sm btn-outline-danger editBtn" data-toggle="modal" data-target="#acceptRequest" data-text='{"team_id":"{{ $request->team_id }}"}'>Akceptuj zaproszenie</button>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.newTeam')
@include('modals.acceptRequest')
@endsection