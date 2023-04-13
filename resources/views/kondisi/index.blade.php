@extends('template.layout')

@section('content')
    @livewire('kondisi.data')
    @livewire('kondisi.form')
    @livewire('import.kondisi')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
