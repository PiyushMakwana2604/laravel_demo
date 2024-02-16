<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gym | Class Timetable</title>
    @include('website.inc/stylesheet')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        .fc-day-number,.fc-left h2,.fc-widget-content span{
            color: white;
        }
        .fc-today .fc-day-number{
            color: black;
        }
        .fc-day-header{
            color: white;
            background: #f36100;
        }
        .fc-center h2{
            color:#f36100;
        }
    </style>
    <script src="{{ asset('gym_assets/js/sweetalert2@10.js')}}"></script>

</head>

<body>

    <!-- Header Section Begin -->
        @include('website.inc/header')
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('gym_assets/img/breadcrumb-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Timetable</h2>
                        <div class="bt-option">
                            <a href="{{route('website.home-page')}}">Home</a>
                            <a href="#">Pages</a>
                            <span>Services</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Class Timetable Section Begin -->
    <section class="class-timetable-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <span>Find Your Time</span>
                        <h2>Find Your Time</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="table-controls">
                        <ul>
                            <li class="active" data-tsfilter="all">All event</li>
                            <li data-tsfilter="fitness">Fitness tips</li>
                            <li data-tsfilter="motivation">Motivation</li>
                            <li data-tsfilter="workout">Workout</li>
                        </ul>
                    </div>
                </div>
            </div>
        <div id='full_calendar_events'></div>

            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="class-timetable">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                    <th>Sunday</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="class-time">6.00am - 8.00am</td>
                                    <td class="dark-bg hover-bg ts-meta" data-tsmeta="workout">
                                        <h5>WEIGHT LOOSE</h5>
                                        <span>RLefew D. Loee</span>
                                    </td>
                                    <td class="hover-bg ts-meta" data-tsmeta="fitness">
                                        <h5>Cardio</h5>
                                        <span>RLefew D. Loee</span>
                                    </td>
                                    <td class="dark-bg hover-bg ts-meta" data-tsmeta="workout">
                                        <h5>Yoga</h5>
                                        <span>Keaf Shen</span>
                                    </td>
                                    <td class="hover-bg ts-meta" data-tsmeta="fitness">
                                        <h5>Fitness</h5>
                                        <span>Kimberly Stone</span>
                                    </td>
                                    <td class="dark-bg blank-td"></td>
                                    <td class="hover-bg ts-meta" data-tsmeta="motivation">
                                        <h5>Boxing</h5>
                                        <span>Rachel Adam</span>
                                    </td>
                                    <td class="dark-bg hover-bg ts-meta" data-tsmeta="workout">
                                        <h5>Body Building</h5>
                                        <span>Robert Cage</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="class-time">10.00am - 12.00am</td>
                                    <td class="blank-td"></td>
                                    <td class="dark-bg hover-bg ts-meta" data-tsmeta="fitness">
                                        <h5>Fitness</h5>
                                        <span>Kimberly Stone</span>
                                    </td>
                                    <td class="hover-bg ts-meta" data-tsmeta="workout">
                                        <h5>WEIGHT LOOSE</h5>
                                        <span>RLefew D. Loee</span>
                                    </td>
                                    <td class="dark-bg hover-bg ts-meta" data-tsmeta="motivation">
                                        <h5>Cardio</h5>
                                        <span>RLefew D. Loee</span>
                                    </td>
                                    <td class="hover-bg ts-meta" data-tsmeta="workout">
                                        <h5>Body Building</h5>
                                        <span>Robert Cage</span>
                                    </td>
                                    <td class="dark-bg hover-bg ts-meta" data-tsmeta="motivation">
                                        <h5>Karate</h5>
                                        <span>Donald Grey</span>
                                    </td>
                                    <td class="blank-td"></td>
                                </tr>
                                <tr>
                                    <td class="class-time">5.00pm - 7.00pm</td>
                                    <td class="dark-bg hover-bg ts-meta" data-tsmeta="fitness">
                                        <h5>Boxing</h5>
                                        <span>Rachel Adam</span>
                                    </td>
                                    <td class="hover-bg ts-meta" data-tsmeta="motivation">
                                        <h5>Karate</h5>
                                        <span>Donald Grey</span>
                                    </td>
                                    <td class="dark-bg hover-bg ts-meta" data-tsmeta="workout">
                                        <h5>Body Building</h5>
                                        <span>Robert Cage</span>
                                    </td>
                                    <td class="blank-td"></td>
                                    <td class="dark-bg hover-bg ts-meta" data-tsmeta="workout">
                                        <h5>Yoga</h5>
                                        <span>Keaf Shen</span>
                                    </td>
                                    <td class="hover-bg ts-meta" data-tsmeta="motivation">
                                        <h5>Cardio</h5>
                                        <span>RLefew D. Loee</span>
                                    </td>
                                    <td class="dark-bg hover-bg ts-meta" data-tsmeta="fitness">
                                        <h5>Fitness</h5>
                                        <span>Kimberly Stone</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="class-time">7.00pm - 9.00pm</td>
                                    <td class="hover-bg ts-meta" data-tsmeta="motivation">
                                        <h5>Cardio</h5>
                                        <span>RLefew D. Loee</span>
                                    </td>
                                    <td class="dark-bg blank-td"></td>
                                    <td class="hover-bg ts-meta" data-tsmeta="fitness">
                                        <h5>Boxing</h5>
                                        <span>Rachel Adam</span>
                                    </td>
                                    <td class="dark-bg hover-bg ts-meta" data-tsmeta="workout">
                                        <h5>Yoga</h5>
                                        <span>Keaf Shen</span>
                                    </td>
                                    <td class="hover-bg ts-meta" data-tsmeta="motivation">
                                        <h5>Karate</h5>
                                        <span>Donald Grey</span>
                                    </td>
                                    <td class="dark-bg hover-bg ts-meta" data-tsmeta="fitness">
                                        <h5>Boxing</h5>
                                        <span>Rachel Adam</span>
                                    </td>
                                    <td class="hover-bg ts-meta" data-tsmeta="workout">
                                        <h5>WEIGHT LOOSE</h5>
                                        <span>RLefew D. Loee</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!-- Class Timetable Section End -->

    <!-- Footer Section Begin -->
        @include('website.inc/footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('website.inc/script')
    <script src="{{ asset('gym_assets/js/moment.min.js')}}"></script>
    <script src="{{ asset('gym_assets/js/fullcalendar.min.js')}}"></script>
    <script src="{{ asset('gym_assets/js/toastr.min.js')}}"></script>
    <script>
        var eventId;
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendar = $('#full_calendar_events').fullCalendar({
                editable: true,
                // editable: true,
                events: '{{ route('website.class-timetable') }}',
                displayEventTime: false,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                header: {
                    left: 'prev,month,next today',
                    center: 'title',
                    right: 'prevYear,year,nextYear'
                    // agendaWeek,agendaDay
                },
                customButtons: {
                    prevYear: {
                        text: 'Prev Year',
                        click: function () {
                            changeYear(-1);
                        }
                    },
                    nextYear: {
                        text: 'Next Year',
                        click: function () {
                            changeYear(1);
                        }
                    },
                    year: {
                        text: 'Year',
                        click: function () {
                            // var currentDate = calendar.fullCalendar('getDate');
                            // var newDate = currentDate.clone().startOf('year');
                            // calendar.fullCalendar('gotoDate', newDate);
                        }
                    }
                },
                select: function (event_start, event_end, allDay) {
                    var event_name = prompt('Event Name:');
                    if (event_name) {
                        var event_start = $.fullCalendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                        var event_end = $.fullCalendar.formatDate(event_end, "Y-MM-DD HH:mm:ss");
                        eventId = Date.now();
                        $.ajax({
                            url: '{{ route('website.calendarEvents') }}',
                            data: {
                                _token: '{{ csrf_token() }}',
                                event_name: event_name,
                                event_start: event_start,
                                event_end: event_end,
                                event_id:eventId,
                                type: 'create'
                            },
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                if(data.code == 200){
                                    displayMessage("Event created.");
                                    calendar.fullCalendar('renderEvent', {
                                        // id: data.id,
                                        event_id:eventId,
                                        title: event_name,
                                        start: event_start,
                                        end: event_end,
                                        allDay: allDay
                                    }, true);
                                    calendar.fullCalendar('unselect');
                                }else if(data.code == 409){
                                    ErrorMessage(data.message);
                                }else{
                                    ErrorMessage("Please Write about event");
                                }
                            },
                            error: function (xhr, status, error) {
                                // Handle the error here
                                console.error(xhr.responseText);
                            }
                        });
                    }else{
                        ErrorMessage("Please Write about event");
                    }
                },
                eventDrop: function (event, delta,revertFunc) {
                    var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                    var originalEvent = {
                        start: event.start.clone(),
                        end: event.end ? event.end.clone() : null,
                    };
                    $.ajax({
                        url: '{{ route('website.calendarEvents') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            title: event.title,
                            event_start: event_start,
                            event_end: event_end,
                            id: event.event_id,
                            type: 'edit'
                        },
                        type: "POST",
                        success: function (response) {
                            if(response.code == 200){
                                displayMessage("Event updated");
                            }else {
                                ErrorMessage("Error. Please try again later.")
                                event.start = originalEvent.start;
                                if (originalEvent.end) {
                                    event.end = originalEvent.end;
                                }
                                revertFunc();
                            }
                        }
                    });
                },
                eventClick: function (event) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this Message:"+event.title,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!",
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: '{{ route('website.calendarEvents') }}',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    id: event.event_id,
                                    type: 'delete'
                                },
                                success: function (response) {
                                    if(response.code == 200){
                                        calendar.fullCalendar('removeEvents', event._id);
                                        displayMessage("Event removed");
                                    }else{
                                        ErrorMessage("Please try again later");
                                    }
                                }
                            });
                        }
                    })
                },
                viewRender: function (view, element,allDay) {
                    $.ajax({
                        url: '{{ route('website.calendarEvents') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            type: 'listing'
                        },
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            calendar.fullCalendar('removeEvents', event.id); //if i don't write it one event show many times
                            if(response && response.data && response.data.length > 0 && response.code == 200){
                                response.data.forEach(element => {
                                    calendar.fullCalendar('renderEvent', {
                                        event_id:element.event_id,
                                        title: element.name,
                                        start: element.event_start,
                                        end: element.event_end,
                                        allDay: allDay
                                    }, true);
                                    calendar.fullCalendar('unselect');
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
            function displayMessage(message) {
                toastr.success(message, 'Event');            
            }
            function ErrorMessage(message) {
                toastr.error(message, 'Event Error');            
            }
            function changeYear(delta) {
                var currentDate = calendar.fullCalendar('getDate');
                var newDate = currentDate.clone().add(delta, 'year');
                calendar.fullCalendar('gotoDate', newDate);
            }
        });

    </script>
</body>

</html>