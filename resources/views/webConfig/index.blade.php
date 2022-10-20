@extends('template.layout')

@section('content')
    @livewire('web-config.data')
    {{-- @livewire('tipe-barang.form') --}}
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
