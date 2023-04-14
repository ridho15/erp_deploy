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
                    : {{ $laporanPekerjaan->projectUnit->project->customer->nama }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    No HP
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : #1{{ $laporanPekerjaan->projectUnit->project->customer->no_hp_1 }},
                    #2{{ $laporanPekerjaan->projectUnit->project->customer->no_hp_2 }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Email
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->projectUnit->project->customer->email }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Alamat
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->projectUnit->project->customer->alamat }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Keterangan lainnya
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->projectUnit->project->customer->barang_customer }}
                    @if (
                        $laporanPekerjaan->projectUnit->project->confirmasi_customer_barang == null ||
                            $laporanPekerjaan->projectUnit->project->confirmasi_customer_barang == 0)
                        <button class="btn btn-sm btn-icon btn-outline btn-outline-success btn-confirmasi-barang ms-3"
                            data-bs-placement="top" data-bs-toggle="tooltip" title="Konfirmasi Barang Customer"
                            wire:click="$emit('onClickConfirmasiCustomerBarang')">
                            <i class="fa-regular fa-circle-check"></i>
                        </button>
                    @else
                        <i class="fa-solid fa-circle-check text-success fs-5 mx-1"></i>
                    @endif
                </div>
            </div>
        </div>
        @if ($laporanPekerjaan->projectUnit->project)
            <div class="col-md-4">
                <div class="mb-5 fw-bold">
                    Project
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Nama
                    </div>
                    <div class="col-md-8 col-8 fw-bold">
                        : {{ $laporanPekerjaan->projectUnit->project->nama }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Kode
                    </div>
                    <div class="col-md-8 col-8 fw-bold">
                        : {{ $laporanPekerjaan->projectUnit->project->kode }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Unit
                    </div>
                    <div class="col-md-8 col-8 fw-bold">
                        : {{ $laporanPekerjaan->projectUnit->no_unit }} {{ $laporanPekerjaan->projectUnit->nama_unit }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        No MFG
                    </div>
                    <div class="col-md-8 col-8 fw-bold">
                        : {{ $laporanPekerjaan->projectUnit->project->no_mfg }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Alamat
                    </div>
                    <div class="col-md-8 col-8 fw-bold">
                        : {{ $laporanPekerjaan->projectUnit->project->alamat }}
                    </div>
                </div>
                @if ($laporanPekerjaan->is_emergency_call == 1)
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Jenis
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : <span class="badge bg-warning">Laporan Pekerjaan</span>
                        </div>
                    </div>
                @else
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Periode
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : @if ($laporanPekerjaan->periode)
                                {{ $laporanPekerjaan->periode }} Bulan
                            @endif
                        </div>
                    </div>
                @endif
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Sales
                    </div>
                    <div class="col-md-8 col-8 fw-bold">
                        : @foreach ($laporanPekerjaan->projectUnit->project->salesProject as $item)
                            {{ $item->sales->nama }},
                        @endforeach
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Nomor PO
                    </div>
                    <div class="col-md-8 col-8 fw-bold">
                        : @if ($laporanPekerjaan->id_purchase_order != null)
                            {{ $laporanPekerjaan->purchaseOrder->no_ref }}
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-4">
            <div class="mb-5 fw-bold">
                Data Tambahan
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Nomor Pekerjaan
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->no_ref }}
                </div>
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
                        {{ $item->user ? $item->user->name : '-' }},
                    @endforeach
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Keterangan untuk teknisi
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->keterangan }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Nama Client
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : {{ $laporanPekerjaan->nama_client }}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-4">
                    Tanggal Estimasi
                </div>
                <div class="col-md-8 col-8 fw-bold">
                    : @if ($laporanPekerjaan->projectUnit->project->tanggal_estimasi)
                        {{ date('d-m-Y H:i', strtotime($laporanPekerjaan->projectUnit->project->tanggal_estimasi)) }}
                    @else
                        -
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        Livewire.on('onClickConfirmasiCustomerBarang', async () => {
            const response = await alertConfirmCustom("Pemberitahuan",
                "Apakah kamu yakin sudah melakukan check barang customer ?", "Ya, Sudah")
            if (response.isConfirmed == true) {
                Livewire.emit('confirmasiBarang')
            }
        })
    </script>
@endpush
