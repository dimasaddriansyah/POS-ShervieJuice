<thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Kasir / Pegawai</th>
        <th>Pendapatan</th>
    </tr>
</thead>
<tbody>
    @foreach ($keuangan as $key => $keuangan)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $keuangan->created_at }}</td>
            <td>{{ $keuangan->pegawai->nama }}</td>
            <td>@currency($keuangan->jumlah_harga)</td>
        </tr>
    @endforeach
</tbody>
</table>
