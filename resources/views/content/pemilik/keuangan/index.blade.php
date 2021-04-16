@extends('layouts.pemilik.master')
@section('title', 'Data Laporan Transaksi')
@section('content')
    <div class="section-header">
        <h1>Laporan Keuangan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Laporan Keuangan</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-info align-content-center float-right mb-3"><i class="fas fa-wallet mr-2"></i> Pendapatan :
                            @currency($pendapatan)</button> 
                    </div>
                    <div class="col-sm-">
                    <form method="post">
                    {{csrf_field()}}
                        <input type="text" name="range" class="form-control" >
                        <input type="submit" name="submit" class="btn btn-info" value="filter">
                    </form>
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-hover table-responsive-lg">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keuangan as $key => $keuangan)
                            <tr>
                                <td> {{++$key }}</td>
                                <td>{{ $keuangan->created_at }}</td>
                                <td> @currency($keuangan->jumlah_harga)</td>

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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('script')
    <script src="{{ asset('assets_admin/dist/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/page/modules-sweetalert.js') }}"></script>
    <script src="{{ asset('assets_admin/dist/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets_admin/dist/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
            $('input[name="range"]').daterangepicker({
                "locale": {
                "format": "YYYY/MM/DD"},
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });

    </script>
@endpush
