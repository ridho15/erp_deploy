@extends('template.layout')

@section('content')
    @livewire('form.data')
    @livewire('form.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
