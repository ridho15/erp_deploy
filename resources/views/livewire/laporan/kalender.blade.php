<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Calender
            </h3>
        </div>
        <div class="card-body">
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'simpanCalenderPenagihan', 'message' => 'Sedang menyimpan data ...'])
            </div>
            @include('helper.alert-message')
            <div class="text-end mb-5">
                <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Agenda" wire:click="$emit('onClickTambahAgenda')">
                    <i class="fa-solid fa-plus"></i> Tambah
                </button>
            </div>
            @if ($showForm)
                <form action="#" wire:submit.prevent="simpanCalenderPenagihan" method="POST">
                    <div class="row align-items-end">
                        <div class="col-md-4 mb-5">
                            <label for="" class="form-label">Tipe</label>
                            <select name="tipe" wire:model="tipe" class="form-select form-select-solid" data-control="select2" required>
                                <option value="">Pilih</option>
                                <option value="1">Receivable</option>
                                <option value="2">Payable</option>
                            </select>
                            @error('tipe')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-5">
                            <label for="" class="form-label">Accounts</label>
                            <select name="id_accounts" wire:model="id_accounts" class="form-select form-select-solid" data-control="select2" required>
                                <option value="">Pilih</option>
                                @foreach ($listAccounts as $item)
                                    <option value="{{ $item->id }}">{{ $item->no_ref }}</option>
                                @endforeach
                            </select>
                            @error('tipe')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-5">
                            <label for="" class="form-label">Deskripsi</label>
                            <textarea name="description" wire:model="description" class="form-control form-control-solid" placeholder="Masukkan description"></textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-5">
                            <label for="" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" wire:model="tanggal" class="form-control form-control-solid" placeholder="Pilih Tanggal">
                            @error('tanggal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-5">
                            <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        </div>
                    </div>
                </form>
                <hr>
            @endif
            <div id="kt_docs_fullcalendar_events_list" class="row">
                @foreach ($listCalenderPenagihan->where('tanggal', null) as $item)
                    <div class="fc-event col-md-3 mb-5" data-id="{{ $item->id }}">
                        <div class="fc-event-main border rounded bg-light-secondary p-3">
                            @if ($item->tipe == 1)
                                <span class="fw-bold">Receivable</span>
                                <span class="">{{ $item->preOrder->no_ref }}</span>
                                Dari <span class="fw-bold">{{ $item->preOrder->customer->nama }}</span>
                                <p>{{ $item->description }}</p>
                            @elseif($item->tipe == 2)
                                <span class="fw-bold">Payable</span>
                                <span class="">{{ $item->supplierOrder->no_ref }}</span>
                                Dari <span class="fw-bold">{{ $item->supplierOrder->supplier->name }}</span>
                                <p>{{ $item->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <div id="kt_docs_fullcalendar_drag"></div>
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
        $(document).ready(function () {
            renderCalender()
        });

        window.addEventListener('contentChange', function(){
            renderCalender()
            $('select[name="tipe"]').select2()
            $('select[name="id_accounts"]').select2()

            $('select[name="tipe"]').on('change', function(){
                @this.set('tipe', $(this).val())
            })

            $('select[name="id_accounts"]').on('change', function(){
                @this.set('id_accounts', $(this).val())
            })
        })



        function renderCalender(){
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
                eventContent: function (info) {
                    var element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                },eventClick: function(arg){
                    console.log(arg.event);
                }
            });

            calendar.render();
        }

        Livewire.on('onClickTambahAgenda', () => {
            @this.set('showForm', true)
        })
    </script>
@endpush
