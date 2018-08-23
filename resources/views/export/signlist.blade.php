<table>
    <thead>
    <tr>
        @foreach($items as $item)
            <th>{{ __($item) }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($class as $key => $klasa)
            @foreach($klasa as $sign)
                <tr>
                    @foreach($items as $item)
                        @if($item == 'race_points')
                            <td>{{ $sign['sign']->points() }}</td>
                        @elseif($item == 'advance')
                            <td>{{ $sign['sign']->remaining_payment() }}</td>
                        @else
                            <td>{{ $sign['sign']->$item }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>