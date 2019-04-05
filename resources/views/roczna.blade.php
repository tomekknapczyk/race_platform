@extends('layouts.app')

@section('content')
<div class="drivers-container container px-0">
    <h3>Klasyfikacja roczna</h3>

    @foreach($klasy as $klasa)
        <h2 class="text-center mb-4 text-uppercase text-white">..:: {{ $klasa }} ::..</h2>
        <div class="row justify-content-start align-items-end mb-5">
            @php
             $order = 2;
            @endphp
            @foreach($race->klasa_rank($klasa)->take(3) as $driver)
                <div class="col-md-4 col-lg-4 col-xl-4 order-{{ $order }} @if($order == 2) mb-5 @endif">
                    <div class="driver"> 
                        @if($driver->user)
                            @if($driver->user->laurels->count())
                                <div class="laurels">
                                    @if($driver->user->laurel_place(1)->count())
                                        <div class="mb-1">
                                            <p class="m-0 laurel gold">{{ $driver->user->laurel_place(1)->count() }}</p>
                                            @php
                                                $klasa = '';
                                                $show = true;
                                            @endphp
                                            @foreach($driver->user->laurel_place(1)->get() as $laurel)
                                                @php
                                                    if($laurel->klasa != $klasa){
                                                        $klasa = $laurel->klasa;
                                                        $show = true;
                                                    }
                                                    else
                                                        $show = false;
                                                @endphp
                                                @if($show)
                                                    <p class="m-0"></p>
                                                    <strong class="inline-block">{{ $klasa }}</strong>
                                                @endif
                                                    <span>{{ $laurel->year }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if($driver->user->laurel_place(2)->count())
                                        <div class="mb-1">
                                            <p class="m-0 laurel silver">{{ $driver->user->laurel_place(2)->count() }}</p>
                                            @php
                                                $klasa = '';
                                                $show = true;
                                            @endphp
                                            @foreach($driver->user->laurel_place(2)->get() as $laurel)
                                                @php
                                                    if($laurel->klasa != $klasa){
                                                        $klasa = $laurel->klasa;
                                                        $show = true;
                                                    }
                                                    else
                                                        $show = false;
                                                @endphp
                                                @if($show)
                                                    <p class="m-0"></p>
                                                    <strong class="inline-block">{{ $klasa }}</strong>
                                                @endif
                                                    <span>{{ $laurel->year }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if($driver->user->laurel_place(3)->count())
                                        <div class="mb-1">
                                            <p class="m-0 laurel brown">{{ $driver->user->laurel_place(3)->count() }}</p>
                                            @php
                                                $klasa = '';
                                                $show = true;
                                            @endphp
                                            @foreach($driver->user->laurel_place(3)->get() as $laurel)
                                                @php
                                                    if($laurel->klasa != $klasa){
                                                        $klasa = $laurel->klasa;
                                                        $show = true;
                                                    }
                                                    else
                                                        $show = false;
                                                @endphp
                                                @if($show)
                                                    <p class="m-0"></p>
                                                    <strong class="inline-block">{{ $klasa }}</strong>
                                                @endif
                                                    <span>{{ $laurel->year }}</span>
                                            @endforeach
                                        </div>
                                    @endif  
                                </div>

                                <div class="laurels-short">
                                    @if($driver->user->laurel_place(1)->count())
                                        <span class="laurel gold mr-1">{{ $driver->user->laurel_place(1)->count() }}</span>
                                    @endif
                                    @if($driver->user->laurel_place(2)->count())
                                        <span class="laurel silver mr-1">{{ $driver->user->laurel_place(2)->count() }}</span>
                                    @endif
                                    @if($driver->user->laurel_place(3)->count())
                                        <span class="laurel brown">{{ $driver->user->laurel_place(3)->count() }}</span>
                                    @endif  
                                </div>
                            @endif
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
                    <h4 class="text-white text-center">Miejsce : {{ $loop->iteration }}</h4>
                    @php
                        switch ($order) {
                            case 2:
                                $order = 1;
                                break;
                            case 1:
                                $order = 3;
                                break;
                        }
                    @endphp
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection