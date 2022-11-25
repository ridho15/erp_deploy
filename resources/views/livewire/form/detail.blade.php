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
            : <span class="fw-bold">
                @if ($formMaster->periode && is_array(json_decode($formMaster->periode)))
                    @foreach (json_decode($formMaster->periode) as $item)
                        {{ $item }},
                    @endforeach
                    Bulan
                @else
                    Tidak ada periode
                @endif
            </span>
        </div>
    </div>
</div>
