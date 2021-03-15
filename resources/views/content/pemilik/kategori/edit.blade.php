<div class="form-group">
    <label for='nama' @error('nama') class='text-danger' @enderror>Kategori Prodcut</label>
    <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror"
        name="nama" value="{{ old('nama',$kategori->nama) }}" placeholder='Masukkan Nama'
        style="text-transform: capitalize;">
    @if ($errors->has('nama')) <span
            class="invalid-feedback"><strong>{{ $errors->first('nama') }}</strong></span>
    @endif
</div>
