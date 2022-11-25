@extends('template.layout')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Supplier Order
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-info btn-temporary mx-2 btn-order-temporary" data-bs-placement="top" data-bs-toggle="tooltip" title="Order Temporary">
                    <i class="fa-solid fa-bars-staggered"></i> Order Temporary
                </button>
                <button class="btn btn-sm btn-outline btn-outline-primary btn-tambah-order mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Buat orderan baru">
                    <i class="bi bi-plus-circle"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            @livewire('supplier.order')
        </div>
    </div>

    @livewire('supplier.form-order')
    @livewire('supplier.order-temporary')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });

        $('.btn-tambah-order').on('click', function(){
            $('#modal_form_order').modal('show')
        })

        $('.btn-order-temporary').on('click', function(){
            $("#modal_order_temporary").modal('show')
        })
    </script>
@endsection
