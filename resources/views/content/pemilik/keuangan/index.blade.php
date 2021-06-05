@extends('layouts.pemilik.master')
@section('title', 'Data Laporan Keuangan')
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
            @if(Session::has('alert'))
            <div class="alert alert-danger mt-2 text-center">
                <div>{{Session::get('alert')}}</div>
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-danger align-content-center float-left mb-3"
                        data-toggle="modal" data-target="#exportPDF"><i class="fas fa-file-pdf mr-2"></i> Export
                        PDF</button>
                    <button type="button" class="btn btn-success align-content-center float-left mb-3 ml-3"
                        data-toggle="modal" data-target="#exportExcel"><i class="fas fa-file-excel mr-2"></i> Export
                        Excel</button>
                    <button class="btn btn-info align-content-center float-right mb-3"><i
                            class="fas fa-wallet mr-2"></i> Pendapatan :
                        @currency($pendapatan)
                    </button>
                    <form method="post">
                        @csrf
                        <input type="text" name="range" class="form-control d-flex d-inline mb-2">
                        <input type="submit" name="submit" class="btn btn-info btn-block mb-3" value="Filter">
                    </form>
                </div>
            </div>
            <table id="example1" class="table table-bordered table-hover table-responsive-sm">
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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $keuangan->created_at }}</td>
                        <td>@currency($keuangan->jumlah_harga)</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
        </div>
    </div>
</div>
@section('modal')
{{-- Modal PDF --}}
<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="exportPDF">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export PDF Laporan Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('exportPDFKeuangan') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for='start' @error('start') class='text-danger' @enderror>Dari Tanggal</label>
                        <input type="date" id="start" class="form-control @error('start') is-invalid @enderror"
                            name="start">
                        @if ($errors->has('start')) <span
                            class="invalid-feedback"><strong>{{ $errors->first('start') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for='end' @error('end') class='text-danger' @enderror>Sampai Tanggal</label>
                        <input type="date" id="end" class="form-control @error('end') is-invalid @enderror" name="end">
                        @if ($errors->has('end')) <span
                            class="invalid-feedback"><strong>{{ $errors->first('end') }}</strong></span>
                        @endif
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                {{-- <button class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button class="btn btn-danger btn-block"><i class="fas fa-file-pdf mr-2"></i> Export PDF</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal PDF --}}

{{-- Modal Excel --}}
<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="exportExcel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Excel Laporan Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('exportExcelKeuangan') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for='start' @error('start') class='text-danger' @enderror>Dari Tanggal</label>
                        <input type="date" id="start" class="form-control @error('start') is-invalid @enderror"
                            name="start">
                        @if ($errors->has('start')) <span
                            class="invalid-feedback"><strong>{{ $errors->first('start') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for='end' @error('end') class='text-danger' @enderror>Sampai Tanggal</label>
                        <input type="date" id="end" class="form-control @error('end') is-invalid @enderror" name="end">
                        @if ($errors->has('end')) <span
                            class="invalid-feedback"><strong>{{ $errors->first('end') }}</strong></span>
                        @endif
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                {{-- <button class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button class="btn btn-success btn-block"><i class="fas fa-file-excel mr-2"></i> Export Excel</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Excel --}}
@endsection
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
