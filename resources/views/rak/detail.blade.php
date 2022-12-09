@extends('template.layout')

@section('content')
    @livewire('rak.detail', ['id_rak' => $rak->id])
    @livewire('rak.log', ['id_rak' => $rak->id])
    @livewire('rak.form')
    @livewire('rak.form-isi-rak')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
