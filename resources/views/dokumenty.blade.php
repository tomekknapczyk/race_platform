@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Dokumenty
                </div>
                <div class="card-body">
                    <div class="col-sm-12 lista p-0">
                        @foreach($docs as $doc)
                            <div class="row d-flex align-items-center p-2">
                                <h5 class="m-0 col-sm-6 col-md-8">{{ $doc->name }}</h5>
                                <div class="col-sm-6 col-md-4 text-right">
                                    <a href="{{ url('public/docs', $doc->file->path) }}" target="_blank" class="btn btn-info">Pobierz plik</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($regulaminy && $regulaminy->count())
                        <h3 class="mt-5">Regulaminy rajdów</h3>
                        <div class="col-sm-12 lista p-0">
                            @foreach($regulaminy as $regulamin)
                                <div class="row d-flex align-items-center p-2">
                                    <h5 class="m-0 col-sm-6 col-md-8">{{ $regulamin->name }} @if($regulamin->sub_name) - {{ $regulamin->sub_name }}@endif<br><small>{{ $regulamin->race->name }}</small></h5>
                                    <div class="col-sm-6 col-md-4 text-right">
                                        <a href="{{ url('public/terms', $regulamin->file->path) }}" class="btn btn-info" target="_blank">Pobierz plik</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($forms && $forms->count())
                        <h3 class="mt-5">Listy zgłoszeń</h3>
                        <div class="col-sm-12 lista p-0">
                            @foreach($forms as $form)
                                <div class="row d-flex justify-content-between align-items-center p-2">
                                    <h5 class="m-0 col-md-6">{{ $form->round->name }} @if($form->round->sub_name) - {{ $form->round->sub_name }}@endif<br><small>{{ $form->round->race->name }}</small></h5>
                                    <div class="col-md-4 text-right">
                                        <a href="{{ url('sign-list', $form->round->id) }}" class="btn btn-sm btn-outline-info">Zobacz listę zgłoszeń</a>
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