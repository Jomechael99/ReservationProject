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
        <section class="content">
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ticketing List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-hover tableScript ">
                                        <thead>
                                        <tr class="text-center">
                                            <th>Ticketing ID</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $row)
                                                <tr class="text-center">
                                                    <td> {{ $row -> reservation_id }}</td>
                                                    <td> {{ $row -> lastname }}, {{ $row -> firstname }}</td>
                                                    <td> {{ $row -> reservation_date }}</td>
                                                    <td>
                                                    @if($row -> reservation_status == 1)
                                                        <span class=" badge bg-info">On Going</span>
                                                    @elseif($row -> reservation_status == 2)
                                                        <span class=" badge bg-warning">Completed</span>
                                                    @else
                                                        <span class=" badge bg-success">Pending</span>
                                                    @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group-vertical">
                                                            <a href="{{ route('viewListItems', $row->reservation_id) }}" class="btn btn-primary"><i class="fas fa-eye"></i>View Items</a>
                                                            {{--<a href="{{ route('viewEditApproval', $row->reservation_id) }}" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp;Edit Schedule</a>
                                                            <a href="{{ route('getFile' , $row->name ?? ""  ) }}" class="btn btn-success"><i class="fas fa-download"></i>&nbsp;Download Document </a>
                                                            @if($row -> reservation_others_status == 0)
                                                            @else
                                                                <button class="btn btn-warning" type="button" btn-id="{{ $row -> reservation_id }}" id="btnSubmit"><i class="fas fa-check"></i> Approved/Disapprove Schedule </button>
                                                            @endif--}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Schedule Ticketing</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-hover tableScript ">
                                        <thead>
                                        <tr class="text-center">
                                            <th>Ticketing ID</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data2 as $row)
                                            <tr class="text-center">
                                                <td> {{ $row -> reservation_id }}</td>
                                                <td> {{ $row -> lastname }}, {{ $row -> firstname }}</td>
                                                <td> {{ $row -> reservation_date }}</td>
                                                <td>
                                                    @if($row -> res_status == 1)
                                                        <span class=" badge bg-info">Requested</span>
                                                    @elseif($row -> res_status == 2)
                                                        <span class=" badge bg-warning">Completed</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group-vertical">
                                                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#btnDetails"><i class=""></i> View Ticket </button>
                                                    </div>
                                                </td>
                                            </tr>
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
                                                                    <label for="">Ticket Description</label>
                                                                    <input type="textarea" id="description" class="form-control" value="{{ $row -> res_description }}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if($row->res_status == 1)
                                                            <div class="modal-footer">
                                                                <button type="button" id="btnTicket" btn-id="{{ $row -> ticket_id  }}" class="btn btn-primary">Complete The Ticket</button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){

            $('#btnTicket').on('click', function(){

                var id = $(this).attr('btn-id');

                $.ajax({

                    type:"GET",
                    url: '/Ticketing/Schedule/Process/' + id,
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
