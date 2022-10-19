@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Detail Form
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-success btn-edit" data-id="{{ $formMaster->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Form">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </div>
        </div>
        <div class="card-body">
            @livewire('form.detail', ['id_form_master' => $formMaster->id])
            <hr>
            @livewire('template-pekerjaan.data', ['id_form_master' => $formMaster->id])
        </div>
    </div>

    @livewire('form.form')
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });

        $('.btn-edit').on('click', function(){
            const id = $(this).data('id')
            Livewire.emit('setDataForm', id)
            $('#modal_form.form-master').modal('show')
        })
    </script>
@endsection
