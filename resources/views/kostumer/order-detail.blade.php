@extends('template.layout')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Kostumer Order Detail</h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-success btn-edit" data-id="{{ $kostumerOrder->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Kostumer Order Detail">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </div>
        </div>
        <div class="card-body">
            @livewire('kostumer.order-details', ['id_kostumer_order' => $kostumerOrder->id])
            <hr>
            @livewire('kostumer.order-detail-list', ['id_kostumer_order' => $kostumerOrder->id])
        </div>
    </div>

    @livewire('kostumer.form-order', ['id' => $kostumerOrder->id_customer])
@endsection

@section('js')
    <script>
        $(document).ready(function () {
        });

        $('.btn-edit').on('click', function(){
            const id = $(this).data('id')
            Livewire.emit('setDataKostumerOrder', id)
            $('#modal_form_order').modal('show')
        })
    </script>
@endsection
