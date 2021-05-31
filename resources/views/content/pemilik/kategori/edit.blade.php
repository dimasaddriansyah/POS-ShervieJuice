<div class="form-group">
    <label for='nama' @error('nama') class='text-danger' @enderror>Kategori Prodcut</label>
    <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror"
        name="nama" value="{{ old('nama',$kategori->nama) }}" placeholder='Masukkan Nama'
        style="text-transform: capitalize;">
    @if ($errors->has('nama')) <span
            class="invalid-feedback"><strong>{{ $errors->first('nama') }}</strong></span>
    @endif
</div>
<div class="form-group">
    <label for='icon' @error('icon') class='text-danger' @enderror>Icon Produk</label>
    <input type="file" id="icon" class="form-control @error('icon') is-invalid @enderror"
        name="icon" value="{{ old('icon') }}">
    @if ($errors->has('icon')) <span
            class="invalid-feedback"><strong>{{ $errors->first('icon') }}</strong></span>
    @endif
</div>
