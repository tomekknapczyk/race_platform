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
            width: 1000px;
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
            font-size: 46px;
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
            justify-content: space-between;
            animation: slideLeft 2s ease forwards;
            position: relative;
            visibility: hidden;
            margin-top: 5px;
            padding-left: 1%;
        }

        .head > span,
        .item > span{
            width: {{ 99 / count($header) }}%;
        }

        /*.head > span.nr,
        .item > strong.nr{
            width: 8%;
            display: inline-block;
            text-align: center;
        }*/

        .item{
            padding: 0;
            margin: 5px 0;
            position: relative;
            background: rgba(17, 24, 39, 0.75);
            color: #fff;
            visibility:hidden;
            animation: slideBottom 2s ease forwards;
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-left: 1%;
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
            animation: flash 12s ease forwards;
            animation-iteration-count: 1;
            visibility: hidden;
            width: 30% !important;
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
        <div class="container">
            <h1>{{ $tabela->name }}</h1>
            <div class="sub-header">
                <h3><span>{{ $tabela->subname }}</span></h3>
            </div>
            <div class="head">
                {{-- <span class="nr">LP</span> --}}
                @foreach($header as $head)
                    <span>{{ $head }}</span>
                @endforeach
            </div> 
            @php
                $users = count($body);
                $loops = ceil($users/10);
                $delay = 10 / $users;
                $current_loop = 1;
                $loop_add = 0;
            @endphp
            <div id="items">
                @foreach($body as $item)
                    @php
                        if($loop->iteration % 10 == 1 && $loop->iteration > 1)
                            $loop_add += 8; // odstęp między zmianami drugi w skrypcie
                        $fields = explode(',', $item);
                    @endphp
                    <p class="item @if($loop->iteration % 2 == 0) odd @endif" style="animation-delay:{{ $loop->index + $loop_add }}s;">
                        <span class="flash" style="animation-delay:{{ $loop->index + 1.2 + $loop_add }}s;"></span>
                        {{-- <strong class="nr">{{ $current_loop++ }}.</strong> --}}
                        @foreach($fields as $field)
                            <span>{{ $field }}</span>
                        @endforeach
                    </p>
                @endforeach
            </div>
        </div>

        <script type="text/javascript">
            var counter = {{ $loops - 1 }};
            if(counter > 0){
                var curr = 1;
                var start = false;
                var first = true;

                var i = setInterval(function(){
                    var body = document.getElementById('items');
                    var c = body.getElementsByTagName('p');

                    if(!start){
                        for (i = (curr - 1) * 10; i < c.length && i < curr * 10; i++) {
                            c[i].style.display = 'none';
                        }

                        if(!first){
                            var j = -1;
                            for (i = curr * 10; i < c.length && i < (curr + 1) * 10; i++) {
                                var flash = c[i].getElementsByClassName('flash');

                                c[i].style.display = 'flex';
                                var delay = j + 1;
                                var flash_delay = delay + 1.2;
                                c[i].style.animationDelay = delay + 's';
                                flash[0].style.animationDelay = flash_delay + 's';
                                j++;
                            }
                        }
                    }
                    else{
                        for (i = (curr - 1) * 10; i < c.length && i < curr * 10; i++) {
                            c[i].style.display = 'none';
                        }

                        for (i = 0; i < c.length && i < 10; i++) {
                            c[i].style.display = 'flex';
                        }

                        curr = 0;
                        start = false;
                    }

                    counter--;
                    curr++;

                    if(counter === 0) {
                        first = false;
                        start = true;
                        counter = {{ $loops }};
                    }
                }, 18000); // odstęp między zmianami 10000 + $loop_add *1000
            }
        </script>
</body>
</html>