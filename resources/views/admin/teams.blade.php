@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow d-flex align-items-center justify-content-between">
                    <h4>Teamy</h4>
                </div>
                <div class="card-body list">
                    @foreach($teams as $team)
                        <div class="d-flex justify-content-start align-items-start flex-wrap">
                            <div class="col-md-4">
                                @if($team->file_id)
                                    <img src="{{ url('/public/team/thumb/', $team->file->path) }}" class="img-fluid thumb-big">
                                @endif
                            </div>
                            <h6 class="m-0 col-md-8">
                                <p class="text-uppercase mt-3">{{ $team->title }}</p>
                                <div class="mt-3">{!! $team->text !!}</div>
                                    <button class="btn btn-sm btn-success editBtn" data-toggle="modal" data-target="#editTeam"
                                    data-text='{"team_id":"{{ $team->id }}", "team_title":"{{ $team->title }}"}'
                                    data-tinymce='{"team_opis":{!! json_encode(str_replace('""', '"', str_replace('\'', '"', $team->text))) !!}}'
                                    >Edytuj</button>

                                    <button class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteTeam"
                                    data-id='{{ $team->id }}'>Usuń</button>
                            </h6>
                            <hr class="col-12 my-2 p-0">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.modals.editTeam')
@include('admin.modals.deleteTeam')
@endsection