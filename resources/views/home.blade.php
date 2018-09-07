@extends('layouts.home')

@section('content')
<div class="counter-container">
    <div class="d-flex align-items-end justify-content-center">
        <div class="timer"></div>
        <div class="counter d-flex align-items-center">
            @if($closest)
                @if($closest->form->active)
                    <p>Do rajdu <span class="yellow">{{ $closest->name }}</span> pozostało</p>
                    <div class="countdown d-flex align-items-center justify-content-around">
                        <span id="counter" data-deadline="{{ $closest->date->format('Y') }}-{{ $closest->date->format('m') }}-{{ $closest->date->format('d') }}T{{ $closest->date->format('H') }}:{{ $closest->date->format('i') }}:00"></span>
                    </div>
                @else
                    <p>Zapisy na <span class="yellow">{{ $closest->name }}</span> ruszają za</p>
                    <div class="countdown d-flex align-items-center justify-content-around">
                        <span id="counter" data-deadline="{{ $closest->sign_date->format('Y') }}-{{ $closest->sign_date->format('m') }}-{{ $closest->sign_date->format('d') }}T{{ $closest->sign_date->format('H') }}:{{ $closest->sign_date->format('i') }}:00"></span>
                    </div>
                @endif
            @endif
        </div>
        <div class="sign-container">
            <div class="d-flex align-items-center justify-content-around mb-2">
                <a href="{{ url('dashboard') }}" class="sign-btn"><span>Zapisz się</span></a>
                <span class="sign-location">na rajd</span>
            </div>
            @if($closest && $closest->form->visible)
                <div class="d-flex align-items-center justify-content-around">
                    <span>Lista zgłoszeń</span>
                    <a href="{{ url('/sign-list', $closest->id) }}" class="sign-btn"><span>Zobacz</span></a>
                </div>
            @endif
        </div>
        @if($closest)
            @if($closest->form->active)
                <div class="sign-counter">
                    <p>Zapisanych uczestników</p>
                    <p><span class="yellow">{{ $closest->form->signs->where('active', 1)->count() }}</span></p>
                </div>
            @endif
        @endif
    </div>
</div>
@if($podium)
<div class="drivers-container">
    @if($promoted_race && $promoted_race->value == 'race')
        <h3>Klasyfikacja roczna</h3>
    @else
        <h3>Ostatni zwycięzcy</h3>
    @endif
    <h2 class="text-center mb-3 text-uppercase text-white">..:: {{ $random }} ::..</h2>
    <div class="row justify-content-center">
        @foreach($podium as $driver)
            <div class="col-md-4 col-lg-3 col-xl-2">
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
    <div class="text-right">
        @if($promoted_race && $promoted_race->value == 'race')
            <a href="{{ url('klasyfikacja-roczna', $last->race->id) }}" class="btn btn-warning">Zobacz pozostałych</a>
        @else
            <a href="{{ url('podium', $last->id) }}" class="btn btn-warning">Zobacz pozostałych</a>
        @endif
    </div>
</div>
@endif
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
</div>

@if($promoted)
    @include('modals.randomPartner')
@endif
@endsection