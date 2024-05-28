(function () {
    document.addEventListener("DOMContentLoaded", function () {
        /* initialize the external events
      -----------------------------------------------------------------*/

        // var containerEl = document.getElementById("external-events-list");
        // new FullCalendar.Draggable(containerEl, {
        //   itemSelector: ".fc-event",
        //   eventData: function (eventEl) {
        //     return {
        //       title: eventEl.innerText.trim(),
        //     };
        //   },
        // });

        //// the individual way to do it
        // var containerEl = document.getElementById('external-events-list');
        // var eventEls = Array.prototype.slice.call(
        //   containerEl.querySelectorAll('.fc-event')
        // );
        // eventEls.forEach(function(eventEl) {
        //   new FullCalendar.Draggable(eventEl, {
        //     eventData: {
        //       title: eventEl.innerText.trim(),
        //     }
        //   });
        // });

        /* initialize the calendar
      -----------------------------------------------------------------*/

        var calendarEl = document.getElementById("calendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
            },
            initialView: "dayGridMonth",
            initialDate: currentDate,
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            selectable: true,
            nowIndicator: true,
            events: events, // Here you include the events array
            dateClick: function (info) {
                // Get the clicked date
                var clickedDate = new Date(info.date);

                // Array of day names
                var days = [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                ];

                // Get the day index (0-6) of the clicked date
                var dayIndex = clickedDate.getDay();

                // Get the complete name of the day
                var dayName = days[dayIndex];
                 var currentDateInView = info.start;

                // Get the current system date
                var currentSystemDate = moment().startOf('day').toDate();

                // Display the modal
                $("#event_entry_modal").modal("show");
                // Initialize modal content
                var modalContent =
                `<form>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="event_name">Date selected</label>
                    <input type="text" readonly name="event_name" id="event_start_date" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <label for="event_name">Date selected (Day: ${dayName})</label>
        </div>
        <div class="row">`;

                // Loop over workhours
                workhours.forEach((work) => {
                    if (work.day_of_week === dayName.toLowerCase()) {
                        var startTime = moment(work.start_time, "HH:mm:ss");
                        var endTime = moment(work.end_time, "HH:mm:ss");
                        var period = [];
                        if (startTime.isValid() && endTime.isValid()) {
                            var periodStart = startTime.clone();

                            // Loop to generate period array
                            while (periodStart.isSameOrBefore(endTime)) {
                                period.push(periodStart.clone());
                                periodStart.add(
                                    difftime.duree_appointments,
                                    "minutes"
                                );
                            }
                        }

                        // Loop over period
                        period.forEach((datetime) => {
                            modalContent += `<div class="col-md-3">
                                <div class="badge text-bg-success">${datetime.format(
                                    "HH:mm"
                                )}</div>
                            </div>`;
                        });
                    }
                });

                // Close the modal content
                modalContent += `</div></div></form>`;

                // Append the modal content to the modal element
                $("#mod").empty().append(modalContent);

                // Empty the #mod element and append the modal content

                // Set the start date in the modal with the complete day name
                $("#event_start_date").val(dayName + ", " + info.dateStr);
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function (arg) {
                // is the "remove after drop" checkbox checked?
                if (document.getElementById("drop-remove").checked) {
                    // if so, remove the element from the "Draggable Events" list
                    arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                }
            },
        });

        calendar.render();
    });
})();
