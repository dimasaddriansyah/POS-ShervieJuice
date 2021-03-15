<div class="form-group">
    <label for='nama' @error('nama') class='text-danger' @enderror>Nama Supplier</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
        style="text-transform: capitalize;" value="{{ old('nama', $supplier->nama) }}">
    @if ($errors->has('nama'))
        <span class="invalid-feedback"><strong>{{ $errors->first('nama') }}</strong></span>
    @endif
</div>
<div class="form-group">
    <label for='no_hp' @error('no_hp') class='text-danger' @enderror>No Hp</label>
    <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
        value="{{ old('no_hp', $supplier->no_hp) }}">
    @if ($errors->has('no_hp'))
        <span class="invalid-feedback"><strong>{{ $errors->first('no_hp') }}</strong></span>
    @endif
</div>
<div class="form-group">
    <label for='alamat' @error('alamat') class='text-danger' @enderror>Alamat</label>
    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
        style="text-transform: capitalize;" value="{{ old('alamat', $supplier->alamat) }}">
    @if ($errors->has('alamat'))
        <span class="invalid-feedback"><strong>{{ $errors->first('alamat') }}</strong></span>
    @endif
</div>
