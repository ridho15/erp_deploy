@extends('template.layout')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">@if($supplierOrder->status_pembayaran != 2) Payable @else Supplier Order @endif Detail</h3>
            <div class="card-toolbar">
                @if ($supplierOrder->status_order != 4)
                <button class="btn btn-sm btn-outline btn-outline-success btn-edit" data-id="{{ $supplierOrder->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Supplier Order Detail">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
                @endif
                @if ($supplierOrder->status_pembayaran != 2)
                    <button class="btn btn-sm btn-success btn-pembayaran mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Pembayaran">
                        <i class="fa-solid fa-credit-card"></i> Bayar
                    </button>
                @endif
                @if ($supplierOrder->status_order != 4)
                    <button class="btn btn-sm btn-success btn-finish mx-2" data-id="{{ $supplierOrder->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Finish Supplier Order Detail">
                        <i class="bi bi-pencil-square"></i> Selesai
                    </button>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @livewire('supplier.order-detail', ['id_supplier_order' => $supplierOrder->id])
                </div>
                <div class="col-md-6">
                    @livewire('supplier.pembayaran-order', ['id_supplier_order' => $supplierOrder->id])
                </div>
            </div>
            <hr>
            @livewire('supplier.order-detail-list', ['id_supplier_order' => $supplierOrder->id])
        </div>
    </div>

    @livewire('supplier.form-order')
    @livewire('supplier.order-detail-form', ['id_supplier_order' => $supplierOrder->id])
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

        $('.btn-pembayaran').on('click', function(){
            Livewire.emit('setPembayaranSekarang');
            $('#modal_form_pembayaran').modal('show')
        })
    </script>
@endsection
