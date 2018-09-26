<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="padding: 0; margin: 0; box-sizing: border-box;">
    <div style="background: rgba(0,0,0,.3); width: 800px; color: #fff;">
        <h1 style="text-align: center; margin: 0;">{{ $tabela->name }}</h1>
        <h3 style="text-align: center;">{{ $tabela->subname }}</h3>

        @foreach($tabela->items as $item)
            <p style="background: rgba(0,0,0,.2); color: #fff; display: block; padding: 5px 10px; margin: 5px 0;">{{ $loop->iteration }}. {{ $item->user->name }} {{ $item->user->car }}</p>
        @endforeach
    </div>
</body>
</html>