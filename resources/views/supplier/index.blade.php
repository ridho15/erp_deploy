@extends('template.layout')

@section('content')
    @livewire('supplier.data')
    @livewire('supplier.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
