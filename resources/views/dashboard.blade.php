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
                    @foreach($place as $place_date)
                        {
                            id: '{{ $place_date -> id }}' , title : '{{ $place_date -> place_name }}'
                        },
                    @endforeach
                ],
                events: [
                    /*{ id: '1', resourceId: 'b', start: '2020-06-07T02:00:00', end: '2020-06-07T07:00:00', title: 'event 1' },
                    { id: '2', resourceId: 'c', start: '2020-06-07T05:00:00', end: '2020-06-07T22:00:00', title: 'event 2' },
                    { id: '3', resourceId: 'd', start: '2020-06-06', end: '2020-06-08', title: 'event 3' },
                    { id: '4', resourceId: 'e', start: '2020-06-07T03:00:00', end: '2020-06-07T08:00:00', title: 'event 4' },
                    { id: '5', resourceId: 'f', start: '2020-06-07T00:30:00', end: '2020-06-07T02:30:00', title: 'event 5' }*/
                ]
            });

            calendar.render();
        });

    </script>

@endsection
