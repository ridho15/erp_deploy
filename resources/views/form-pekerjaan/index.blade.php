@extends('template.layout')

@section('content')
    @livewire('form-pekerjaan.data')
    @livewire('form-pekerjaan.form')
@endsection


@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
