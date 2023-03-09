@extends('template.layout')

@section('content')

    <div class="mb-5 hover-scroll-x">
        <div class="d-grid">
            <ul class="nav nav-tabs flex-nowrap text-nowrap">
                <li class="nav-item">
                    <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 fw-bold"
                        data-bs-toggle="tab" href="#list">List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 fw-bold"
                        data-bs-toggle="tab" href="#selesai">Selesai</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="list" role="tabpanel">
            @livewire('daftar-tugas.data')
            @livewire('daftar-tugas.form')
        </div>
        <div class="tab-pane fade" id="selesai" role="tabpanel">
            @livewire('daftar-tugas.selesai')
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
