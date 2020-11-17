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
                            <div class="card-body table-responsive">
                                <table class="table table-hover tableScript text-nowrap">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Reservation ID
                                        <th>Student Name</th>
                                        <th>Reservation Start</th>
                                        <th>Reservation End</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data->chunk(10) as $chunk)
                                        @foreach($chunk as $data)
                                            <tr class="text-center">
                                                <td>{{ $data->reservation_id }}</td>
                                                <td>{{ $data->lastname }} , {{ $data -> firstname }}</td>
                                                <td>{{ date('Y-m-d h:i A', strtotime($data->reservation_start)) }}</td>
                                                <td>{{ date('Y-m-d h:i A', strtotime($data->reservation_end)) }}</td>
                                                <td>
                                                    <div class="btn-group-vertical">
                                                        <a href="{{ route('viewEmoListApproved', $data->reservation_id) }}" class="btn btn-info"><i class="fas fa-eye"></i>&nbsp;View Schedule</a>
                                                        <a href="{{ route('viewEditApproval', $data->reservation_id) }}" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp;Edit Schedule</a>
                                                        <a href="{{ route('getFile' , $data->name ?? ""  ) }}" class="btn btn-success"><i class="fas fa-download"></i>&nbsp;Download Document </a>
                                                        @if($data -> reservation_emo_status == 1)
                                                        @else
                                                        <button class="btn btn-warning" type="button" btn-id="{{ $data -> reservation_id }}" id="btnSubmit"><i class="fas fa-check"></i> Approved/Disapprove Schedule </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
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
            $('#btnSubmit').on('click', function(){

                var id = $(this).attr('btn-id');

                console.log(id);

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
                        var receivedby = '{{ Auth::user() -> username }}';
                        $.ajax({
                            type:"POST",
                            url: '{{ route('EmoApproving') }}',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id' : id,
                                'approve_status' : '1',
                                'receivedby' : receivedby
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
                        var receivedby = '{{ Auth::user() -> username }}';
                        $.ajax({
                            type:"POST",
                            url: '{{ route('EmoApproving') }}',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id' : id,
                                'approve_status' : '0',
                                'receivedby' : receivedby
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
                    }
                })
            });
        })
    </script>
@endsection
