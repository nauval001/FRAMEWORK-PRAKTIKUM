<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Tindakan Terapi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kodeTindakan as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->nama_tindakan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>