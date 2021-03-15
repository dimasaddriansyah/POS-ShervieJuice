<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Pegawai | Dashboard</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/tampilan-admin/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('/dash/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('/dash/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('/dash/vendors/css/vendor.bundle.addons.css')}}">
  <script src="{{ asset('js/app.js') }}"></script>
  <script>
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
      return (((sign)?'':'-') + 'Rp. ' + num);
    }
</script>

</head>
<body>
    <nav class="navbar navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <li class="col-md-12">
                 <h3><i class="fa fa-cash-register" style="color: green"></i> Transaksi Pembelian</h3>
                </li>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Notifications Dropdown Menu -->

          <li class="nav-item">
          <li class="col-md-12">
              <a class="mr-3"><i class="fa fa-user-alt"></i> {{ Auth::guard('pegawai')->user()->name }}</a>
              <a href="{{ url('/keluar') }}">Logout</a>
          </li>
          </li>
        </ul>
    </nav>

    <div class="content mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="/pegawai/index" class="btn btn-primary float-left mb-4">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #008080">
                            <h5 style="color: white"><i class="fas fa-dollar-sign"></i>  Transaksi No -
                                @if(!empty($transaksi_barang))
                                {{ $transaksi_barang->id}} </h5>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger" align="left">
                                <ul>
                                    <p>Kesalahan !</p>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless table-hover">
                                        <h3 class="mt-4">Data Pembelian Barang</h3>
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
                                            @foreach($transaksi_detail as $key => $transaksi_detail)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$transaksi_detail->barang->nama_barang}}</td>
                                                    <td>{{ $transaksi_detail->jumlah_beli }}pcs</td>
                                                    <td>@currency($transaksi_detail->barang->harga_jual)</td>
                                                    <td>@currency($transaksi_detail->jumlah_harga)</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col">
                                        </div>
                                        <div class="float-right">
                                            <h6>Tanggal Pemesanan : <b>{{ $transaksi_barang->created_at }}</b></h6>
                                        </div>
                                        </div>
                                        <h3 class="mt-2">Data Transaksi</h3>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <td><strong>Nama Pembeli</strong></td>
                                                    <td>:</td>
                                                    <td>{{ $transaksi_barang->nama_pembeli }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Total Harga</strong></td>
                                                    <td>:</td>
                                                    <td>@currency($transaksi_barang->jumlah_harga)</td>
                                                </tr>
                                                    <tr>
                                                    <td><strong>Uang Bayar</strong></td>
                                                    <td>:</td>
                                                    <td>@currency($transaksi_barang->uang_bayar)</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Kembali</strong></td>
                                                    <td>:</td>
                                                    <td>@currency($transaksi_barang->uang_bayar - $transaksi_barang->jumlah_harga)</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <a class="btn btn-success btn-lg float-right" href="{{ url('cetak_pdf')}}/{{$transaksi_barang->id }}"
                                                            target="_blank"><i class="fas fa-print"></i> Print</a>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('/tampilan-admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('/tampilan-admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('/tampilan-admin/dist/js/adminlte.min.js')}}"></script>
    @include('sweet::alert')

</body>
</html>
