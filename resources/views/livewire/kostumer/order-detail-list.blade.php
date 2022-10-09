<div>
    @include('helper.alert-message')
    <div class="text-center">
        @include('helper.simple-loading', ['target' => 'cari', 'message' => 'Memuat data...'])
    </div>
    <div class="row mb-5">
        <div class="col-md-3">
            @include('helper.form-pencarian', ['model' => 'cari'])
        </div>
        <div class="col-md text-end">
            <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Tambah Barang Ke Order" wire:click="$emit('onClickTambahBarang', {{ $id_kostumer_order }})">
                <i class="bi bi-plus-circle"></i> Tambah
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
            <thead>
                <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                    <th>No</th>
                    <th>Barang</th>
                    <th>Total Barang</th>
                    <th>Total Harga</th>
                    <th>Status Order</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($listKostumerOrderDetail) > 0)
                @foreach ($listKostumerOrderDetail as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->barang->nama }}</td>
                    <td>{{ $item->total_produk }}</td>
                    <td>{{ $item->total_harga_formatted }}</td>
                    <td>{{ $item->status_order_formatted }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Edit Supplier Order Barang"
                                wire:click="$emit('onClickEditOrderBarang', {{ $item->id }})">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Hapus Barang Supplier"
                                wire:click="$emit('onClickHapusBarang', {{ $item->id }})">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                            <a href="{{ route('barang.detail', ['id' => $item->id_barang]) }}"
                                class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Data Barang">
                                <i class="bi bi-info-circle-fill"></i>
                            </a>
                        </div>
                    </td>
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
    <div class="text-center">{{ $listKostumerOrderDetail->links() }}</div>

    {{-- @livewire('supplier.order-detail-form', ['id_kostumer_order' => $id_kostumer_order]) --}}
</div>

@push('js')
<script>
    $(document).ready(function () {

        });

        Livewire.on('onClickTambahBarang', (id_kostumer_order) => {
            $('#modal_form_order_detail').modal('show')
        })

        Livewire.on('onClickHapusBarang', async(id) => {
            const response = await alertConfirm("Peringatan", "Apakah kamu yakin ingin menghapus barang ?");
            if(response.isConfirmed == true){
                Livewire.emit('hapusBarangOrder', id)
            }
        })

        Livewire.on('onClickEditOrderBarang', (id) => {
            Livewire.emit('setDataKostumerOrderDetail', id)
            $('#modal_form_order_detail').modal('show')
        })
</script>
@endpush
