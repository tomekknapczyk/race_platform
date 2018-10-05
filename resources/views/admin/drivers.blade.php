@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark" id="driver-list">
                <div class="card-header bg-yellow d-flex align-items-center justify-content-between">
                    <h4>Zawodnicy</h4>
                    <div class="col-sm-5">
                        <input class="search form-control" placeholder="Wyszukaj" />
                    </div>
                </div>
                <div class="card-body list">
                    @foreach($users as $user)
                        <div class="d-flex justify-content-start align-items-start flex-wrap">
                            <div class="col-md-2">
                                @if($user->profile && $user->profile->file_id)
                                    <img src="{{ url('/public/driver/thumb/', $user->profile->file->path) }}" class="img-fluid thumb-big">
                                @else
                                    <img src="{{ url('/images/driver.png') }}" class="img-fluid thumb-big">
                                @endif
                            </div>
                            <h6 class="m-0 col-md-3 imie nazwisko" data-imie="{{ optional($user->profile)->name }}" data-nazwisko="{{ optional($user->profile)->lastname }}">
                                <a href="{{ route('kierowca', $user->id) }}" class="text-dark">{{ optional($user->profile)->name }} {{ optional($user->profile)->lastname }}</a>
                                <br>
                                <small>{{ $user->email }}</small>
                                <button class="btn btn-sm btn-link editBtn" data-toggle="modal" data-target="#editDriver"
                                data-text='{"driver_id":"{{ optional($user->profile)->id }}", "driver_name":"{{ optional($user->profile)->name }}", "driver_lastname":"{{ optional($user->profile)->lastname }}", "driver_phone":"{{ optional($user->profile)->phone }}", "driver_id_card":"{{ optional($user->profile)->id_card }}", "driver_address":"{{ optional($user->profile)->address }}", "driver_driving_license":"{{ optional($user->profile)->driving_license }}", "driver_oc":"{{ optional($user->profile)->oc }}", "driver_nw":"{{ optional($user->profile)->nw }}"}'
                                data-check='{"driver_showName":"{{ optional($user->profile)->show_name }}", "driver_showLastname":"{{ optional($user->profile)->show_lastname }}", "driver_showEmail":"{{ optional($user->profile)->show_email }}"}'
                                @if($user->profile && $user->profile->file_id)
                                    data-img='{"driver_photo":"{{ url('public/driver/thumb/', $user->profile->file->path) }}"}'
                                @else
                                    data-img='{"driver_photo":""}'
                                @endif
                                data-tinymce='{"driver_text":{!! json_encode(optional($user->profile)->desc) !!}}'
                                >Edytuj</button>
                                <p class="klasa text-uppercase mt-3">{{ $user->klasy() }}</p>
                            </h6>
                            <div class="col-md-4">
                                @if($user->pilots->count())
                                    <h6 class="text-center">Piloci</h6>
                                    @foreach($user->pilots as $pilot)
                                        <div class="d-flex justify-content-start align-items-center flex-wrap">
                                            <div class="col-sm-8">
                                                {{ $pilot->name }} {{ $pilot->lastname }}
                                            </div>
                                            <div class="col-sm-4">
                                                <button class="btn btn-sm btn-link editBtn" data-toggle="modal" data-target="#editPilot"
                                                data-text='{"id":"{{ $pilot->id }}", "name":"{{ $pilot->name }}", "lastname":"{{ $pilot->lastname }}", "phone":"{{ $pilot->phone }}", "email":"{{ $pilot->email }}", "id_card":"{{ $pilot->id_card }}", "address":"{{ $pilot->address }}", "driving_license":"{{ $pilot->driving_license }}", "oc":"{{ $pilot->oc }}", "nw":"{{ $pilot->nw }}"}'
                                                data-check='{"showName":"{{ $pilot->show_name }}", "showLastname":"{{ $pilot->show_lastname }}", "showEmail":"{{ $pilot->show_email }}"}'
                                                @if($pilot->file_id)
                                                    data-img='{"photo":"{{ url('public/pilot/thumb/', $pilot->file->path) }}"}'
                                                @else
                                                    data-img='{"photo":""}'
                                                @endif
                                                >Edytuj</button>
                                            </div>
                                        </div>
                                        <hr class="m-0">
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if($user->cars->count())
                                    <h6 class="text-center">Samochody</h6>
                                    @foreach($user->cars as $car)
                                        <div class="d-flex justify-content-start align-items-center flex-wrap">
                                            <div class="col-sm-8">
                                                {{ $car->marka }} {{ $car->model }}
                                            </div>
                                            <div class="col-sm-4">
                                                <button class="btn btn-sm btn-link editBtn" data-toggle="modal" data-target="#editCar"
                                                data-text='{"car_id":"{{ $car->id }}", "marka":"{{ $car->marka }}", "model":"{{ $car->model }}", "rok":"{{ $car->rok }}", "ccm":"{{ $car->ccm }}", "nr_rej":"{{ $car->nr_rej }}"}'
                                                data-check='{"turbo":"{{ $car->turbo }}", "rwd":"{{ $car->rwd }}"}'
                                                @if($car->file_id)
                                                    data-img='{"car_photo":"{{ url('public/car/thumb/', $car->file->path) }}"}'
                                                @else
                                                    data-img='{"car_photo":""}'
                                                @endif
                                                >Edytuj</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <hr class="col-12 my-2 p-0">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.modals.editDriver')
@include('modals.editPilot')
@include('modals.editCar')

<script>
    var options = {
      valueNames: [ { attr: 'data-imie', name: 'imie' }, { attr: 'data-nazwisko', name: 'nazwisko' }, 'klasa' ]
    };

    var userList = new List('driver-list', options);
</script>
@endsection