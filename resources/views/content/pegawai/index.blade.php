@extends('layouts.pegawai.master')
@section('title', 'Casshier Page')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="text-white">List Produk</h5>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            @foreach ($produks as $produk)
                                @if ($produk->stok <= 0)
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <button class="card bg-danger mb-2" style="text-decoration: none" disabled>
                                        <div class="card-body text-white">
                                            <h6>{{ $produk->nama }}</h6>
                                            <p>Harga : {{ $produk->harga }}</p>
                                            <p>Stok : {{ $produk->stok }}</p>
                                        </div>
                                    </button>
                                </div>
                                @else
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <button class="card mb-2" style="text-decoration: none" data-bs-toggle="modal"
                                        data-bs-target="#produk{{ $produk->id }}">
                                        <div class="card-body">
                                            <h6>{{ $produk->nama }}</h6>
                                            <p>Harga : {{ $produk->harga }}</p>
                                            <p>Stok : {{ $produk->stok }}</p>
                                        </div>
                                    </button>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header" style="background-color: #008080;">
                    <h5 style="color: white">
                        <i class="fa fa-info-circle"></i>
                        Detail Transaksi :
                            @if (!empty($transaksi))
                                No - {{ $transaksi->id }}
                            @endif
                    </h5>
                </div>
                <div class="card-body">
                    @if (!empty($transaksi))
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah Beli</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah Harga</th>
                                        <th>
                                            <center>Option</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi_detail as $transaksi_detail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transaksi_detail->produk->nama }}</td>
                                            <td>{{ $transaksi_detail->jumlah_beli }} Pcs</td>
                                            <td>@currency($transaksi_detail->produk->harga)</td>
                                            <td>@currency($transaksi_detail->jumlah_harga)</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-xs btn-danger btn-flat swal-confirm"
                                                    data-id="{{ $transaksi_detail->id }}">
                                                    <form action="{{ route('kasir.hapusTransaksi', $transaksi_detail) }}"
                                                        method="POST" id="delete{{ $transaksi_detail->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" align="right"><strong>Total Harga : </strong></td>
                                        <td>
                                            @if (!empty($transaksi))
                                                <strong>@currency($transaksi->jumlah_harga)</strong>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                    <div class="text-center">
                        <h4 class="py-5">Transaksi Kosong, Tambahkan Produk</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header bg-success">
                    <h5 class="text-white"><i class="fas fa-check-double"></i> Konfirmasi Transaksi</h5>
                </div>
                <div class="card-body">
                    @if (!empty($transaksi))
                        <form action="{{ route('kasir.konfirmasiTransaksi', $transaksi) }}" method="post">
                    @endif
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Nama Pembeli</label>
                        <input type="text" class="form-control @error('nama_pembeli') is-invalid @enderror"
                            name="nama_pembeli" value="Pembeli Shervie Juice" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Total Harga</label>
                        <input type="text" class="form-control" name="total_harga" onfocus="startCalculate()"
                            onblur="stopCalc()" @if (!empty($transaksi)) value="@currency($transaksi->jumlah_harga)" @endif readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Uang Bayar</label>
                        <input type="text" id="uang_bayar" class="form-control @error('uang_bayar') is-invalid @enderror"
                            name="uang_bayar" value="{{ old('uang_bayar') }}" onfocus="startCalculate()"
                            onblur="stopCalc()"
                            onkeyup="document.getElementById('format').innerHTML = formatCurrency(this.value);">Nominal
                        : <span id="format"></span>
                        @if ($errors->has('uang_bayar')) <span
                                class="invalid-feedback"><strong>{{ $errors->first('uang_bayar') }}</strong></span>
                        @endif
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-success btn-block mt-3">Konfirmasi</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @foreach ($produks as $produk)
        <div class="modal fade" id="produk{{ $produk->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{ $produk->nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kasir.tambahTransaksi', $produk) }}" method="post">
                            @csrf
                            <div class="from-group">
                                <label for="jumlah_beli"
                                    class="form-label @error('jumlah_beli') text-danger @enderror">Jumlah Beli</label>
                                <input type="number" name="jumlah_beli"
                                    class="form-control @error('jumlah_beli') is-invalid @enderror"
                                    value="{{ old('jumlah_beli') }}" placeholder="Masukan Jumlah Beli">
                                @if ($errors->has('jumlah_beli')) <span
                                    class="invalid-feedback fw-bold">{{ $errors->first('jumlah_beli') }}</span>@enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<!-- End Modal -->
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function formatCurrency(num) {
        num = num.toString().replace(/\$|\,/g, '');
        if (isNaN(num))
            num = "0";
        sign = (num == (num = Math.abs(num)));
        num = Math.floor(num * 100 + 0.50000000001);
        cents = num % 100;
        num = Math.floor(num / 100).toString();
        if (cents < 10)
            cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
            num = num.substring(0, num.length - (4 * i + 3)) + '.' +
            num.substring(num.length - (4 * i + 3));
        return (((sign) ? '' : '-') + 'Rp ' + num);
    }

    function startCalculate() {
        interval = setInterval("Calculate()", 1);
    }

    function Calculate() {
        var a = document.form1.total_harga.value;
        var c = document.form1.uang_bayar.value;
        document.form1.uang_kembali.value = (c - a);
    }

    function stopCalc() {
        clearInterval(interval);
    }

</script>
@endpush
