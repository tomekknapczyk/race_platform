@extends('layouts.home')

@section('content')
<div class="counter-container">
    <div class="d-flex align-items-end justify-content-center">
        <div class="timer"></div>
        <div class="counter d-flex align-items-center">
            <p>Do <span class="yellow">4 runda</span> pozostało:</p>
            <div class="countdown d-flex align-items-center justify-content-around">
                <span id="counter" @if($closest) data-deadline="{{ $closest->date->format('Y') }},{{ $closest->date->format('n') }},{{ $closest->date->format('j') }}" @endif></span>
            </div>
        </div>
        <div class="sign-container d-flex align-items-center justify-content-around">
            <a href="{{ url('dashboard') }}" class="sign-btn">Zapisz się</a>
            <span>na rajd</span>
        </div>
    </div>
</div>
<div class="drivers-container">
    <h3>Ostatni zwycięzcy</h3>
    <h2 class="text-center mb-3 text-uppercase text-white">..:: {{ $random }} ::..</h2>
    <div class="row justify-content-center">
        @foreach($podium as $driver)
            <div class="col-sm-3">
                <div class="driver"> 
                    <a href="{{ url('kierowca', $driver->user->id) }}">
                    @if($driver->user->driver->file_id)
                        <img src="{{ url('public/driver', $driver->user->driver->file->path) }}" class="img-fluid">
                    @else
                        <img src="{{ url('images/driver.png') }}" class="img-fluid">
                    @endif
                    <h6 class="my-3">
                            @if($driver->user->driver->show_name){{ $driver->user->driver->name }}@endif
                            @if($driver->user->driver->show_lastname){{ $driver->user->driver->lastname }}@endif
                            @if(!$driver->user->driver->show_lastname && !$driver->user->driver->show_name) Anonim @endif
                    </h6>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="news-container">
    <h3>News</h3>
    <div class="row justify-content-start">
        @foreach($news as $post)
            <div class="col-sm-3">
                <div class="news"> 
                    @if($post->file_id)
                        <img src="{{ url('public/post', $post->file->path) }}" class="img-fluid">
                    @endif
                    <div class="news-body">
                        <p>{{ str_limit(strip_tags($post->text), 100) }}</p>

                        <a href="{{ url('aktualnosc', $post->id) }}">więcej</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@if($promoted)
    @include('modals.randomPartner')
@endif
@endsection