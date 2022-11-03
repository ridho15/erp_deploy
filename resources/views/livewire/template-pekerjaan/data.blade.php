<div>
    <div class="card-header">
        <h3 class="card-title">
            Data Template Pekerjaan
        </h3>
        <div class="card-toolbar">
            <button class="btn btn-sm btn-outline btn-outline-primary"
                wire:click="$emit('onClickTambahTemplatePekerjaan', {{ $id_form_master }})"><i
                    class="bi bi-plus-circle"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        @include('helper.alert-message')
        <div class="text-center">
            @include('helper.simple-loading', ['target' => 'cari,hapusTemplatePekerjaan', 'message' => 'Memuat
            data...'])
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
                        @if ($periode > 0)
                        <th>Checklist 1 Bulan</th>
                        @endif
                        @if ($periode > 1)
                        <th>Checklist 2 Bulan</th>
                        @endif
                        @if ($periode > 2)
                        <th>Checklist 3 Bulan</th>
                        @endif
                        @if ($periode > 5)
                        <th>Checklist 6 Bulan</th>
                        @endif
                        @if ($periode > 11)
                        <th>Checklist 1 Tahun</th>
                        @endif
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($listTemplatePekerjaan) > 0)
                    @foreach ($listTemplatePekerjaan as $index => $item)
                    {{-- {{ dd($item) }} --}}
                    <tr class="fw-bold">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_pekerjaan }}</td>
                        <td>
                            @php
                                $kerja = json_decode($item->keterangan);
;                            @endphp
                            @if ($kerja != null)
                                @foreach ($kerja as $k)
                                    <span class="badge badge-secondary text-light">{{  App\CPU\Helpers::getPekerjaan($k) }}</span>
                                @endforeach
                            @endif
                        </td>
                        @if ($periode > 0)
                        <td></td>
                        @endif
                        @if ($periode > 1)
                        <td></td>
                        @endif
                        @if ($periode > 2)
                        <td></td>
                        @endif
                        @if ($periode > 5)
                        <td></td>
                        @endif
                        @if ($periode > 11)
                        <td></td>
                        @endif
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit Template Pekerjaan"
                                    wire:click="$emit('onClickEditTemplatePekerjaan', {{ $item->id }})">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit Template Pekerjaan"
                                    wire:click="$emit('onClickHapusTemplatePekerjaan', {{ $item->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Tambah Uraian Pekerjaan"
                                    wire:click="$emit('onClickTambahUraianPekerjaan', {{ $item->id }})">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @foreach ($item->detail as $nomor => $detail)
                    <tr>
                        <td>{{ $nomor + 1 }}</td>
                        <td>{{ $detail->nama_pekerjaan }}</td>
                        <td>
                            @php
                                $kerjah = json_decode($detail->keterangan)
                            @endphp
                            @if ($kerjah != null)
                                <div class="d-flex">
                                    @foreach ($kerjah as $k)
                                        <span class="badge me-1 badge-secondary text-secondary  text-dark">{{ App\CPU\Helpers::getPekerjaan($k) }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        @if ($periode > 0)
                        <td>
                            <span class="badge me-1 badge-info  text-light">{{ $detail->checklist_1_bulan ? App\CPU\Helpers::getKondisi($detail->checklist_1_bulan) : '' }}</span>
                        </td>
                        @endif
                        @if ($periode > 1)
                        <td>
                            <span class="badge me-1 badge-info  text-light">{{ $detail->checklist_2_bulan ? App\CPU\Helpers::getKondisi($detail->checklist_2_bulan) : '' }}</span>
                        </td>
                        @endif
                        @if ($periode > 2)
                        <td>
                            <span class="badge me-1 badge-info  text-light">{{ $detail->checklist_3_bulan ? App\CPU\Helpers::getKondisi($detail->checklist_3_bulan) : '' }}</span>
                        </td>
                        @endif
                        @if ($periode > 5)
                        <td>
                            <span class="badge me-1 badge-info  text-light">{{ $detail->checklist_6_bulan ? App\CPU\Helpers::getKondisi($detail->checklist_6_bulan) : '' }}</span>
                        </td>
                        @endif
                        @if ($periode > 11)
                        <td>
                            <span class="badge me-1 badge-info  text-light">{{ $detail->checklist_1_tahun ? App\CPU\Helpers::getKondisi($detail->checklist_1_tahun) : '' }}</span>
                        </td>
                        @endif
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit Detail Pekerjaan"
                                    wire:click="$emit('onClickEditDetailPekerjaan', {{ $detail->id }}, {{ $periode }})">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Hapus Detail Pekerjaan"
                                    wire:click="$emit('onClickHapusDetailPekerjaan', {{ $detail->id }})">
                                    <i class="bi bi-trash-fill"></i>
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
    @livewire('template-pekerjaan.form-detail')
</div>

@push('js')
<script>
    $(document).ready(function () {

        });

        Livewire.on('onClickTambahTemplatePekerjaan', (id) => {
            Livewire.emit('setIdFormMaster', id)
            $('#modal_form.template-pekerjaan').modal('show')
        })

        Livewire.on('onClickEditTemplatePekerjaan', (id) => {
            Livewire.emit('setDataTemplatePekerjaan', id)
            $('#modal_form.template-pekerjaan').modal('show')
        })

        Livewire.on('onClickHapusTemplatePekerjaan', async(id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ?')
            if(response.isConfirmed == true){
                Livewire.emit('hapusTemplatePekerjaan', id)
            }
        })

        Livewire.on('onClickEditDetailPekerjaan', (id, periode) => {
            Livewire.emit('setDetailPekerjaan', id,  periode)
            $('#modal_form_detail_pekerjaan').modal('show')
        })

        Livewire.on('onClickHapusDetailPekerjaan', async (id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data?')
            if(response.isConfirmed == true){
                Livewire.emit('hapusDetailPekerjaan', id)
            }
        })

        Livewire.on('onClickTambahUraianPekerjaan', (id) => {
            Livewire.emit('setIdTemplatePekerjaan', id)
            $('#modal_form_detail_pekerjaan').modal('show')
        })
</script>
@endpush
