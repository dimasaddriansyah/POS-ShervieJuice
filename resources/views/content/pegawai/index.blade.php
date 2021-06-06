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
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                            <button class="card mb-3 hov" style="text-decoration: none" data-toggle="modal"
                                data-target="#kategori{{ $kategori->id }}">
                                <div class="card-body" style="height: 80px; width: 200px">
                                    <h6>
                                        <img src="{{ asset('img/icon/'. $kategori->icon) }}" class="mr-2"
                                            style="height: 30px; width: 30px"> {{ $kategori->nama }}
                                    </h6>
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
    <div class="col-12 col-lg-8">
        <div class="card mb-4">
            <div class="card-header bg-warning">
                <h5>
                    <i class="fa fa-clipboard mr-2"></i>
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
                                <th style="width: 20%">Jumlah Beli</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah Harga</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi_detail as $transaksi_detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaksi_detail->produk->kategori->nama.' - '.$transaksi_detail->produk->nama }}
                                </td>
                                <td style="width: 20%">
                                    <div class="row justify-content-center">
                                        <form action="{{ url('kurangStok') }}/{{ $transaksi_detail->id }}"
                                            method="POST">
                                            @csrf
                                            @if($transaksi_detail->jumlah_beli > 1)
                                            <button class="btn btn-danger btn-xs mr-2" style="padding : 2px 6px">
                                                <i class="fas fa-minus" style="font-size: 12px"></i>
                                            </button>
                                            @endif
                                        </form>
                                        {{ $transaksi_detail->jumlah_beli }}
                                        <form action="{{ url('tambahStok') }}/{{ $transaksi_detail->id }}"
                                            method="POST">
                                            @csrf
                                            <button class="btn btn-primary btn-xs ml-2" style="padding : 2px 6px">
                                                <i class="fas fa-plus" style="font-size: 12px"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>@currency($transaksi_detail->produk->harga)</td>
                                <td>@currency($transaksi_detail->jumlah_harga)</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-xs btn-danger btn-flat btn-hapus"
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
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-header bg-warning">
                <h5><i class="fas fa-check-square mr-2"></i> Konfirmasi Transaksi</h5>
            </div>
            <div class="card-body">
                @if (!empty($transaksi))
                <form action="{{ route('kasir.konfirmasiTransaksi', $transaksi) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Nama Pembeli</label>
                        <input type="text" class="form-control @error('nama_pembeli') is-invalid @enderror"
                            name="nama_pembeli">
                        @if ($errors->has('nama_pembeli')) <span
                            class="invalid-feedback"><strong>{{ $errors->first('nama_pembeli') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">Total Harga</label>
                        <input type="text" class="form-control" name="total_harga" onfocus="startCalculate()"
                            onblur="stopCalc()" @if (!empty($transaksi)) value="@currency($transaksi->jumlah_harga)"
                            @endif readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Uang Bayar</label>
                        <div class="row justify-content-center">
                            <button type="button" class="btn btn-primary btn-sm mr-2" onClick="uangBayar(2000)">Rp
                                2.000</button>
                            <button type="button" class="btn btn-primary btn-sm mr-2" onClick="uangBayar(5000)">Rp
                                5.000</button>
                            <button type="button" class="btn btn-primary btn-sm mr-2" onClick="uangBayar(10000)">Rp
                                10.000</button>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <button type="button" class="btn btn-primary btn-sm mr-2" onClick="uangBayar(20000)">Rp
                                20.000</button>
                            <button type="button" class="btn btn-primary btn-sm mr-2" onClick="uangBayar(50000)">Rp
                                50.000</button>
                            <button type="button" class="btn btn-primary btn-sm mr-2" onClick="uangBayar(100000)">Rp
                                100.000</button>
                        </div>
                        <br>
                        <input type="number" id="uang_bayar"
                            class="form-control @error('uang_bayar') is-invalid @enderror" name="uang_bayar"
                            value="{{ old('uang_bayar') }}" onfocus="startCalculate()" onblur="stopCalc()"
                            onkeyup="document.getElementById('format').innerHTML = formatCurrency(this.value);">Nominal
                        : <span id="format"></span>
                        @if ($errors->has('uang_bayar')) <span
                            class="invalid-feedback"><strong>{{ $errors->first('uang_bayar') }}</strong></span>
                        @endif
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-warning btn-block mt-3">Konfirmasi</button>
                    </div>
                </form>
                @else
                <h6 class="text-center">Tidak Ada Transaksi</h6>
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
                <h5 class="modal-title">Kategori {{$kategori->nama}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover table-responsive-lg example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Jumlah Beli</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori->produk as $produk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>@currency($produk->harga)</td>
                            <form method="POST" action="{{route('kasir.tambahTransaksi', $produk->id)}}">
                                @csrf
                                <td width="10%"><input @if($produk->stok==0) disabled @endif type="number"
                                    class="form-control" name="jumlah_beli" ></td>
                                <td width="10%">
                                    @if ($produk->stok==0)
                                    <input type="submit" class="btn btn-danger" name="submit" value="Tambahkan"
                                        disabled>
                                    @else
                                    <input type="submit" class="btn btn-primary" name="submit" value="Tambahkan">
                                    @endif
                                </td>
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
<link rel="stylesheet" href="{{asset('assets_admin/dist/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<style>
    .hov:hover {
        background-color: #ffc107;
    }
</style>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets_admin/dist/datatables/jquery.dataTables.js') }}"></script>
<script src="{{asset('assets_admin/dist/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
    $(function () {
            $(".example1").DataTable();
            $('.example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            });
        });

    @if($errors->any())
        $('#produk').modal('show'),
    @endif

    $(".btn-hapus").click(function(e) {
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
    function uangBayar(uang){
        var uangbayar1 = $("#uang_bayar").val()
        if(!uangbayar1) uangbayar1 = 0
        var bayar = parseInt(uang, 10)+parseInt(uangbayar1, 10)
       $("#uang_bayar").val(bayar)
       document.getElementById('format').innerHTML = formatCurrency(bayar)
    }
</script>
@endpush
