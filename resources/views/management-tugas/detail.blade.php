@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('management-tugas') }}" class="btn btn-sm btn-icon btn-light me-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                Detail Management Tugas
            </h3>
            <div class="card-toolbar">
                <div class="me-5">
                    @if ($laporanPekerjaan->signature != null && $laporanPekerjaan->jam_selesai != null)
                        <span class="badge badge-success">Selesai</span>
                    @elseif($laporanPekerjaan->user != null && $laporanPekerjaan->jam_mulai != null)
                        <span class="badge badge-warning">Sedang Dikerjakan</span>
                    @else
                        <span class="badge badge-secondary">Belum Dikerjakan</span>
                    @endif
                </div>
                <a href="{{ route('management-tugas.export', ['id' => $laporanPekerjaan->id]) }}" class="btn btn-sm btn-outline btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak PDF">
                    <i class="bi bi-printer"></i> Cetak
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-7">
                <div class="col-md-4 mb-10">
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
                            : {{ $laporanPekerjaan->projectUnit->project->customer->no_hp }}
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
                            List Perlengkapan
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->projectUnit->project->customer->barang_customer }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-10">
                    <div class="mb-5 fw-bold">
                        Project
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Nama
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->projectUnit->project ? $laporanPekerjaan->projectUnit->project->nama : '-' }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Kode
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->projectUnit->project ? $laporanPekerjaan->projectUnit->project->kode : '-' }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No Unit
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
                            : {{ $laporanPekerjaan->projectUnit->project ? $laporanPekerjaan->projectUnit->project->no_mfg : '-' }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Alamat
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->projectUnit->project ? $laporanPekerjaan->projectUnit->project->alamat : '-' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-10">
                    <div class="mb-5 fw-bold">
                        Data Tambahan
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Nomor Pekerjaan
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->kode_pekerjaan }}
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
                            Keterangan
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->keterangan ?? '-' }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Periode
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : @if ($laporanPekerjaan->is_emergency_call == 1)
                                <span class="badge badge-warning">Laporan Pekerjaan</span>
                            @else
                                {{ $laporanPekerjaan->periode }} Bulan
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-10">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <div class="fw-bold mb-5">
                        Keterangan Pekerjaan
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Tanggal Pekerjaan
                        </div>
                        <div class="col-md-8 col-8">
                            : {{ date('d/m/Y', strtotime($laporanPekerjaan->tanggal_pekerjaan)) }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Jam Mulai
                        </div>
                        <div class="col-md-8 col-8">
                            : {{ $laporanPekerjaan->jam_mulai_formatted }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Jam Selesai
                        </div>
                        <div class="col-md-8 col-8">
                            : {{ $laporanPekerjaan->jam_selesai_formatted }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Tanggal Estimasi
                        </div>
                        <div class="col-md-8 col-8">
                            : @if ($laporanPekerjaan->tanggal_estimasi)
                                {{ date('d-m-Y H:i', strtotime($laporanPekerjaan->tanggal_estimasi)) }}
                            @endif
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Keterangan Teknisi
                        </div>
                        <div class="col-md-8 col-8">
                            : @if (count($laporanPekerjaan->catatanTeknisiPekerjaan) > 0)
                                    @foreach ($laporanPekerjaan->catatanTeknisiPekerjaan as $item)
                                        <div class="col-md fw-bold">
                                            {{ $item->keterangan }} ({{ $item->status == 1 ? "Ya" : "Tidak" }}),
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12 text-center text-gray-500">
                                        Belum ada catatan
                                    </div>
                                @endif
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Keterangan
                        </div>
                        <div class="col-md-8 col-8">
                            : {{ $laporanPekerjaan->keterangan }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Catatan Customer
                        </div>
                        <div class="col-md-8 col-8">
                            : {{ $laporanPekerjaan->catatan_customer }}
                        </div>
                    </div>
                    {{-- <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Signature
                        </div>
                        <div class="col-md-8 col-8">
                            : @if ($laporanPekerjaan->signature)
                                <img src="{{ asset('storage' . $laporanPekerjaan->signature) }}" class="border rounded" alt="" height="100" width="100" style="object-fit: contain">
                            @else
                                Belum ada tanda tangan
                            @endif
                        </div>
                    </div> --}}
                </div>
                <div class="col-md-4">
                    <div class="mb-5 fw-bold">
                        Foto
                    </div>
                    <div class="border rounded p-5">
                        @if (count($laporanPekerjaan->laporanPekerjaanFoto) > 0)
                            <div class="row">
                                @foreach ($laporanPekerjaan->laporanPekerjaanFoto as $item)
                                    <div class="col-md-4">
                                        <a href="{{ asset('storage' . $item->file) }}" target="blank">
                                            <img src="{{ asset('storage' . $item->file) }}" class="border rounded img-fluid" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $item->keterangan }}" alt="Foto Pekerjaan">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center text-gray-500">
                                Tidak ada foto
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fw-bold mb-5">
                        Spareparts
                    </div>
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                         <thead>
                          <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                           <th>No</th>
                           <th>SKU</th>
                           <th>Nama Barang</th>
                           <th>Jumlah / Qty</th>
                          </tr>
                         </thead>
                         <tbody>
                            @if (count($laporanPekerjaan->laporanPekerjaanBarang) > 0)
                                @foreach ($laporanPekerjaan->laporanPekerjaanBarang as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->barang->sku }}</td>
                                        <td>{{ $item->barang->nama }}</td>
                                        <td>{{ $item->qty }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center text-gray-500">Tidak ada barang</td>
                                </tr>
                            @endif
                         </tbody>
                        </table>
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
