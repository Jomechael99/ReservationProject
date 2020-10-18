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
        <div id="calendarModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3> Event Title </h3>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                    </div>
                    <div id="modalBody" class="modal-body" style="margin: 0 auto;">
                        <div class="row">
                            <h5>
                                <div class="text-center">
                                    <span> Event : </span> &nbsp;
                                    <span id="title"></span>
                                </div>
                            </h5>
                        </div>
                        <div class="row">
                            <h5>
                                <div class="text-center">
                                    <span> Time Start : </span> &nbsp;
                                    <span id="start"></span>
                                </div>
                            </h5>
                        </div>
                        <div class="row">
                            <h5>
                                <div class="text-center">
                                    <span> Time End : </span> &nbsp;
                                    <span id="end"></span>
                                </div>
                            </h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
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
                now: '{{ date('Y-m-d') }}',
                scrollTime: '00:00', // undo default 6am scrollTime
                selectable: true,
                aspectRatio: 1.8,
                initialView: 'dayGridMonth',
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
                        @foreach($data as $list)
                    {  start: '{{ $list -> reservation_start }}', end: '{{ $list -> reservation_end }}', title: '{{ $list->lastname }} , {{ $list -> firstname }} - Purpose : {{ $list -> reservation_purpose }} ' },
                    @endforeach
                ],
                eventClick:  function(info) {
                    var data = info.event;

                    $('#title').text(data.title);
                    $('#start').text(moment(data.start).format('MMM Do h:mm A'));
                    $('#end').text(moment(data.end).format('MMM Do h:mm A'));
                    $('#calendarModal').modal();
                },


            });

            calendar.render();
        });

    </script>

@endsection
