@extends('template.layout')

@section('content')
    @livewire('rak.data')
    @livewire('rak.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
