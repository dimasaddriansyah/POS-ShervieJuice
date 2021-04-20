@extends('layouts.pemilik.master')
@section('title', 'Data Riwayat Transaksi')
@section('content')
    <div class="section-header">
        <h1>Riwayat Transaksi Page</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Riwayat Transaksi</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('transaksi.cetakPDF') }}" target="_blank" class="btn btn-danger align-content-center float-left mb-3"><i class="fas fa-file-pdf mr-2"></i>
                            Export PDF
                        </a>
                        <a href="{{ route('transaksi.cetakExcel') }}" target="_blank" class="btn btn-success align-content-center float-left mb-3 ml-3"><i class="fas fa-file-excel mr-2"></i>
                            Export Excel
                        </a>
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-hover table-responsive-lg">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Kasir / Pegawai</th>
                            <th>Nama Pembeli</th>
                            <th>Total Harga</th>
                            <th>Uang Bayar</th>
                            <th>Kembalian</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $key => $transaksi)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $transaksi->pegawai->nama }}</td>
                                <td>{{ $transaksi->nama_pembeli }}</td>
                                <td>@currency($transaksi->jumlah_harga)</td>
                                <td>@currency($transaksi->uang_bayar)</td>
                                <td>@currency($transaksi->uang_bayar - $transaksi->jumlah_harga)</td>
                                <td>{{ $transaksi->created_at }}</td>
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
