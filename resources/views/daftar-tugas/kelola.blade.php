@extends('template.layout')
@section('content')
    <div class="card shadow-sm mb-5">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('daftar-tugas') }}" class="btn btn-sm btn-icon btn-light me-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                Informasi Tugas
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('management-tugas.export', ['id' => $laporanPekerjaan->id]) }}" class="btn btn-sm btn-outline btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak PDF">
                    <i class="bi bi-printer"></i> Cetak
                </a>
            </div>
        </div>
        <div class="card-body">
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
                            : {{ $laporanPekerjaan->project->nama }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Kode
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->project->kode }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No Unit
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->project->no_unit }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No MFG
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->project->no_mfg }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Alamat
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->project->alamat }}
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
                            : {{ $laporanPekerjaan->user->name }}
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#laporan_pekerjaan">Laporan Pekerjaan</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#laporan_perawatan_lift">Laporan Perawatan Lift</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#laporan_sparepart">Laporan Sparepart</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="laporan_pekerjaan" role="tabpanel">
            @livewire('daftar-tugas.laporan-pekerjaan', ['id_laporan_pekerjaan' => $laporanPekerjaan->id])
        </div>
        <div class="tab-pane fade" id="laporan_sparepart" role="tabpanel">
            @livewire('daftar-tugas.laporan-sparepart', ['id_laporan_pekerjaan' => $laporanPekerjaan->id])
        </div>
        <div class="tab-page fade" id="laporan_perawatan_lift" role="tabpanel">
            @livewire('daftar-tugas.laporan-perawatan-lift', ['id_laporan_pekerjaan' => $laporanPekerjaan->id])
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
