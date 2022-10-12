@extends('template.layout')
@section('content')
    <div class="card shadow-sm mb-5">
        <div class="card-header">
            <h3 class="card-title">
                Informasi Tugas
            </h3>
            <div class="card-toolbar">
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
        <div class="tab-pane fade" id="laporan_perawatan_lift" role="tabpanel">
            <div class="card shadow-sm" role="tabpanel">
                <div class="card-header">
                    <h3 class="card-title">
                        Laporan Perawatan Lift
                    </h3>
                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md mb-5">
                            <label for="" class="form-label">Tanggal</label>
                            <input type="text" class="form-control form-control-solid" name="tanggal" placeholder="Masukkan tanggal" disabled>
                        </div>
                        <div class="col-md mb-5">
                            <label for="" class="form-label">Jam Mulai</label>
                            <input type="text" class="form-control form-control-solid" name="jam_mulai" placeholder="Masukkan waktu" disabled>
                        </div>
                        <div class="col-md mb-5">
                            <label for="" class="form-label">Jam Selesai</label>
                            <input type="text" class="form-control form-control-solid" name="jam_selesai" placeholder="Masukkan waktu" disabled>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="mb-5 col-md-6">
                            <label for="" class="form-label required">Keterangan Pekerja / Catatan Teknisi</label>
                            <textarea name="keterangan" class="form-control form-control-solid" placeholder="Masukkan keterangan / Catatan" cols="30" rows="5"></textarea>
                        </div>

                        <div class="mb-5 col-md-6">
                            <label for="" class="form-label required">Keterangan Client / Pelanggan</label>
                            <textarea name="catatan_pelanggan" class="form-control form-control-solid" placeholder="Masukkan keterangan / Catatan" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <label for="" class="form-label">Upload Foto</label>
                    <div class="border rounded text-center py-5">
                        <label for="upload_file" class="btn btn-sm btn-icon btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Foto">
                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-10-09-043348/core/html/src/media/icons/duotune/general/gen035.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </label>
                        <input type="file" hidden accept="image/*" multiple id="upload_file">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
