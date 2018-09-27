<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
</head>
    <body>
        <h2 style="text-align: center;text-transform: uppercase;">Potwierdź swój adres email</h2>
        <hr>

        <div style="text-align: center; font-size: 16px;">
            <p>Dziękujemy za założenie konta w naszym serwisie.</p>
            <p>Aby aktywować konto kliknij w poniższy przycisk:</p>
            <p style="text-align: center;">
                <a href="{{ route('confirmation_path',['confirmationCode' => $confirmation_code]) }}" style="text-align: center;padding: 6px 12px; display: inline-block; color: #fff; background-color: #17a2b8; border-color: #148ea1; vertical-align: middle; border: 1px solid; font-size: 14px; line-height: 1.6; border-radius: 4px; text-decoration: none;">
                    WERYFIKUJ KONTO
                </a>
            </p>
            <p>lub wpisz poniższy adres w przeglądarce:</p>
            <p>{{ route('confirmation_path',['confirmationCode' => $confirmation_code]) }}</p>
        </div>

    </body>
</html>