@extends('template.layout')

@section('content')
    @livewire('satuan.data')
    @livewire('satuan.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
