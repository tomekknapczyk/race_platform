<!DOCTYPE html>
<html lang="pl"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
        html {
            margin: 0px;
        }
        body {
            font-family: DejaVu Sans;
            font-weight: 300;
            color: #000;
            padding-left: 40px;
            padding-right: 40px;
            padding-top: 50px;
            font-size: 12px;
        }
    </style>
</head><body>
    <div class="section">
        <img src="{{ public_path('images/logo.png')}}" style="max-width: 15%; height: auto;" />
        <h3 style="text-align: center; height: 45px;">
            {{ $round->race->name }} @if($round->sub_name){{ $round->sub_name }}<br>@endif{{ $round->name }} - wniosek akredytacyjny dla mediów
        </h3>
        
        <div>
            <h4 style="text-align: center;">
                Dane redakcji
            </h4>
            <p>
                <strong style="width: 25%; display: inline-block;">Redakcja:</strong>
                <span style="border-bottom: 1px dotted #000;width: 70%; display: inline-block; padding-bottom: 5px; padding-left: 15px;">{{ $accreditations->first()->user->profile->name }}</span>
            </p>
            <p>
                <strong style="width: 25%; display: inline-block;">Adres:</strong>
                <span style="border-bottom: 1px dotted #000;width: 70%; display: inline-block; padding-bottom: 5px; padding-left: 15px;">{{ $accreditations->first()->user->profile->address }}</span>
            </p>
            <p>
                <strong style="width: 25%; display: inline-block;">Numer telefonu:</strong>
                <span style="border-bottom: 1px dotted #000;width: 70%; display: inline-block; padding-bottom: 5px; padding-left: 15px;">{{ $accreditations->first()->user->profile->phone }}</span>
            </p>
            <p>
                <strong style="width: 25%; display: inline-block;">Adres e-mail:</strong>
                <span style="border-bottom: 1px dotted #000;width: 70%; display: inline-block; padding-bottom: 5px; padding-left: 15px;">{{ $accreditations->first()->user->profile->lastname }}</span>
            </p>
        </div>

        <div>
            <h4 style="text-align: center;">
                Dane<br>
                fotografa/operatora
            </h4>
            @foreach($accreditations as $item)
            <div style="margin-bottom: 25px; page-break-inside: avoid; padding-top: 7px;">
                <p>
                    <strong style="width: 40%; display: inline-block;">Imię i nazwisko:</strong>
                    <span style="border-bottom: 1px dotted #000;width: 55%; display: inline-block; padding-bottom: 5px; padding-left: 15px;">{{ $item->staff->name }}</span>
                </p>
                <p>
                    <strong style="width: 40%; display: inline-block;">Adres e-mail:</strong>
                    <span style="border-bottom: 1px dotted #000;width: 55%; display: inline-block; padding-bottom: 5px; padding-left: 15px;">{{ $item->staff->email }}</span>
                </p>
                <p>
                    <strong style="width: 40%; display: inline-block;">Numer telefonu:</strong>
                    <span style="border-bottom: 1px dotted #000;width: 55%; display: inline-block; padding-bottom: 5px; padding-left: 15px;">{{ $item->staff->phone }}</span>
                </p>
                <p>
                    <strong style="width: 40%; display: inline-block;">Kontakt w razie wypadku (ICE):</strong>
                    <span style="border-bottom: 1px dotted #000;width: 55%; display: inline-block; padding-bottom: 5px; padding-left: 15px;">{{ $item->staff->ice }}</span>
                </p>
                <p>
                    <strong style="width: 40%; display: inline-block;">Rodzaj akredytacji:</strong>
                    <span style="border-bottom: 1px dotted #000;width: 55%; display: inline-block; padding-bottom: 5px; padding-left: 15px;">{{ $item->staff->type }}</span>
                </p>
            </div>
            @endforeach
        </div>

        <div style="page-break-inside: avoid;">
            <p style="text-align:center;font-size: 12px; margin-bottom: 0;font-weight: 600;margin-top: 0;">Rajdowy Puchar Śląska</p>
            <p style="text-align: center;font-size: 10px;"><strong>Numer i data rundy: {{ $round->race->name }} {{ $round->name }} {{ $round->date->format('d.m.Y') }}</strong></p>
            <p style="border-bottom: 2px solid #000;margin: 0; padding-top: 50px;">
                <span style="width: 50%; display: inline-block; text-align: center;">Podpis redaktora naczelnego</span>
                <span style="width: 50%; display: inline-block; text-align: center;">Podpis składającego wniosek</span>
            </p>
            <p style="text-align: center;font-size: 10px;">Czytelny skan wypełnionego i podpisanego wniosku akredytacyjnego należy wysyłać na adres <strong>racegc.atmrally@gmail.com</strong></p>
            <p style="text-align: center;font-size: 10px;">Poprzez złożenie wypełnionego wniosku akredytacji potwierdzam, że: mam ukończone18 lat, zapoznałem się z regulaminem procesu akredytacyjnego, zobowiązuję się do przestrzegania regulaminu akredytacji i wypełniania poleceń osób zabezpieczających imprezę, a w razie wypadku w trakcie trwania imprezy nie będę wysuwał żadnych roszczeń pod adresem organizatora. Potwierdzam, że wszystkie informacje, jakie umieściłem(am) w niniejszym formularzu są prawdziwe. Ponadto oświadczam, że także jestem świadomy zagrożeń wynikających z pracy podczas imprez sportu samochodowego i zobowiązuję się dopełnić wszelkich możliwych starań, aby ich uniknąć.
            </p>
            <p style="text-align: center;font-size: 10px; margin-bottom: 0;">Każdy fotoreporter otrzymujący akredytację zobowiązany jest do przekazania organizatorowi co najmniej 5 zdjęć z imprezy w wysokiej rozdzielczości, z prawem do wykorzystania w materiałach prasowych i promocyjnych, do 2 dni od zakończenia imprezy. Zdjęcia i skany prosimy wysyłać na adres <strong>racegc.atmrally@gmail.com</strong> Operatorzy kamer są zobowiązani do udostępnienia do 60 sekund surowego materiału filmowego na wniosek organizatora, w ciągu 2 dni od złożenia wniosku.</p>
        </div>
    </div>
</body></html>