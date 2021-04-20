@extends('layouts.pemilik.master')
@section('title', 'Data Pegawai')
@section('content')
    <div class="section-header">
        <h1>Halaman Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Pegawai</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahPegawai"><i class="fas fa-user-plus mr-2"></i> Tambah Akun
                        </button>
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-hover table-responsive-lg">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>
                                <center>Option</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawais as $key => $pegawai)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $pegawai->nama }}</td>
                                <td>{{ $pegawai->email }}</td>
                                <td>{{ $pegawai->alamat }}</td>
                                <td>{{ $pegawai->no_hp }}</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#editPegawai{{ $pegawai->id }}"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-xs btn-danger btn-flat swal-confirm" data-id="{{ $pegawai->id }}">
                                            <form action="{{ route('pegawai.destroy', $pegawai) }}" method="POST" id="delete{{ $pegawai->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <i class="fa fa-trash"></i>
                                        </button>
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

@section('modal')
    {{-- Add --}}
    <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" id="tambahPegawai">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Akun Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pegawai.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for='nama' @error('nama') class='text-danger' @enderror>Nama Pegawai</label>
                            <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror"
                                name="nama" value="{{ old('nama') }}" placeholder='Masukkan Nama'
                                style="text-transform: capitalize;">
                            @if ($errors->has('nama')) <span
                                    class="invalid-feedback"><strong>{{ $errors->first('nama') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for='email' @error('email') class='text-danger' @enderror>Email Pegawai</label>
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder='Masukkan Email'>
                            @if ($errors->has('email')) <span
                                    class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for='password' @error('password') class='text-danger' @enderror>Password Pegawai</label>
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" value="{{ old('password') }}" placeholder='Masukkan Password'>
                            @if ($errors->has('password')) <span
                                    class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for='no_hp' @error('no_hp') class='text-danger' @enderror>No Handphone Pegawai</label>
                            <input type="number" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                                name="no_hp" value="{{ old('no_hp') }}" placeholder='Masukkan No Handphone'
                                style="text-transform: capitalize;">
                            @if ($errors->has('no_hp')) <span
                                    class="invalid-feedback"><strong>{{ $errors->first('no_hp') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for='alamat' @error('alamat') class='text-danger' @enderror>Alamat Pegawai</label>
                            <input type="text" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                            name="alamat" value="{{ old('alamat') }}" placeholder='Masukkan No Handphone'>
                            @if ($errors->has('alamat')) <span
                                    class="invalid-feedback"><strong>{{ $errors->first('alamat') }}</strong></span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add --}}

    <!-- Modal edit -->
    @foreach ($pegawais as $pegawai)
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="editPegawai{{ $pegawai->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editPegawai" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPegawai">Edit Data Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pegawai.update',$pegawai) }}" method="post">
                        @method('PATCH')
                        @csrf
                        @include('content.pemilik.pegawai.edit')
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    {{-- End Edit --}}
@endsection
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
    $('#tambahPegawai').on('shown.bs.modal', function() {
        $('#name').focus();
    })

    @if($errors->any())
        $('#tambahPegawai').modal('show')
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
