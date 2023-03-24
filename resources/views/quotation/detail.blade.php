@extends('template.layout')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('quotation') }}" class="btn btn-sm btn-icon btn-light me-5" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Kembali">
                    <i class="fa-solid fa-arrow-left"></i>
                </a> Detail Quotation
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('quotation.preview', ['id' => $quotation->id]) }}" target="_blank"
                    class="btn btn-sm btn-outline btn-outline-info mx-2" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Preview Quotation">
                    <i class="fa-solid fa-magnifying-glass"></i> Preview
                </a>
                <a href="{{ route('quotation.export', ['id' => $quotation->id]) }}"
                    class="btn btn-sm btn-outline btn-outline-danger mx-2" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Cetak PDF">
                    <i class="bi bi-printer"></i> Cetak
                </a>
                <a href="#" class="btn btn-sm btn-outline btn-outline-primary mx-2 btn-send-quotation"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Kirim Quotation" data-id="{{ $quotation->id }}">
                    <i class="fa-solid fa-paper-plane"></i> Kirim
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
                            : {{ $quotation->projectUnit->project->customer->nama }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No HP
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->projectUnit->project->customer->no_hp }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Email
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->projectUnit->project->customer->email }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Alamat
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->projectUnit->project->customer->alamat }}
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
                            : {{ $quotation->projectUnit->project->nama }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Kode
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->projectUnit->project->kode }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No Unit
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->projectUnit->no_unit }} {{ $quotation->projectUnit->nama_unit }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No MFG
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->projectUnit->project->no_mfg }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Alamat
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->projectUnit->project->alamat }}
                        </div>
                    </div>
                </div>
                @if ($quotation->laporanPekerjaan)
                    <div class="col-md-4 mb-10">
                        <div class="mb-5 fw-bold">
                            Data Tambahan
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Merk
                            </div>
                            <div class="col-md-8 col-8 fw-bold">
                                : {{ $quotation->laporanPekerjaan->merk->nama_merk }}
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Nama Form
                            </div>
                            <div class="col-md-8 col-8 fw-bold">
                                : {{ $quotation->laporanPekerjaan->formMaster->nama }}
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Kode Form
                            </div>
                            <div class="col-md-8 col-8 fw-bold">
                                : {{ $quotation->laporanPekerjaan->formMaster->kode }}
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Nomor Lift
                            </div>
                            <div class="col-md-8 col-8 fw-bold">
                                : {{ $quotation->laporanPekerjaan->nomor_lift }}
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 col-4">
                                Teknisi
                            </div>
                            <div class="col-md-8 col-8 fw-bold">
                                : @if ($quotation->laporanPekerjaan)
                                    @foreach ($quotation->laporanPekerjaan->teknisi as $item)
                                        {{ $item->user->name }},
                                    @endforeach
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No. Ref
                        </div>
                        <div class="col-md-8 col-8">
                            : <span class="fw-bold">{{ $quotation->no_ref }}</span>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Keterangan
                        </div>
                        <div class="col-md-8 col-8">
                            : <span class="fw-bold"><?= $quotation->keterangan ?></span>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Hal
                        </div>
                        <div class="col-md-8 col-8">
                            : <span class="fw-bold">{{ $quotation->hal }}</span>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            PIC
                        </div>
                        <div class="col-md-8 col-8">
                            : <span class="fw-bold">
                                @foreach ($quotation->quotationSales as $item)
                                    {{ $item->sales->nama }},
                                @endforeach
                            </span>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            File
                        </div>
                        <div class="col-md-8 col-8">
                            : <a href="{{ $quotation->file ? asset('storage' . $quotation->file) : '#' }}"
                                class="btn btn-sm btn-icon btn-light" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Lihat File">
                                <i class="fa-solid fa-file"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Penawaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Quotation Send Log</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                    @livewire('quotation.detail', ['id_quotation' => $quotation->id])
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                    @livewire('quotation.send-log', ['id_quotation' => $quotation->id])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

        });

        $('.btn-send-quotation').on('click', function() {
            const id = $(this).data('id')
            Livewire.emit('sendQuotationToCustomer', id)
        })
    </script>
@endsection
