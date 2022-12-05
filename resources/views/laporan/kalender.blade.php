@extends('template.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Calender
            </h3>
        </div>
        <div class="card-body">
            <div id="kt_docs_fullcalendar_events_list" class="row">
                <div class="fc-event col-md-3">
                    <div class="fc-event-main">Event 1</div>
                </div>
                <div class="fc-event col-md-3">
                    <div class="fc-event-main">Event 1</div>
                </div>
                <div class="fc-event col-md-3">
                    <div class="fc-event-main">Event 1</div>
                </div>
                <div class="fc-event col-md-3">
                    <div class="fc-event-main">Event 1</div>
                </div>
                <div class="fc-event col-md-3">
                    <div class="fc-event-main">Event 1</div>
                </div>
            </div>
            {{-- <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event badge me-3 my-1">
                <div class="fc-event-main">Event 1</div>
            </div>
            <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event badge me-3 my-1">
                <div class="fc-event-main">Event 2</div>
            </div>
            <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event badge me-3 my-1">
                <div class="fc-event-main">Event 3</div>
            </div>
            <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event badge me-3 my-1">
                <div class="fc-event-main">Event 4</div>
            </div>
            <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event badge me-3 my-1">
                <div class="fc-event-main">Event 5</div>
            </div> --}}
            <!--begin::Checkbox-->
            <div class="mt-2 my-5">
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="" id="drop-remove" />
                    <label class="form-check-label" for="drop-remove">
                        Remove event after drop
                    </label>
                </div>
            </div>
            <!--end::Checkbox-->
            <hr>
            <div id="kt_docs_fullcalendar_drag"></div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });

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
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function(arg) {
                // is the "remove after drop" checkbox checked?
                if (document.getElementById("drop-remove").checked) {
                    // if so, remove the element from the "Draggable Events" list
                    arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                }
            }
        });

        calendar.render();
    </script>
@endsection
