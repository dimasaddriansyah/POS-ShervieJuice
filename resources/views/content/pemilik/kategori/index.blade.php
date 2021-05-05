@extends('layouts.pemilik.master')
@section('title', 'Data Kategori Produk')
@section('content')
    <div class="section-header">
        <h1>Kategori Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Kategori Produk</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary float-right px-4 mb-3" data-toggle="modal" data-target="#tambahKategori"><i class="fas fa-plus mr-2"></i> Tambah
                            Data</button>
                    </div>
                </div>
                <table id="" class="table table-bordered table-hover table-responsive-lg example1">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori Product</th>
                            <th>
                                <center>Option</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoris as $key => $kategori)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $kategori->nama }}</td>
                                <td>
                                    <center>
                                        {{-- <button type="button" class="btn btn-warning  btn-edit" data-toggle="modal" data-target="#editKategori-{{ $kategori->id }}">
                                            <i class="fas fa-user-edit"></i>
                                        </button> --}}
                                        <button type="button" class="btn btn-xs btn-info btn-flat" data-toggle="modal" data-target="#detailKategori{{ $kategori->id }}"><i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#editKategori{{ $kategori->id }}"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-xs btn-danger btn-flat swal-confirm"
                                            data-id="{{ $kategori->id }}">
                                            <form action="{{ route('kategori.destroy', $kategori) }}" method="POST"
                                                id="delete{{ $kategori->id }}">
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
    @foreach ($kategoris as $kategori)
    <div class="modal fade" tabindex="-1" role="dialog" id="detailKategori{{$kategori->id}}" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">List Produk Kategori {{ $kategori->nama }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="" class="table table-bordered table-hover table-responsive-lg example1">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Supplier</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($kategori->produk as $produk)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{$produk->nama}}</td>
                                    <td>{{$produk->supplier->nama}}</td>
                                    <td>{{$produk->stok}}</td>
                                    <td>@currency($produk->harga)</td>
                                    <td>
                                        @if ($produk->stok <= 0)
                                            <span class="badge badge-danger">Habis</span>
                                        @elseif($produk->stok < 5)
                                            <span class="badge badge-warning">Kritis</span>
                                        @else
                                            <span class="badge badge-success">Aman</span>
                                        @endif
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{-- End Detail --}}

    {{-- Add --}}
    <div class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" id="tambahKategori" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kategori.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for='nama' @error('nama') class='text-danger' @enderror>Kategori Produk</label>
                            <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror"
                                name="nama" value="{{ old('nama') }}" placeholder='Masukkan Nama'
                                style="text-transform: capitalize;">
                            @if ($errors->has('nama')) <span
                                    class="invalid-feedback"><strong>{{ $errors->first('nama') }}</strong></span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add --}}

    <!-- Modal edit -->
    @foreach ($kategoris as $kategori)
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="editKategori{{ $kategori->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editKategori" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategori">Edit Kategori Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kategori.update',$kategori) }}" method="post">
                        @method('PATCH')
                        @csrf
                        @include('content.pemilik.kategori.edit')
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
<link rel="stylesheet" href="{{asset('assets_admin/dist/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush

@push('script')
<script src="{{asset('assets_admin/dist/datatables/jquery.dataTables.js') }}"></script>
<script src="{{asset('assets_admin/dist/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('assets_admin/dist/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/page/modules-sweetalert.js') }}"></script>
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
    $('#tambahKategori').on('shown.bs.modal', function() {
        $('#name').focus();
    })

    @if($errors->any())
        $('#tambahKategori').modal('show'),
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
