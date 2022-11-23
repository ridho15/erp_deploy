<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_order_temporary">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">List Permintaan Barang Gagal</h3>

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
                        @include('helper.simple-loading', ['target' => null, 'message' => 'Menyimpan data ...'])
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4">
                            @include('helper.form-pencarian', ['model' => 'cari'])
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-rounded border gy-7 gs-7">
                            <thead>
                                <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                    <th>SKU</th>
                                    <th>Barang</th>
                                    <th>Stock Sekarang</th>
                                    <th>Jumlah Diminta</th>
                                    <th>Jumlah Kurang</th>
                                    <th>Tanggal</th>
                                    <th>Check</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($listOrderTemporary) > 0)
                                    @foreach ($listOrderTemporary as $index => $item)
                                        <tr class="@if($item->status == 1) bg-light-success @endif">
                                            <td>{{ $item->barang->sku }}</td>
                                            <td>{{ $item->barang->nama }}</td>
                                            <td>{{ $item->stock_sekarang }}</td>
                                            <td>{{ $item->jumlah_diminta }}</td>
                                            <td>{{ $item->jumlah_kurang }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" wire:click="changeStatusOrderTemporary({{ $item->id }})" @if($item->status == 1) checked @endif id="flexCheckDefault"/>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Sudah Periksa
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center text-gray-500">Tidak ada data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function () {
            if(@this.get('openModal') === true){
                setTimeout(() => {
                    $("#modal_order_temporary").modal('show')
                }, 500);
            }
        });
    </script>
@endpush
