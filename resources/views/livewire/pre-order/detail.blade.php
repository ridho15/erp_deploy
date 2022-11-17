<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">
            <a href="{{ route('pre-order') }}" class="btn btn-sm btn-icon btn-light me-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            Detail PO
        </h3>
        <div class="card-toolbar">
            <button class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Bayar Pre Order" wire:click="$emit('onClickBayar')">
                <i class="fa-solid fa-cash-register"></i> Bayar
            </button>
            <button class="btn btn-sm btn-outline btn-outline-success btn-edit mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Pre Order" wire:click="$emit('onClickEditPreOrder', {{ $preOrder }})">
                <i class="bi bi-pencil-square"></i> Edit
            </button>
            <button class="btn btn-sm btn-danger mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Batalkan Pre Order" wire:click="$emit('onClickBatalPreOrder', {{ $preOrder->id }})">
                <i class="fa-solid fa-ban"></i> Batalkan
            </button>
            @if ($preOrder->status == 1)
                <button class="btn btn-sm btn-warning btn-proses mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Ganti Status PO" wire:click="$emit('onClickChangeStatus', {{ $id_pre_order }}, 2)">
                    <i class="fa-solid fa-rotate"></i> Proses
                </button>
            @elseif($preOrder->status == 2)
                <button class="btn btn-sm btn-success btn-success mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="PO Selesai" wire:click="$emit('onClickSelesai', {{ $id_pre_order }}, 3)">
                    <i class="fa-solid fa-circle-check"></i> Selesai
                </button>
            @elseif($preOrder->status == 3)
                <a href="{{ route('pre-order.invoice', ['id' => $preOrder->id]) }}" target="_blank" class="btn btn-sm btn-info btn-proses mx-2"><i class="fa-solid fa-print"></i>Cetak Invoice</a>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="text-center">
                    @include('helper.simple-loading', ['target' => 'changeStatusPreOrder', 'message' => 'Sedang memuat data ...'])
                </div>
                @include('helper.alert-message')
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
                        Status
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold"><?= $preOrder->status_formatted ?></span>
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
                        PPN 11%
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
            </div>
            <div class="col-md-8">
                @livewire('pre-order.detail-barang', ['id_pre_order' => $preOrder->id])
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
        $(document).ready(function () {

        });

        Livewire.on('onClickEditPreOrder', (item) => {
            tinymce.activeEditor.setContent(item.keterangan ? item.keterangan : '');
            Livewire.emit('setDataPreOrder', item.id)
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickChangeStatus', async (id, status) => {
            const response = await alertConfirmCustom("Pemberitahuan", 'Apakah kamu yakin ingin merubah status Pre Order ?', "Ya, Proses")
            if(response.isConfirmed == true){
                Livewire.emit('changeStatusPreOrder', id, status)
            }
        })

        Livewire.on('onClickBatalPreOrder', async(id) => {
            const response = await alertConfirmCustom('Peringatan !', "Apakah kamu yakin ingin membatalkan Pre Order ? ", "Ya, Batalkan");
            if(response.isConfirmed == true){
                Livewire.emit('changeStatusPreOrder', id, 0)
            }
        })

        Livewire.on('onClickSelesai', async (id, status) => {
            const response = await alertConfirmCustom('Peringatan !', 'Apakah kamu yakin ingin menyudahi proses Pre Order ?', 'Ya, Selesai');
            if(response.isConfirmed == true){
                Livewire.emit('preOrderSelesai', id, status)
            }
        })

        Livewire.on('onClickBayar', () => {
            $('#modal_form_bayar').modal('show')
        })
    </script>
@endpush
