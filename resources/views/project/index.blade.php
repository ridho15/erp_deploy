@extends('template.layout')

@section('content')
    @livewire('project.data')
    @livewire('project.form')
    @livewire('project.unit')
    @livewire('import.project')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
