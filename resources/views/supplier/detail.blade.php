@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Detail Supplier
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-info btn-tambah-kategori me-2" data-id="{{ $supplier->id }}"><i class="bi bi-plus"></i> Tambah Barang</button>
                <button class="btn btn-sm btn-outline btn-outline-success btn-edit" data-id="{{ $supplier->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data Supplier">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </div>
        </div>
        <div class="card-body">
            @livewire('supplier.detail', ['id_supplier' => $supplier->id])
            <hr>
            @livewire('supplier.barang', ['id_supplier' => $supplier->id])
        </div>
    </div>

    @livewire('supplier.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });

        $('.btn-edit').on('click', function(){
            const id = $(this).data('id')
            Livewire.emit('setDataSupplier', id)
            $('#modal_form').modal('show')
        })
    </script>
@endsection
