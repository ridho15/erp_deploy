<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">
            <a href="{{ route('pre-order') }}" class="btn btn-sm btn-icon btn-light me-5" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Kembali">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            @if (
                $preOrder &&
                    $preOrder->quotation &&
                    $preOrder->quotation->laporanPekerjaan &&
                    $preOrder->quotation->laporanPekerjaan->signature != null &&
                    $preOrder->quotation->laporanPekerjaan->jam_selesai != null &&
                    $preOrder->status == 3)
                PO Done
            @elseif(
                $preOrder &&
                    $preOrder->quotation &&
                    $preOrder->quotation->laporanPekerjaan &&
                    $preOrder->quotation->laporanPekerjaan->signature != null &&
                    $preOrder->quotation->laporanPekerjaan->jam_selesai != null)
                Account Receivable
            @else
                Detail PO ({{ $preOrder->no_ref }})
            @endif
        </h3>
        <div class="card-toolbar">
            @if ($isControl == true && $preOrder->status != 3)
                <button class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Bayar Pre Order" wire:click="$emit('onClickBayar')">
                    <i class="fa-solid fa-cash-register"></i> Bayar
                </button>
                <button class="btn btn-sm btn-outline btn-outline-success btn-edit mx-2" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Edit Pre Order"
                    wire:click="$emit('onClickEditPreOrder', {{ $preOrder }})">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
                @if ($total_bayar > 0 && $preOrder->status != 3)
                    <button class="btn btn-sm btn-danger mx-2" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Batalkan Pre Order" wire:click="$emit('onClickBatalPreOrder', {{ $preOrder->id }})">
                        <i class="fa-solid fa-ban"></i> Batalkan
                    </button>
                    @if ($preOrder->status == 1)
                        <button class="btn btn-sm btn-warning btn-proses mx-2" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Ganti Status PO"
                            wire:click="$emit('onClickChangeStatus', {{ $id_pre_order }}, 2)">
                            <i class="fa-solid fa-rotate"></i> Proses
                        </button>
                    @elseif($preOrder->status == 2)
                        <button class="btn btn-sm btn-success btn-success mx-2" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="PO Selesai"
                            wire:click="$emit('onClickSelesai', {{ $id_pre_order }}, 3)">
                            <i class="fa-solid fa-circle-check"></i> Selesai
                        </button>
                    @elseif($preOrder->status == 3)
                        <a href="{{ route('pre-order.invoice', ['id' => $preOrder->id]) }}" target="_blank"
                            class="btn btn-sm btn-info btn-proses mx-2"><i class="fa-solid fa-print"></i>Cetak
                            Invoice</a>
                    @endif
                @endif
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-5">
            <div class="col-md-4 mb-5">
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <h4 class="fw-bold mb-5">Customer</h4>
                    <button class="btn btn-sm btn-icon btn-light-success" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Edit" wire:click="changeShowFormCustomer">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
                @if ($showFormCustomer == true)
                    <div class="border rounded p-5 mb-5">
                        <form action="#" wire:submit.prevent="simpanUpdateCustomer" method="POST">
                            @include('helper.alert-message')
                            <div class="text-center">
                                @include('helper.simple-loading', [
                                    'target' => 'simpanUpdateCustomer',
                                    'message' => 'Simpan',
                                ])
                            </div>
                            <div class="mb-5">
                                <label for="" class="form-label">Customer</label>
                                <select name="id_customer" class="form-select form-select-solid" data-control="select2"
                                    wire:model="id_customer" required>
                                    <option value="">Pilih</option>
                                    @foreach ($listCustomer as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_customer')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="" class="form-label">Project</label>
                                <input type="text" class="form-control form-control-solid"
                                    value="{{ $namaProject }}" disabled>
                                @error('id_project')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="" class="form-label">Nomor Lift</label>
                                <input type="text" class="form-control form-control-solid" name="nomor_lift"
                                    wire:model="nomor_lift">
                            </div>
                            <div class="mb-5">
                                <label for="" class="form-label">Merk</label>
                                <select name="id_merk" class="form-select form-select-solid" data-control="select2"
                                    wire:model="id_merk">
                                    <option value="">Pilih</option>
                                    @foreach ($listMerk as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_merk }}</option>
                                    @endforeach
                                </select>
                                @error('id_merk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Simpan">
                                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Nama
                    </div>
                    <div class="col-md-8 col-8">
                        : {{ $preOrder->customer->nama }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Nama Project
                    </div>
                    <div class="col-md-8 col-8">
                        : @isset($preOrder->customer->project)
                            {{ $preOrder->customer->project->nama }}
                        @endisset
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Nomor Lift
                    </div>
                    <div class="col-md-8 col-8">
                        : @isset($preOrder->quotation->laporanPekerjaan)
                            {{ $preOrder->quotation->laporanPekerjaan }}
                        @endisset
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        BA
                    </div>
                    <div class="col-md-8 col-8">
                        : @isset($preOrder->quotation->laporanPekerjaan->merk)
                            {{ $preOrder->quoation->laporanPekerjaan->merk->nama_merk }}
                        @endisset
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Barang Customer
                    </div>
                    <div class="col-md-8 col-8">
                        : {{ $preOrder->customer->barang_customer }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        PPN (%)
                    </div>
                    <div class="col-md-8 col-8">
                        : {{ $preOrder->customer->ppn }}%
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-8">
                <div class="text-center">
                    @include('helper.simple-loading', ['target' => 'changeStatusPreOrder', 'message' => 'Sedang memuat data ...'])
                </div>
                @include('helper.alert-message')
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        No Ref
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $preOrder->no_ref }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Customer
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $preOrder->customer->nama }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Kode Customer
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $preOrder->customer->kode }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Quotation
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $preOrder->quotation ? $preOrder->quotation->no_ref : '-' }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Tipe Pembayaran
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $preOrder->tipePembayaran->nama_tipe }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Metode Pembayaran
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $preOrder->metodePembayaran ? $preOrder->metodePembayaran->nama_metode : '-' }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Pembuat
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">
                            @if ($preOrder->user)
                                {{ $preOrder->user->name }} ({{ $preOrder->user->jabatan }})
                            @else
                                Dikonfirmasi Pelanggan
                            @endif
                        </span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Status Pekerjaan
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">
                            @if ($preOrder->quotation && $preOrder->quotation->laporanPekerjaan)
                                @if ($preOrder->quotation->laporanPekerjaan->signature != null && $preOrder->quotation->laporanPekerjaan->jam_selesai != null)
                                    <span class="badge badge-success">Selesai</span>
                                @elseif($preOrder->quotation->laporanPekerjaan->jam_mulai != null)
                                    <span class="badge badge-warning">Sedang Dikerjakan</span>
                                @else
                                    <span class="badge badge-secondary">Belum Dikerjakan</span>
                                @endif
                            @else
                                Tidak ada pekerjaan
                            @endif
                        </span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Total
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">Rp.{{ number_format($preOrder->total,0,',','.') }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        PPN {{ $preOrder->quotation ? $preOrder->quotation->ppn : 11 }}%
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">Rp.{{ number_format($preOrder->ppn,0,',','.') }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Total Bayar
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold"><?= $preOrder->total_bayar_formatted ?></span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Status Bayar
                    </div>
                    <div class="col-md-8 col-8">
                        : <?= $preOrder->status_pembayaran ?>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Keterangan
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold"><?= $preOrder->keterangan ?? '-' ?></span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        File
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">
                            @if ($preOrder->file)
                                <a href="{{ asset('storage' . $preOrder->file) }}" class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Download File">
                                    <i class="fa-solid fa-file"></i>
                                </a>
                            @else
                                File tidak ada
                            @endif
                        </span>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-8 mb-5">
                @livewire('pre-order.detail-barang', ['id_pre_order' => $preOrder->id])
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="fw-bold mb-5">Pembayaran Area</h4>
                    <button class="btn btn-sm btn-icon btn-light-success" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Edit" wire:click="changeShowFormPembayaran">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
                @if ($showFormPembayaran == true)
                <div class="border rounded p-5">
                    <form action="#" wire:submit.prevent="simpanUpdatePembayaran" method="POST">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanUpdatePembayaran', 'message' => 'Loading ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Metode Pembayaran</label>
                            <select name="id_metode_pembayaran" class="form-select form-select-solid"
                                wire:model="id_metode_pembayaran" data-control="select2" required>
                                <option value="">Pilih</option>
                                @foreach ($listMetodePembayaran as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_metode }}</option>
                                @endforeach
                            </select>
                            @error('id_metode_pembayaran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Tipe Pembayaran</label>
                            <select name="id_tipe_pembayaran" class="form-select form-select-solid"
                                wire:model="id_tipe_pembayaran" data-control="select2" required>
                                <option value="">Pilih</option>
                                @foreach ($listTipePembayaran as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_tipe }}</option>
                                @endforeach
                            </select>
                            @error('id_tipe_pembayaran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control form-control-solid" wire:model="keterangan"></textarea>
                            @error('keterangan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false, progress = 0"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress" wire:ignore>
                            <label for="" class="form-label">File</label>
                            <input type="file" id="file" name="file" wire:model="file"
                                class="form-control form-control-solid" hidden accept=".jpg,.png,.jpeg,.docx,.pdf,.xlsx">
                            <div class="text-center">
                                <label for="file"
                                    class="btn btn-sm btn-outline btn-outline-primary btn-outline-dashed btn-active-light-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Pilih File">
                                    <i class="fa-solid fa-file"></i> Upload File
                                </label>
                            </div>
                            <div x-show="isUploading" class="progress mt-5">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                    role="progressbar" aria-label="Animated striped example" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                            </div>
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @if ($file)
                                <div class="d-flex align-items-center justify-content-center mt-5">
                                    <span class="me-5">{{ $file->getClientOriginalName() }}</span>
                                    <span class="" wire:click="hapusFile" style="cursor: pointer">
                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Simpan">
                                <i class="fa-solid fa-floppy-disk"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
                @endif
                <div class="row mb-5">
                    <div class="col-md-4">
                        Tipe Pembayaran
                    </div>
                    <div class="col-md-8">
                        : @isset($preOrder->tipePembayaran)
                            {{ $preOrder->tipePembayaran->nama_tipe }}
                        @endisset
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4">
                        Metode Pembayaran
                    </div>
                    <div class="col-md-8">
                        : @isset($preOrder->metodePembayaran)
                            {{ $preOrder->metodePembayaran->nama_metode }}
                        @endisset
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4">
                        Keterangan
                    </div>
                    <div class="col-md-8">
                        : <?= $preOrder->keterangan ?>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        File
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">
                            @if ($preOrder->file)
                                <a href="{{ asset('storage' . $preOrder->file) }}"
                                    class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Download File">
                                    <i class="fa-solid fa-file"></i>
                                </a>
                            @else
                                File tidak ada
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                @livewire('pre-order.log', ['id_pre_order' => $preOrder->id])
            </div>
            <div class="col-md-6">
                @livewire('pre-order.pembayaran', ['id_pre_order' => $preOrder->id])
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            select2()
        });

        window.addEventListener('contentChange', function() {
            select2()
        })

        function select2() {
            $('select[name="id_customer"]').select2();
            $('select[name="id_merk"]').select2();
            $('select[name="id_customer"]').on('change', function() {
                Livewire.emit('changeCustomer', $(this).val())
            })

            $('select[name="id_merk"]').on('change', function() {
                Livewire.emit('changeMerk', $(this).val())
            })
        }

        Livewire.on('onClickEditPreOrder', (item) => {
            tinymce.activeEditor.setContent(item.keterangan ? item.keterangan : '');
            Livewire.emit('setDataPreOrder', item.id)
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickChangeStatus', async (id, status) => {
            const response = await alertConfirmCustom("Pemberitahuan",
                'Apakah kamu yakin ingin merubah status Pre Order ?', "Ya, Proses")
            if (response.isConfirmed == true) {
                Livewire.emit('changeStatusPreOrder', id, status)
            }
        })

        Livewire.on('onClickBatalPreOrder', async (id) => {
            const response = await alertConfirmCustom('Peringatan !',
                "Apakah kamu yakin ingin membatalkan Pre Order ? ", "Ya, Batalkan");
            if (response.isConfirmed == true) {
                Livewire.emit('changeStatusPreOrder', id, 0)
            }
        })

        Livewire.on('onClickSelesai', async (id, status) => {
            const response = await alertConfirmCustom('Peringatan !',
                'Apakah kamu yakin ingin menyudahi proses Pre Order ?', 'Ya, Selesai');
            if (response.isConfirmed == true) {
                Livewire.emit('preOrderSelesai', id, status)
            }
        })

        Livewire.on('onClickBayar', () => {
            $('#modal_form_bayar').modal('show')
        })

        Livewire.on('finishSimpanData', (status, message) => {
            alertMessage(status, message)
        })
    </script>
@endpush
