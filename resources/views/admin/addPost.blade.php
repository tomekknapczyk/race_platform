@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark">
                    <a href="{{ url('news') }}" class="text-white">Aktualności</a> : Dodaj aktualność
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('savePost') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="title">Tytuł</label>
                                    <input type="text" name="title" class="form-control" required="">
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="text">Treść</label>
                                    <textarea name="text" class="tinymce" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="photo">Zdjęcie główne</label>
                                    <input type="file" name="photo" class="form-control">
                                    @if ($errors->has('photo'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Zapisz
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection