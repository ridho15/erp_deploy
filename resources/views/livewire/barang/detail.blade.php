<div>
    @include('helper.alert-message')
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
            : <span class="fw-bold">{{ $barang->tipeBarang->tipe_barang }}</span>
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
            Satuan
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $barang->satuan->nama_satuan }}</span>
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
                        <span class="" wire:click="$emit('onClickHapusKategori', {{ $item->id }})" style="cursor: pointer">{{ $item->kategori->nama_kategori }} <i class="bi bi-trash-fill text-danger"></i></span>,
                    @endforeach
                @else
                    -
                @endif
            </span>
        </div>
    </div>
</div>
@push('js')
    <script>
        Livewire.on('finishDataBarang', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })

        Livewire.on('onClickHapusKategori', async(id) => {
            const response = await alertConfirm("Peringatan", 'Apakah kamu yakin ingin menghapus kategori pada barang ?');
            if(response.isConfirmed == true){
                Livewire.emit('hapusKategoriBarang', id);
            }
        })
    </script>
@endpush
