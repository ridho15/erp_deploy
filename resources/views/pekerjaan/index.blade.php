@extends('template.layout')

@section('content')
    @livewire('pekerjaan.data')
    @livewire('pekerjaan.form')
    @livewire('import.pekerjaan')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
