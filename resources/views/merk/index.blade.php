@extends('template.layout')

@section('content')
    @livewire('merk.data')
    @livewire('merk.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
