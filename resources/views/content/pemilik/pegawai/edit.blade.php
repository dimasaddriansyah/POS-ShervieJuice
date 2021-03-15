<div class="form-group">
    <label>Nama Pegawai</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
        value="{{ $pegawai->nama }}" style="text-transform: capitalize;">
    @if ($errors->has('nama')) <span
            class="invalid-feedback"><strong>{{ $errors->first('nama') }}</strong></span> @endif
</div>
<div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ $pegawai->email }}">
    @if ($errors->has('email')) <span
            class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span> @endif
</div>
<div class="form-group">
    <label>Alamat</label>
    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
        value="{{ $pegawai->alamat }}">
    @if ($errors->has('alamat')) <span
            class="invalid-feedback"><strong>{{ $errors->first('alamat') }}</strong></span> @endif
</div>
<div class="form-group">
    <label>No Hp</label>
    <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
        value="{{ $pegawai->no_hp }}">
    @if ($errors->has('no_hp')) <span
            class="invalid-feedback"><strong>{{ $errors->first('no_hp') }}</strong></span> @endif
</div>
