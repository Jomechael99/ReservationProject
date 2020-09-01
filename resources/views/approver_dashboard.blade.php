@extends('main')

@section('content')
    <div class="content-wrapper" style="min-height: 583px;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div id='calendar'></div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')

    <script>

        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                now: '2020-06-07',
                scrollTime: '00:00', // undo default 6am scrollTime
                editable: true, // enable draggable events
                selectable: true,
                aspectRatio: 1.8,
                headerToolbar: {
                    left: 'today prev,next',
                    center: 'title',
                    right: 'resourceTimelineDay,resourceTimelineThreeDays,timeGridWeek,dayGridMonth,listWeek'
                },
                initialView: 'resourceTimelineDay',
                views: {
                    resourceTimelineThreeDays: {
                        type: 'resourceTimeline',
                        duration: { days: 3 },
                        buttonText: '3 days'
                    }
                },
                resourceAreaHeaderContent: 'Rooms',
                resources: [
                    { id: 'a', title: 'Auditorium A' },
                    { id: 'b', title: 'Auditorium B', eventColor: 'green' },
                    { id: 'c', title: 'Auditorium C', eventColor: 'orange' },
                    { id: 'd', title: 'Auditorium D', children: [
                            { id: 'd1', title: 'Room D1' },
                            { id: 'd2', title: 'Room D2' }
                        ] },
                    { id: 'e', title: 'Auditorium E' },
                    { id: 'f', title: 'Auditorium F', eventColor: 'red' },
                    { id: 'g', title: 'Auditorium G' },
                    { id: 'h', title: 'Auditorium H' },
                    { id: 'i', title: 'Auditorium I' },
                    { id: 'j', title: 'Auditorium J' },
                    { id: 'k', title: 'Auditorium K' },
                    { id: 'l', title: 'Auditorium L' },
                    { id: 'm', title: 'Auditorium M' },
                    { id: 'n', title: 'Auditorium N' },
                    { id: 'o', title: 'Auditorium O' },
                    { id: 'p', title: 'Auditorium P' },
                    { id: 'q', title: 'Auditorium Q' },
                    { id: 'r', title: 'Auditorium R' },
                    { id: 's', title: 'Auditorium S' },
                    { id: 't', title: 'Auditorium T' },
                    { id: 'u', title: 'Auditorium U' },
                    { id: 'v', title: 'Auditorium V' },
                    { id: 'w', title: 'Auditorium W' },
                    { id: 'x', title: 'Auditorium X' },
                    { id: 'y', title: 'Auditorium Y' },
                    { id: 'z', title: 'Auditorium Z' }
                ],
                events: [
                    { id: '1', resourceId: 'b', start: '2020-06-07T02:00:00', end: '2020-06-07T07:00:00', title: 'event 1' },
                    { id: '2', resourceId: 'c', start: '2020-06-07T05:00:00', end: '2020-06-07T22:00:00', title: 'event 2' },
                    { id: '3', resourceId: 'd', start: '2020-06-06', end: '2020-06-08', title: 'event 3' },
                    { id: '4', resourceId: 'e', start: '2020-06-07T03:00:00', end: '2020-06-07T08:00:00', title: 'event 4' },
                    { id: '5', resourceId: 'f', start: '2020-06-07T00:30:00', end: '2020-06-07T02:30:00', title: 'event 5' }
                ]
            });

            calendar.render();
        });

    </script>

@endsection
