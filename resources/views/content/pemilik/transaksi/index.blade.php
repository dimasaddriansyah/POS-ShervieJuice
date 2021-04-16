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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksis as $key => $transaksi)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $transaksi->pegawai->nama }}</td>
                                <td>{{ $transaksi->nama_pembeli }}</td>
                                <td>@currency($transaksi->jumlah_harga)</td>
                                <td>@currency($transaksi->uang_bayar)</td>
                                <td>@currency($transaksi->uang_bayar - $transaksi->jumlah_harga)</td>
                                <td>{{ $transaksi->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-icon" data-toggle="modal" data-target="#detailTransaksi{{ $transaksi->id }}"><i class="fas fa-eye"></i></button>
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
    {{-- Add --}}
    @foreach($transaksis as $transaksi)
    <div class="modal fade" data-keyboard="false" tabindex="-1" role="dialog" id="detailTransaksi{{ $transaksi->id }}">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pr-5">Nama Pembeli : {{$transaksi->nama_pembeli}}</h5>
                    <h5 class="modal-title">Transaksi {{$transaksi->created_at}}</h5>
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
                            <th>Kategori</th>
                            <th>Jumlah Beli</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($transaksi->transaksi_detail as $detail_transaksi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail_transaksi->produk->nama }}</td>
                            <td>{{ $detail_transaksi->produk->kategori->nama }}</td>
                            <td>{{ $detail_transaksi->jumlah_beli }}</td>
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
    {{-- End Add --}}
    @endsection
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
