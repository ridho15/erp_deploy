@extends('template.layout')

@section('content')
    @livewire('worker.data')
    @livewire('worker.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
