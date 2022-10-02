<div>
    <div class="row mb-7">
        <div class="col-md-4">
            Nama Barang
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $barang->nama }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Tipe Barang
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $barang->tipeBarang() }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Stock
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $barang->stock }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Minimal Stock
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $barang->min_stock }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Harga
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $barang->harga_formatted }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Merk Barang
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $barang->merk ? $barang->merk->nama_merk : '-' }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Kategori
        </div>
        <div class="col-md">
            : <span class="fw-bold">
                @if (count($barang->barangKategori) > 0)
                    @foreach ($barang->barangKategori as $item)
                        {{ $item->kategori->nama_kategori }},
                    @endforeach
                @else
                    -
                @endif
            </span>
        </div>
    </div>
</div>
