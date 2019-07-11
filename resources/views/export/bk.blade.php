<table>
    <thead>
    <tr>
        <th>Imię i nazwisko kierowcy</th>
        <th>Marka i model</th>
    </tr>
    </thead>
    <tbody>
        @foreach($drivers as $driver)
            <tr>
                <td>{{ $driver->name }} {{ $driver->lastname }}</td>
                <td>{{ $driver->marka }} {{ $driver->model }}</td>
            </tr>
        @endforeach
    </tbody>
</table>