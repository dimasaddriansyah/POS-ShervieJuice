@extends('layouts.pemilik.master')
@section('title', 'Data Stok Masuk')
@section('content')
    <div class="section-header">
        <h1>Data Stok Masuk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Stok Masuk</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        @if (!empty($habis))
                            <a class="btn btn-danger" style="color: white"><i class="fas fa-ban mr-2"></i> Stok Habis
                                <b>{{ $habis }}</b></a>
                        @endif
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary float-right px-4 mb-3" data-toggle="modal"
                            data-target="#tambahStokMasuk"><i class="fas fa-plus mr-2"></i> Tambah Produk Masuk</button>
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-hover table-responsive-lg">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Nama Produk</th>
                            <th>Kategori Produk</th>
                            <th>Harga</th>
                            <th>Jumlah Produk</th>
                            <th>Update</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks as $key => $produk)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $produk->supplier->nama }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->kategori->nama }}</td>
                                <th>@currency($produk->harga)</th>
                                <th>
                                    <center>{{ $produk->stok }} Pcs</center>
                                </th>
                                <td>{{ $produk->updated_at }}</td>
                                <td>
                                    <center>
                                        <button class="btn btn-xs btn-warning btn-flat mt-1 mb-1" data-toggle="modal" data-target="#editHarga{{ $produk->id }}"><i class="fas fa-edit mr-2"></i>
                                            Edit Harga</button>
                                        <button class="btn btn-xs btn-success btn-flat" data-toggle="modal" data-target="#tambahStok{{ $produk->id }}"><i class="fas fa-plus mr-2"></i>
                                            Tambah Stok</button>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>
@section('modal')
    {{-- Add Product In --}}
    <div class="modal fade" role="dialog" id="tambahStokMasuk"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('produkMasuk.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="supplier">Nama Supplier</label>
                            <select name="supplier" id="supplier" class="form-control select2 @error('supplier') is-invalid @enderror">
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ old('supplier') == $supplier->id ? 'selected' : null }}>
                                        {{ $supplier->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('supplier')) <span
                                    class="invalid-feedback"><strong>{{ $errors->first('supplier') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        name="nama" value="{{ old('nama') }}"
                                        style="text-transform: capitalize;">
                                    @if ($errors->has('nama')) <span
                                            class="invalid-feedback"><strong>{{ $errors->first('nama') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Kategori Produk</label>
                                    <select name="kategori"
                                        class="form-control select2 @error('kategori') is-invalid @enderror">
                                        @foreach ($kategoris as $kategori)
                                            {{ old('kategori') == $kategori->id ? 'selected' : null }}>
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                        id="num" name="harga" value="{{ old('harga') }}"
                                        onkeyup="document.getElementById('format2').innerHTML = formatCurrency(this.value);">Nominal
                                    : <span id="format2"></span>
                                    @if ($errors->has('harga')) <span
                                            class="invalid-feedback"><strong>{{ $errors->first('harga') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Jumlah produk</label>
                                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                        name="jumlah" value="{{ old('jumlah') }}">
                                    @if ($errors->has('jumlah')) <span
                                            class="invalid-feedback"><strong>{{ $errors->first('jumlah') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-secondary px-5" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary px-5">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add Produk In --}}

    {{-- Edit Add Stock --}}
    @foreach ($produks as $produk)
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="tambahStok{{ $produk->id }}" tabindex="-1" role="dialog"
        aria-labelledby="tambahStok" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahStok">Add Stock Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('produkMasuk.tambahStok',$produk) }}" method="post">
                        @method('PATCH')
                        @csrf
                        @include('content.pemilik.produk_masuk.tambahStok')
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    {{-- End Add Stock --}}

    {{-- Edit Edit Price --}}
    @foreach ($produks as $produk)
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="editHarga{{ $produk->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editHarga" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHarga">Edit Price Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('produkMasuk.editHarga',$produk) }}" method="post">
                        @method('PATCH')
                        @csrf
                        @include('content.pemilik.produk_masuk.editHarga')
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    {{-- End Edit Price --}}
@endsection
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets_admin/dist/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets_admin/dist/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/page/modules-sweetalert.js') }}"></script>
<script src="{{asset('assets_admin/dist/datatables/jquery.dataTables.js') }}"></script>
<script src="{{asset('assets_admin/dist/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
    $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            });
        });
    $('.select2').select2({
        dropdownParent: $('#tambahStokIn'),
    });
    $('#addEmployee').on('shown.bs.modal', function() {
        $('#supplier').focus();
    })

    @if($errors->any())
        $('#tambahStokMasuk').modal('show'),
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
            }
        });
    });
    function formatCurrency(num) {
        num = num.toString().replace(/\$|\,/g,'');
        if(isNaN(num))
        num = "0";
        sign = (num == (num = Math.abs(num)));
        num = Math.floor(num*100+0.50000000001);
        cents = num%100;
        num = Math.floor(num/100).toString();
        if(cents<10)
        cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
        num = num.substring(0,num.length-(4*i+3))+'.'+
        num.substring(num.length-(4*i+3));
        return (((sign)?'':'-') + 'Rp ' + num);
    }
    </script>
@include('sweet::alert')
@endpush
