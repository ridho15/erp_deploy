@extends('template.layout')

@section('content')
    @livewire('tipe-user.data')
    @livewire('tipe-user.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
