@extends('layouts.pegawai.master')
@section('title', 'Casshier Page')
@section('content')
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addProduct">
                <i class="bi bi-plus me-1"></i> Tambah Produk
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header" style="background-color: #008080;">
                    <h5 style="color: white">
                        <i class="fa fa-info-circle"></i>
                        Detail Transaksi : No - <i>
                            @if (!empty($transaksi))
                                {{ $transaksi->id }}
                            @endif
                        </i>
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
                                        <td>
                                            <center>
                                                <a href="{{ url('/delete-transaksi/' . $transaksi_detail->id) }}"
                                                    class="btn btn-xs btn-danger btn-flat"
                                                    onclick=" return confirm('Anda Yakin Akan Menghapus Data produk ?');"><i
                                                        class="fa fa-trash"></i></a>
                                            </center>
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
                    @endif
                    </table>
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header"
                    style="background: rgb(72,228,119);
                                                                                                                            background: linear-gradient(90deg, rgba(72,228,119,1) 0%, rgba(117,255,107,1) 100%);">
                    <h5 style="color: white"><i class="fas fa-check-double"></i> Konfirmasi Transaksi</h5>
                </div>
                <div class="card-body">
                    @if (!empty($transaksi))
                        <form action="{{ url('/add-konfirmasi') }}/{{ $transaksi->id }}" id="form1" name="form1"
                            method="post">
                    @endif
                    @csrf
                    <div class="form-group">
                        <label>Nama Pembeli</label>
                        <input type="text" class="form-control @error('nama_pembeli') is-invalid @enderror"
                            name="nama_pembeli" value="{{ old('nama_pembeli') }}">
                        @if ($errors->has('nama_pembeli')) <span
                                class="invalid-feedback"><strong>{{ $errors->first('nama_pembeli') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Total Harga</label>
                        <input type="text" class="form-control" name="total_harga" onfocus="startCalculate()"
                            onblur="stopCalc()" @if (!empty($transaksi)) value="@currency($transaksi->jumlah_harga)" @endif
                            readonly>
                    </div>
                    <div class="form-group">
                        <label>Uang Bayar</label>
                        <input type="text" id="uang_bayar" class="form-control @error('uang_bayar') is-invalid @enderror"
                            name="uang_bayar" value="{{ old('uang_bayar') }}" onfocus="startCalculate()"
                            onblur="stopCalc()"
                            onkeyup="document.getElementById('format').innerHTML = formatCurrency(this.value);">Nominal
                        : <span id="format"></span>
                        @if ($errors->has('uang_bayar')) <span
                                class="invalid-feedback"><strong>{{ $errors->first('uang_bayar') }}</strong></span>
                        @endif
                    </div>
                    <button class="btn btn-success btn-flat btn-block btn-sm">Konfirmasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kasir.tambahTransaksi') }}" method="post">
                    @csrf
                    <div class="modal-body mb-5">
                        <div class="row">
                            @foreach ($produks as $produk)
                            <div class="col-3">
                                <a href="" class="card mb-3" style="text-decoration: none">
                                    <div class="card-body">
                                        <h6>{{ $produk->nama }}</h6>
                                        <p>Harga : {{ $produk->harga }}</p>
                                        <p>Stok : {{ $produk->stok }}</p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        {{-- <div class="form-group mb-3">
                            <label for="produk" class="form-label">Nama Product</label>
                            <select name="produk" class="form-control select2" data-width="100%">
                                @foreach ($produk as $produk)
                                    <option value="{{ $produk->id }}">{{ $produk->nama_produk }} | Stok :
                                        {{ $produk->stok }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_beli" class="form-label">Jumlah Beli</label>
                            <input type="number" class="form-control @error('jumlah_beli') is-invalid @enderror"
                                name="jumlah_beli" value="{{ old('jumlah_beli') }}">
                            @if ($errors->has('jumlah_beli')) <span
                                    class="invalid-feedback"><strong>{{ $errors->first('jumlah_beli') }}</strong></span>
                            @endif
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        @if($errors->any())
            $('#addProduct').modal('shown.bs.modal'),
        @endif

        $('.select2').select2({
            dropdownParent: $('#addProduct'),
        });

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
            return (((sign) ? '' : '-') + 'Rp' + num);
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
