@extends('layouts.app')

@section('content')
<div class="drivers-container">
    <div class="d-flex align-items-center justify-content-start">
        <h3 class="mr-3"><a href="{{ url('wyniki') }}" class="text-white">Wyniki > </a></h3>
        <h3>{{ $name }}</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <iframe width="100%" height="550" border="0" src="http://{{ $path }}" frameborder="0" allowfullscreen=""></iframe>
        </div>
    </div>
</div>
@endsection