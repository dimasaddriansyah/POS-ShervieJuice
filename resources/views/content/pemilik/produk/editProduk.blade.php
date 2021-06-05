<div class="form-group">
    <label for="supplier">Nama Supplier</label>
    <select name="supplier" id="supplier" class="form-control select2 @error('supplier') is-invalid @enderror">
        @foreach ($suppliers as $supplier)
        <option value="{{ $supplier->id }}" {{ old('supplier') == $supplier->id ? 'selected' : null }}>
            {{ $supplier->nama }}
        </option>
        @endforeach
    </select>
    @if ($errors->has('supplier')) <span
        class="invalid-feedback"><strong>{{ $errors->first('supplier') }}</strong></span>
    @endif
</div>
<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                value="{{ old('nama',$produk->nama) }}" style="text-transform: capitalize;">
            @if ($errors->has('nama')) <span
                class="invalid-feedback"><strong>{{ $errors->first('nama') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label>Kategori Produk</label>
            <select name="kategori" class="form-control select2 @error('kategori') is-invalid @enderror">
                @foreach ($kategoris as $kategori)>
                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label>Harga</label>
            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="num" name="harga"
                value="{{ old('harga',$produk->harga) }}"
                onkeyup="document.getElementById('format').innerHTML = formatCurrency(this.value);">Nominal
            : <span id="format"></span>
            @if ($errors->has('harga')) <span
                class="invalid-feedback"><strong>{{ $errors->first('harga') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label>Jumlah produk</label>
            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                value="{{ old('jumlah',$produk->stok) }}">
            @if ($errors->has('jumlah')) <span
                class="invalid-feedback"><strong>{{ $errors->first('jumlah') }}</strong></span>
            @endif
        </div>
    </div>
</div>
