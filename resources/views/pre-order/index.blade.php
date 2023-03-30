@extends('template.layout')

@section('content')
    @livewire('pre-order.data')
    @livewire('pre-order.form', ['show_modal' => $show_modal, 'id_quotation' => $id_quotation])
    @livewire('pre-order.preview')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
