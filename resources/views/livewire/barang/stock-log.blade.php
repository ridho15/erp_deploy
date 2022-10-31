<div>
    <div class="card-header">
        <h3 class="card-title">List Stock Log</h3>
        <div class="card-toolbar">
        </div>
    </div>
    <div class="card-body">
        @include('helper.alert-message')
        <div class="table-responsive">
            <table class="table table-rounded table-striped border gy-7 gs-7">
             <thead>
              <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
               <th>No</th>
               <th>User</th>
               <th>Nama Barang</th>
               <th>Stock Awal</th>
               <th>Perubahan</th>
               <th>Tipe Perubahan</th>
               <th>Tanggal Perubahan</th>
              </tr>
             </thead>
             <tbody>
                @if (count($listStockLog) > 0)
                    @foreach ($listStockLog as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($item->user)
                                    {{ $item->user->name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->barang->nama }}</td>
                            <td>{{ $item->stock_awal }}</td>
                            <td>{{ $item->perubahan }}</td>
                            <td><?= $item->tipePerubahanStock ? $item->tipePerubahanStock->badge : null ?></td>
                            <td>{{ $item->tanggal_perubahan_formatted }}</td>
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
        <div class="text-center">{{ $listStockLog->links() }}</div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_form_edit_stock">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Stock</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                </div>

                <form action="#" wire:submit.prevent="simpanDataStock">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanDataStock', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Stock</label>
                            <input type="number" name="stock" wire:model="stock" class="form-control form-control-solid" min="0" placeholder="Masukkan stock" required>
                            @error('stock')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Min Stock</label>
                            <input type="number" name="min_stock" wire:model="min_stock" class="form-control form-control-solid" min="0" placeholder="Masukan minimal stock" required>
                            @error('min_stock')
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

        Livewire.on('onClickEditStock', () => {
            $('#modal_form_edit_stock').modal('show')
        })

        Livewire.on("finishUpdateStock", (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
