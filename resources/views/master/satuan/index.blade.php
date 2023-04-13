@extends('template.layout')

@section('content')
    @livewire('satuan.data')
    @livewire('satuan.form')
    @livewire('import.satuan')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
