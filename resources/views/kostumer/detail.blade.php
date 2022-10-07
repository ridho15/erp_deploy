@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Detail Customer Order
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-info btn-tambah-barang me-2" data-id_supplier="{{ $kostumer->id }}"><i class="bi bi-plus"></i> Tambah Barang</button>
                <button class="btn btn-sm btn-outline btn-outline-success btn-edit" data-id="{{ $kostumer->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data Supplier">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </div>
        </div>
        <div class="card-body">
            @livewire('kostumer.order', ['id_supplier' => $kostumer->id])
            <hr>
            @livewire('kostumer.order-details', ['id_supplier' => $kostumer->id])
        </div>
    </div>

    {{-- @livewire('supplier.form')
    @livewire('supplier.tambah-barang') --}}
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            Livewire.emit('setIdSupplier', {{ $kostumer->id }})
        });

        $('.btn-edit').on('click', function(){
            const id = $(this).data('id')
            Livewire.emit('setDataSupplier', id)
            $('#modal_form').modal('show')
        })

        $('.btn-tambah-barang').on('click', function(){
            const id_supplier = $(this).data('id_supplier');
            Livewire.emit('setIdSupplier', id_supplier)
            $('#modal_tambah_supplier_barang').modal('show')
        })
    </script>
@endsection
