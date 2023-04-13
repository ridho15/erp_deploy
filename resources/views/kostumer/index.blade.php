@extends('template.layout')

@section('content')
    @livewire('kostumer.data')
    @livewire('kostumer.form')
    @livewire('import.customer')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
