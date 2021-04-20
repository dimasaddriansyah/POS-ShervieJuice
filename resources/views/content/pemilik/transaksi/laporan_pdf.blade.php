<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi PDF</title>
    <style>
        .hero{
            display: flex;
        }
        h1{
            align-items: center;
            margin-left: 110px;
        }
        .table{
            border-collapse: collapse;
        }

        .table, th, td {
            border: 1px solid #000;
            padding: 8px 10px;
        }
    </style>
</head>
<body>
    <div class="hero">
        <img src="{{ public_path('img/Shervie.png') }}" height="100px" width="100px">
        <h1>Toko Shervie Juice</h1>
    </div>
    <h2>Laporan Transaksi Toko Shervie Juice</h2>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kasir / Pegawai</th>
                <th>Nama Pembeli</th>
                <th>Uang Bayar</th>
                <th>Total Harga</th>
                <th>Kembalian</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->pegawai->nama }}</td>
                    <td>Pembeli Shervie Juice</td>
                    <td>@currency($transaksi->uang_bayar)</td>
                    <td>@currency($transaksi->jumlah_harga)</td>
                    <td>@currency($transaksi->uang_bayar - $transaksi->jumlah_harga)</td>
                    <td>{{ $transaksi->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
