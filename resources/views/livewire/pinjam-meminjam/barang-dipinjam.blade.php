<div>
    @include('helper.alert-message')
    <div class="text-center">
        @include('helper.simple-loading', ['target' => 'cari,simpanCheck', 'message' => 'Memuat data...'])
    </div>
    <div class="row mb-5">
        <div class="col-md-3">
            @include('helper.form-pencarian', ['model' => 'cari'])
        </div>
        <div class="col-md text-end">
            <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Peminjaman Barang" wire:click="$emit('onClickTambahPeminjamanBarang')">
                <i class="bi bi-plus-circle"></i> Tambah
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
            <thead>
            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                <th>No</th>
                <th>Nama Proyek</th>
                <th>SKU</th>
                <th>Barang</th>
                <th>Satuan</th>
                <th>Estimasi Kembali</th>
                <th>Jumlah / Qty</th>
                <th>Label</th>
                <th>Nomor ITT/ITS</th>
                <th>Tipe Barang</th>
                <th>Catatan Teknisi</th>
                <th>Status</th>
                <th>Yang Meminjamkan</th>
                <th>Peminjam</th>
                <th>Tanggal Peminjaman</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @if (count($listBarangDipinjam) > 0)
                @foreach ($listBarangDipinjam as $index => $item)
                    <tr>
                        <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                        <td>{{ isset($item->laporanPekerjaan->projectUnit->project) ? $item->laporanPekerjaan->projectUnit->project->nama : null }}</td>
                        <td>
                            <a href="{{ route('barang.detail', ['id' => $item->id_barang]) }}" class="text-dark">
                                {{ $item->barang->sku }}
                            </a>
                        </td>
                        <td>{{ $item->barang ? $item->barang->nama : '-' }}</td>
                        <td>{{ $item->barang? $item->barang->satuan->nama_satuan : '-' }}</td>
                        <td>
                            @if ($item->estimasi)
                                {{ date('d-m-Y H:i', strtotime($item->estimasi)) }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->versionBelong->version }} V</td>
                        <td>{{ isset($item->nomorItt) ? $item->nomorItt->nomor_itt : '-' }}</td>
                        <td>{{ $item->tipeBarang ? $item->tipeBarang->tipe_barang : '-' }}</td>
                        <td>{{ $item->catatan_teknisi }}</td>
                        <td><?= $item->status_formatted ?></td>
                        <td>{{ $item->userMeminjamkan ? $item->userMeminjamkan->name : '-' }}</td>
                        <td>{{ $item->userPeminjam ? $item->userPeminjam->name : '-' }}</td>
                        <td>
                            @php
                                $laporanPekerjaanBarangLog = \App\Models\LaporanPekerjaanBarangLog::where('id_laporan_pekerjaan_barang', $item->id)
                                ->where('status', 2)
                                ->orderBy('updated_at', 'ASC')
                                ->first();

                                if($laporanPekerjaanBarangLog){
                                    echo date('d-m-Y H:i', strtotime($laporanPekerjaanBarangLog->updated_at));
                                }
                            @endphp
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Kembalikan Barang Kegudang" wire:click="$emit('onClickKembalikan', {{ $item->id }})">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="16" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="text-center">{{ $listBarangDipinjam->links() }}</div>

    <div wire:ignore.self class="modal fade kostumer" tabindex="-1" id="modal_tambah_peminjaman_barang">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Peminjaman Barang</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="#" wire:submit.prevent="simpanDataPeminjamanBarang" id="form_peminjaman_barang">

                    <div class="modal-body">
                        <div class="row mb-5">
                            @if ($laporanPekerjaan)
                                <div class="col-md-6">
                                    <div class="row mb-5">
                                        <div class="col-md-4 col-4">
                                            Kode Pekerjaan
                                        </div>
                                        <div class="col-md-8 col-8">
                                            : <span class="fw-bold">{{ $laporanPekerjaan->kode_pekerjaan }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4 col-4">
                                            Project
                                        </div>
                                        <div class="col-md-8 col-8">
                                            : <span class="fw-bold">
                                                @if ($laporanPekerjaan->project)
                                                    ({{ $laporanPekerjaan->project->kode }}) {{ $laporanPekerjaan->project->nama }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4 col-4">
                                            Merk
                                        </div>
                                        <div class="col-md-8 col-8">
                                            : <span class="fw-bold">({{ $laporanPekerjaan->merk->nama_merk }})</span>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4 col-4">
                                            Nomor Lift
                                        </div>
                                        <div class="col-md-8 col-8">
                                            : <span class="fw-bold">({{ $laporanPekerjaan->nomor_lift }})</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($barang)
                            <div class="col-md-6">
                                <div class="row mb-5">
                                    <div class="col-md-4 col-4">
                                        SKU
                                    </div>
                                    <div class="col-md-8 col-8">
                                        : <span class="fw-bold">{{ $laporanPekerjaan ? $laporanPekerjaan->kode_pekerjaan : '-'}}</span>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-4 col-4">
                                        Barang
                                    </div>
                                    <div class="col-md-8 col-8">
                                        : <span class="fw-bold">{{ $barang->nama }}</span>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-4 col-4">
                                        Satuan
                                    </div>
                                    <div class="col-md-8 col-8">
                                        : <span class="fw-bold">{{ $barang->satuan->nama_satuan }}</span>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-4 col-4">
                                        Tipe Barang
                                    </div>
                                    <div class="col-md-8 col-8">
                                        : <span class="fw-bold">{{ $barang->tipeBarang->tipe_barang }}</span>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-4 col-4">
                                        Stock
                                    </div>
                                    <div class="col-md-8 col-8">
                                        : <span class="fw-bold">{{ $barang->stock }}</span>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-4 col-4">
                                        Deskripsi
                                    </div>
                                    <div class="col-md-8 col-8">
                                        : <?= $barang->deskripsi ?>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-4 col-4">
                                        Sub Total
                                    </div>
                                    <div class="col-md-8 col-8">
                                        : <span class="fw-bold">Rp. {{ number_format($subTotal,0,',','.') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataPeminjamanBarang', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="row mb-5">
                            <div class="mb-5 col-md-4">
                                <label for="" class="form-label required">Pekerjaan</label>
                                <select name="id_laporan_pekerjaan" wire:model="id_laporan_pekerjaan" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_tambah_peminjaman_barang" data-placeholder="Pilih" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listLaporanPekerjaan as $item)
                                        <option value="{{ $item->id }}">{{ $item->kode_pekerjaan }} {{ $item->project ? $item->project->nama : '-' }}</option>
                                    @endforeach
                                </select>
                                @error('id_laporan_pekerjaan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-4">
                                <label for="" class="form-label required">Barang</label>
                                <select name="id_barang" wire:model="id_barang" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_tambah_peminjaman_barang" data-placeholder="Pilih" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listBarang as $item)
                                        <option value="{{ $item->id }}">{{ $item->sku }} {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5 col-md-4">
                                <label for="" class="form-label required">Jumlah</label>
                                <input type="number" name="qty" wire:model="qty" class="form-control form-control-solid" placeholder="Masukan jumlah barang" required>
                                @error('qty')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-5">
                                <label for="" class="form-label required">Label</label>
                                <select name="version" wire:model="version" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_tambah_peminjaman_barang" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listVersion as $item)
                                        <option value="{{ $item }}">{{ $item }} V</option>
                                    @endforeach
                                </select>
                                @error('version')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-5">
                                <label for="" class="form-label required">Tipe</label>
                                <select name="id_tipe_barang" wire:model="id_tipe_barang" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_tambah_peminjaman_barang" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listTipeBarang as $item)
                                        <option value="{{ $item->id }}">{{ $item->tipe_barang }}</option>
                                    @endforeach
                                </select>
                                @error('id_tipe_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-down"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_kembalikan_barang">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Konfirmasi Jumlah Barang</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="balikanBarangPinjaman" id="form_peminjaman_barang">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'balikanBarangPinjaman', 'message' => 'Menyimpan data ...'])
                        </div>
                        @error('id_laporan_pekerjaan_barang')
                            <div class="text-center">
                                <small class="text-center text-danger">{{ $message }}</small>
                            </div>
                        @enderror
                        @if ($barang)
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    SKU
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->sku }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Nama
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->nama }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Satuan
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->satuan->nama_satuan }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Stock
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->stock }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Tipe Barang
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->tipeBarang->tipe_barang }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Deskripsi
                                </div>
                                <div class="col-md-8 col-8">
                                    : <span class="fw-bold">{{ $barang->deskripsi }}</span>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <div class="mb-5">
                            <label for="" class="form-label required">Jumlah Dikembalikan</label>
                            <input type="number" class="form-control form-control-solid" name="qty" wire:model="qty" placeholder="Jumlah barang" required>
                            @error('qty')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-down"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        window.addEventListener('contentChange', function(){
            $('select[name="id_laporan_pekerjaan"]').select2();
            $('select[name="id_tipe_barang"]').select2();
            $('select[name="version"]').select2();
            $('select[name="id_barang"]').select2();
        })

        $('select[name="id_laporan_pekerjaan"]').on('change', function(){
            @this.set('id_laporan_pekerjaan', $(this).val())
        });

        $('#form_peminjaman_barang select[name="id_barang"]').on('change', function(){
            @this.set('id_barang', $(this).val())
        });

        $('select[name="id_tipe_barang"]').on('change', function(){
            @this.set('id_tipe_barang', $(this).val())
        });

        $('select[name="version"]').on('change', function(){
            @this.set('version', $(this).val())
        });

        Livewire.on('onClickBatalkan', async (id) => {
            const response = await alertConfirmCustom("Peringatan !", "Apakah kamu yakin ingin mengembalikan barang ke gudang?", 'Ya, Kembalikan')
            if(response.isConfirmed == true){
                Livewire.emit('balikanBarangPinjaman', id)
            }
        })

        Livewire.on('onClickKembalikan', (id) => {
            Livewire.emit('setBarangPinjaman', id)
            $('#modal_kembalikan_barang').modal('show')
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message);
        })

        Livewire.on('onClickTambahPeminjamanBarang', () => {
            $('#modal_tambah_peminjaman_barang').modal('show');
        })
    </script>
@endpush
