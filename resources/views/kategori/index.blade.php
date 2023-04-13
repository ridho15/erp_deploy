@extends('template.layout')
@section('content')
    @livewire('kategori.data')
    @livewire('kategori.form')
    @livewire('kategori.barang')
    @livewire('kategori.tambah-barang-kategori')
    @livewire('import.kategori')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
