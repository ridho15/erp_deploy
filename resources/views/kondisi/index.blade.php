@extends('template.layout')

@section('content')
    @livewire('kondisi.data')
    @livewire('kondisi.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
