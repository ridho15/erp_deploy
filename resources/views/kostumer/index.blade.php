@extends('template.layout')

@section('content')
    @livewire('kostumer.data')
    @livewire('kostumer.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
