@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Detail Barang</h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-info btn-tambah-kategori me-2" data-id="{{ $barang->id }}"><i class="bi bi-plus"></i> Tambah Kategori</button>
                <button class="btn btn-sm btn-outline btn-outline-success btn-edit" data-id="{{ $barang->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Barang">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </div>
        </div>
        <div class="card-body">
            @livewire('barang.detail', ['id_barang' => $barang->id])
            <hr>
            @livewire('barang.gambar', ['id_barang' => $barang->id])
            <hr>
            @livewire('barang.stock-log', ['id_barang' => $barang->id])
        </div>
    </div>

    @livewire('barang.form')
    @livewire('kategori.tambah-barang-kategori')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });

        $('.btn-edit').on('click', function(){
            const id = $(this).data('id')
            Livewire.emit('setDataBarang', id)
            $('#modal_form.barang').modal('show')
        })

        $('.btn-tambah-kategori').on('click', function(){
            const id = $(this).data('id')
            Livewire.emit('setIdBarang', id)
            $('#modal_tambah_barang_kategori').modal('show')
        })
    </script>
@endsection
