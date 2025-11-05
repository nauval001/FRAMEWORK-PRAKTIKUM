<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pet</th>
            <th>Nama Pemilik</th>
            <th>Ras Hewan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pet as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->nama_pet }}</td>
            {{-- Ambil data dari relasi 'pemilik' lalu ke 'user' [cite: 361] --}}
            <td>{{ $item->pemilik->user->nama ?? 'N/A' }}</td>
            {{-- Ambil data dari relasi 'rasHewan' --}}
            <td>{{ $item->rasHewan->nama_ras_hewan ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>