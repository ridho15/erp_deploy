@extends('template.layout')

@section('content')
    @livewire('inventory.stock-opname')
    @livewire('inventory.form-stock-opname')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
