@extends('template.layout')

@section('content')
    @livewire('quotation.data')
    @livewire('quotation.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
