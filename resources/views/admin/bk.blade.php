@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    <a href="{{ url('races') }}" class="text-white">Rajdy</a> : {{ $race->name }} - Badania kontrolne
                </div>
                <div class="card-body">
                    <h2>Pokaż kierowców biorących udział w wybranych rajdach</h2>
                    <form method="POST" action="{{ route('show_bk') }}">
                        @csrf
                        @foreach($race->rounds as $round)
                            @if($round->startList)
                                <div class="checkbox">
                                    <input type="checkbox" name="round[]" value="{{ $round->id }}" id="runda_{{$round->id}}">
                                    <label for="runda_{{$round->id}}">{{ $round->name }} - {{ $round->sub_name }}</label>
                                </div>
                            @endif
                        @endforeach
                        <button type="submit" class="btn btn-primary btn-block">Pokaż</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection