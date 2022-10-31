<div>
    @include('helper.alert-message')
    <div class="row mb-7">
        <div class="col-md-4">
            Kode Form
        </div>
        <div class="col-md-8">
            : <span class="fw-bold">{{ $formMaster->kode }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Nama Form
        </div>
        <div class="col-md-8">
            : <span class="fw-bold">{{ $formMaster->nama }}</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Periode
        </div>
        <div class="col-md-8">
            : <span class="fw-bold">{{ $formMaster->periode }} Bulan</span>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4">
            Keterangan
        </div>
        <div class="col-md-8">
            : <span class="fw-bold">{{ $formMaster->keterangan }}</span>
        </div>
    </div>
</div>
