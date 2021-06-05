<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Keuangan PDF</title>
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
    <h2>Laporan Keuangan Toko Shervie Juice</h2>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Kasir / Pegawai</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pdf as $pdf)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pdf->created_at }}</td>
                    <td>{{ $pdf->pegawai->nama }}</td>
                    <td>@currency($pdf->jumlah_harga)</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
