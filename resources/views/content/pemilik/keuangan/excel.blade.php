<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Pendapatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($keuangans as $keuangan)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $keuangan->created_at }}</td>
            <td>@currency($keuangan->jumlah_harga)</td>
        </tr>
        @endforeach
    </tbody>
</table>
