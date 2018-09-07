@extends('layouts.app')

@section('content')
    <div class="news-container">
        <h3>News</h3>
        <div class="row justify-content-start">
            @foreach($news as $post)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="news"> 
                        @if($post->file_id)
                            <img src="{{ url('public/post', $post->file->path) }}" class="img-fluid">
                        @endif
                        <div class="news-body">
                            <p>{!! str_limit(strip_tags($post->text, '<p><span><br /><br><strong>'), 100) !!}</p>

                            <a href="{{ url('aktualnosc', $post->id) }}"><span>więcej</span></a>

                            <div class="news-date">
                                <span class="day">{{ $post->created_at->format('d') }}</span>
                                <span class="month text-uppercase">{{ __($post->created_at->format('M')) }}</span>
                                <span class="year">{{ $post->created_at->format('Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $news->links() }}
        </div>
    </div>
@endsection