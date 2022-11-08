<div>
    <div for="" class="h4 fw-bold">Pembayaran</div>
    @include('helper.alert-message')
    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
        <thead>
            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                <th>No</th>
                <th>Total Bayar Sebelumnya</th>
                <th>Pembayaran Terbaru</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @if (count($listPreOrderBayar) > 0)
                @foreach ($listPreOrderBayar as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->total_bayar_formatted }}</td>
                        <td>{{ $item->pembayaran_terbaru_formatted }}</td>
                        <td>{{ $item->tanggal }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endif
        </tbody>
        </table>
    </div>
    <div class="modal fade" tabindex="-1" id="modal_form_bayar" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Pembayaran Pre Order</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1"></span>
                    </div>
                </div>

                <form action="" method="POST" wire:submit.prevent="simpanPreOrderBayar">
                    <div class="modal-body">
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanPreOrderBayar', 'message' => 'Sedang menyimpan data ...'])
                        </div>
                        @include('helper.alert-message')
                        <div class="row mb-5">
                            <div class="col-md-6 col-6">
                                Total Pembayaran
                            </div>
                            <div class="col-md-6 col-6">
                                : <span class="fw-bold">{{ $preOrder->total_bayar_formatted }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6 col-6">
                                Yang sudah dibayarkan
                            </div>
                            <div class="col-md-6 col-6">
                                : <span class="fw-bold">Rp. {{ number_format($sudah_bayar,0,',','.') }}</span>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label">Jumlah Bayar</label>
                            <input type="number" name="pembayaran_sekarang" wire:model="pembayaran_sekarang" class="form-control form-control-solid" placeholder="jumlah pembayaran" required>
                            @error('pembayaran_sekarang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
