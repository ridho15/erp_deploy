@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Daftar Version</h3>
            <div class="card-toolbar">
                {{-- <button class="btn btn-sm btn-outline btn-outline-success me-3">
                    <i class="fa-solid fa-file-import"></i> Import
                </button> --}}
                <button class="btn btn-sm btn-outline btn-outline-primary btn-tambah"><i class="bi bi-plus-circle"></i>
                    Tambah</button>
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="row mb-5">
                <div class="col-md-2 col-4">
                    <form data-kt-search-element="form" class="d-none d-lg-block w-100 position-relative mb-5 mb-lg-0"
                        autocomplete="off">
                        <span
                            class="svg-icon svg-icon-2 svg-icon-lg-3 svg-icon-gray-800 position-absolute top-50 translate-middle-y ms-5">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="currentColor"></path>
                            </svg>
                        </span>
                        <input type="text" class="search-input form-control form-control-solid ps-13" name="cari"
                            placeholder="Search...">
                        <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5"
                            data-kt-search-element="spinner">
                            <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                        </span>
                        <span
                            class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4"
                            data-kt-search-element="clear">
                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                        rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                        </span>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7" id="table_version">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                            <th>No</th>
                            <th>Version</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listVersion as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->version }}</td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-icon btn-success btn-edit" data-item="{{ $item }}" data-bs-toggle="tooltip" id="button_edit"
                                            data-bs-placement="top" title="Edit Version">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-danger btn-hapus" data-bs-toggle="tooltip" data-id="{{ $item->id }}" id="button_hapus"
                                            data-bs-placement="top" title="Hapus Version">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>

                                    <form action="{{ route('version.hapus', ['id' => $item->id]) }}" method="POST" id="form_hapus_{{ $item->id }}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="modal_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form Version</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('version.simpan') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', [
                                'target' => 'simpanSales',
                                'message' => 'Menyimpan data ...',
                            ])
                        </div>
                        <input type="numeric" name="id_version" class="form-control form-control-solid" hidden
                            id="id_version">
                        <div class="mb-5">
                            <label for="" class="form-label required">Version</label>
                            <input type="text" class="form-control form-control-solid" name="version"
                                placeholder="Masukkan version" required>
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-down"></i>
                            Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            table = $('#table_version').DataTable()
            $('input[name="cari"]').on('keyup', function() {
                table.search(this.value).draw();
            })
        });
        $('.btn-tambah').on('click', function() {
            $('#modal_form').modal('show')
        })

        $('#button_edit').on('click', function() {
            item = $(this).data('item')
            console.log(item);
            $('#id_version').val(item.id)
            $('input[name="version"]').val(item.version)
            $('#modal_form').modal('show')
        })

        $('#button_hapus').on('click', async function () {
            const id = $(this).data('id')
            const response = await alertConfirm('Peringatan !', "Apakah kamu yakin ingin menghapus data version")
            if(response.isConfirmed == true){
                $('#form_hapus_' + id).submit()
            }
        })
    </script>
@endsection
