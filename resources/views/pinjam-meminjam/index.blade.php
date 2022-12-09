@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="h4 mb-10">Data Pinjam Meminjam</div>
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#barang_diminta">Barang Diminta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#accourate_keluar">Accurate Keluar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#barang_dipinjam">Barang Dipinjam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#barang_dibalikan">Barang Dibalikan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#accurate_masuk">Accurate Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#barang_dikasih">Barang Dikasih</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="barang_diminta" role="tabpanel">
                    @livewire('pinjam-meminjam.barang-diminta')
                </div>
                <div class="tab-pane fade" id="accourate_keluar" role="tabpanel">
                    @livewire('pinjam-meminjam.acureate-keluar')
                </div>
                <div class="tab-pane fade" id="barang_dipinjam" role="tabpanel">
                    @livewire('pinjam-meminjam.barang-dipinjam')
                </div>
                <div class="tab-pane fade" id="accurate_masuk" role="tabpanel">
                    @livewire('pinjam-meminjam.acureate-masuk')
                </div>
                <div class="tab-pane fade" id="barang_dibalikan" role="tabpanel">
                    @livewire('pinjam-meminjam.barang-dibalikan')
                </div>
                <div class="tab-pane fade" id="barang_dikasih" role="tabpanel">
                    @livewire('pinjam-meminjam.barang-dikasih')
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
