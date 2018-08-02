@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark">
                    <a href="{{ url('races') }}" class="text-white">Rajdy</a> : <a href="{{ url('race', $round->race->id) }}" class="text-white">{{ $round->race->name }}</a> : {{ $round->name }}
                    <div class="float-right d-flex justify-content-between align-items-center">
                        @if($round->form->active)
                            <span>Formularz zgłoszeniowy jest włączony</span>
                            <button class="btn btn-sm btn-danger ml-2" data-toggle="modal" data-target="#signFormStatus">Wyłącz</button>
                        @else
                            <span>Formularz zgłoszeniowy jest wyłączony</span>
                            <button class="btn btn-sm btn-success ml-2" data-toggle="modal" data-target="#signFormStatus">Włącz</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.signFormStatus')
@endsection