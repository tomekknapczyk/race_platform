@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark">
                    Zawodnicy
                </div>
                <div class="card-body">
                    @foreach($users as $user)
                        <div class="d-flex justify-content-start align-items-center flex-wrap">
                            <div class="col-sm-2">
                                @if($user->driver->file_id)
                                    <img src="{{ url('public/driver', $user->driver->file->path) }}" class="img-fluid img-thumbnail">
                                @endif
                            </div>
                            <h6 class="m-0 col-sm-2">
                                <a href="{{ url('driver', $user->driver->id) }}" class="text-dark">{{ $user->driver->name }} {{ $user->driver->lastname }}</a>
                                <br>
                                <small>{{ $user->email }}</small>
                                <button class="btn btn-sm btn-link editBtn" data-toggle="modal" data-target="#editDriver"
                                data-text='{"driver_id":"{{ $user->driver->id }}", "driver_name":"{{ $user->driver->name }}", "driver_lastname":"{{ $user->driver->lastname }}", "driver_phone":"{{ $user->driver->phone }}", "driver_id_card":"{{ $user->driver->id_card }}", "driver_address":"{{ $user->driver->address }}", "driver_driving_license":"{{ $user->driver->driving_license }}", "driver_oc":"{{ $user->driver->oc }}", "driver_nw":"{{ $user->driver->nw }}"}'
                                data-check='{"driver_showName":"{{ $user->driver->show_name }}", "driver_showLastname":"{{ $user->driver->show_lastname }}", "driver_showEmail":"{{ $user->driver->show_email }}"}'
                                @if($user->driver->file_id)
                                    data-img='{"driver_photo":"{{ url('public/driver', $user->driver->file->path) }}"}'
                                @else
                                    data-img='{"driver_photo":""}'
                                @endif
                                >Edytuj</button>
                            </h6>
                            <div class="col-sm-4">
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
                                                    data-img='{"photo":"{{ url('public/pilot', $pilot->file->path) }}"}'
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
                            <div class="col-sm-4">
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
                                                    data-img='{"car_photo":"{{ url('public/car', $car->file->path) }}"}'
                                                @else
                                                    data-img='{"car_photo":""}'
                                                @endif
                                                >Edytuj</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.modals.editDriver')
@include('modals.editPilot')
@include('modals.editCar')
@endsection