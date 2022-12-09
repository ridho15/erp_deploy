<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_form_to_rak">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Masukkan Barang Ke Rak</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanBarangKeRak">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanBarangKeRak', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="table-responsive">
                            <table class="table table-rounded table-striped border gy-7 gs-7">
                             <thead>
                              <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                               <th>No</th>
                               <th>SKU</th>
                               <th>Nama Barang</th>
                               <th>Jumlah</th>
                               <th>Rak</th>
                              </tr>
                             </thead>
                             <tbody>
                                @if (count($listSupplierOrderDetail) > 0)
                                    @foreach ($listSupplierOrderDetail as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->barang->sku }}</td>
                                            <td>{{ $item->barang->nama }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>
                                                <div wire:ignore>
                                                    <select name="id_rak" class="form-select" data-control="select2" data-dropdown-parent="#modal_form_to_rak" data-placeholder="Pilih" data-kode_masuk="{{ $item->id }}">
                                                        <option value="">Pilih</option>
                                                        @foreach ($listRak as $rak)
                                                            @php
                                                                $dataIsiRak = $rak->isiRak->where('id_barang', $item->id_barang)->where('kode_masuk', $item->id)->where('jumlah', $item->qty)->first();
                                                            @endphp
                                                            <option value="{{ $rak->id }}" @if($dataIsiRak) selected @endif>{{ $rak->nama_rak }} ({{ $rak->kode_rak }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center text-gray-500">Tidak ada data</td>
                                    </tr>
                                @endif
                             </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="finishPindahKeRak"><i class="bi bi-box-arrow-down"></i> Simpan</button>
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

        window.addEventListener('contentChange', function(){
            $('select[name="id_rak"]').select2();
        })
        $('select[name="id_rak"]').on('change', function(){
            const id_rak = $(this).val()
            const kode_masuk = $(this).data('kode_masuk')

            Livewire.emit('simpanBarangKeRak', id_rak, kode_masuk);
        });
    </script>
@endpush
