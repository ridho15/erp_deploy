<div>
    @include('helper.alert-message')
    <div class="row mb-7">
        <div class="col-md-4">
            <div class="mb-5 fw-bold">
                Customer
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Nama
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->customer->nama }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    No HP
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->customer->no_hp }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Email
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->customer->no_hp }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Alamat
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->customer->alamat }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    List Perlengkapan
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->customer->barang_customer }}
                    @if ($laporanPekerjaan->confirmasi_customer_barang == null || $laporanPekerjaan->confirmasi_customer_barang == 0)
                        <button class="btn btn-sm btn-icon btn-outline btn-outline-success btn-confirmasi-barang ms-3" data-bs-placement="top" data-bs-toggle="tooltip" title="Konfirmasi Barang Customer" wire:click="$emit('onClickConfirmasiCustomerBarang')">
                            <i class="fa-regular fa-circle-check"></i>
                        </button>
                    @else
                        <i class="fa-solid fa-circle-check text-success fs-5 mx-1"></i>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-5 fw-bold">
                Project
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Nama
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->project ? $laporanPekerjaan->project->nama : '-' }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Kode
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->project ? $laporanPekerjaan->project->kode : '-' }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    No Unit
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->project ? $laporanPekerjaan->project->no_unit : '-' }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    No MFG
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->project ? $laporanPekerjaan->project->no_mfg : '-' }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Alamat
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->project ? $laporanPekerjaan->project->alamat : '-' }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Periode
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : @if ($laporanPekerjaan->is_emergency_call == 1)
                        <span class="badge badge-warning">Emergency Call</span>
                    @else
                        {{ $laporanPekerjaan->periode }} Bulan
                    @endif
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Sales
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : @foreach ($laporanPekerjaan->project->salesProject as $item)
                        {{ $item->sales->nama }},
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-5 fw-bold">
                Data Tambahan
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Merk
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->merk->nama_merk }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Nama Form
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->formMaster->nama }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Kode Form
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->formMaster->kode }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Nomor Lift
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->nomor_lift }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Teknisi
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : @foreach ($laporanPekerjaan->teknisi as $item)
                        {{ $item->user->name }},
                    @endforeach
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Tanggal Estimasi
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : @if ($laporanPekerjaan->tanggal_estimasi)
                        {{ date('d-m-Y H:i', strtotime($laporanPekerjaan->tanggal_estimasi)) }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        Livewire.on('onClickConfirmasiCustomerBarang', async () => {
            const response = await alertConfirmCustom("Pemberitahuan", "Apakah kamu yakin sudah melakukan check barang customer ?", "Ya, Sudah")
            if(response.isConfirmed == true){
                Livewire.emit('confirmasiBarang')
            }
        })
    </script>
@endpush
