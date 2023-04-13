@extends('template.layout')

@section('content')
    @livewire('data-master.sales.data')
    @livewire('data-master.sales.form')
    @livewire('import.sales')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
