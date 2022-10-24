@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Detail Management Tugas
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('management-tugas.export', ['id' => $laporanPekerjaan->id]) }}" class="btn btn-sm btn-outline btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak PDF">
                    <i class="bi bi-printer"></i> Cetak
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-7">
                <div class="col-md-4 mb-10">
                    <div class="mb-5 fw-bold">
                        Customer
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Nama
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->customer->nama }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No HP
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->customer->no_hp }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Email
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->customer->no_hp }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Alamat
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->customer->alamat }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-10">
                    <div class="mb-5 fw-bold">
                        Project
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Nama
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->project->nama }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Kode
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->project->kode }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No Unit
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->project->no_unit }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No MFG
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->project->no_mfg }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Alamat
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->project->alamat }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-10">
                    <div class="mb-5 fw-bold">
                        Data Tambahan
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Merk
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->merk->nama_merk }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Nama Form
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->formMaster->nama }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Kode Form
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->formMaster->kode }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Nomor Lift
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->nomor_lift }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Teknisi
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $laporanPekerjaan->user->name }}
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-10">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <div class="fw-bold mb-5">
                        Keterangan Pekerjaan
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Jam Mulai
                        </div>
                        <div class="col-md-8 col-8">
                            : {{ $laporanPekerjaan->jam_mulai_formatted }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Jam Selesai
                        </div>
                        <div class="col-md-8 col-8">
                            : {{ $laporanPekerjaan->jam_selesai_formatted }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Keterangan Teknisi
                        </div>
                        <div class="col-md-8 col-8">
                            : {{ $laporanPekerjaan->keterangan }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Catatan Customer
                        </div>
                        <div class="col-md-8 col-8">
                            : {{ $laporanPekerjaan->catatan_customer }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Signature
                        </div>
                        <div class="col-md-8 col-8">
                            : @if ($laporanPekerjaan->signature)
                                <img src="{{ asset('storage' . $laporanPekerjaan->signature) }}" class="border rounded" alt="" height="100" width="100" style="object-fit: contain">
                            @else
                                Belum ada tanda tangan
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5 fw-bold">
                        Foto
                    </div>
                    <div class="border rounded p-5">
                        @if (count($laporanPekerjaan->laporanPekerjaanFoto) > 0)
                            <div class="row">
                                @foreach ($laporanPekerjaan->laporanPekerjaanFoto as $item)
                                    <div class="col-md-4">
                                        <a href="{{ asset('storage' . $item->file) }}" target="blank">
                                            <img src="{{ asset('storage' . $item->file) }}" class="border rounded img-fluid" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $item->keterangan }}" alt="Foto Pekerjaan">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center text-gray-500">
                                Tidak ada foto
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fw-bold mb-5">
                        Spareparts
                    </div>
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                         <thead>
                          <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                           <th>No</th>
                           <th>SKU</th>
                           <th>Nama Barang</th>
                           <th>Satuan</th>
                           <th>Harga</th>
                           <th>Jumlah / Qty</th>
                          </tr>
                         </thead>
                         <tbody>
                            @if (count($laporanPekerjaan->laporanPekerjaanBarang) > 0)
                                @foreach ($laporanPekerjaan->laporanPekerjaanBarang as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->barang->sku }}</td>
                                        <td>{{ $item->barang->nama }}</td>
                                        <td>{{ $item->barang->satuan->nama_satuan }}</td>
                                        <td>{{ $item->barang->harga_formatted }}</td>
                                        <td>{{ $item->qty }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center text-gray-500">Tidak ada barang</td>
                                </tr>
                            @endif
                         </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
