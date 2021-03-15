@extends('layouts.pemilik.master')
@section('title', 'Data Produk')
@section('content')
    <div class="section-header">
        <h1>Data Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Produk</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mb-3">
                        @if (!empty($kritis))
                            <a class="btn btn-warning mr-2" style="color: white"><i
                                    class="fas fa-exclamation-triangle mr-2"></i> Stok
                                Kritis <b>{{ $kritis }}</b></a>
                        @endif
                        @if (!empty($habis))
                            <a class="btn btn-danger" style="color: white"><i class="fas fa-ban mr-2"></i> Stok Habis
                                <b>{{ $habis }}</b></a>
                        @endif
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-hover table-responsive-lg">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Supplier Produk</th>
                            <th>Kategori Produk</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Update</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks as $key => $produk)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->supplier->nama }}</td>
                                <td>{{ $produk->kategori->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>@currency($produk->harga)</td>
                                <td>{{ $produk->updated_at }}</td>
                                <td>
                                    <center>
                                        @if ($produk->stok <= 0)
                                            <span class="badge badge-danger">Habis</span>
                                        @elseif($produk->stok < 5) <span class="badge badge-warning">Kritis</span>
                                            @else
                                                <span class="badge badge-success">Aman</span>
                                        @endif
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
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets_admin/dist/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@push('script')
    <script src="{{ asset('assets_admin/dist/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/page/modules-sweetalert.js') }}"></script>
    <script src="{{ asset('assets_admin/dist/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets_admin/dist/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function() {
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

    </script>
@endpush
