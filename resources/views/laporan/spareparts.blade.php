@extends('template.layout')

@section('content')
    <div class="card card-shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Sparepart yang kurang dari minimum
            </h3>
        </div>
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => null])
                </div>
            </div>
            <div class="table-responsive">
                <table id="table_list_barang" class="table table-rounded table-striped border gy-7 gs-7">
                    <thead>
                    <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                    <th>No</th>
                    <th>SKU</th>
                    <th>Nama</th>
                    <th>Merek</th>
                    <th>Stock</th>
                    <th>Satuan</th>
                    <th>Min.Stock</th>
                    <th>Tipe Barang</th>
                    <th>Deskripsi</th>
                    <th>Status Stock</th>
                    <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 0;
                        @endphp
                        @foreach ($listBarang as $index => $item)
                            @if ($item->stock < $item->min_stock)
                                    <tr>
                                        <td>{{ $nomor + 1 }}</td>
                                        <td>{{ $item->sku }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->merk ? $item->merk->nama_merk : '-' }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>{{ $item->satuan->nama_satuan }}</td>
                                        <td>{{ $item->min_stock }}</td>
                                        <td>{{ $item->tipeBarang->tipe_barang }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            @if ($item->stock < $item->min_stock)
                                                <span class="badge badge-danger">Stock Kurang</span>
                                            @else
                                                <span class="badge badge-success">Stock Cukup</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('barang.detail', ['id' => $item->id]) }}" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Barang">
                                                    <i class="bi bi-info-circle-fill"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @php
                                    $nomor++;
                                @endphp
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var table_list_barang;
        $(document).ready(function () {
            table_list_barang = $('#table_list_barang').DataTable()
        });

        $('input[name="cari"]').on('keyup', function(){
            table_list_barang.search($(this).val()).draw()
        })
    </script>
@endsection
