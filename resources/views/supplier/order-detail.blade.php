@extends('template.layout')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Supplier Order Detail</h3>
            <div class="card-toolbar">
                @if ($supplierOrder->status_order != 4)
                <button class="btn btn-sm btn-outline btn-outline-success btn-edit" data-id="{{ $supplierOrder->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Supplier Order Detail">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
                @endif
                @if ($supplierOrder->status_order != 4)
                    <button class="btn btn-sm btn-success btn-finish ms-3" data-id="{{ $supplierOrder->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Finish Supplier Order Detail">
                        <i class="bi bi-pencil-square"></i> Selesai
                    </button>
                @endif
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

        $('.btn-finish').on('click', async function(){
            const id = $(this).data('id')
            const response = await alertConfirmCustom('Peringatan !', "Stock barang akan bertambah dan tidak dapat di restore ulang. apakah kamu yakin ?", 'Ya, Selesai')
            if(response.isConfirmed == true){
                Livewire.emit('finishSupplierOrder', id);
            }
        })
    </script>
@endsection
