<div>
    @include('helper.alert-message')
    <div class="">
        <div class="row mb-5">
            <div class="col-md-5">
                Kode
            </div>
            <div class="col-md-5">
                : <span class="fw-bold">{{ $kostumer->kode }}</span>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5">
                Nama Kostumer
            </div>
            <div class="col-md">
                : <span class="fw-bold">{{ $kostumer->nama }}</span>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5">
                No HP
            </div>
            <div class="col-md">
                : <span class="fw-bold">{{ $kostumer->no_hp }}</span>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5">
                Email
            </div>
            <div class="col-md">
                : <span class="fw-bold">{{ $kostumer->email }}</span>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5">
                Alamat
            </div>
            <div class="col-md">
                : <span class="fw-bold">{{ $kostumer->alamat }}</span>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5">
                Status
            </div>
            <div class="col-md">
                : <span class="fw-bold"><?= $kostumer->status_formatted ?></span>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5">
                Barang Perlengkapan
            </div>
            <div class="col-md">
                : <span class="fw-bold">{{ $kostumer->barang_customer }}</span>
            </div>
        </div>
    </div>
    <hr>
    <div class="row mb-5">
        <div class="col-md-4 col-4">
            @include('helper.form-pencarian', ['model' => 'cari'])
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
            <thead>
                <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Customer</th>
                    <th>Alamat</th>
                    <th>Catatan</th>
                    <th>No Unit</th>
                    <th>No MFG</th>
                    <th>Sales</th>
                    <th>Lokasi</th>
                    <th>Tanggal Project</th>
                    <th>Total Pekerjaan</th>
                </tr>
            </thead>
            <tbody>
                @if (count($listProject) > 0)
                    @foreach ($listProject as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->customer->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->catatan }}</td>
                            <td>{{ $item->no_unit }}</td>
                            <td>{{ $item->no_mfg }}</td>
                            <td>
                                @foreach ($item->salesProject as $salesProject)
                                    {{ $salesProject->sales->nama }},
                                @endforeach
                            </td>
                            <td>
                                @if ($item->map)
                                    <a href="{{ $item->map }}"
                                        class="btn btn-sm btn-icon btn-outline btn-outline-success" target="_blank">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($item->tanggal)
                                    {{ date('d-m-Y', strtotime($item->tanggal)) }}
                                @endif
                            </td>
                            <td>
                                @php
                                    $total_pekerjaan_selesai = 0;
                                    foreach ($item->listUnit as $index => $value) {
                                        if (isset($value->laporanPekerjaan) && $value->laporanPekerjaan->signature != null && $value->laporanPekerjaan->jam_selesai != null) {
                                            $total_pekerjaan_selesai++;
                                        }
                                    }
                                @endphp
                                {{ $total_pekerjaan_selesai }} / {{ $item->total_pekerjaan }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10" class="text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
