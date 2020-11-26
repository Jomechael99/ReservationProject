@extends('main')

@section('content')
    <div class="content-wrapper" style="min-height: 1200.88px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('Dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">View Schedule</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Schedule List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-hover tableScript ">
                                        <thead>
                                            <tr class="text-center">
                                               <th>Reservation ID</th>
                                               <th>Reservation Start</th>
                                               <th>Reservation End</th>
                                               <th>Status</th>
                                               <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $data)
                                                <tr class="text-center">
                                                    <td>{{ $data->reservation_id }}</td>
                                                    <td>{{ date('Y-m-d h:i A', strtotime($data->reservation_start)) }}</td>
                                                    <td>{{ date('Y-m-d h:i A', strtotime($data->reservation_end)) }}</td>
                                                    <td>

                                                            @if($data -> reservation_emo_status == 2)
                                                                <span class="float-right badge bg-danger">Disapproved</span>
                                                            @elseif($data -> reservation_emo_status == 1)
                                                                <span class="float-right badge bg-success">Approved</span>
                                                            @else
                                                                <span class="float-right badge bg-primary">Pending</span>
                                                            @endif

                                                    </td>
                                                    <td>
                                                        <div class="btn-group-vertical">
                                                            <a href="{{ route('Schedule.show', $data->reservation_id) }}" class="btn btn-primary">View Schedule</a>
                                                            @if( date('Y-m-d h:i A', strtotime($data->reservation_start)) < date('Y-m-d h:i A') && date('Y-m-d h:i A', strtotime($data->reservation_end)) > date('Y-m-d h:i A')  )
                                                                @if($data -> res_status == 1)
                                                                    <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#btnDetails"><i class=""></i> View Ticket </button>
                                                                @elseif($data -> res_status == 2)
                                                                    <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#btnDetails"><i class=""></i> View Ticket </button>
                                                                @else
                                                                    <button class="btn btn-info" type="button" data-toggle="modal" data-target="#btnSubmit"><i class=""></i> Add Ticket </button>

                                                                @endif
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="btnSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Schedule Ticketing</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="">Ticketing Description</label>
                                                                        <input type="textarea" id="description" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" id="btnTicket" btn-id="{{ $data -> reservation_id }}" class="btn btn-primary">Add Ticketing</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="btnDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Ticketing Status</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="form-group col-md-12 text-center">
                                                                        @if($data -> res_status == 1)
                                                                            <h3><span class="badge bg-warning">Ongoing Ticket</span></h3>
                                                                        @elseif($data -> res_status == 2)
                                                                            <h3><span class="badge bg-green">Complete Ticket</span></h3>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Modal -->

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

            $('#btnTicket').on('click', function(){

                var id = $(this).attr('btn-id');
                var desc = $('#description').val();

                $.ajax({
                    type:"POST",
                    url: '{{ route('addScheduleStatus') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id' : id,
                        'desc' : desc,
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
            });


        })
    </script>
@endsection
