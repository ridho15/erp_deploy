@extends('template.layout')

@section('content')
    @livewire('metode-pembayaran.data')
    @livewire('metode-pembayaran.form')
    @livewire('import.metode-pembayaran')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
