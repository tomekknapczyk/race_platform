@extends('layouts.app')

@section('content')
<div class="drivers-container">
    <h3>Piloci</h3>
    <div class="container" id="pilots-list">
        <div class="row justify-content-center align-items-center p-3">
            <div class="filter-box">
                <p>Sortowanie</p>
                <button class="sort btn btn-warning m-1" data-sort="nazwisko">Sortuj wg nazwiska</button>
            </div>
            <div class="filter-box col-sm-3">
                <p>Wyszukiwarka</p>
                <div class="m-1">
                    <input class="search form-control" placeholder="Wyszukaj" />
                </div>
            </div>
        </div>
        <div class="row justify-content-center list">
            @foreach($pilots as $user)
                @if($user->profile)
                    <div class="col-md-4 col-lg-4 col-xl-3">
                        <div class="driver">
                            @if($user->laurels->count())
                                <div class="laurels">
                                    @if($user->laurel_first->count())
                                        <div class="mb-1">
                                            <p class="m-0 laurel gold">{{ $user->laurel_first->count() }}</p>
                                            @php
                                                $klasa = '';
                                                $show = true;
                                            @endphp
                                            @foreach($user->laurel_first as $laurel)
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
                                    @if($user->laurel_second->count())
                                        <div class="mb-1">
                                            <p class="m-0 laurel silver">{{ $user->laurel_second->count() }}</p>
                                            @php
                                                $klasa = '';
                                                $show = true;
                                            @endphp
                                            @foreach($user->laurel_second as $laurel)
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
                                    @if($user->laurel_third->count())
                                        <div class="mb-1">
                                            <p class="m-0 laurel brown">{{ $user->laurel_third->count() }}</p>
                                            @php
                                                $klasa = '';
                                                $show = true;
                                            @endphp
                                            @foreach($user->laurel_third as $laurel)
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
                                    @if($user->laurel_first->count())
                                        <span class="laurel gold mr-1">{{ $user->laurel_first->count() }}</span>
                                    @endif
                                    @if($user->laurel_second->count())
                                        <span class="laurel silver mr-1">{{ $user->laurel_second->count() }}</span>
                                    @endif
                                    @if($user->laurel_third->count())
                                        <span class="laurel brown">{{ $user->laurel_third->count() }}</span>
                                    @endif  
                                </div>
                            @endif
                            @if($user->profile->show_name && $user->profile->show_lastname)
                                <a href="{{ route('pilot', [$user->id, str_slug($user->profile->name.'-'.$user->profile->lastname)]) }}">
                            @elseif($user->profile->show_lastname)
                                <a href="{{ route('pilot', [$user->id, $user->profile->lastname]) }}">
                            @else
                                <a href="{{ route('pilot', $user->id) }}">
                            @endif
                            @if($user->profile->file_id)
                                <img src="{{ url('/public/driver/thumb/', $user->profile->file->path) }}" class="img-fluid">
                            @else
                                <img src="{{ url('/images/driver.png') }}" class="img-fluid">
                            @endif
                            <h6 class="my-3 nazwisko" data-nazwisko="@if($user->profile->show_lastname){{ $user->profile->lastname }}@endif">@if($user->profile->show_name){{ $user->profile->name }}@endif @if($user->profile->show_lastname){{ $user->profile->lastname }}@endif @if(!$user->profile->show_lastname && !$user->profile->show_name) Anonim @endif</h6>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<script>
    var options = {
      valueNames: [ { attr: 'data-nazwisko', name: 'nazwisko' } ]
    };

    var userList = new List('pilots-list', options);
</script>
@endsection