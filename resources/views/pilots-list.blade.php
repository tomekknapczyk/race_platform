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
            @foreach($pilots as $pilot)
                @if($pilot->profile)
                    <div class="col-md-4 col-lg-4 col-xl-3">
                        <div class="driver">
                            @if($pilot->profile->show_name && $pilot->profile->show_lastname)
                                <a href="{{ route('pilot', [$pilot->id, str_slug($pilot->profile->name.'-'.$pilot->profile->lastname)]) }}">
                            @elseif($pilot->profile->show_lastname)
                                <a href="{{ route('pilot', [$pilot->id, $pilot->profile->lastname]) }}">
                            @else
                                <a href="{{ route('pilot', $pilot->id) }}">
                            @endif
                            @if($pilot->profile->file_id)
                                <img src="{{ url('/public/driver', $pilot->profile->file->path) }}" class="img-fluid">
                            @else
                                <img src="{{ url('/images/driver.png') }}" class="img-fluid">
                            @endif
                            <h6 class="my-3 nazwisko" data-nazwisko="@if($pilot->profile->show_lastname){{ $pilot->profile->lastname }}@endif">
                                @if($pilot->profile->show_name){{ $pilot->profile->name }}@endif
                                @if($pilot->profile->show_lastname){{ $pilot->profile->lastname }}@endif
                                @if(!$pilot->profile->show_lastname && !$pilot->profile->show_name) Anonim @endif
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
      valueNames: [ { attr: 'data-nazwisko', name: 'nazwisko' } ]
    };

    var userList = new List('pilots-list', options);
</script>
@endsection