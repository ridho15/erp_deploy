<div>
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
            Pembuat
        </div>
        <div class="col-md-8 col-8">
            : <span class="fw-bold">{{ $preOrder->user->name }} ({{ $preOrder->user->jabatan }})</span>
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
            Keterangan
        </div>
        <div class="col-md-8 col-8">
            : <span class="fw-bold"><?= $preOrder->keterangan ?></span>
        </div>
    </div>
</div>
