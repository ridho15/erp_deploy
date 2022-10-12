@extends('template.layout')

@section('content')
    @livewire('tipe-barang.data')
    @livewire('tipe-barang.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
