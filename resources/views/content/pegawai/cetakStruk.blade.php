<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Struct</title>
</head>

<body>
    <div class="col-12 mt-3">
        <div class="card">
            <h1>Shervie Juice</h1>
            <h5>Jl. Tanjung Pura 18 (Ruko Kuning Pintu Ijo, Utara Perempatan SC), Indramayu.</h5>
            <table class="table">
                <tr>
                    <td>Nama Kasir</td>
                    <td>:</td>
                    <td>{{ Auth::guard('pegawai')->user()->nama }}</td>
                </tr>
                <tr>
                    <td>No Transaksi</td>
                    <td>:</td>
                    <td>{{ $transaksi->id }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pembelian</td>
                    <td>:</td>
                    <td>{{ $transaksi->created_at }}</td>
                </tr>
                <tr>
                    <td>Nama Pembeli</td>
                    <td>:</td>
                    <td>{{ $transaksi->nama_pembeli }}</td>
                </tr>
            </table>
            <h5>----------------------------------------------------------------------------------------------------
            </h5>
            <div>
                <table>
                    <thead>
                        <tr>
                            <td>No|</td>
                            <td>Nama Barang |</td>
                            <td>Jumlah Beli |</td>
                            <td>Harga Satuan |</td>
                            <td>Jumlah Harga |</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi_detail as $transaksi_detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaksi_detail->produk->nama }}</td>
                                <td>{{ $transaksi_detail->jumlah_beli }}pcs</td>
                                <td>@currency($transaksi_detail->produk->harga)</td>
                                <td>@currency($transaksi_detail->jumlah_harga)</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            <td style="font-size: 14px;"><strong>
                                    <p>Total Harga</p>
                                </strong></td>
                            <td style="font-size: 14px;"><strong>@currency($transaksi->jumlah_harga)</strong></td>
                        <tr>
                            <td colspan="3"></td>
                            <td style="font-size: 14px;"><strong>Uang Bayar</strong></td>
                            <td style="font-size: 14px;"><strong>@currency($transaksi->uang_bayar)</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td style="font-size: 14px;"><strong>Kembali</strong></td>
                            <td style="font-size: 14px;"><strong>@currency($transaksi->uang_bayar -
                                    $transaksi->jumlah_harga)</strong></td>
                        </tr>
                    </tbody>
                </table>
                <h5>----------------------------------------------------------------------------------------------------
                </h5>
                <table>
                    <h4>Terima Kasih :)</h4>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
