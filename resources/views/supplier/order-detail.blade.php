@extends('template.layout')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Supplier Order Detail</h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-success btn-edit" data-id="{{ $supplierOrder->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Supplier Order Detail">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </div>
        </div>
        <div class="card-body">
            @livewire('supplier.order-detail', ['id_supplier_order' => $supplierOrder->id])
            <hr>
            @livewire('supplier.order-detail-list', ['id_supplier_order' => $supplierOrder->id])
        </div>
    </div>

    @livewire('supplier.form-order')
@endsection

@section('js')
    <script>
        $(document).ready(function () {
        });

        $('.btn-edit').on('click', function(){
            const id = $(this).data('id')
            Livewire.emit('setDataSupplierOrder', id)
            $('#modal_form_order').modal('show')
        })
    </script>
@endsection
