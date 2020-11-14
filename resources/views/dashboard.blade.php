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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Places Selection</h3>
                </div>
                <div class="card-body">
                    <!-- Minimal style -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="place" id="place" class="form-control place">
                                    <option value="">Choose Option</option>
                                    <option value="1">Auditorium</option>
                                    <option value="2">Quadrangle</option>
                                    <option value="3">University Gym</option>
                                    <option value="4">Student Lounge</option>
                                    <option value="5">Tower Lounge</option>
                                    <option value="6">Review Center (G-36)</option>
                                    <option value="7">Others</option>
                                </select>
                            </div>
                            <!-- radio -->
                            <!-- <div class="form-group clearfix text-center">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="place1" name="place" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="place1">Auditorium</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="place2" name="place" class="custom-control-input" value="2">
                                    <label class="custom-control-label" for="place2">Quadrangle</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="place3" name="place" class="custom-control-input" value="3">
                                    <label class="custom-control-label" for="place3">University Gym</label>
                                </div>
                            </div>
                            <div class="form-group clearfix text-center">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="place4" name="place" class="custom-control-input" value="4">
                                    <label class="custom-control-label" for="place4">Student Lounge</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="place5" name="place" class="custom-control-input" value="5">
                                    <label class="custom-control-label" for="place5">Tower Lounge</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="place6" name="place" class="custom-control-input" value="6">
                                    <label class="custom-control-label" for="place6">Review Center (G-36)</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="place7" name="place" class="custom-control-input" value="7">
                                    <label class="custom-control-label" for="place7">Others</label>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

            </div>
        </div>
    </div>
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


    $(document).ready(function(){
        $('.place').on('change', function(){

            var id = $('#place option:selected').attr("value");
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }

            console.log(color);

            $.ajax({

                type:"GET",
                url: '/Calendar/Place/' + id,
                success: function(data) {

                    var events = [];


                    for(var i = 0 ; i < data.length ; i++ ){
                        events.push({
                            title: data[i].place_name,
                            start: data[i].reservation_start, // will be parsed,
                            end: data[i].reservation_end,
                            color: color
                        });
                    }

                        var calendarEl = document.getElementById('calendar');
                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            now: '{{ date("Y-m-d") }}',
                            selectable: true,
                            initialView: 'dayGridMonth',
                            events: events,
                            eventClick: function(info) {
                                var data = info.event;
                                $('#start').text(moment(data.start).format('MMM Do h:mm A'));
                                $('#end').text(moment(data.end).format('MMM Do h:mm A'));
                                $('#calendarModal').modal();
                            },


                        });

                        calendar.render();

                }
            });

        })

    });

  /*  document.addEventListener('DOMContentLoaded', function() {

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            now: '{{ date("Y-m-d") }}',
            selectable: true,
            initialView: 'dayGridMonth',
            events: [
                    @foreach($data as $list) {
                    start: '{{ $list -> reservation_start }}',
                    end: '{{ $list -> reservation_end }}',
                    title: '{{ $list -> place_name }} '
                },
                @endforeach
            ],
            eventClick: function(info) {
                var data = info.event;

                $('#start').text(moment(data.start).format('MMM Do h:mm A'));
                $('#end').text(moment(data.end).format('MMM Do h:mm A'));
                $('#calendarModal').modal();
            },


        });

        calendar.render();
    })*/


</script>

@endsection
