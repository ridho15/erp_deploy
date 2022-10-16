@extends('template.layout')

@section('content')
    @livewire('pre-order.detail', ['id_pre_order' => $preOrder->id])

    @livewire('pre-order.form')
@endsection

@section('js')
    <script src="https://cdn.tiny.cloud/1/nvlmmvucpbse1gtq3xttm573xnabu23ppo0pbknjx49633ka/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function () {

        });


    </script>
@endsection
