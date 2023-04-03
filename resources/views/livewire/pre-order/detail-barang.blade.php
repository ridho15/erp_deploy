<div>
    <h4 class="fw-bold mb-5">PO Barang</h4>
    @include('helper.alert-message')
    <div class="text-center">
        @include('helper.simple-loading', ['target' => 'cari,id_barang', 'message' => 'Memuat data...'])
    </div>
    <div class="row mb-5">
        <div class="col-md-4">
            @include('helper.form-pencarian', ['model' => 'cari'])
        </div>
        @if ($preOrder->status == 1)
            <div class="col-md-8 text-end">
                <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Tambah Barang" wire:click="changeTambahBarang">
                    <i class="bi bi-plus-circle"></i> Tambah
                </button>
            </div>
        @endif
    </div>
    <div class="row mb-5 @if ($tambahBarang == false) d-none @endif">
        <div class="col-md mb-5">
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    SKU
                </div>
                <div class="col-md-8 col-8">
                    : <span class="fw-bold">{{ $barang ? $barang->sku : null }}</span>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Nama Barang
                </div>
                <div class="col-md-8 col-8">
                    : <span class="fw-bold">{{ $barang ? $barang->nama : null }}</span>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Stock
                </div>
                <div class="col-md-8 col-8">
                    : <span class="fw-bold">{{ $barang ? $barang->stock : null }}</span>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Harga
                </div>
                <div class="col-md-8 col-8">
                    : <span class="fw-bold">{{ $barang ? $barang->harga_formatted : null }}</span>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Satuan
                </div>
                <div class="col-md-8 col-8">
                    : <span
                        class="fw-bold">{{ $barang && $barang->satuan ? $barang->satuan->nama_satuan : null }}</span>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Merk
                </div>
                <div class="col-md-8 col-8">
                    : <span class="fw-bold">{{ $barang && $barang->merk ? $barang->merk->nama_merk : null }}</span>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Tipe Barang
                </div>
                <div class="col-md-8 col-8">
                    : <span
                        class="fw-bold">{{ $barang && $barang->tipeBarang ? $barang->tipeBarang->tipe_barang : null }}</span>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Deskripsi
                </div>
                <div class="col-md-8 col-8">
                    : <span class="fw-bold">{{ $barang ? $barang->deskripsi : null }}</span>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Sub Total
                </div>
                <div class="col-md-8 col-8">
                    : <span class="fw-bold">
                        @if ($qty && $barang)
                            {{ 'Rp. ' . number_format($barang->harga * $qty, 0, ',', '.') }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md mb-5">
            <form action="#" method="POST" wire:submit.prevent="simpanBarang">
                <div class="mb-5">
                    <label for="" class="form-label required">Barang</label>
                    <select name="id_barang" wire:model="id_barang" class="form-select form-select-solid"
                        data-control="select2" data-placeholder="Pilih Barang" required>
                        <option value="">Pilih</option>
                        @foreach ($listBarang as $item)
                            <option value="{{ $item->id }}">{{ $item->sku }} {{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_barang')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="" class="form-label required">Jumlah</label>
                    <input type="number" name="qty" wire:model="qty" class="form-control form-control-solid"
                        placeholder="Masukkan jumlah" required>
                    @error('qty')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="" class="form-label required">Harga</label>
                    <input type="number" name="harga" wire:model="harga" class="form-control form-control-solid"
                        placeholder="Masukkan harga" required>
                    @error('harga')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-5" wire:ignore>
                    <label for="" class="form-label">Keterangan</label>
                    <textarea name="keterangan" wire:model="keterangan" class="form-control form-control-solid"
                        placeholder="Masukan keterangan"></textarea>
                    @error('keterangan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="d-flex justify-content-between mb-5">
                    <div class="text-start">
                        @include('helper.simple-loading', [
                            'target' => 'simpanBarang',
                            'message' => 'Sedang menyimpan data ...',
                        ])
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Simpan Data">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
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
                    <th>Keterangan</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($listPreOrderDetail) > 0)
                    @foreach ($listPreOrderDetail as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ route('barang.detail', ['id' => $item->id_barang]) }}" class="text-dark">
                                    {{ $item->barang->sku }}
                                    <span data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Lihat Detail Barang">
                                        <i class="bi bi-question-circle"></i>
                                    </span>
                                </a>
                            </td>
                            <td>{{ $item->barang->nama }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->harga_formatted }}</td>
                            <td>{{ $item->satuan->nama_satuan }}</td>
                            <td><?= $item->keterangan ?></td>
                            <td>{{ $item->sub_total_formatted }}</td>
                            <td>
                                @if ($item->preOrder->status == 1)
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Edit Pre Order Barang"
                                            wire:click="$emit('onClickEditBarang', {{ $item }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Hapus Pre Order barang"
                                            wire:click="$emit('onClickHapusBarang', {{ $item->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                @php
                    $total = $preOrder->total;
                    if ($preOrder->id_quotation != null) {
                        $ppn = $preOrder->quotation->ppn;
                    } elseif ($preOrder->id_project_unit != null && isset($preOrder->projectUnit->project->customer->ppn)) {
                        $ppn = $preOrder->projectUnit->project->customer->ppn;
                    }
                    $total_bayar = $preOrder->total_bayar_formatted;
                @endphp
                <tr>
                    <td colspan="7" class="text-center fw-bold">Subtotal</td>
                    <td colspan="2" class="text-end fw-bold">Rp. {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-center fw-bold">PPN ({{ $ppn }}%)</td>
                    <td colspan="2" class="text-end fw-bold">Rp.{{ number_format($preOrder->ppn, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="7" class="text-center fw-bold">Total</td>
                    <td colspan="2" class="text-end fw-bold">{{ $total_bayar }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            refreshSelect()
        });

        tinymce.init({
            selector: 'textarea[name="keterangan"]',
            forced_root_block: false,
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save()
                });
                editor.on('change', function(e) {
                    // @this.set('keterangan', editor.getContent())
                    Livewire.emit('changeKeterangan', editor.getContent())
                })
            }
        });

        window.addEventListener('contentChange', function() {
            $('select[name="id_barang"]').select2()
            $('select[name="id_barang"]').on('change', function() {
                Livewire.emit('changeBarang', $(this).val())
            })
        })

        Livewire.on('onClickEditBarang', (item) => {
            tinymce.activeEditor.setContent(item.keterangan ? item.keterangan : '')
            Livewire.emit('setBarang', item.id)
        })

        Livewire.on('finishSimpanData', (status, message) => {
            alertMessage(status, message);
        })

        Livewire.on('finishRefreshData', (status, message) => {
            alertMessage(status, message);
        })

        Livewire.on('onClickHapusBarang', async (id) => {
            const response = await alertConfirm("Peringatan ?",
                "Apakah kamu yakin ingin menghapus barang dari orderan ?")
            if (response.isConfirmed == true) {
                Livewire.emit('hapusBarang', id)
            }
        })
    </script>
@endpush
