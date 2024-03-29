@extends('main')

@section('content')
    <div class="content-wrapper" style="min-height: 1200.88px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Scheduled Form </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('Dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Scheduled Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>



        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <form id="scheduledForm">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    @foreach($schedule as $sched)
                                    @endforeach
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Date Applied</label>
                                            <input type="date" class="form-control" id="dateApplied" name="dateApplied" value="{{ $sched->reservation_date_applied }}" placeholder="Date Applied" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Date & Time EMO Request Received ( For EMO Use Only ) </label>
                                            <input type="text" class="form-control" name="datetimeEMO" id="datetimeEMO" value="{{ date('m-d-Y h:i:s A', strtotime($sched -> reservation_approved_time))}} " readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="">Place</label>
                                            <select class="form-control" id="scheduledPlace" name="scheduledPlace">
                                                <option value=""> Choose option </option>

                                                @foreach($place as $data2)

                                                    <option value="{{ $data2 -> id }}" {{ ( $data2->id == $sched -> facility_id) ? 'selected' : '' }} readonly> {{ $data2 -> place_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12" id="other_place_details" hidden>
                                            <label for="">Please specify : </label>
                                            <input type="text" class="form-control " id="other_place" name="other_place" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Date of Used</label>
                                            <input type="date" class="form-control" id="Applicants" name="useDate" value="{{ $sched -> reservation_date }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="">Start</label>
                                            <input type="time" class="form-control" id="timeStart" name="timeStart" value="{{ date('H:i', strtotime($sched -> reservation_start)) }}" >
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="">End</label>
                                            <input type="time" class="form-control" id="timeEnd" name="timeEnd" value="{{ date('H:i', strtotime($sched -> reservation_end)) }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="">Applicants</label>
                                            <input type="text" class="form-control" id="Applicants" value="{{ $sched -> lastname }} , {{ $sched -> firstname }}" name="Applicants"  readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="">Division</label>
                                            <input type="text" class="form-control" id="Applicants" value="{{ $sched -> division_name ? $sched->division_name : '' }}" name="Applicants"  readonly>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Department</label>
                                            <input type="text" class="form-control" id="Applicants" value="{{  $sched -> department_name ? $sched->department_name : '' }}" name="Applicants"  readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="">Purpose</label>
                                            <input type="text" class="form-control" id="Purpose" name="Purpose" value="{{ $sched -> reservation_purpose }}" >
                                        </div>
                                        <div class="form-group col-md-5" hidden>
                                            <label for="">Additionals Facitilies Needed</label>
                                            <input type="text" class="form-control" id="facilities" >
                                        </div>
                                        <div class="form-group col-md-1" hidden>
                                            <label for="">&nbsp;</label>
                                            <button type="button" class="form-control btn-info" id="additionalButton">+</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card col-md-12">
                                            <div class="card-header">
                                                <h3 class="card-title">Additionals Facilities Details:</h3>
                                            </div>
                                            <div class="card-body table-responsive table-striped p-0">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th>Additionals Details</th>
                                                        <th>Additionals Quantity</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="additionTable">
                                                    @foreach($schedule as $other)
                                                        <tr class="text-center">
                                                            <td> {{ $other -> facilities_name }}</td>
                                                            <td> {{ $other -> facilities_qty }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($sched -> reservation_status == 2)
                                    <div class="card-footer text-center">
                                        <button class="btn btn-info btn-sm  col-md-4" type="button" id="btnSubmit"> Approved/Disapproved Schedule </button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    {{-- Footer --}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

            $('input').attr('readonly', true);

            $('#scheduledPlace ').attr('disabled', true);

            $('#btnSubmit').on('click', function(){
                Swal.fire({
                    title: 'What do you want to do ?',
                    text: "You won't be able to revert this!",
                    icon: 'Success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Approved!',
                    cancelButtonText: 'No, Disapproved'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type:"POST",
                            url: '{{ route('ScheduleApproving') }}',
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'id' : {{ $id }},
                                'approve_status' : '1'
                            }, // get all form field value in serialize form
                            success: function(response){

                                if(response.status == "success"){
                                    swal.fire("Approving of scheduled is Success","","success").then(function(){
                                        location.reload();
                                    });

                                }else{
                                    swal.fire("Something is error please contact developer", "","error");
                                }

                                /*swal.fire("Sorry this function currently not working");*/

                            }
                        });
                    }else{
                        Swal.fire({
                            title: 'Submit your reason here',
                            input: 'text',
                            inputAttributes: {
                                autocapitalize: 'off'
                            },
                            preConfirm: (login) => {
                                var reason = (`${login}`);
                                $.ajax({
                                    type:"POST",
                                    url: '{{ route('ScheduleApproving') }}',
                                    data: {
                                        '_token': $('input[name=_token]').val(),
                                        'id' : {{ $id }},
                                        'approve_status' : '0',
                                        'reason' : reason
                                    }, // get all form field value in serialize form
                                    success: function(response){

                                        /*swal.fire("Sorry this function currently not working");*/

                                        if(response.status == "success"){
                                             swal.fire("Disapproved of scheduled is Success","","success").then(function(){
                                                 location.reload();
                                             });

                                        }else{
                                            swal.fire("Something is error please contact developer", "","error");
                                        }

                                    }
                                });
                            },
                        });
                    }
                })
            });

        });

    </script>
@endsection
