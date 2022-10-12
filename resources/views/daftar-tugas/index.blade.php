@extends('template.layout')

@section('content')
    @livewire('daftar-tugas.data')
    @livewire('daftar-tugas.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
