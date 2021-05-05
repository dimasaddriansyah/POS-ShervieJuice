@extends('layouts.pemilik.master')
@section('title', 'Pengaturan Stok')
@section('content')
    <div class="section-header">
        <h1>Pengaturan Stok</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Pengaturan Stok</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-responsive-lg">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Stok Produk</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaturans as $pengaturan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pengaturan->keterangan }}</td>
                                <td>{{ $pengaturan->stok }}</td>
                                <td>
                                    <button class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets_admin/dist/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush

@push('script')
    <script src="{{ asset('assets_admin/dist/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/page/modules-sweetalert.js') }}"></script>
    <script src="{{asset('assets_admin/dist/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{asset('assets_admin/dist/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
    $(function () {
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
    $('#tambahStok').on('shown.bs.modal', function() {
        $('#name').focus();
    })

    @if($errors->any())
        $('#tambahStok').modal('show')
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
