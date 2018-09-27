<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Teko:400,700&amp;subset=latin-ext" rel="stylesheet">
    <style type="text/css">

        body{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Teko', sans-serif;
        }

        *{
            box-sizing: border-box;
        }

        .container{
            width: 900px;
            color: #fff;
            overflow: hidden;
        }

        .sub-header{
            background: rgba(17, 24, 39, .75);
            animation: slideLeft 2s ease forwards;
            position: relative;
            visibility: hidden;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 10px 0;
        }

        h1{
            background: rgba(206, 4, 4, 0.9);
            text-align: left;
            margin: 0;
            visibility: hidden;
            position: relative;
            animation: slideLeft 2s ease forwards;
            text-transform: uppercase;
            padding: 10px 10px 0 10px;
            font-weight: 400;
            font-size: 60px;
            line-height: 1;
            letter-spacing: 3px;
        }

        h3{
            width: 80%;
            margin: 0;
            text-align: left;
            visibility: hidden;
            position: relative;
            animation: slideLeft 3s ease forwards;
            padding: 5px 0 5px 20px;
            background: rgba(206, 4, 4, 0.8);
            transform: skew(27deg);
            margin-right: -20px;
            font-weight: 300;
            font-size: 32px;
            line-height: 1;
        }

        h3 span{
            transform: skew(-27deg);
            display: block;
        }

        .head{
            background: rgba(17, 24, 39, 0.9);
            padding: 10px 0;
            font-size: 22px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-around;
            animation: slideLeft 2s ease forwards;
            position: relative;
            visibility: hidden;
            margin-top: 5px;
        }

        .nr{
            width: 12%;
            display: inline-block;
            text-align: center;
        }

        .name{
            width: 44%;
            display: inline-block;
            text-align: left;
        }

        .car{
            width: 44%;
            display: inline-block;
            text-align: left;
        }

        .item{
            display: block;
            padding: 5px 0;
            margin: 5px 0;
            position: relative;
            background: rgba(17, 24, 39, 0.75);
            color: #fff;
            visibility:hidden;
            animation: slideBottom 2s ease forwards;
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .item.odd{
            background: rgba(17, 24, 39, 0.9);
        }

        .item > *{
            margin: 0;
            padding: 5px 0;
            text-transform: uppercase;
            font-size: 24px;
            font-weight: 300;
        }

        .flash{
            animation: flash 10s ease forwards;
            animation-iteration-count: infinite;
            visibility: hidden;
            width: 30%;
            /* background: rgba(255, 255, 255, 0.7); */
            /* box-shadow: 0 0 30px 2px rgba(255,255,255,1); */
            position: absolute;
            top: 0;
            opacity: .5;
            left: -20%;
            height: 120%;
            transform: skew(27deg);
            /* filter: blur(0px); */
            background: rgba(255, 255, 255, 0.13);
            background: linear-gradient( to right, rgba(255, 255, 255, 0.13) 0%, rgba(255, 255, 255, 0.18) 15%, rgba(255, 255, 255, 0.5) 98%, rgba(255, 255, 255, 0.0) 100% );
        }

        @keyframes flash {
            from {
                left: -20%;
                opacity: .5;
            }
            5%{
                opacity: 1;
            }
            10%{
                opacity: 1;
                left: 110%;
                visibility: visible;
            }
            to {
                left: 110%;
                visibility: visible;
            }
        }

        @keyframes slideLeft {
            from {
                left: -100%;
            }
            to {
                left: 0;
                visibility: visible;
            }
        }

        @keyframes slideTop {
            from {
                top: -200px;
            }
            to {
                top: 0;
                visibility: visible;
            }
        }

         @keyframes slideBottom {
            from {
                bottom: -200px;
            }
            to {
                bottom: 0;
                opacity: 1;
                visibility: visible;
            }
        }
    </style>
</head>
<body>
    @if($tabela->items->count())
        <div class="container">
            <h1>{{ $tabela->name }}</h1>
            <div class="sub-header">
                <h3><span>{{ $tabela->subname }}</span></h3>
            </div>
            <div class="head">
                <span class="nr">LP</span>
                <span class="name">IMIĘ I NAZWISKO</span>
                <span class="car">SAMOCHÓD</span>
            </div> 
            @php
                $delay = 10 / $tabela->items->count();
            @endphp
            @foreach($tabela->items as $item)
                <p class="item @if($loop->iteration  % 2 == 0) odd @endif" style="animation-delay:{{ $loop->iteration/1.2 }}s;">
                    <span class="flash" style="animation-delay:{{ $loop->iteration*$delay }}s;"></span>
                    <strong class="nr">{{ $loop->iteration }}.</strong>
                    <span class="name">{{ $item->user->name }}</span>
                    <span class="car">{{ $item->user->car }}</span>
                </p>
            @endforeach
        </div>
    @endif
</body>
</html>