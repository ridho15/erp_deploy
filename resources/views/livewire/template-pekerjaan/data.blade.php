<div>
    <div class="card-header">
        <h3 class="card-title">
            Data Template Pekerjaan
        </h3>
        <div class="card-toolbar">
            <button class="btn btn-sm btn-outline btn-outline-primary" wire:click="$emit('onClickTambahTemplatePekerjaan', {{ $id_form_master }})"><i class="bi bi-plus-circle"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="text-center">
            @include('helper.simple-loading', ['target' => 'cari,hapusTemplatePekerjaan', 'message' => 'Memuat data...'])
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
               <th>Keterangan</th>
               <th>Checklist 1 Bulan</th>
               <th>Checklist 2 Bulan</th>
               <th>Checklist 3 Bulan</th>
               <th>Checklist 6 Bulan</th>
               <th>Checklist 1 Tahun</th>
               <th>Aksi</th>
              </tr>
             </thead>
             <tbody>
                @if (count($listTemplatePekerjaan) > 0)
                    @foreach ($listTemplatePekerjaan as $index => $item)
                        <tr class="fw-bold">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_pekerjaan }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Template Pekerjaan" wire:click="'$emit('onClickTemplatePekerjaan', {{ $item->id }})'">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @foreach ($item->detail as $nomor => $detail)
                            <tr>
                                <td>{{ $nomor + 1 }}</td>
                                <td>{{ $detail->nama_pekerjaan }}</td>
                                <td>{{ $detail->checklist_1_bulan }}</td>
                                <td>{{ $detail->checklist_2_bulan }}</td>
                                <td>{{ $detail->checklist_3_bulan }}</td>
                                <td>{{ $detail->checklist_6_bulan }}</td>
                                <td>{{ $detail->checklist_1_tahun }}</td>
                                <td>{{ $detail->keterangan }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Template Pekerjaan">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endif
             </tbody>
            </table>
        </div>
        <div class="text-center">{{ $listTemplatePekerjaan->links() }}</div>
    </div>

    @livewire('template-pekerjaan.form')
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('onClickTambahTemplatePekerjaan', (id) => {
            Livewire.emit('setIdFormMaster', id)
            $('#modal_form.template-pekerjaan').modal('show')
        })

        Livewire.on('onClickEditTemplatePekerjaan', () => {
            // Livewire.emit('')
        })
    </script>
@endpush
