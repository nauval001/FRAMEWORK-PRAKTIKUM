<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->email }}</td>
            {{-- Ambil data dari relasi 'role' --}}
            <td>{{ $item->role->nama_role ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>