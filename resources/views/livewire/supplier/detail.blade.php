<div>
    @include('helper.alert-message')
    <div class="row mb-5">
        <div class="col-md-5">
            Nama Supplier
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplier->name }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-5">
            No HP
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplier->no_hp }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-5">
            Email
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplier->email }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-5">
            Alamat
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplier->alamat }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-5">
            Status
        </div>
        <div class="col-md">
            : <span class="fw-bold"><?= $supplier->status_formatted ?></span>
        </div>
    </div>
</div>
