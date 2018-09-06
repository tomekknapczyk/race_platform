@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Dokumenty
                </div>
                <div class="card-body">
                    <div class="col-sm-12 lista p-0">
                        @foreach($docs as $doc)
                            <div class="row d-flex align-items-center p-2">
                                <h4 class="m-0 col-sm-8 text-center">{{ $doc->name }}</h4>
                                <div class="col-sm-4 text-right">
                                    <a href="{{ url('public/docs', $doc->file->path) }}" target="_blank" class="btn btn-info">Pobierz plik</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($regulaminy->count())
                        <h3 class="mt-5">Regulaminy rajdów</h3>
                        <div class="col-sm-12 lista p-0">
                            @foreach($regulaminy as $regulamin)
                                <div class="row d-flex align-items-center p-2">
                                    <h4 class="m-0 col-sm-8 text-center">{{ $regulamin->race->name }} : {{ $regulamin->name }}</h4>
                                    <div class="col-sm-4 text-right">
                                        <a href="{{ url('public/terms', $regulamin->file->path) }}" class="btn btn-info" target="_blank">Pobierz plik</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection