@extends('main')

@section('content')
    <div class="content-wrapper" style="min-height: 1200.88px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ticketing Maintenance </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('Dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Items List</li>
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
                                    <div class="row">
                                        @foreach($items as $data)
                                        @endforeach
                                        <div class="card col-md-12">
                                            <div class="card-header">
                                                <h3 class="card-title">Additionals Facilities Details:</h3>
                                            </div>
                                            <div class="card-body table-responsive table-striped p-0">
                                                <input type="hidden" name="fk_id" value="{{ $data -> reservation_fk_id }}">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th>Item Name</th>
                                                        <th>Item Quantity</th>
                                                        @if($data -> reservation_status == 1)
                                                            <th>Item Note ( to Ongoing ) </th>
                                                            <th>Item Note ( to Completed ) </th>
                                                        @elseif($data -> reservation_status == 2)
                                                            <th>Item Note ( to Ongoing ) </th>
                                                            <th>Item Note ( to Completed ) </th>
                                                        @else
                                                            <th>Item Note ( to Ongoing ) </th>
                                                        @endif
                                                    </tr>
                                                    </thead>
                                                    <tbody id="additionTable">
                                                    @foreach($items as $row)
                                                        <tr class="text-center">
                                                            <td>{{ $row -> facilities_name }} <input type="hidden" name="id[]" value="{{ $row -> id }}"></td>
                                                            <td>{{ $row -> facilities_qty }} Pcs </td>
                                                            @if($data -> reservation_status == 1)
                                                                <td> {{ $row -> reservation_others_before }}</td>
                                                                <td> <input type="textarea" name="after[]" value=""></td>
                                                            @elseif($data -> reservation_status == 2)
                                                                <td> {{ $row -> reservation_others_before }}</td>
                                                                <td> {{ $row -> reservation_other_after }}</td>
                                                            @else
                                                                <td> <input type="textarea" name="before[]" value=""></td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    @foreach($items as $data)
                                    @endforeach
                                    @if($data -> reservation_status == 1)
                                        <div class="card-footer text-center">
                                            <input type="hidden" name="status" value="1">
                                            <button class="btn btn-info btn-sm  col-md-4" type="submit" value="1" id="btnSubmit"> Change to Complete </button>
                                        </div>
                                    @elseif($data -> reservation_status == null)
                                        <div class="card-footer text-center">
                                            <input type="hidden" name="status" value="3">
                                            <button class="btn btn-info btn-sm  col-md-4" type="submit" value="3" id="btnSubmit"> Change to Ongoing </button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#scheduledForm').submit(function(e){


                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type:"POST",
                    url: '{{ route('addListItemsStatus') }}',
                    data: formData, // get all form field value in serialize form
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(response){

                        if(response.status == "success"){
                            swal.fire("Ticketing Status Updated","","success").then(function(){
                                window.location.href = "{{ route('viewEmoList') }}"
                            });

                        }else{
                            alert("Schedule Not Added");
                        }

                    }
                });
                return false;
            });
        })
    </script>
@endsection
