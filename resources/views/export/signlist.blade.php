<table>
    <thead>
    <tr>
        @foreach($items as $item)
            <th>{{ __($item) }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($klasy as $klasa)
            @foreach($class[$klasa] as $sign)
                <tr>
                    @foreach($items as $item)
                        @if($item == 'race_points')
                            <td>{{ $sign['sign']->points() }}</td>
                        @elseif($item == 'advance')
                            <td>{{ $sign['sign']->remaining_payment() }}</td>
                        @elseif($item == 'marka_model')
                            <td>{{ $sign['sign']->marka }} {{ $sign['sign']->model }}</td>
                        @elseif($item == 'phone')
                            <td>{{ str_replace('+48', '', str_replace(' ', '', $sign['sign']->phone)) }}</td>
                        @elseif($item == 'pilot_phone')
                            <td>{{ str_replace('+48', '', str_replace(' ', '', $sign['sign']->pilot_phone)) }}</td>
                        @else
                            <td>{{ $sign['sign']->$item }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>