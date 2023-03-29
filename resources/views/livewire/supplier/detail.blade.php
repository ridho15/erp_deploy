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
            Hp #1
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplier->no_hp_1 }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-5">
            Hp #2
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplier->no_hp_2 }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-5">
            Telp #1
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplier->telp_1 }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-5">
            Telp #2
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $supplier->telp_2 }}</span>
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
            PIC
        </div>
        <div class="col-md">
            : <span class="fw-bold">
                @foreach ($supplier->supplierSales as $item)
                    {{ $item->sales->nama }} ({{ $item->sales->no_hp }}),
                @endforeach
            </span>
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
