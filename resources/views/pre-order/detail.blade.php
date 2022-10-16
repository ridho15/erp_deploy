@extends('template.layout')

@section('content')
    @livewire('pre-order.detail', ['id_pre_order' => $preOrder->id])

    @livewire('pre-order.form')
@endsection

@section('js')
    <script src="https://cdn.tiny.cloud/1/nvlmmvucpbse1gtq3xttm573xnabu23ppo0pbknjx49633ka/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function () {

        });

        $('.btn-edit').on('click', function(){
            const item = $(this).data('item');
            tinymce.activeEditor.setContent(item.keterangan ? item.keterangan : '');
            Livewire.emit('setDataPreOrder', item.id)
            $('#modal_form').modal('show')
        })

        $('.btn-proses').on('click', async function(){
            const id = $(this).data('id')
            const status = $(this).data('status')
            const response = await alertConfirmCustom("Pemberitahuan", 'Apakah kamu yakin ingin merubah status Pre Order ?', "Ya")
            if(response.isConfirmed == true){
                Livewire.emit('changeStatusPreOrder', id, status)
            }
        })
    </script>
@endsection
