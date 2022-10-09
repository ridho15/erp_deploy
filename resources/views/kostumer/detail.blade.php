@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Detail Kostumer Order
            </h3>
            {{-- <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-info btn-tambah-barang me-2" data-id_supplier="{{ $kostumer->id }}"><i class="bi bi-plus"></i> Tambah Barang</button>
                <button class="btn btn-sm btn-outline btn-outline-success btn-edit" data-id="{{ $kostumer->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data Supplier">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </div> --}}
        </div>
        <div class="card-body">
            @livewire('kostumer.order', ['id_customer' => $kostumer->id])
            <hr>
            {{-- @livewire('kostumer.order-details', ['id_supplier_order' => $kostumer->id]) --}}
        </div>
    </div>

    @livewire('kostumer.form-order', ['id' => $kostumer->id])
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            Livewire.emit('setIdKostumer', {{ $kostumer->id }})
        });
    </script>
@endsection
