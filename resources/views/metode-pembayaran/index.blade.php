@extends('template.layout')

@section('content')
    @livewire('metode-pembayaran.data')
    @livewire('metode-pembayaran.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
