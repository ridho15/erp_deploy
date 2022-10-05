<div>
    @include('helper.alert-message')
    <div class="text-center">
        @include('helper.simple-loading', ['target' => 'cari', 'message' => 'Sedang mencari data ...'])
    </div>
    <div class="row mb-5">
        <div class="col-md-3">
            @include('helper.form-pencarian', ['model' => 'cari'])
        </div>
        <div class="col-md text-end">
            <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="$emit('onClickTambahPekerjaan', {{ $id_project }})" title="Tambah Detail Pekerjaan">
                <i class="bi bi-plus-circle"></i> Tambah
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
         <thead>
          <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
           <th>No</th>
           <th>Nama Project</th>
           <th>Nama Pekerjaan</th>
           <th>Pekerja</th>
           <th>Keterangan</th>
           <th>Mulai</th>
           <th>Selesai</th>
           <th>Status</th>
           <th>Aksi</th>
          </tr>
         </thead>
         <tbody>
            @if (count($listProjectDetail) > 0)
                @foreach ($listProjectDetail as $index => $item)
                    <tr>
                        <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                        <td>{{ $item->project->nama_project }}</td>
                        <td>{{ $item->nama_pekerjaan }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->jam_mulai }}</td>
                        <td>{{ $item->jam_selesai }}</td>
                        <td><?= $item->status_formatted ?></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Project" wire:click="$emit('onClickEdit', {{ $item->id }})">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Project" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                <a href="{{ route('form-pekerjaan.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Project">
                                    <i class="bi bi-info-circle-fill"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
         </tbody>
        </table>
    </div>
    <div class="text-center">{{ $listProjectDetail->links() }}</div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickTambahPekerjaan', (id_project) => {
            Livewire.emit('setIdProject', id_project)
            $('#modal_form_project_detail').modal('show')
        })

        Livewire.on('onClickEdit', (id) => {
            Livewire.emit('setDataProjectDetail', id)
            $('#modal_form_project_detail').modal('show')
        })
    </script>
@endpush
