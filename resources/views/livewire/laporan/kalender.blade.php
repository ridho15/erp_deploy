<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Calender
            </h3>
        </div>
        <div class="card-body">
            <div class="text-center">
                @include('helper.simple-loading', [
                    'target' => 'simpanCalenderPenagihan',
                    'message' => 'Sedang menyimpan data ...',
                ])
            </div>
            @include('helper.alert-message')
            <div class="text-end mb-5">
                <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Tambah Agenda" wire:click="showHideForm">
                    <i class="fa-solid fa-plus"></i> Tambah
                </button>
            </div>
            @if ($showForm)
                <form action="#" wire:submit.prevent="simpanCalenderPenagihan" method="POST">
                    <div class="row align-items-end">
                        <div class="col-md-4 mb-5">
                            <label for="" class="form-label">Tipe</label>
                            <select name="tipe" wire:model="tipe" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Pilih" required>
                                <option value="">Pilih</option>
                                <option value="1">Receivable</option>
                                <option value="2">Payable</option>
                                <option value="3">Quotation</option>
                                <option value="4">Laporan Pekerjaan</option>
                            </select>
                            @error('tipe')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-5">
                            <label for="" class="form-label">Accounts</label>
                            <select name="id_accounts" wire:model="id_accounts" class="form-select form-select-solid"
                                data-placeholder="Pilih" data-control="select2" required>
                                <option value="">Pilih</option>
                                @foreach ($listAccounts as $item)
                                    <option value="{{ $item->id }}">{{ $item->no_ref }}</option>
                                @endforeach
                            </select>
                            @error('id_accounts')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-5">
                            <label for="" class="form-label">Deskripsi</label>
                            <textarea name="description" wire:model="description" class="form-control form-control-solid"
                                placeholder="Masukkan description"></textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-5">
                            <label for="" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" wire:model="tanggal"
                                class="form-control form-control-solid" placeholder="Pilih Tanggal">
                            @error('tanggal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-5">
                            <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Simpan"><i class="fa-solid fa-floppy-disk"></i>
                                Simpan</button>
                        </div>
                    </div>
                </form>
                <hr>
            @endif
            <div id="kt_docs_fullcalendar_events_list" class="row">
                @foreach ($listCalenderPenagihan->where('tanggal', null) as $item)
                    <div class="fc-event col-md-3 mb-5" data-id="{{ $item->id }}">
                        <div class="fc-event-main border rounded bg-light-secondary p-3">
                            @if ($item->tipe == 1 && $item->id_accounts != null)
                                <span class="fw-bold">Receivable</span>
                                <span class="">{{ $item->preOrder->no_ref }}</span>
                                Dari <span class="fw-bold">{{ $item->preOrder->customer->nama }}</span>
                                <p>{{ $item->description }}</p>
                            @elseif($item->tipe == 2 && $item->id_accounts != null)
                                <span class="fw-bold">Payable</span>
                                <span class="">{{ $item->supplierOrder->no_ref }}</span>
                                Dari <span class="fw-bold">{{ $item->supplierOrder->supplier->name }}</span>
                                <p>{{ $item->description }}</p>
                            @elseif($item->tipe == 3 && $item->id_accounts != null)
                                <span class="fw-bold">Quotation</span>
                                <span class="">{{ $item->quotation->no_ref }}</span>
                                Dari <span class="fw-bold">{{ $item->quotation->customer->nama }}</span>
                                <p>{{ $item->description }}</p>
                            @elseif($item->tipe == 4 && $item->id_accounts != null)
                                <span class="fw-bold">Laporan Pekerjaan</span>
                                <span class="">{{ $item->laporanPekerjaan->kode_pekerjaan }}</span>
                                Dari <span class="fw-bold">{{ $item->laporanPekerjaan->project->nama }}
                                    ({{ $item->laporanPekerjaan->project->kode }})
                                </span>
                                <p>{{ $item->description }}</p>
                            @endif
                            <div class="text-end">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-icon btn-light" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Hapus Agenda"
                                        wire:click="$emit('onClickHapus', {{ $item->id }})">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-light" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Hapus Agenda"
                                        wire:click="setDataAgenda({{ $item->id }})">
                                        <i class="fas fa-edit text-success"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <div id="kt_docs_fullcalendar_drag"></div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_show_agenda">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">List Agenda</h3>

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
                            'target' => null,
                            'message' => 'Menyimpan data ...',
                        ])
                    </div>
                    <div class="mb-5">
                        Tanggal : <span class="fw-bold">{{ date('d-m-Y', strtotime($tanggalClick)) }}</span>
                    </div>
                    <div class="row">
                        @if (count($listAgenda) > 0)
                            @foreach ($listAgenda as $item)
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light-secondary p-5 border rounded">
                                        @if ($item->tipe == 1 && $item->id_accounts != null)
                                            <span class="fw-bold">Receivable</span>
                                            <span class="">{{ $item->preOrder->no_ref }}</span>
                                            Dari <span class="fw-bold">{{ $item->preOrder->customer->nama }}</span>
                                            <p>{{ $item->description }}</p>
                                        @elseif($item->tipe == 2 && $item->id_accounts != null)
                                            <span class="fw-bold">Payable</span>
                                            <span class="">{{ $item->supplierOrder->no_ref }}</span>
                                            Dari <span
                                                class="fw-bold">{{ $item->supplierOrder->supplier->name }}</span>
                                            <p>{{ $item->description }}</p>
                                        @elseif($item->tipe == 3 && $item->id_accounts != null)
                                            <span class="fw-bold">Quotation</span>
                                            <span class="">{{ $item->quotation->no_ref }}</span>
                                            Dari <span class="fw-bold">{{ $item->quotation->customer->nama }}</span>
                                            <p>{{ $item->description }}</p>
                                        @elseif($item->tipe == 4 && $item->id_accounts != null)
                                            <span class="fw-bold">Laporan Pekerjaan</span>
                                            <span class="">{{ $item->laporanPekerjaan->kode_pekerjaan }}</span>
                                            Dari <span
                                                class="fw-bold">{{ $item->laporanPekerjaan->customer->nama }}</span>
                                            <p>{{ $item->description }}</p>
                                        @endif
                                        <div class="text-end">
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-icon btn-light"
                                                    wire:click="hapusTanggalAgenda({{ $item->id }})">
                                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                                </button>
                                                @if ($item->tipe == 1 && $item->id_accounts != null)
                                                    <a href="{{ $item->tipe == 1 ? route('pre-order.detail', ['id' => $item->preOrder->id]) : route('supplier.order-detail', ['id' => $item->supplierOrder->id]) }}"
                                                        class="btn btn-sm btn-icon btn-light">
                                                        <i class="fa-solid fa-eye text-primary"></i>
                                                    </a>
                                                @elseif($item->tipe == 2 && $item->id_accounts != null)
                                                    <a href="{{ $item->tipe == 1 ? route('pre-order.detail', ['id' => $item->preOrder->id]) : route('supplier.order-detail', ['id' => $item->supplierOrder->id]) }}"
                                                        class="btn btn-sm btn-icon btn-light">
                                                        <i class="fa-solid fa-eye text-primary"></i>
                                                    </a>
                                                @elseif($item->tipe == 3 && $item->id_accounts != null)
                                                    <a href="{{ route('quotation.detail', ['id' => $item->quotation->id]) }}"
                                                        class="btn btn-sm btn-icon btn-light">
                                                        <i class="fa-solid fa-eye text-primary"></i>
                                                    </a>
                                                @elseif($item->tipe == 4 && $item->id_accounts != null)
                                                    <a href="{{ route('management-tugas.detail', ['id' => $item->laporanPekerjaan->id]) }}"
                                                        class="btn btn-sm btn-icon btn-light">
                                                        <i class="fa-solid fa-eye text-primary"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12 text-center text-gray-500">
                                Tidak ada agenda
                            </div>
                        @endif
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
        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
        $(document).ready(function() {
            renderCalender()
        });

        window.addEventListener('contentChange', function() {
            renderCalender()
            $('select[name="tipe"]').select2()
            $('select[name="id_accounts"]').select2()

            $('select[name="tipe"]').on('change', function() {
                @this.set('tipe', $(this).val())
            })

            $('select[name="id_accounts"]').on('change', function() {
                @this.set('id_accounts', $(this).val())
            })
        })

        function renderCalender() {
            // Initialize the external events -- for more info please visit the official site: https://fullcalendar.io/demos
            var containerEl = document.getElementById("kt_docs_fullcalendar_events_list");
            new FullCalendar.Draggable(containerEl, {
                itemSelector: ".fc-event",
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText.trim()
                    }
                }
            });

            // initialize the calendar -- for more info please visit the official site: https://fullcalendar.io/demos
            var calendarEl = document.getElementById("kt_docs_fullcalendar_drag");
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek"
                },
                contentHeight: 1000,
                editable: true,
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,
                droppable: true, // this allows things to be dropped onto the calendar
                drop: function(arg) {
                    // is the "remove after drop" checkbox checked?
                    arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                    const id = $(arg.draggedEl).data('id')
                    const tanggal = arg.dateStr;

                    Livewire.emit('updateCalenderPenagihan', id, tanggal)
                    // Livewire.emit('')
                    // if (document.getElementById("drop-remove").checked) {
                    //     // if so, remove the element from the "Draggable Events" list
                    //     arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                    // }
                },
                events: @this.get('listEvents'),
                eventContent: function(info) {
                    var element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event
                                .extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info
                                .event.extendedProps.description + '</div>');
                        }
                    }
                },
                select: function(arg) {
                    const tanggal = arg.startStr;
                    Livewire.emit('setTanggalClick', tanggal)
                    $('#modal_show_agenda').modal('show')
                }
            });

            calendar.render();
        }

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm("Peringatan !", "Apakah kamu yakin ingin menghapus data ?")
            if (response.isConfirmed == true) {
                Livewire.emit('hapusAgenda', id)
            }
        })
    </script>
@endpush
