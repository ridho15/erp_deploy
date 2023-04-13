@extends('template.layout')

@section('content')
    @livewire('tipe-barang.data')
    @livewire('tipe-barang.form')
    @livewire('import.tipe-barang')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
