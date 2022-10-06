<div>
    <div class="row mb-5">
        <div class="col-md-4">
            Nama Project
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $project->nama_project }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-4">
            Customer
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $project->customer ? $project->customer->nama : '-' }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-4">
            Alamat Project
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $project->alamat_project ?? '-' }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-4">
            Keterangan Project
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $project->keterangan_project ?? '-' }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-4">
            Total Barang
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $project->total_barang }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-4">
            Total Harga
        </div>
        <div class="col-md">
            : <span class="fw-bold">{{ $project->total_harga_formatted }}</span>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-4">
            Total Harga
        </div>
        <div class="col-md">
            : <?= $project->status_formatted ?>
        </div>
    </div>
</div>
