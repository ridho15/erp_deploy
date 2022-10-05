@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Detail Project
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-success btn-edit" data-id="{{ $project->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Supplier Order Detail">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </div>
        </div>
        <div class="card-body">
            @livewire('form-pekerjaan.detail', ['id_project' => $project->id])
            <hr>
            @livewire('form-pekerjaan.list-detail', ['id_project' => $project->id])
        </div>
    </div>

    @livewire('form-pekerjaan.form')
    @livewire('form-pekerjaan.form-detail-project')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });

        $('.btn-edit').on('click', function(){
            const id = $(this).data('id')
            Livewire.emit('setDataProject', id)
            $('#modal_form').modal('show')
        })
    </script>
@endsection
