@extends('template.layout')
@section('content')
    <div class="card shadow-sm mb-5">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('daftar-tugas') }}" class="btn btn-sm btn-icon btn-light me-5" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Kembali">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                Informasi Tugas
            </h3>
            <div class="card-toolbar">
                <div class="me-5">
                    @if ($laporanPekerjaan->signature != null && $laporanPekerjaan->jam_selesai != null)
                        <span class="badge badge-success">Selesai</span>
                    @elseif($laporanPekerjaan->jam_mulai != null)
                        <span class="badge badge-warning">Sedang Dikerjakan</span>
                    @else
                        <span class="badge badge-secondary">Belum Dikerjakan</span>
                    @endif
                </div>
                @if (!$laporanPekerjaan->teknisi->where('id_user', session()->get('id_user'))->first())
                    {{-- <a href="{{ route('daftar-tugas.ambil', ['id' => $laporanPekerjaan->id]) }}" class="btn btn-sm btn-outline btn-outline-primary me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Ambil Tugas">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    Ambil Tugas
                </a> --}}
                @endif
                <a href="{{ route('management-tugas.export', ['id' => $laporanPekerjaan->id]) }}"
                    class="btn btn-sm btn-outline btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Cetak PDF">
                    <i class="bi bi-printer"></i> Cetak
                </a>
                @if ($laporanPekerjaan->jam_mulai == null)
                    <a href="{{ route('daftar-tugas.mulai', ['id' => $laporanPekerjaan->id]) }}"
                        class="btn btn-sm btn-outline btn-outline-success ms-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Mulai Pekerjaan">
                        <i class="fa-solid fa-play"></i> Mulai
                    </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            @livewire('daftar-tugas.detail', ['id_laporan_pekerjaan' => $laporanPekerjaan->id])
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab"
                        href="#laporan_pekerjaan">Laporan Pekerjaan</a>
                </li>
                @if ($laporanPekerjaan->is_emergency_call == 0)
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                            href="#laporan_perawatan_lift">Laporan Perawatan Lift</a>
                    </li>
                @endif
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                        href="#laporan_sparepart">Laporan Sparepart</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                        href="#laporan_pinjam">Laporan Pinjam</a>
                </li>
                {{-- <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#tanda_tangan_teknisi">Tanda Tangan Teknisi</a>
                </li> --}}
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
            @livewire('daftar-tugas.laporan-perawatan-lift', ['id_laporan_pekerjaan' => $laporanPekerjaan->id])
        </div>
        <div class="tab-pane fade" id="laporan_pinjam" role="tabpanel">
            @livewire('daftar-tugas.laporan-pinjam', ['id_laporan_pekerjaan' => $laporanPekerjaan->id])
        </div>
        {{-- <div class="tab-pane fade" id="tanda_tangan_teknisi" role="tabpanel">
            @livewire('daftar-tugas.tanda-tangan-teknisi', ['id_laporan_pekerjaan' => $laporanPekerjaan->id])
        </div> --}}
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
