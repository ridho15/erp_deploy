@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Detail Pekerjaan
            </h3>
            <div class="card-toolbar">
                @if ($projectDetail->status == 0)
                    <button class="btn btn-outline btn-sm btn-outline-success btn-edit me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Detail Pekerjaan" data-id="{{ $projectDetail->id }}">
                        <i class="bi bi-pencil-square"></i> Edit
                    </button>
                    <button class="btn btn-success btn-sm btn-finish ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Finish Detail Pekerjaan" data-id="{{ $projectDetail->id }}">
                        <i class="bi bi-pencil-square"></i> Finish
                    </button>
                @endif
            </div>
        </div>
        <div class="card-body">
            @livewire('form-pekerjaan.detail-pekerjaan', ['id_project_detail' => $projectDetail->id])
            <hr>
            @livewire('form-pekerjaan.detail-sub-pekerjaan', ['id_project_detail' => $projectDetail->id])
        </div>
    </div>
    @livewire('form-pekerjaan.form-detail-project')
    @livewire('form-pekerjaan.form-uraian-pekerjaan')
    @livewire('form-pekerjaan.project-detail-sub-foto')
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

        $('.btn-finish').on('click', async function(){
            const id = $(this).data('id')
            const response = await alertConfirmCustom('Peringatan !', 'Setelah Pekerjaan selesai tidak dapat di ubah lagi. apakah kamu yakin ?', 'Ya, Selesai')
            if(response.isConfirmed == true){
                Livewire.emit('finishProjectDetail', id)
            }
        })
    </script>
@endsection
