<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label for="stock">Stock Sebelumnya</label>
            <input type="text" class="form-control" value="{{ $produk->stok }}" readonly>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="stok">Stok Sekarang</label>
            <input type="number" id="stok" class="form-control @error('stok') is-invalid @enderror" name="stok">
            @if ($errors->has('stok')) <span
            class="invalid-feedback"><strong>{{ $errors->first('stok') }}</strong></span> @endif
        </div>
    </div>
</div>
