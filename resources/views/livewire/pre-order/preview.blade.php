<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_preview">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Preview PO</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', [
                            'target' => 'simpanMetodePembayaran',
                            'message' => 'Menyimpan data ...',
                        ])
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="fw-bold mb-5">Customer Area</h4>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Customer
                                </div>
                                <div class="col-md-8 col-4">
                                    : @if (isset($purchaseOrder->project->customer))
                                        {{ $purchaseOrder->project->customer->nama }}
                                    @elseif(isset($purchaseOrder->projectUnit->project->customer))
                                        {{ $purchaseOrder->projectUnit->project->customer->nama }}
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Nama Project
                                </div>
                                <div class="col-md-8 col-4">
                                    : @if (isset($purchaseOrder->project))
                                        {{ $purchaseOrder->project->nama }}
                                    @elseif(isset($purchaseOrder->projectUnit->project))
                                        {{ $purchaseOrder->projectUnit->project->nama }}
                                    @else
                                        Tidak ada project
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    UP & Nomor Handphone
                                </div>
                                <div class="col-md-8 col-4">
                                    : @if (isset($purchaseOrder->project))
                                        {{ $purchaseOrder->project->penanggung_jawab }}
                                    @elseif(isset($purchaseOrder->projectUnit->project))
                                        {{ $purchaseOrder->projectUnit->project->penanggung_jawab }}
                                    @else
                                        Tidak ada project
                                    @endif
                                    -
                                    @if (isset($purchaseOrder->project))
                                        {{ $purchaseOrder->project->no_hp }}
                                    @elseif(isset($purchaseOrder->projectUnit->project))
                                        {{ $purchaseOrder->projectUnit->project->no_hp }}
                                    @else
                                        Tidak ada project
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Nomor Lift / Unit
                                </div>
                                <div class="col-md-8 col-4">
                                    : @if (isset($purchaseOrder->quotation->laporanPekerjaan->projectUnit))
                                        {{ $purchaseOrder->quotation->laporanPekerjaan->projectUnit->no_unit }}
                                        {{ $purchaseOrder->quotation->laporanPekerjaan->projectUnit->nama_unit }}
                                    @elseif(isset($purchaseOrder->projectUnit))
                                        {{ $purchaseOrder->projectUnit->no_unit }}
                                        {{ $purchaseOrder->projectUnit->nama_unit }}
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    Merk
                                </div>
                                <div class="col-md-8 col-4">
                                    :
                                    {{ isset($purchaseOrder->quotation->laporanPekerjaan->merk) ? $purchaseOrder->quotation->laporanPekerjaan->merk->nama_merk : 'Belum ada pekerjaan' }}
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-4">
                                    PPN (%)
                                </div>
                                <div class="col-md-8 col-4">
                                    : {{ $ppn }}% <span style="cursor: pointer;" wire:click="showEditPpn"><i
                                            class="fas fa-edit"></i></span>
                                    <div class="form-group text-end mt-5" @if($show_edit == false) hidden @endif>
                                        <input type="text" class="form-control form-control-solid" name="ppn"
                                            wire:model="ppn">
                                        <div class="mt-5">
                                            <button class="btn btn-sm btn-icon btn-danger" wire:click="showEditPpn">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-success" wire:click="simpanPpn">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="fw-bold">Barang Area</h4>
                            <div class="table-responsive">
                                <table class="table table-rounded table-striped border gy-7 gs-7">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                            <th>No</th>
                                            <th>SKU</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Satuan</th>
                                            <th>Harga Satuan</th>
                                            <th>Total Harga</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($listPreOrderDetail) > 0)
                                            @foreach ($listPreOrderDetail as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <a href="{{ route('barang.detail', ['id' => $item->id_barang]) }}"
                                                            class="text-dark">
                                                            {{ $item->barang->sku }}
                                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Lihat Detail Barang">
                                                                <i class="bi bi-question-circle"></i>
                                                            </span>
                                                        </a>
                                                    </td>
                                                    <td>{{ $item->barang->nama }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->satuan->nama_satuan }}</td>
                                                    <td>{{ $item->harga_formatted }}</td>
                                                    <td>{{ $item->sub_total_formatted }}</td>
                                                    <td><?= $item->keterangan ?></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9" class="text-center text-gray-500">Tidak ada data</td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Clear</button>
                </div>
            </div>
        </div>
    </div>
</div>
