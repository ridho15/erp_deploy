@extends('template.layout')

@section('content')
    @livewire('tipe-pembayaran.data')
    @livewire('tipe-pembayaran.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
