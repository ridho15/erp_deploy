@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Detail Pekerjaan
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-outline btn-sm btn-outline-success btn-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Detail Pekerjaan" data-id="{{ $projectDetail->id }}">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </div>
        </div>
        <div class="card-body">
            @livewire('form-pekerjaan.detail-pekerjaan', ['id_project_detail' => $projectDetail->id])
            <hr>
            @livewire('form-pekerjaan.detail-sub-pekerjaan', ['id_project_detail' => $projectDetail->id])
        </div>
    </div>
    @livewire('form-pekerjaan.project-detail-barang')
    @livewire('form-pekerjaan.form-uraian-pekerjaan')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });

        $('.btn-edit').on('click', function(){
            const id = $(this).data('id')
            Livewire.emit('setDataProjectDetail', id)
            $('#modal_form_project_detail').modal('show')
        })
    </script>
@endsection
