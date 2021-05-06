@extends('layouts.pegawai.master')
@section('title', 'Konfirmasi Transaksi')
@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <a href="{{ route('kasir') }}" class="btn btn-primary"><i class="fas fa-angle-left mr-2"></i> Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5><i class="fas fa-scroll"></i> Data Pembelian</h5>
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Beli</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi_detail as $key => $transaksi_detail)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $transaksi_detail->produk->kategori->nama.'-'.$transaksi_detail->produk->nama }}</td>
                                            <td>{{ $transaksi_detail->jumlah_beli }}pcs</td>
                                            <td>@currency($transaksi_detail->produk->harga)</td>
                                            <td>@currency($transaksi_detail->jumlah_harga)</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5><i class="fas fa-check-double"></i> Data Transaksi : TR - @if (!empty($transaksi)){{ $transaksi->id }}@endif
                    </h5>
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <h6 class="mb-4 float-right"> Tanggal Pemesanan : <b>{{ $transaksi->created_at }}</b></h6>
                        <table class="table table-hover">
                            <tr>
                                <td><strong>Nama Pembeli</strong></td>
                                <td>:</td>
                                <td>{{ $transaksi->nama_pembeli }}</td>
                            </tr>
                            <tr>
                                <td><strong>Total Harga</strong></td>
                                <td>:</td>
                                <td>@currency($transaksi->jumlah_harga)</td>
                            </tr>
                            <tr>
                                <td><strong>Uang Bayar</strong></td>
                                <td>:</td>
                                <td>@currency($transaksi->uang_bayar)</td>
                            </tr>
                            <tr>
                                <td><strong>Kembali</strong></td>
                                <td>:</td>
                                <td>@currency($transaksi->uang_bayar - $transaksi->jumlah_harga)</td>
                            </tr>
                        </table>
                        <div class="d-grid gap-2">
                            <a class="btn btn-warning" href="{{ route('kasir.cetakPDF', $transaksi) }}" target="_blank"><i
                                    class="bi bi-printer me-2"></i>Export PDF</a>
                            <button type="button" class="btn btn-primary" onClick="cetak({{$transaksi->id}})"><i
                                    class="bi bi-printer me-2"></i>Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function cetak(id) {
    swal({
        title: "Print?",
        text: "Print Transaksi ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((konfirm) => {
        if(konfirm) {
            $.ajax({
                type: "POST",
                url: "{{url('print')}}",
                data: {id: id, _token: '{{csrf_token()}}'},
                success: function(data){
                    var json = $.parseJSON(data)
                    var ic = "error", msg="Terjadi Kesalahan!"
                    if(json.status == 200) {ic="success"; msg="Berhasil!"}
                    swal({
                        title: msg,
                        text: json.message,
                        icon: ic,
                    });
                }
            });
        }else{
            swal({
                title: "Dibatalkan!",
                text: "Print dibatalkan!",
                icon: "info",
            });
        }
    });
    }
</script>
@endpush
