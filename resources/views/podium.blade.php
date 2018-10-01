@extends('layouts.app')

@section('content')
<div class="drivers-container">
    <h3>Zwycięzcy {{ $round->name }} @if($round->sub_name) - {{ $round->sub_name }}@endif</h3>

    @foreach($klasy as $klasa)
        <h2 class="text-center mb-3 text-uppercase text-white">..:: {{ $klasa }} ::..</h2>
        <div class="row justify-content-center">
            @foreach($round->podium($start_list_id, $klasa) as $driver)
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
                                <img src="{{ url('public/driver', $driver->user->profile->file->path) }}" class="img-fluid">
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
    @endforeach
</div>
@endsection