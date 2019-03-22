<div class="modal fade" tabindex="-1" role="dialog" id="makeFileSign" aria-labelledby="makeFileSign" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Generuj plik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('makeFileSign') }}" id="makeFileSign">
                    @csrf
                    <input type="hidden" name="id" value="{{ $round->id }}">
                    <input type="hidden" name="items" id="file_items">

                    <h4>Elementy do wyboru:</h4>
                    <div class="bg-dark p-2 rounded mb-5 d-flex justify-content-start align-items-center flex-wrap" id="items">
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="address">Kierowca adres</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="id_card">Kierowca numer dowodu</div>                       
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="email">Kierowca email</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="driving_license">Kierowca numer prawa jazdy</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="oc">OC</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="nw">NW</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="pilot_address">Pilot adres</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="pilot_id_card">Pilot numer dowodu</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="pilot_email">Pilot email</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="pilot_driving_license">Pilot numer prawa jazdy</div>
{{--                         <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="pilot_oc">Pilot oc</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="pilot_nw">Pilot nw</div>   --}}                      
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="rok">Rocznik</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="ccm">Pojemność</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="turbo">Turbo</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="nr_rej">Numer rejestracyjny</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="rwd">RWD</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="race_points">Punkty w całym rajdzie</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="marka">Marka</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="model">Model</div>
                    </div>

                    <h4>Wybrane elementy:</h4>
                    <div class="bg-info p-2 rounded d-flex justify-content-start align-items-center flex-wrap" id="dropdown">
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="id">ID</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="name">Kierowca imie</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="lastname">Kierowca nazwisko</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="pilot_name">Pilot imie</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="pilot_lastname">Pilot nazwisko</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="marka_model">Marka_model</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="klasa">Klasa</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="phone">Kierowca telefon</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="pilot_phone">Pilot telefon</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="advance">Pozostała wpłata</div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-info btn-block" id="generateFile">
                                Generuj plik
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>