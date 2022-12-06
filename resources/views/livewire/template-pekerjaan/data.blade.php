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
            @include('helper.simple-loading', ['target' => 'cari,hapusTemplatePekerjaan', 'message' => 'Memuat data...'])
        </div>
        <div class="row mb-5">
            <div class="col-md-3">
                @include('helper.form-pencarian', ['model' => 'cari'])
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-rounded border gy-7 gs-7">
                <thead>
                    <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th>No</th>
                        <th>Nama Pekerjaan</th>
                        <th>Periode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($listTemplatePekerjaan) > 0)
                        @foreach ($listTemplatePekerjaan as $index => $item)
                            <tr class="fw-bold bg-light-success">
                                <td>{{ \App\CPU\Helpers::numberToLetter($index + 1) }}</td>
                                <td>{{ $item->nama_pekerjaan }}</td>
                                <td>
                                    @if ($item->periode && is_array(json_decode($item->periode)))
                                        @if (count(json_decode($item->periode)) > 0)
                                            @foreach (json_decode($item->periode) as $periode)
                                                {{ $periode }},
                                            @endforeach
                                            Bulan
                                        @endif
                                    @endif
                                </td>
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
                            @foreach ($item->detail as $number => $value)
                                <tr>
                                    <td>{{ $number + 1 }}</td>
                                    <td>{{ $value->nama_pekerjaan }}</td>
                                    <td>
                                        @if ($value->periode && is_array(json_decode($value->periode)))
                                            @if (count(json_decode($value->periode)) > 0)
                                                @foreach (json_decode($value->periode) as $periode)
                                                    {{ $periode }},
                                                @endforeach
                                                Bulan
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit Template Pekerjaan"
                                                wire:click="$emit('onClickEditTemplatePekerjaanParent', {{ $value->id }})">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Hapus Template Pekerjaan"
                                                wire:click="$emit('onClickHapusTemplatePekerjaanParent', {{ $value->id }})">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Tambah Uraian Pekerjaan"
                                                wire:click="$emit('onClickTambahUraianPekerjaanParent',{{ $value->id }})">
                                                <i class="bi bi-plus-circle"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @foreach ($value->children as $numberChild => $child)
                                    <tr>
                                        <td>{{ $number + 1 }}.{{ $numberChild + 1 }}</td>
                                        <td>{{ $child->nama_pekerjaan }}</td>
                                        <td>
                                            @if ($child->periode && is_array(json_decode($child->periode)))
                                                @if (count(json_decode($child->periode)) > 0)
                                                    @foreach (json_decode($child->periode) as $periode)
                                                        {{ $periode }},
                                                    @endforeach
                                                    Bulan
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit Template Pekerjaan"
                                                    wire:click="$emit('onClickEditTemplatePekerjaanDetail', {{ $child->id }})">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit Template Pekerjaan"
                                                    wire:click="$emit('onClickHapusTemplatePekerjaanDetail', {{ $child->id }})">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                                {{-- <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Tambah Uraian Pekerjaan"
                                                    wire:click="$emit('onClickTambahUraianPekerjaan', {{ $child->id }})">
                                                    <i class="bi bi-plus-circle"></i>
                                                </button> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @else
                    <tr>
                        <td colspan="4" class="text-center text-gray-500">Tidak ada data</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @livewire('template-pekerjaan.form')
    @livewire('template-pekerjaan.form-detail', ['id_form_master' => $id_form_master])
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

        Livewire.on('onClickEditTemplatePekerjaanDetail', (id) => {
            Livewire.emit('setDataTemplatePekerjaanDetail', id)
            $('#modal_form_edit_pekerjaan_detail').modal('show')
        })

        Livewire.on('onClickHapusTemplatePekerjaan', async(id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ?')
            if(response.isConfirmed == true){
                Livewire.emit('hapusTemplatePekerjaan', id)
            }
        })

        Livewire.on('onClickHapusTemplatePekerjaanDetail', async(id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ?')
            if(response.isConfirmed == true){
                Livewire.emit('hapusTemplatePekerjaanDetail', id)
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

        Livewire.on('onClickTambahUraianPekerjaanDetail', (id_template_pekerjaan,id) => {
            Livewire.emit('setIdTemplatePekerjaanDetail',id_template_pekerjaan, id)
            $('#modal_form_detail_pekerjaan').modal('show')
        })

        Livewire.on('onClickEditTemplatePekerjaanParent', (id_template_pekerjaan_detail) => {
            Livewire.emit('setTemplatePekerjaanDetailParent', id_template_pekerjaan_detail);
            $('#modal_form_detail_pekerjaan').modal('show')
        })

        Livewire.on('onClickTambahUraianPekerjaanParent', (id_template_pekerjaan_detail) => {
            Livewire.emit('setIdParentTemplatePekerjaanDetail', id_template_pekerjaan_detail);
            $('#modal_form_detail_pekerjaan').modal('show')
        })

        Livewire.on('onClickHapusTemplatePekerjaanParent', async (id_template_pekerjaan_detail) => {
            const response = await alertConfirm("Peringatan", "Apakah kamu ingin menghapus data ?")
            if(response.isConfirmed == true){
                Livewire.emit('hapusTemplatePekerjaanDetailParent', id_template_pekerjaan_detail)
            }
        })
</script>
@endpush
