@extends('template.layout')

@section('content')
    @livewire('pre-order.data')
    @livewire('pre-order.form', ['show_modal' => $show_modal])
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
