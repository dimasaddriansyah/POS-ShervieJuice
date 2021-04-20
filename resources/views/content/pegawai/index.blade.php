@extends('layouts.pegawai.master')
@section('title', 'Casshier Page')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5><i class="fas fa-cubes mr-2"></i> List Produk</h5>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            @foreach ($kategoris as $kategori)
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <button class="card mb-2" style="text-decoration: none" data-toggle="modal"
                                        data-target="#kategori{{ $kategori->id }}">
                                    <div class="card-body">
                                            <h6>{{ $kategori->nama }}</h6>
                                        </div>
                                    </button>
                                </div>
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
                <div class="card-header bg-warning">
                    <h5>
                        <i class="fa fa-info-circle mr-2"></i>
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
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah Beli</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah Harga</th>
                                        <th>Option</th>
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
                                                    <i class="fas fa-trash-alt"></i>
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
                <div class="card-header bg-warning">
                    <h5><i class="fas fa-check-double mr-2"></i> Konfirmasi Transaksi</h5>
                </div>
                <div class="card-body">
                    @if (!empty($transaksi))
                        <form action="{{ route('kasir.konfirmasiTransaksi', $transaksi) }}" method="post">
                        @csrf
                    @endif
                    <div class="form-group">
                        <label class="form-label">Nama Pembeli</label>
                        <input type="text" class="form-control @error('nama_pembeli') is-invalid @enderror"
                            name="nama_pembeli">
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
                    @if (!empty($transaksi))
                    <div class="d-grid gap-2">
                        <button class="btn btn-warning btn-block mt-3">Konfirmasi</button>
                    </div>
                    </form>
                    @else
                    <div class="d-grid gap-2">
                        <button class="btn btn-warning btn-block mt-3">Silahkan Tambah Produk</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @foreach ($kategoris as $kategori)
    <div class="modal fade" data-keyboard="false" tabindex="-1" role="dialog" id="kategori{{ $kategori->id }}">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$kategori->nama}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="example1" class="table table-bordered table-hover table-responsive-lg">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Jumlah Beli</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($kategori->produk as $produk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>{{ $produk->harga }}</td>
                            <form method="POST" action="{{route('kasir.tambahTransaksi', $produk->id)}}">
                            {{csrf_field()}}
                            <td width="10%"><input @if($produk->stok==0) disabled @endif type="number" class="form-control" name="jumlah_beli" ></td>
                            <td width="10%"><input @if($produk->stok==0) disabled @endif type="submit" class="btn btn-primary" name="submit" value="Tambahkan" ></td>
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- End Modal -->
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .hov:hover{
        background-color: #ffc107;
    }
</style>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    @if($errors->any())
        $('#produk').modal('show'),
    @endif

    $(".swal-confirm").click(function(e) {
        id = e.target.dataset.id;
        swal({
                title: 'Delete Data',
                text: 'Are you sure ?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
        .then((willDelete) => {
            if(willDelete){
                $('#delete' + id).submit();
            };
        });
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
    function tambahkan(){

    }
</script>
@endpush
