@extends('template.layout')

@section('content')
    @livewire('barang.data')
    @livewire('barang.form')
    @livewire('import.barang')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
