<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label>Harga Sebelumnya</label>
            <input type="text" class="form-control" value="{{ $produk->harga }}" readonly>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label>Harga Sekarang</label>
            <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga"
                id="num" value="{{ old('harga') }}"
                onkeyup="document.getElementById('format').innerHTML = formatCurrency(this.value);">Nominal : <span
                id="format"></span>
            @if ($errors->has('harga')) <span
                    class="invalid-feedback"><strong>{{ $errors->first('harga') }}</strong></span> @endif
        </div>
    </div>
</div>
