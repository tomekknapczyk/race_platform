@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Aktualności
                    <a class="btn btn-sm btn-primary float-right" href="{{ url('newPost') }}">Dodaj nową aktualność</a>
                </div>
                <div class="card-body">
                    @foreach($news as $post)
                        <div class="d-flex justify-content-start align-items-center flex-wrap">
                            <div class="col-sm-2">
                                @if($post->file_id)
                                    <img src="{{ url('public/post/thumb/', $post->file->path) }}" class="img-fluid img-thumbnail">
                                @endif
                            </div>
                            <div class="col-sm-2 text-center">
                                {{ $post->created_at->format('Y-m-d') }}
                            </div>
                            <h6 class="m-0 col-sm-2">
                                {{ $post->title }}
                            </h6>
                            <div class="col-sm-4">
                                {{ strip_tags($post->text) }}
                            </div>
                            <div class="col-sm-2 text-right">
                                <a href="{{ url('editPost', $post->id) }}" class="btn btn-sm btn-info">Edytuj</a>
                                <button class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteNews" data-id="{{ $post->id }}">Usuń</button>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.deleteNews')
@endsection