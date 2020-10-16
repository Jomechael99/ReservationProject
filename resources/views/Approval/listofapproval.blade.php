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
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Reservation ID
                                        <th>Student Name</th>
                                        <th>Reservation Start</th>
                                        <th>Reservation End</th>
                                        <th>Status</th>
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
                                                    @if($data -> reservation_status == 0)
                                                        <span class="float-right badge bg-error">Disapproved</span>
                                                    @elseif($data -> reservation_status == 1)
                                                        <span class="float-right badge bg-success">Approved</span>
                                                    @else
                                                        <span class="float-right badge bg-primary">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group-vertical">
                                                        <a href="{{ route('viewApprovalList', $data->reservation_id) }}" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp;View Schedule</a>
                                                        <a href="{{ route('getFile' , $data->name ?? ""  ) }}" class="btn btn-success"><i class="fas fa-download"></i>&nbsp;Download Document </a>
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
@endsection
