@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="h4 mb-10">Data Inventory </div>
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#stock_barang">Stock Barang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#barang_diminta">Barang Diminta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#barang_dipinjam">Barang Dipinjam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#barang_terjual">Barang Terjual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#barang_masuk">Barang Masuk</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="stock_barang" role="tabpanel">
                    @livewire('inventory.stock-barang')
                </div>
                <div class="tab-pane fade" id="barang_diminta" role="tabpanel">
                    @livewire('inventory.barang-diminta')
                </div>
                <div class="tab-pane fade" id="barang_dipinjam" role="tabpanel">
                    @livewire('inventory.barang-dipinjam')
                </div>
                <div class="tab-pane fade" id="barang_terjual" role="tabpanel">
                    @livewire('inventory.barang-terjual')
                </div>
                <div class="tab-pane fade" id="barang_masuk" role="tabpanel">
                    @livewire('inventory.barang-masuk')
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
