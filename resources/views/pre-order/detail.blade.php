@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Detail Pre Order
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-success btn-edit" data-item="{{ $preOrder }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Pre Order">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-4">
                    @livewire('pre-order.detail', ['id_pre_order' => $preOrder->id])
                </div>
                <div class="col-md-8">
                    @livewire('pre-order.detail-barang', ['id_pre_order' => $preOrder->id])
                </div>
            </div>
        </div>
    </div>

    @livewire('pre-order.form')
@endsection

@section('js')
    <script src="https://cdn.tiny.cloud/1/nvlmmvucpbse1gtq3xttm573xnabu23ppo0pbknjx49633ka/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function () {

        });

        $('.btn-edit').on('click', function(){
            const item = $(this).data('item');
            tinymce.activeEditor.setContent(item.keterangan ? item.keterangan : '');
            Livewire.emit('setDataPreOrder', item.id)
            $('#modal_form').modal('show')
        })
    </script>
@endsection
