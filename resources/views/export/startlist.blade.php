<table>
    <thead>
    <tr>
        @foreach($items as $item)
            <th>{{ __($item) }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($class as $klasa)
            @foreach($round->startPositions($round->startList->id)->where('klasa', $klasa) as $position)
                <tr>
                    @foreach($items as $item)
                        @if($item == 'points')
                            <td>{{ $position->points }}</td>
                        @elseif($item == 'race_points')
                            <td>{{ $position->sign->points() }}</td>
                        @elseif($item == 'advance')
                            <td>{{ $position->sign->remaining_payment() }}</td>
                        @elseif($item == 'marka_model')
                            <td>{{ $position->sign->marka }} {{ $position->sign->model }}</td>
                        @elseif($item == 'phone')
                            <td>{{ str_replace('-', '', str_replace('+48', '', str_replace(' ', '', $position->sign->phone))) }}</td>
                        @elseif($item == 'pilot_phone')
                            <td>{{ str_replace('-', '', str_replace('+48', '', str_replace(' ', '', $position->sign->pilot_phone))) }}</td>
                        @elseif($item == 'nr')
                            <td>{{ $position->sign->start_nr() }}</td>
                        @else
                            <td>{{ $position->sign->$item }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>