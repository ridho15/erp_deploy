@extends('template.layout')

@section('content')
    @livewire('supplier.data')
    @livewire('supplier.form')
    @livewire('import.supplier')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
