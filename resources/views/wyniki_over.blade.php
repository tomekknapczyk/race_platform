@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Wyniki
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h3>Rajdowy Puchar Śląska 2018</h3>
                        <div>
                            <a href="{{ url('rank2018') }}" class="btn btn-success">Klasyfikacja Roczna</a>
                        </div>
                    </div>
                    <div>
                        <p class="h5 py-1"><a href="http://wyniki.stcs.pl/rps18/R1/" target="_blank" rel="nofollow">Runda 1</a></p>
                        <p class="h5 py-1"><a href="http://wyniki.stcs.pl/rps18/R2/" target="_blank" rel="nofollow">Runda 2</a></p>
                        <p class="h5 py-1"><a href="http://wyniki.stcs.pl/rps18/R3/" target="_blank" rel="nofollow">Runda 3</a></p>
                        <p class="h5 py-1"><a href="http://wyniki.stcs.pl/rps18/R4/" target="_blank" rel="nofollow">Runda 4</a></p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h3>Rajdowy Puchar Śląska 2017</h3>
                        <div>
                            <a href="{{ url('rank2017') }}" class="btn btn-success">Klasyfikacja Roczna</a>
                        </div>
                    </div>
                    <div>
                        <p class="h5 py-1"><a href="http://wyniki.stcs.pl/rps17/r1/" target="_blank" rel="nofollow">Runda 1</a></p>
                        <p class="h5 py-1"><a href="http://wyniki.stcs.pl/rps17/r2/" target="_blank" rel="nofollow">Runda 2</a></p>
                        <p class="h5 py-1"><a href="http://wyniki.stcs.pl/rps17/r3/" target="_blank" rel="nofollow">Runda 3</a></p>
                        <p class="h5 py-1"><a href="http://wyniki.stcs.pl/rps17/r4/" target="_blank" rel="nofollow">Runda 4</a></p>
                        <p class="h5 py-1"><a href="http://wyniki.stcs.pl/rps17/r5/" target="_blank" rel="nofollow">Runda 5</a></p>
                        <p class="h5 py-1"><a href="http://wyniki.stcs.pl/rps17/r6/" target="_blank" rel="nofollow">Runda 6</a></p>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection