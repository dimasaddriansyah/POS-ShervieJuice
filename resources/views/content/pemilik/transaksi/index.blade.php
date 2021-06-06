@extends('layouts.pemilik.master')
@section('title', 'Data Riwayat Transaksi')
@section('content')
<div class="section-header">
    <h1>Riwayat Transaksi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Riwayat Transaksi</div>
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
                            <button type="button" class="btn btn-info btn-xs btn-icon" data-toggle="modal"
                                data-target="#detailTransaksi{{ $transaksi->id }}"><i class="fas fa-eye"></i></button>
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

{{-- Modal PDF --}}
<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="exportPDF">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export PDF Riwayat Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('exportPDFTransaksi') }}" method="POST">
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
                <h5 class="modal-title">Export Excel Riwayat Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('exportExcelTransaksi') }}" method="POST">
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
