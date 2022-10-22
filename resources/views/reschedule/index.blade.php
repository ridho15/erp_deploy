@extends('template.layout')

@section('content')
    @livewire('reschedule.data')
    @livewire('reschedule.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
