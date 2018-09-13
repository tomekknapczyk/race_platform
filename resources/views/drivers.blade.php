@extends('layouts.app')

@section('content')
<div class="drivers-container">
    <h3>Kierowcy</h3>
    <div class="container" id="driver-list">
        <div class="row justify-content-center align-items-center py-3">
            <button class="search-clear btn btn-warning m-1">Wszyscy</button>
            <button class="search-class btn btn-warning m-1" data-klasa="k1">K1</button>
            <button class="search-class btn btn-warning m-1" data-klasa="k2">K2</button>
            <button class="search-class btn btn-warning m-1" data-klasa="k3">K3</button>
            <button class="search-class btn btn-warning m-1" data-klasa="k4">K4</button>
            <button class="search-class btn btn-warning m-1" data-klasa="k5">K5</button>
            <button class="search-class btn btn-warning m-1" data-klasa="k6">K6</button>
            <button class="search-class btn btn-warning m-1" data-klasa="k7">K7</button>
            <button class="sort btn btn-warning m-1" data-sort="nazwisko">Sortuj wg nazwiska</button>
            <div class="col-sm-3">
                <input class="search form-control" placeholder="Wyszukaj" />
            </div>
        </div>
        <div class="row justify-content-center list">
            @foreach($users as $user)
                @if($user->driver)
                    <div class="col-md-4 col-lg-4 col-xl-3">
                        <div class="driver klasa" data-klasa="{{ $user->klasy() }}">
                            @if($user->driver->show_name && $user->driver->show_lastname)
                                <a href="{{ route('kierowca', [$user->id, str_slug($user->driver->name.'-'.$user->driver->lastname)]) }}">
                            @elseif($user->driver->show_lastname)
                                <a href="{{ route('kierowca', [$user->id, $user->driver->lastname]) }}">
                            @else
                                <a href="{{ route('kierowca', $user->id) }}">
                            @endif
                            @if($user->driver->file_id)
                                <img src="{{ url('/public/driver', $user->driver->file->path) }}" class="img-fluid">
                            @else
                                <img src="{{ url('/images/driver.png') }}" class="img-fluid">
                            @endif
                            <h6 class="my-3 nazwisko" data-nazwisko="@if($user->driver->show_lastname){{ $user->driver->lastname }}@endif">
                                @if($user->driver->show_name){{ $user->driver->name }}@endif
                                @if($user->driver->show_lastname){{ $user->driver->lastname }}@endif
                                @if(!$user->driver->show_lastname && !$user->driver->show_name) Anonim @endif
                            </h6>
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
      valueNames: [ { attr: 'data-klasa', name: 'klasa' }, { attr: 'data-nazwisko', name: 'nazwisko' } ]
    };

    var userList = new List('driver-list', options);
</script>
@endsection