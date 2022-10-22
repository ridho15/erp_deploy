@extends('template.layout')
@section('content')
    @livewire('management-tugas.data')
    @livewire('management-tugas.form')
    @livewire('management-tugas.atur-jadwal')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
