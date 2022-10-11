
<div>
    @include('helper.alert-message')
    <div class="row mb-7">
        <div class="col-md-4 fw-bold">
            Nama Pekerjaan
        </div>
        <div class="col-md">
            : {{ $projectDetail->nama_pekerjaan }}
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4 fw-bold">
            Status
        </div>
        <div class="col-md">
            : <?= $projectDetail->status_formatted ?>
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4 fw-bold">
            Jam Mulai
        </div>
        <div class="col-md">
            : {{ $projectDetail->jam_mulai_formatted }}
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4 fw-bold">
            Jam Selesai
        </div>
        <div class="col-md">
            : {{ $projectDetail->jam_selesai_formatted }}
        </div>
    </div>
    <div class="row mb-7">
        <div class="col-md-4 fw-bold">
            Keterangan
        </div>
        <div class="col-md">
            : {{ $projectDetail->keterangan }}
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
