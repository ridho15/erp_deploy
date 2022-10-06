<div>
    <div wire:ignore.self class="modal fade barang" tabindex="-1" id="modal_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Quotation</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="simpanDataQuotation">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataQuotation', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Status Response</label>
                            <select name="status_response" class="form-select form-select-solid" wire:model="status_response" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih" required>
                                <option value="">Pilih</option>
                                @foreach ($listStatusResponse as $item)
                                    <option value="{{ $item['status_response'] }}">{{ $item['keterangan'] }}</option>
                                @endforeach
                            </select>
                            @error('status_response')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Tipe Pembayaran</label>
                            <select name="id_tipe_pembayaran" class="form-select form-select-solid" wire:model="id_tipe_pembayaran" data-control="select2" data-dropdown-parent="#modal_form" data-placeholder="Pilih" required>
                                <option value="">Pilih</option>
                                @foreach ($listTipePembayaran as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_tipe }}</option>
                                @endforeach
                            </select>
                            @error('id_tipe_pembayaran')
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

        window.addEventListener('contentChange', function(){

        })
    </script>
@endpush
