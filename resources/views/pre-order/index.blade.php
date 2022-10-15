@extends('template.layout')

@section('content')
    @livewire('pre-order.data')
    @livewire('pre-order.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
