@extends('template.layout')
@section('content')
    @livewire('management-tugas.data')
    @livewire('management-tugas.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
