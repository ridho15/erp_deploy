@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Detail Customer Order
            </h3>
        </div>
        <div class="card-body">
            @livewire('kustomer.project', ['id_customer' => $kostumer->id])
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
