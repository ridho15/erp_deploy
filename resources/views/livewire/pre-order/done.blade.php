<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                PO Done
            </h3>
            <div class="card-toolbar">
                <button class="mx-2 btn btn-sm btn-outline btn-outline-warning btn-acitve-light-warning mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Filter Data" wire:click="$emit('onClickFilter')">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,hapusPreOrder', 'message' => 'Memuat data...'])
            </div>
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
                {{-- <div class="col-md text-end">
                    <label for="" class="form-label">Filter</label>
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="form-check form-check-custom form-check-solid mx-2">
                            <input class="form-check-input" type="checkbox" value="1" wire:model="selesai" id="flexCheckDefault"/>
                            <label class="form-check-label" for="flexCheckDefault">
                                Selesai
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mx-2">
                            <input class="form-check-input" type="checkbox" value="1" wire:model="belum_selesai" id="flexCheckDefault"/>
                            <label class="form-check-label" for="flexCheckDefault">
                                Belum Selesai
                            </label>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="tables w-100" style="position: relative !important">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                 <thead>
                  <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200 sticky">
                   <th>No</th>
                   <th>No Ref</th>
                   <th>Kode Quotation</th>
                   <th>Customer</th>
                   <th>User</th>
                   <th>Tipe Pembayaran</th>
                   <th>Metode Pembayaran</th>
                   <th>Status Pembayaran</th>
                   <th>Keterangan</th>
                   <th>File</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listPreOrder) > 0)
                        @foreach ($listPreOrder as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->no_ref }}</td>
                                <td>{{ $item->quotation? $item->quotation->no_ref : '-' }}</td>
                                <td>
                                    @if (isset($item->quotation->project->customer))
                                        {{ $item->quotation->project->customer->nama }} {{ $item->quotation->project->customer->kode }}
                                    @elseif(isset($item->projectUnit->project->customer)){
                                        {{ $item->projectUnit->project->customer->nama }} {{ $item->projectUnit->project->customer->kode }}
                                    }
                                    @endif
                                </td>
                                <td>
                                    @if ($item->user)
                                        {{ $item->user->name }}
                                    @else
                                        Dikonfirmasi Pelanggan
                                    @endif
                                </td>
                                <td>{{ $item->tipePembayaran ? $item->tipePembayaran->nama_tipe : '-' }}</td>
                                <td>
                                    @if ($item->metodePembayaran)
                                        {{ $item->metodePembayaran->nama_metode }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><?= $item->status_pembayaran ?></td>
                                <td><?= $item->keterangan ?? '-' ?></td>
                                <td>
                                    @if ($item->file)
                                        <a href="{{ asset('storage' . $item->file) }}" class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Download File">
                                            <i class="fa-solid fa-file"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('pre-order.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Kelola Pre Order" target="blank">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endif
                </tbody>
                </table>
            </div>
            <div class="text-center">{{ $listPreOrder->links() }}</div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_filter">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Filter Data</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', ['target' => 'simpanMetodePembayaran', 'message' => 'Menyimpan data ...'])
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Tanggal Pre Order</label>
                        <input type="date" class="form-control form-control-solid" name="tanggal" wire:model="tanggal" data-dropdown-parent="#modal_filter" placeholder="Pilih Tanggal" autocomplete="off" required>
                        @error('tanggal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Customer</label>
                        <select name="id_customer_filter" wire:model="id_customer_filter" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            @foreach ($listCustomer as $item)
                                <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">User</label>
                        <select name="id_user_filter" wire:model="id_user_filter" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            @foreach ($listUser as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Status Pekerjaan</label>
                        <select name="status_pekerjaan" wire:model="status_pekerjaan" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            <option value="0">Belum Dikerjakan</option>
                            <option value="1">Sedang Dikerjakan</option>
                            <option value="2">Selesai</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Status Pembayaran</label>
                        <select name="status_pembayaran" wire:model="status_pembayaran" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            <option value="0">Belum Bayar</option>
                            <option value="1">Belum Lunas</option>
                            <option value="2">Lunas</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" wire:click="clearFilter" data-bs-dismiss="modal">Clear</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-search"></i> Cari</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.tiny.cloud/1/nvlmmvucpbse1gtq3xttm573xnabu23ppo0pbknjx49633ka/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function () {
        });

        window.addEventListener('contentChange', function(){
            $('select[name="id_customer_filter"]').select2()
            $('select[name="id_user_filter"]').select2()
            $('select[name="status_pekerjaan"]').select2()
            $('select[name="status_pembayaran"]').select2()
        })

        $('select[name="id_customer_filter"]').on('change', function(){
            @this.set('id_customer_filter', $(this).val())
        })

        $('select[name="status_pembayaran"]').on('change', function(){
            @this.set('status_pembayaran', $(this).val())
        })

        $('select[name="status_pekerjaan"]').on('change', function(){
            @this.set('status_pekerjaan', $(this).val())
        })

        $('select[name="id_user_filter"]').on('change', function(){
            @this.set('id_user_filter', $(this).val())
        })

        Livewire.on('onClickTambah', () => {
            tinymce.activeEditor.setContent('')
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickEdit', (item) => {
            tinymce.activeEditor.setContent(item.keterangan ? item.keterangan : '');
            Livewire.emit('setDataPreOrder', item.id)
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickHapus', async(id) =>{
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ?')
            if(response.isConfirmed == true){
                Livewire.emit('hapusPreOrder', id);
            }
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })

        Livewire.on('onClickFilter', () => {
            $('#modal_filter').modal('show')
        })
    </script>
@endpush
