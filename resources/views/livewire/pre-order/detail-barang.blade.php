<div>
    <h4 class="fw-bold mb-5">Pre Order Barang</h4>
    @include('helper.alert-message')
    <div class="text-center">
        @include('helper.simple-loading', ['target' => 'cari,hapusBarang', 'message' => 'Memuat data...'])
    </div>
    <div class="row mb-5">
        <div class="col-md-4">
            @include('helper.form-pencarian', ['model' => 'cari'])
        </div>
        <div class="col-md-8 text-end">
            <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Barang" wire:click="changeTambahBarang">
                <i class="bi bi-plus-circle"></i> Tambah
            </button>
        </div>
    </div>
    <form action="#" method="POST" wire:submit.prevent="simpanBarang">
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="row mb-5">

                </div>
            </div>
            <div class="col-md-6 mb-5">
                <label for="" class="form-label required">Barang</label>
                <select name="id_barang" wire:model="id_barang" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih" required>
                    <option value="">Pilih</option>
                    @foreach ($listBarang as $item)
                        <option value="{{ $item->id }}">{{ $item->sku }} {{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
        <thead>
        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
            <th>No</th>
            <th>SKU</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Satuan</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @if (count($listPreOrderDetail) > 0)
                @foreach ($listPreOrderDetail as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->barang->sku }}</td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->harga_formatted }}</td>
                        <td>{{ $item->satuan->nama_satuan }}</td>
                        <td><?= $item->keterangan ?></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Kategori" wire:click="$emit('onClickEdit', {{ $item->id }})">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Kategori" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
        </tbody>
        </table>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('finishSimpanData', (status, message) => {
            alertMessage(status, message);
        })
    </script>
@endpush
