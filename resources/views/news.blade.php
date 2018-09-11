@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    <a href="{{ url('/aktualnosci') }}" class="text-white">Aktualności</a> : {{ $news->title }}
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-top flex-wrap">
                        <div class="col-sm-3">
                            @if($news->file_id)
                                <img src="{{ url('public/post', $news->file->path) }}" class="img-fluid img-thumbnail">
                            @endif
                        </div>
                        <div class="col-sm-9 full-news-body">
                            {!! $news->text !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.deleteNews')
@endsection