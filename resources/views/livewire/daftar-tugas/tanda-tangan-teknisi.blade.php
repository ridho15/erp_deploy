<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Tanda Tangan Teknisi
            </h3>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'simpanTandaTangan', 'message' => 'Menyimpan data ...'])
            </div>
            <form action="#" wire:submit.prevent="simpanTandaTangan">
                <div class="row">
                    @foreach ($listLaporanPekerjaanUser as $index => $item)
                    <div class="col-md-4 text-center mb-5">
                        <label for="" class="form-label">Tanda Tangan {{ $item->user ? $item->user->name : '-' }}</label>
                        <div class="position-relative">
                            <canvas id="signature-pad-{{ $index }}" class="signature-pad border rounded w-100 tanda-tangan" style="height: 200px;"></canvas>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-5">
                            <button type="button" class="btn btn-sm btn-icon btn-outline btn-outline-danger mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Clear" wire:click="$emit('onClickClear', {{ $item->id }}, {{ $index }})">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-icon btn-outline btn-outline-primary mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Selesai" wire:click="$emit('onClickFiks', {{ $item->id }}, {{ $index }})">
                                <i class="fa-solid fa-circle-check"></i>
                            </button>
                        </div>
                        <div class="border rounded p-5 text-center text-gray-500">
                            @if ($item->signature != null)
                                <img src="{{ asset('storage/' . $item->signature) }}" class="img-fluid" alt="">
                            @else
                                Belum di tanda tangan
                            @endif
                        </div>
                    </div>
                @endforeach
                </div>
                {{-- <div class="text-end">
                    <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Simpan Tanda Tangan">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                </div> --}}
            </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        var signaturePad = null;
        $(document).ready(function () {
            $('.tanda-tangan').each(function(index){
                signaturePad[index] = new SignaturePad(document.getElementById('signature-pad-' + index), {
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    penColor: 'rgb(0, 0, 0)'
                });
            })
        });

        Livewire.on('onClickClear', (id, index) => {
            signaturePad.splice(index, 1)
            Livewire.emit('clearTandaTangan', id)
        })

        Livewire.on('onClickFiks', (id, index) => {
            if(signaturePad[index] != null){
                var data = signaturePad[index].toDataURL('image/png');
                Livewire.emit('simpanTandaTangan', id, data)
            }
        })
    </script>
@endpush
