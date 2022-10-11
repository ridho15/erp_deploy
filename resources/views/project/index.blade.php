@extends('template.layout')

@section('content')
    @livewire('project.data')
    @livewire('project.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
