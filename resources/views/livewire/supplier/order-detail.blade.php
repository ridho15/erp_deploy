<div>
    @include('helper.alert-message')
    <div class="row mb-7">
        <div class="col-md-4">
            Supplier
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplierOrder->supplier->name }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            User Order
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplierOrder->user->name }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Status Order
        </div>
        <div class="col-md">
            : <span class="fw-bold"><?= $supplierOrder->status_order_formatted['badge'] ?></span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Total Harga
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplierOrder->total_harga_formatted }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Tipe Pembayaran
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplierOrder->tipePembayaran->nama_tipe }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Tanggal Order
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplierOrder->tanggal_order_formatted }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Keterangan
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplierOrder->keterangan }}</span>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('statusOrderFinish', (status, message) => {
            alertMessage(status,message)
            location.reload()
        })
    </script>
@endpush
