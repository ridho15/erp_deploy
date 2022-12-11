<div>
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
                <th>SKU</th>
                <th>Nama</th>
                <th>Rak</th>
                <th>ITT</th>
                <th>Qty</th>
                <th>Peminjam</th>
                <th>Check</th>
            </tr>
            </thead>
            <tbody>
            @if (count($listAcurateKeluar) > 0)
                @foreach ($listAcurateKeluar as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('barang.detail', ['id' => $item->id_barang]) }}" class="text-dark">
                                {{ $item->barang->sku }}
                            </a>
                        </td>
                        <td>{{ $item->barang ? $item->barang->nama : '-' }}</td>
                        <td>{{ $item->rak ? $item->rak->nama_rak . "(" . $item->rak->kode_rak . ")" : '-' }}</td>
                        <td>{{ $item->nomor_itt }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->userPeminjam ? $item->userPeminjam->name : '-' }}</td>
                        <td>
                            <div class="form-check form-check-custom form-check-solid">
                                {{-- <input class="form-check-input" type="checkbox" value="1" wire:click="$emit('checkAccurateKeluar', {{ $item->id }})" @if($item->check == 1) checked @endif id="flexCheckDefault"/> --}}
                                <input class="form-check-input" type="checkbox" value="1" wire:click="simpanCheck({{ $item->id }})" @if($item->check == 1) checked @endif id="flexCheckDefault"/>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="text-center">{{ $listAcurateKeluar->links() }}</div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_form_nomor_itt">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Masukkan nomor peminjaman hari ini (ITT)</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanCheck">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanCheck', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Nomor ITT</label>
                            <input type="text" class="form-control form-control-solid" name="nomor_itt" wire:model="nomor_itt" placeholder="Masukkan nama metode" required>
                            @error('nomor_itt')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-down"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {

        });

        Livewire.on('checkAccurateKeluar', (id) => {
            @this.set('id_laporan_pekerjaan_barang', id)
            $('#modal_form_nomor_itt').modal('show')
        })
    </script>
@endpush
