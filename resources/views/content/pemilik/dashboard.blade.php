@extends('layouts.pemilik.master')
@section('title', 'Dashboard Pemilik')
@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            @if (!empty($kritis))
                <a class="btn btn-warning mr-2" href="{{ route('produk.index') }}">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Stok Produk Kritis <b>{{ $kritis }}</b>
                </a>
            @endif
            @if (!empty($habis))
                <a class="btn btn-danger" href="{{ route('produk.index') }}"><i class="fas fa-ban mr-2"></i> Stok Produk
                    Habis
                    <b>{{ $habis }}</b></a>
            @endif
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('pegawai.index') }}" class="card card-statistic-1" style="text-decoration: none">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pegawai</h4>
                        </div>
                        <div class="card-body">
                            <div class="count">{{ $pegawai }}</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('supplier.index') }}" class="card card-statistic-1" style="text-decoration: none">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Supplier</h4>
                        </div>
                        <div class="card-body">
                            <div class="count">{{ $supplier }}</div>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('kategori.index') }}" class="card card-statistic-1" style="text-decoration: none">
                    <div class="card-icon bg-success">
                        <i class="fas fa-clipboard"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kategori</h4>
                        </div>
                        <div class="card-body">
                            <div class="count">{{ $kategori }}</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('produk.index') }}" class="card card-statistic-1" style="text-decoration: none">
                    <div class="card-icon bg-success">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Produk</h4>
                        </div>
                        <div class="card-body">
                            <div class="count">{{ $produk }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="" class="card card-statistic-1 btn-info" style="text-decoration: none">
                    <div class="card-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4 class="text-white">Pendapatan</h4>
                        </div>
                        <div class="card-body">
                            <div class="text-white count">{{ $pendapatan }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets_admin/js/count.js') }}"></script>
@endpush
