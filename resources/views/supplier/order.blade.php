@extends('template.layout')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Supplier Order
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary btn-tambah-order" data-bs-toggle="tooltip" data-bs-placement="top" title="Buat orderan baru">
                    <i class="bi bi-plus-circle"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            @livewire('supplier.order')
        </div>
    </div>

    @livewire('supplier.form-order')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });

        $('.btn-tambah-order').on('click', function(){
            console.log('testing');
            $('#modal_form_order').modal('show')
        })
    </script>
@endsection
