<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Laporan Pinjam
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Tambah Spareparts" wire:click="changeTambahBarang">
                    <i class="bi bi-plus-circle"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            @if ($tambahBarang)
                <form action="#" method="POST" wire:submit.prevent="simpanLaporanPinjam" id="form_laporan_pinjam">
                    <div class="text-center">
                        @include('helper.simple-loading', [
                            'target' => 'simpanLaporanPinjam',
                            'message' => 'Sedang menyimpan data ...',
                        ])
                    </div>
                    <div class="row">
                        <div class="col-md-6">
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
                            <div class="flex flex-wrap">
                                @if ($barang)
                                    @foreach ($barang->barangGambar as $item)
                                        <div class="symbol symbol-100px">
                                            <img src="{{ asset('storage' . $item->file) }}" alt=""
                                                style="object-fit: cover" />
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-5">
                                <div class="mb-5">
                                    <label for="" class="form-label required">Tools</label>
                                    <select name="id_barang" wire:model="id_barang"
                                        class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Pilih Barang" required>
                                        <option value="">Pilih</option>
                                        @foreach ($listBarang as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_barang')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <label for="" class="form-label required">Version</label>
                                    <select name="version" wire:model="version" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="Pilih" required>
                                        <option value="">Pilih</option>
                                        @foreach ($listVersion as $item)
                                            <option value="{{ $item }}">V{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('version')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <label for="" class="form-label required">Jumlah / Qty</label>
                                    <input type="number" class="form-control form-control-solid" name="qty"
                                        wire:model="qty" placeholder="Masukkan jumlah" required>
                                    @error('qty')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <label for="" class="form-label">Catatan Teknisi</label>
                                    <textarea name="catatan_teknisi" wire:model="catatan_teknisi" class="form-control form-control-solid"
                                        placeholder="Masukkan catatan"></textarea>
                                    @error('catatan_teknisi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <label for="" class="form-label required">Estimasi Kembali</label>
                                    <input type="datetime-local" name="estimasi" wire:model="estimasi"
                                        class="form-control form-control-solid" required>
                                    @error('estimasi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end mb-5">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Simpan Barang Ke Laporan">
                                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', [
                    'target' => 'cari,hapusBarang',
                    'message' => 'Memuat data...',
                ])
            </div>
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                            <th>No</th>
                            <th>SKU</th>
                            <th>Nama Barang</th>
                            <th>Tipe Barang</th>
                            <th>Version</th>
                            <th>Satuan</th>
                            <th>Estimasi Kembali</th>
                            <th>Qty</th>
                            <th>Catatan Teknisi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($listLaporanPekerjaanBarang) > 0)
                            @foreach ($listLaporanPekerjaanBarang as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <a href="{{ route('barang.detail', ['id' => $item->id_barang]) }}"
                                            class="text-dark">
                                            {{ $item->barang->sku }}
                                        </a>
                                    </td>
                                    <td>{{ $item->barang->nama }}</td>
                                    <td>{{ $item->tipeBarang ? $item->tipeBarang->tipe_barang : null }}</td>
                                    <td>
                                        @if ($item->version)
                                            {{ $item->version }} V
                                        @endif
                                    </td>
                                    <td>{{ $item->barang->satuan->nama_satuan }}</td>
                                    <td>
                                        @if ($item->estimasi)
                                            {{ date('d-m-Y H:i', strtotime($item->estimasi)) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->catatan_teknisi }}</td>
                                    <td><?= $item->status_formatted ?></td>
                                    <td>
                                        <div class="text-center">
                                            @if ($item->tipeBarang && strtolower($item->tipeBarang->tipe_barang) == 'consumable')
                                                C
                                            @endif
                                        </div>
                                        <div class="btn-group">
                                            @if ($item->status == 0 || $item->status == 1)
                                                <button class="btn btn-sm btn-icon btn-success"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                                    wire:click="$emit('onClickEditBarangLaporanPinjam', {{ $item->id }})">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-icon btn-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                                    wire:click="$emit('onClickHapusBarangLaporanPinjam', {{ $item->id }})">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center text-gray-500">Tidak ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $listLaporanPekerjaanBarang->links() }}
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            select2()
        });

        window.addEventListener('contentChangeLaporanPinjam', function() {
            select2()
        })

        function select2() {
            $('#form_laporan_pinjam select[name="id_barang"]').select2();
            $('#form_laporan_pinjam select[name="id_barang"]').on('change', function() {
                Livewire.emit('changeBarang', $(this).val())
            })

            $('#form_laporan_pinjam select[name="version"]').select2();
            $('#form_laporan_pinjam select[name="version"]').on('change', function() {
                Livewire.emit('changeVersion', $(this).val())
            })

            $('#form_laporan_pinjam select[name="id_tipe_barang"]').select2();
            $('#form_laporan_pinjam select[name="id_tipe_barang"]').on('change', function() {
                Livewire.emit('changeTipeBarang', $(this).val())
            })
        }


        Livewire.on('onClickEditBarangLaporanPinjam', (id) => {
            Livewire.emit('setDataLaporanPekerjaanBarangLaporanPinjam', id)
        })

        Livewire.on('onClickHapusBarangLaporanPinjam', async (id) => {
            const response = await alertConfirm('Peringatan !', "Apakah kamu yakin ingin menghapus barang ?")
            if (response.isConfirmed == true) {
                Livewire.emit('hapusDataLaporanPekerjaanBarangLaporanPinjam', id)
            }
        })

        Livewire.on("finishSimpanData", (status, message) => {
            alertMessage(status, message);
        })
    </script>
@endpush
