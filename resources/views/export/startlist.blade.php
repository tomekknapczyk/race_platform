<table>
    <thead>
    <tr>
        @foreach($items as $item)
            <th>{{ __($item) }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($round->klasy() as $klasa)
            @foreach($round->startPositions()->where('klasa', $klasa) as $position)
                <tr>
                    @foreach($items as $item)
                        @if($item == 'points')
                            <td>{{ $position->points }}</td>
                        @elseif($item == 'race_points')
                            <td>{{ $position->sign->points() }}</td>
                        @else
                            <td>{{ $position->sign->$item }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>