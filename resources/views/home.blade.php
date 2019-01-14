@extends('layouts.home')

@section('content')
<div class="counter-container d-flex justify-content-center align-items-start">
    <div class="d-flex align-items-center justify-content-center flex-wrap">
        @if($closest)
            <div class="timer"></div>
            <div class="counter d-flex align-items-center">
                {{-- @if($closest) --}}
                    @if($closest->form->active || $closest->startList)
                        <p>Do rajdu <a href="{{ route('rajd', $closest->id) }}" class="yellow">@if($closest->sub_name){{ $closest->sub_name }}@else{{ $closest->name }}@endif</a> pozostało</p>
                        <div class="countdown d-flex align-items-center justify-content-end">
                            <span id="counter" data-deadline="{{ $closest->date->format('Y') }}-{{ $closest->date->format('m') }}-{{ $closest->date->format('d') }}T{{ $closest->date->format('H') }}:{{ $closest->date->format('i') }}:00"></span>
                        </div>
                    @else
                        <p>Zapisy na <a href="{{ route('rajd', $closest->id) }}" class="yellow">@if($closest->sub_name){{ $closest->sub_name }}@else{{ $closest->name }}@endif</a> ruszają za</p>
                        <div class="countdown d-flex align-items-center justify-content-end">
                            <span id="counter" data-deadline="{{ $closest->sign_date->format('Y') }}-{{ $closest->sign_date->format('m') }}-{{ $closest->sign_date->format('d') }}T{{ $closest->sign_date->format('H') }}:{{ $closest->sign_date->format('i') }}:00"></span>
                        </div>
                    @endif
                {{-- @endif --}}
            </div>
        @else
            <h3 class="text-white h1 mt-5 text-uppercase text-center">Wkrótce zapisy</h3>
        @endif
        <div class="sign-container">
            @if($closest && $closest->form->active)
                <div class="d-flex align-items-center justify-content-around mb-2">
                    <a href="{{ url('dashboard') }}" class="sign-btn"><span>Zapisz się</span></a>
                    <span class="sign-location">na rajd</span>
                </div>
            @endif
            @if($closest && $closest->form->visible)
                <div class="d-flex align-items-center justify-content-around">
                    <span>Lista zgłoszeń</span>
                    <a href="{{ url('/sign-list', $closest->id) }}" class="sign-btn"><span>Zobacz</span></a>
                </div>
            @endif
        </div>
        @if($closest)
            @if($closest->form->active || $closest->startList)
                <div class="sign-counter">
                    <p class="m-0">Zapisanych uczestników</p>
                    <p><span class="yellow">{{ $closest->form->signs->where('active', 1)->count() }}</span></p>
                </div>
            @endif
        @endif
    </div>
</div>
@if($podium && $podium->count)
<div class="drivers-container">
    @if($promoted_race && $promoted_race->value == 'race')
        <h3>Klasyfikacja roczna</h3>
    @else
        <h3>Zwycięzcy {{ $last->name }}</h3>
    @endif
    <h2 class="text-center mb-3 text-uppercase text-white">..:: {{ $random }} ::..</h2>
    <div class="row justify-content-center">
        @foreach($podium->take(3) as $driver)
            <div class="col-md-4 col-lg-4 col-xl-3">
                <div class="driver"> 
                    @if($driver->user)
                        @if($driver->user->profile->show_name && $driver->user->profile->show_lastname)
                            <a href="{{ route('kierowca', [$driver->user->id, str_slug($driver->user->profile->name.'-'.$driver->user->profile->lastname)]) }}">
                        @elseif($driver->user->profile->show_lastname)
                            <a href="{{ route('kierowca', [$driver->user->id, $driver->user->profile->lastname]) }}">
                        @else
                            <a href="{{ route('kierowca', $driver->user->id) }}">
                        @endif

                        @if($driver->user->profile->file_id)
                            <img src="{{ url('public/driver/thumb/', $driver->user->profile->file->path) }}" class="img-fluid">
                        @else
                            <img src="{{ url('images/driver.png') }}" class="img-fluid">
                        @endif
                        <h6 class="my-3">
                            @if($driver->user->profile->show_name){{ $driver->user->profile->name }}@endif
                            @if($driver->user->profile->show_lastname){{ $driver->user->profile->lastname }}@endif
                            @if(!$driver->user->profile->show_lastname && !$driver->user->profile->show_name) Anonim @endif
                        </h6>
                        </a>
                    @else
                        <img src="{{ url('images/driver.png') }}" class="img-fluid">
                        <h6 class="my-3">
                            {{ $driver->sign->name }} {{ $driver->sign->lastname }}
                        </h6>
                    @endif
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
                        <a href="{{ url('aktualnosc', $post->id) }}"><img src="{{ url('public/post/thumb/', $post->file->path) }}" class="img-fluid"></a>
                    @endif
                    <div class="news-body">
                        <div class="news-content">
                            <p>{!! str_limit(strip_tags($post->text, '<p><span><br /><br><strong>'), 100) !!}</p>
                        </div>

                        <a href="{{ url('aktualnosc', $post->id) }}" class="news-btn"><span>więcej</span></a>

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