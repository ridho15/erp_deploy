@extends('template.layout')

@section('content')
    @livewire('barang-customer.data')
    @livewire('barang-customer.form')
    @livewire('import.customer')
@endsection
