@section('title', 'Agenda')
@extends('layouts_user.master')

@section('content')
    {{-- <p>Current Date: {{ $currentDate }}</p> --}}
    <div class="container-fluid calendar-basic">
        <div class="card">
            <div class="card-header border-0">
                <h4>
                    <i class="fa fa-calendar"></i>&nbsp;Agenda
                    <a href="{{ route('bussinss.days') }}" class="float-end"><i class="icon-timer"></i>&nbsp;&nbsp;Working
                        Houres</a>
                </h4>
            </div>
            <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Add New Appointment</h5>
                        </div>
                        <div class="modal-body">
                            <div class="img-container" id="mod">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>

                            <button type="button" class="btn btn-primary" onclick="save_event()">Save Event</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row" id="wrap">
                    {{-- <div class="col-xxl-3 box-col-12">
            <div class="md-sidebar mb-3"><a class="btn btn-primary md-sidebar-toggle" href="javascript:void(0)">calendar filter</a>
                <div class="md-sidebar-aside job-left-aside custom-scrollbar">
                <div id="external-events">
                    <h4>Draggable Events</h4>
                    <div id="external-events-list">
                    <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
                        <div class="fc-event-main"> <i class="fa fa-birthday-cake me-2"></i>Birthday Party</div>
                    </div>
                    <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
                        <div class="fc-event-main"> <i class="fa fa-user me-2"></i>Meeting With Team.</div>
                    </div>
                    <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
                        <div class="fc-event-main"> <i class="fa fa-plane me-2"></i>Tour & Picnic</div>
                    </div>
                    <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
                        <div class="fc-event-main"> <i class="fa fa-file-text me-2"></i>Reporting Schedule</div>
                    </div>
                    <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
                        <div class="fc-event-main"> <i class="fa fa-briefcase me-2"></i>Lunch & Break</div>
                    </div>
                    </div>
                    <p>
                    <input class="checkbox_animated" id="drop-remove" type="checkbox">
                    <label for="drop-remove">remove after drop</label>
                    </p>
                </div>
                </div>
            </div>
            </div> --}}
                    <div class="col-xxl-12 box-col-12">
                        <div class="calendar-default" id="calendar-container">
                            <div id="calendar"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script>
        var currentDate = "{{ $currentDate }}";
        var appointments = @json($appointments);
        var workhours= @json($workhours);
        var difftime = @json($difftime);
        var events = [];

        appointments.forEach(appointment => {
            var startDateTime = appointment.appontment_date + ' ' + appointment.start_at;
            var event = {
                id: appointment.id,
                title: appointment.patient.fname + ' ' + appointment.patient.lname,
                start: startDateTime
            }
            events.push(event);
        });



    </script>

    <script src="{{ asset('assets/js/calendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/fullcalendar-custom.js') }}"></script>
@endsection
