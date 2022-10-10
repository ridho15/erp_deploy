<div>
    <div class="card-header">
        <h3 class="card-title">Uraian Pekerjaan</h3>
        <div class="card-toolbar">
            <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Uraian Pekerjaan" wire:click="$emit('onClickTambahUraianPekerjaan', {{ $projectDetail->id }})">
                <i class="bi bi-plus-circle"></i> Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        @include('helper.alert-message')
        <div class="text-center">
            @include('helper.simple-loading', ['target' => 'cari', 'message' => 'Memuat data...'])
        </div>
        <div class="row mb-5">
            <div class="col-md-3">
                @include('helper.form-pencarian', ['model' => 'cari'])
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-rounded table-striped border gy-7 gs-7">
             <thead>
              <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
               <th>No</th>
               <th>Nama Pekerjaan</th>
               <th>Kondisi</th>
               <th>1 Bulan</th>
               <th>2 Bulan</th>
               <th>3 Bulan</th>
               <th>6 Bulan</th>
               <th>1 Tahun</th>
               <th>Keterangan</th>
               <th>Aksi</th>
              </tr>
             </thead>
             <tbody>
                @if (count($listProjectDetailSub) > 0)
                    @foreach ($listProjectDetailSub as $index => $item)
                        @php
                            $kondisi1Bulan = $item->kondisi1Bulan;
                            $kondisi2Bulan = $item->kondisi2Bulan;
                            $kondisi3Bulan = $item->kondisi3Bulan;
                            $kondisi6Bulan = $item->kondisi6Bulan;
                            $kondisi1Tahun = $item->kondisi1Tahun;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_sub_pekerjaan }}</td>
                            <td>
                                {{ $kondisi1Bulan ? $kondisi1Bulan->kode : '-' }} / {{ $kondisi2Bulan ? $kondisi2Bulan->kode : '-' }} / {{ $kondisi3Bulan ? $kondisi3Bulan->kode : '-' }} / {{ $kondisi6Bulan ? $kondisi6Bulan->kode : '-' }} / {{ $kondisi1Tahun ? $kondisi1Tahun->kode : '-' }}
                            </td>
                            <td>{{ $item->kondisi1Bulan ? $item->kondisi1Bulan->keterangan : '-' }}</td>
                            <td>{{ $item->kondisi2Bulan ? $item->kondisi2Bulan->keterangan : '-' }}</td>
                            <td>{{ $item->kondisi3Bulan ? $item->kondisi3Bulan->keterangan : '-' }}</td>
                            <td>{{ $item->kondisi6Bulan ? $item->kondisi6Bulan->keterangan : '-' }}</td>
                            <td>{{ $item->kondisi1Tahun ? $item->kondisi1Tahun->keterangan : '-' }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Pekerjaan" wire:click="$emit('onClickEdit', {{ $item->id }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Pekerjaan" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center text-gray-500" colspan="10">Tidak ada data</td>
                    </tr>
                @endif
             </tbody>
            </table>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {
            Livewire.emit('setProjectDetailId', {{ $projectDetail->id }})
        });

        Livewire.on('onClickTambahUraianPekerjaan', (id) => {
            $("#modal_form_project_detail_sub").modal('show')
        })

        Livewire.on('finishRefreshData', (status, message) => {
            alertMessage(status, message)
        })

        Livewire.on('onClickEdit', (id) => {
            Livewire.emit('setDataProjectDetailSub', id)
            $('#modal_form_project_detail_sub').modal('show')
        })

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm('Peringatan !', "Apakah kamu yakin ingin menghapus data ?")
            if(response.isConfirmed == true){
                Livewire.emit('hapusProjectDetailSub', id)
            }
        })
    </script>
@endpush
