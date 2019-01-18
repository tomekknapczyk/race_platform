@extends('layouts.app')

@section('content')
<div class="drivers-container">
    <h3>Teams</h3>
    <div class="container">
        <div class="row justify-content-center">
            @foreach($teams as $team)
                    <div class="col-md-4 col-lg-4 col-xl-3">
                        <div class="driver">
                            <a href="{{ route('team', $team->id) }}">
                            @if($team->file_id)
                                <img src="{{ url('/public/team/thumb/', $team->file->path) }}" class="img-fluid">
                            @endif
                            <h6 class="my-3" >{{ $team->title }}</h6>
                            </a>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>
@endsection