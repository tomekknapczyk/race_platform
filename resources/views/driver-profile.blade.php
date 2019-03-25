@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Twój profil
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('saveDriver') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-sm-4">
                                @if(auth()->user()->profile && auth()->user()->profile->file_id)
                                    <img src="{{ url('public/driver/thumb/', auth()->user()->profile->file->path) }}" class="img-fluid img-thumbnail">
                                @endif
                                
                                <div class="form-group">
                                    <label for="photo">Zdjęcie profilowe</label>
                                    <input type="file" name="photo" class="form-control">
                                    @if ($errors->has('photo'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label for="deletePhoto">
                                            <input type="checkbox" name="deletePhoto" id="deletePhoto" value="1">
                                            Usuń zdjęcie
                                        </label>
                                        @if ($errors->has('deletePhoto'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('deletePhoto') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if(auth()->user()->driver != 2)
                                <hr>
                                <h3>
                                    Profil publiczny
                                </h3>

                                <div class="form-group mt-3">
                                    <div class="checkbox">
                                        <label for="showName">
                                            <input type="checkbox" name="showName" id="showName" @if(optional(auth()->user()->profile)->show_name) checked="checked" @endif>
                                            Pokazuj imie
                                        </label>
                                        @if ($errors->has('showName'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('showName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label for="showLastname">
                                            <input type="checkbox" name="showLastname" id="showLastname" @if(optional(auth()->user()->profile)->show_lastname) checked="checked" @endif>
                                            Pokazuj nazwisko
                                        </label>
                                        @if ($errors->has('showLastname'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('showLastname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label for="showEmail">
                                            <input type="checkbox" name="showEmail" id="showEmail" @if(optional(auth()->user()->profile)->show_email) checked="checked" @endif>
                                            Pokazuj adres e-mail
                                        </label>
                                        @if ($errors->has('showEmail'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('showEmail') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text">O mnie:</label>
                                    <textarea name="text" class="tinymce_user" rows="4">{{ old('text', optional(auth()->user()->profile)->desc) }}</textarea>
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-8">
                                @if(auth()->user()->driver != 2)
                                    <div class="form-group">
                                        <label for="name">Imię</label>
                                        <input type="text" name="name" value="{{ old('name', optional(auth()->user()->profile)->name) }}" class="form-control" required=""> 
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="lastname">Nazwisko</label>
                                        <input type="text" name="lastname" value="{{ old('lastname', optional(auth()->user()->profile)->lastname) }}" class="form-control" required=""> 
                                        @if ($errors->has('lastname'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Adres</label>

                                        <textarea name="address" class="form-control" rows="2" required="">{{ old('address', optional(auth()->user()->profile)->address) }}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="id_card">Seria nr dowodu osobistego</label>
                                        <input type="text" name="id_card" value="{{ old('id_card', optional(auth()->user()->profile)->id_card) }}" class="form-control" required=""> 
                                        @if ($errors->has('id_card'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('id_card') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Telefon</label>
                                        <input type="text" name="phone" value="{{ old('phone', optional(auth()->user()->profile)->phone) }}" class="form-control" required=""> 
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="driving_license">Nr prawo jazdy</label>
                                        <input type="text" name="driving_license" value="{{ old('driving_license', optional(auth()->user()->profile)->driving_license) }}" class="form-control" required=""> 
                                        @if ($errors->has('driving_license'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('driving_license') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="name">Nazwa redakcji / Imię i Nazwisko</label>
                                        <input type="text" name="name" value="{{ old('name', optional(auth()->user()->profile)->name) }}" class="form-control" required=""> 
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="lastname">Adres email</label>
                                        <input type="email" name="lastname" value="{{ old('lastname', optional(auth()->user()->profile)->lastname) }}" class="form-control" required=""> 
                                        @if ($errors->has('lastname'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Adres</label>
                                        
                                        <textarea name="address" class="form-control" rows="2" required="">{{ old('address', optional(auth()->user()->profile)->address) }}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Telefon</label>
                                        <input type="text" name="phone" value="{{ old('phone', optional(auth()->user()->profile)->phone) }}" class="form-control" required=""> 
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="text">Opis:</label>
                                        <textarea name="text" class="tinymce_user" rows="4">{{ old('text', optional(auth()->user()->profile)->desc) }}</textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            @if(auth()->user()->pressPhoto1)
                                                <img src="{{ url('public/redakcja/thumb/', auth()->user()->pressPhoto1->path) }}" class="img-fluid">
                                            @endif
                                            <div class="form-group">
                                                <label for="photo1">Zdjęcie 1</label>
                                                <input type="file" name="photo1" class="form-control">
                                                @if ($errors->has('photo1'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('photo1') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label for="deletePhoto1">
                                                        <input type="checkbox" name="deletePhoto1" id="deletePhoto1" value="1">
                                                        Usuń zdjęcie
                                                    </label>
                                                    @if ($errors->has('deletePhoto1'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('deletePhoto1') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            @if(auth()->user()->pressPhoto2)
                                                <img src="{{ url('public/redakcja/thumb/', auth()->user()->pressPhoto2->path) }}" class="img-fluid">
                                            @endif
                                            <div class="form-group">
                                                <label for="photo2">Zdjęcie 2</label>
                                                <input type="file" name="photo2" class="form-control">
                                                @if ($errors->has('photo2'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('photo2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label for="deletePhoto2">
                                                        <input type="checkbox" name="deletePhoto2" id="deletePhoto2" value="1">
                                                        Usuń zdjęcie
                                                    </label>
                                                    @if ($errors->has('deletePhoto2'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('deletePhoto2') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            @if(auth()->user()->pressPhoto3)
                                                <img src="{{ url('public/redakcja/thumb/', auth()->user()->pressPhoto3->path) }}" class="img-fluid">
                                            @endif
                                            <div class="form-group">
                                                <label for="photo3">Zdjęcie 3</label>
                                                <input type="file" name="photo3" class="form-control">
                                                @if ($errors->has('photo3'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('photo3') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label for="deletePhoto3">
                                                        <input type="checkbox" name="deletePhoto3" id="deletePhoto3" value="1">
                                                        Usuń zdjęcie
                                                    </label>
                                                    @if ($errors->has('deletePhoto3'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('deletePhoto3') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- <div class="form-group">
                                    <label for="oc">Nazwa nr polisy OC</label>
                                    <input type="text" name="oc" value="{{ old('oc', optional(auth()->user()->profile)->oc) }}" class="form-control" required=""> 
                                    @if ($errors->has('oc'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('oc') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="nw">Nazwa nr polisy NW</label>
                                    <input type="text" name="nw" value="{{ old('nw', optional(auth()->user()->profile)->nw) }}" class="form-control" > 
                                    @if ($errors->has('nw'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('nw') }}</strong>
                                        </span>
                                    @endif
                                </div> --}}
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