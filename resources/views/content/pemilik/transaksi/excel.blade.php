<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kasir / Pegawai</th>
            <th>Nama Pembeli</th>
            <th>Total Harga</th>
            <th>Uang Bayar</th>
            <th>Kembalian</th>
            <th>Tanggal Transaksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksis as $transaksi)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $transaksi->pegawai->nama }}</td>
            <td>{{ $transaksi->nama_pembeli }}</td>
            <td>@currency($transaksi->jumlah_harga)</td>
            <td>@currency($transaksi->uang_bayar)</td>
            <td>@currency($transaksi->uang_bayar - $transaksi->jumlah_harga)</td>
            <td>{{ $transaksi->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
