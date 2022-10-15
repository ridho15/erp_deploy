@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Kategori
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('testing.export-pdf') }}" class="btn btn-sm btn-outline btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Data">
                    <i class="fas fa-file-pdf"></i> Export
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => null])
                </div>
            </div>
            <div class="table-responsive">
                <table id="tabel_kategori" class="table table-rounded table-striped border gy-7 gs-7">
                 <thead>
                  <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                   <th>No</th>
                   <th>Nama Kategori</th>
                   <th>Total Barang</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @foreach ($listKategori as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td>{{ $item->barangKategori->count() }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Kategori" wire:click="$emit('onClickEdit', {{ $item->id }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Kategori" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Barang Kategori" wire:click="$emit('onClickTambahBarang', {{ $item->id }})">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Barang Kategori" wire:click="$emit('onClickLihatBarang', {{ $item->id }})">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                 </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var tabel_kategori
        $(document).ready(function () {
            tabel_kategori = $('#tabel_kategori').DataTable()
        });
    </script>
@endsection
