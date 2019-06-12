<table>
    <thead>
    <tr>
        <th>Nr</th>
        <th>Imię i nazwisko kierowcy</th>
        <th>Telefon</th>
        <th>Marka i model</th>
    </tr>
    </thead>
    <tbody>
        @foreach($collection as $item)
            <tr>
                <td>{{ $item['item']->start_nr() }}.</td>
                <td>{{ $item['item']->name }} {{ $item['item']->lastname }}</td>
                <td>{{ $item['item']->phone }}</td>
                <td>{{ $item['item']->marka }} {{ $item['item']->model }}</td>
            </tr>
            @foreach($item['partners'] as $partner)
                <tr>
                    <td>{{ $partner->partner->start_nr() }}.</td>
                    <td>{{ $partner->partner->name }} {{ $partner->partner->lastname }}</td>
                    <td>{{ $partner->partner->phone }}</td>
                    <td>{{ $partner->partner->marka }} {{ $partner->partner->model }}</td>
                </tr>
            @endforeach
            <tr></tr><tr></tr>
        @endforeach
    </tbody>
</table>