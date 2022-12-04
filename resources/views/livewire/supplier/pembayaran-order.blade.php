<div>
    <label for="" class="form-label">List Pembayaran</label>
    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
         <thead>
          <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
           <th>No</th>
           <th>Pembayaran</th>
           <th>Total Bayar Sebelumnya</th>
           <th>Tanggal</th>
           <th>Bukti Pembayaran</th>
          </tr>
         </thead>
         <tbody>
            @if (count($listSupplierOrderPembayaran) > 0)
                @foreach ($listSupplierOrderPembayaran as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>Rp.{{ number_format($item->pembayaran_sekarang,0,',','.') }}</td>
                        <td>Rp.{{ number_format($item->total_bayar_sebelumnya,0,',','.') }}</td>
                        <td>{{ $item->tanggal_formatted }}</td>
                        <td>
                            <a href="{{ asset('storage' . $item->bukti_bayar) }}" target="_blank">
                                <div class="symbol symbol-100px">
                                    <img src="{{ asset('storage' . $item->bukti_bayar) }}" alt="" style="object-fit: cover"/>
                                </div>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
         </tbody>
        </table>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_form_pembayaran">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Pembayaran</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanSupplierOrderPembayaran">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanSupplierOrderPembayaran', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Total Bayar
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold">Rp.{{ number_format($total_bayar, 0,',','.') }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Yang sudah dibayar
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold">Rp.{{ number_format($sudah_bayar, 0,',','.') }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Sisa Bayar
                            </div>
                            <div class="col-md-8 col-8">
                                : <span class="fw-bold">Rp.{{ number_format($sisa_bayar, 0,',','.') }}</span>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Pembayaran</label>
                            <input type="number" class="form-control form-control-solid" name="pembayaran_sekarang" wire:model="pembayaran_sekarang" placeholder="Masukkan pembayaran" required>
                            @error('pembayaran_sekarang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5 text-center"
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false, progress = 0"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <label for="" class="form-label">Bukti Pembayaran</label>
                            <br>
                            <label for="pilih_file" class="btn btn-sm btn-outline btn-outline-primary btn-outline-dashed btn-active-light-primary mb-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Pilih File">
                                <i class="fa-solid fa-file"></i> Pilih File
                            </label>
                            @if ($bukti_bayar)
                                <span style="cursor: pointer" wire:click="hapusBuktiBayar">
                                    {{ $bukti_bayar->getClientOriginalName() }}
                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                </span>
                            @endif
                            <input type="file" id="pilih_file" name="bukti_bayar" wire:model="bukti_bayar" accept=".jpg,.png,.jpeg,.pdf" hidden>
                            <div class="progress" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                              </div>
                            @error('bukti_bayar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Tanggal Pembayaran</label>
                            <input type="datetime-local" class="form-control form-control-solid" name="tanggal_pembayaran" wire:model="tanggal_pembayaran" required>
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
        Livewire.on('finishSimpanData', (status, message) => {
            $(".modal").modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
