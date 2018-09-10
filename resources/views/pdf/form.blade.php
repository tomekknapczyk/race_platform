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
            color: #414042;
            padding-left: 20px;
            padding-right: 20px;
        }
        .gray{
            background: #ddd;
            text-align: center;
        }
    </style>
</head><body>
    <div class="section">
        <div style="width:60%;float:left;">
            <h3>
                {{ $form->round->race->name }}<br>
                @if($form->round->sub_name){{ $form->round->sub_name }}<br>@endif
                {{ $form->round->name }}
            </h3>
        </div>

        <div style="width:40%;float:right;">
            <h3>Numer startowy</h3>
            <div style="border:1px solid #000;height: 80px; width: 80%; display: block;"></div>
        </div>

        <div style="clear: both;margin-top: 10px;">
            <table cellpadding="3" cellspacing="8" width="100%" border="0" style="font-size: 14px;">
                <thead>
                    <tr style="text-align: center;">
                        <th style="width: 30%;"></th>
                        <th><span style="font-size:18px;">KIEROWCA</span></th>
                        <th><span style="font-size:18px;">PILOT</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Imię:</td>
                        <td class="gray">{{ $data->name }}</td>
                        <td class="gray">{{ $data->pilot_name }}</td>
                    </tr>
                    <tr>
                        <td>Nazwisko:</td>
                        <td class="gray">{{ $data->lastname }}</td>
                        <td class="gray">{{ $data->pilot_lastname }}</td>
                    </tr>
                    <tr>
                        <td>Adres:</td>
                        <td class="gray">{{ $data->address }}</td>
                        <td class="gray">{{ $data->pilot_address }}</td>
                    </tr>
                    <tr>
                        <td>Seria nr dowodu osobistego:</td>
                        <td class="gray">{{ $data->id_card }}</td>
                        <td class="gray">{{ $data->pilot_id_card }}</td>
                    </tr>
                    <tr>
                        <td>Telefon:</td>
                        <td class="gray">{{ $data->phone }}</td>
                        <td class="gray">{{ $data->pilot_phone }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td class="gray">{{ $data->email }}</td>
                        <td class="gray">{{ $data->pilot_email }}</td>
                    </tr>
                    <tr>
                        <td>Nr prawo jazdy:</td>
                        <td class="gray">{{ $data->driving_license }}</td>
                        <td class="gray">{{ $data->pilot_driving_license }}</td>
                    </tr>
                    <tr>
                        <td>Nazwa nr polisy OC:</td>
                        <td class="gray">{{ $data->oc }}</td>
                        <td class="gray">{{ $data->pilot_oc }}</td>
                    </tr>
                    <tr>
                        <td>Nazwa nr polisy NW:</td>
                        <td class="gray">{{ $data->nw }}</td>
                        <td class="gray">{{ $data->pilot_nw }}</td>
                    </tr>
                </tbody>
            </table>

            <table cellpadding="3" cellspacing="8" width="100%" border="0" style="font-size: 14px;">
                <thead>
                    <tr style="text-align: center;">
                        <th colspan="4"><span style="font-size:18px;">SAMOCHÓD</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 22%;">Marka, model, turbo</td>
                        <td style="width: 48%;" class="gray">{{ $data->marka }}, {{ $data->model }}, Turbo: {{ $data->turbo }}</td>
                        <td style="width: 10%;text-align: right;">Poj.ccm</td>
                        <td style="width: 20%;" class="gray">{{ $data->ccm }}</td>
                    </tr>
                </tbody>
            </table>

            <table cellpadding="3" cellspacing="8" width="100%" border="0" style="font-size: 14px;">
                <tbody>
                    <tr>
                        <td style="width: 10%;">Nr rej.</td>
                        <td style="width: 20%;" class="gray">{{ $data->nr_rej }}</td>
                        <td style="width: 20%;text-align: right;">Rok produkcji</td>
                        <td style="width: 20%;" class="gray">{{ $data->rok }}</td>
                        <td style="width: 10%;text-align: right;">Klasa</td>
                        <td style="width: 20%;" class="gray">{{ $data->klasa }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="clear: both;margin-top: 10px;margin-bottom: 50px;">
            <p style="text-align: center;font-size: 12px;">Zgłaszam swój udział w {{ $form->round->race->name }} - {{ $form->round->name }} i stwierdzam swoim podpisem prawdziwość danych zawartych w Zgłoszeniu. Oświadczam, iż biorę udział w Zawodach na własną odpowiedzialność i zrzekam się wszelkich roszczeń w stosunku do Organizatora Zawodów w razie jakiegokolwiek wypadku lub szkody wyrządzonym sobie czy innym osobą lub mieniu. Stwierdzam że znane mi są postanowienia Regulaminu Zawodów i warunki bezpieczeństwa obowiązujące uczestników.</p>
        </div>

        <div style="width: 35%; display: block; float: left;">
            <div style="height: 80px;width: 100%;display: block;background: #ddd;"></div>
            <p style="text-align: center;">Czytelny podpis kierowcy</p>
        </div>
        <div style="width: 20%; display: block; float: left;">
            <div style="height: 80px;width: 100%;display: block;background: #ddd;border-left: 1px solid #000;"></div>
            <p style="text-align: center;">Data</p>
        </div>

        <div style="width: 35%; display: block; float: right;">
            <div style="height: 80px;width: 100%;display: block;background: #ddd;"></div>
            <p style="text-align: center;">Czytelny podpis pilota</p>
        </div>
    </div>
</body></html>