@extends('layouts.pemilik.master')
@section('title', 'Data Supplier')
@section('content')
    <div class="section-header">
        <h1>Data Supplier</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Supplier</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary float-right px-4 mb-3" data-toggle="modal" data-target="#tambahSupplier" href=""><i class="fas fa-user-plus mr-2"></i> Tambah Data</button>
                    </div>
                </div>
                <table class="table table-bordered table-hover table-responsive-lg example1">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>
                                <center>Option</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $key => $supplier)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $supplier->nama }}</td>
                                <td>{{ $supplier->alamat }}</td>
                                <td>{{ $supplier->no_hp }}</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#detailSupplier{{ $supplier->id }}"><i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editSupplier{{ $supplier->id }}"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-xs btn-danger swal-confirm" data-id="{{ $supplier->id }}">
                                            <form action="{{ route('supplier.destroy', $supplier) }}" method="POST" id="delete{{ $supplier->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <i class="fa fa-trash"></i>
                                        </button>
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

    {{-- Detail --}}
    @foreach($suppliers as $supplier)
    <div class="modal fade" tabindex="-1" role="dialog" id="detailSupplier{{$supplier->id}}" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">List Produk Supplier {{ $supplier->nama }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover table-responsive-lg example1">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($supplier->produk as $produk)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{$produk->nama}}</td>
                                    <td>{{$produk->kategori->nama}}</td>
                                    <td>{{$produk->stok}}</td>
                                    <td>@currency($produk->harga)</td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{-- End Detail --}}

    {{-- Add --}}
    <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="tambahSupplier">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('supplier.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for='nama' @error('nama') class='text-danger' @enderror>Nama Supplier</label>
                            <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror"
                                name="nama" value="{{ old('nama') }}" placeholder='Masukkan Nama'
                                style="text-transform: capitalize;">
                            @if ($errors->has('nama')) <span
                                    class="invalid-feedback"><strong>{{ $errors->first('nama') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for='no_hp' @error('no_hp') class='text-danger' @enderror>No Handphone</label>
                            <input type="number" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                                name="no_hp" value="{{ old('no_hp') }}" placeholder='Masukkan No Handphone'>
                            @if ($errors->has('no_hp')) <span
                                    class="invalid-feedback"><strong>{{ $errors->first('no_hp') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for='alamat' @error('alamat') class='text-danger' @enderror>Alamat Lengkap</label>
                            <input type="address" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                name="alamat" value="{{ old('alamat') }}" placeholder='Masukkan Alamat Lengkap'
                                style="text-transform: capitalize;">
                            @if ($errors->has('alamat')) <span
                                    class="invalid-feedback"><strong>{{ $errors->first('alamat') }}</strong></span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add --}}

    <!-- Modal edit -->
    @foreach ($suppliers as $supplier)
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="editSupplier{{ $supplier->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editSupplier" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSupplier">Edit Fata Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('supplier.update',$supplier) }}" method="post">
                        @method('PATCH')
                        @csrf
                        @include('content.pemilik.supplier.edit')
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
    {{-- End Edit --}}

@endsection
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets_admin/dist/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush

@push('script')
<script src="{{ asset('assets_admin/dist/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/page/modules-sweetalert.js') }}"></script>
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
    $('#tambahSupplier').on('shown.bs.modal', function() {
        $('#name').focus();
    })

    @if($errors->any())
        $('#tambahSupplier').modal('show')
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
</script>
@include('sweet::alert')
@endpush


