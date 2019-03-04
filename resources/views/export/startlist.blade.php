<table>
    <thead>
    <tr>
        @foreach($items as $item)
            <th>{{ __($item) }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($round->klasy($round->startList->id) as $klasa)
            @foreach($round->startPositions($round->startList->id)->where('klasa', $klasa) as $position)
                <tr>
                    @foreach($items as $item)
                        @if($item == 'points')
                            <td>{{ $position->points }}</td>
                        @elseif($item == 'race_points')
                            <td>{{ $position->sign->points() }}</td>
                        @elseif($item == 'advance')
                            <td>{{ $position->sign->remaining_payment() }}</td>
                        @else
                            <td>{{ $position->sign->$item }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>