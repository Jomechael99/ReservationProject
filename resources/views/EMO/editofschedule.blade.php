@extends('main')

@section('content')
    <div class="content-wrapper" style="min-height: 1200.88px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student Scheduled Form </h1>
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
                                    <input type="hidden" name="res_id" value="{{ $sched -> reservation_id }}">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Date Applied</label>
                                            <input type="date" class="form-control input" id="dateApplied" name="dateApplied" value="{{ $sched->reservation_date_applied }}" placeholder="Date Applied" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Date & Time EMO Request Receive ( For Emo Use Only ) </label>
                                            <input type="text" class="form-control input" name="datetimeEMO" id="datetimeEMO" value="{{ date('m-d-Y h:i:s A', strtotime($sched -> reservation_approved_time))}} " readonly>
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
                                            <input type="text" class="form-control input" id="Applicants" value="{{ $sched -> lastname }} , {{ $sched -> firstname }}" name="Applicants"  readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="">Division</label>
                                            <input type="text" class="form-control input" id="Applicants" value="{{ $sched -> division_name ? $sched->division_name : '' }}" name="Applicants"  readonly>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Department</label>
                                            <input type="text" class="form-control input" id="Applicants" value="{{  $sched -> department_name ? $sched->department_name : '' }}" name="Applicants"  readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="">Purpose</label>
                                            <input type="text" class="form-control input" id="Purpose" name="Purpose" value="{{ $sched -> reservation_purpose }}" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="">Additionals Facitilies Needed</label>
                                            <select class="form-control" id="facilities">
                                                <option value=""> Choose option </option>
                                                @foreach($facilities as $row)
                                                    <option value="{{ $row -> id }}"> {{ $row -> facilities_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="">Quantity In Need</label>
                                            <input type="number" class="form-control" id="quantity" >
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="">&nbsp;</label>
                                            <button type="button" class="form-control btn-info" id="additionalButton">+</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card col-md-12">
                                            <div class="card-header">
                                                <h3 class="card-title">List of Facilities Details:</h3>
                                            </div>
                                            <div class="card-body table-responsive table-striped p-0">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th>Additionals Details</th>
                                                        <th>Additionals Quantity</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="">
                                                    @foreach($schedule as $other)
                                                        <tr class="text-center">
                                                            <td class="text-center d-none"><input type="hidden" name="editID[]" id="prodID" value="{{ $other-> reservation_others_details }}">{{ $other-> reservation_others_details }}</td>
                                                            <td> {{ $other -> facilities_name }}</td>
                                                            <td class="text-center">
                                                                <input type="text" name="editQty[]" class="qty" value="{{ $other -> facilities_qty }}" data-value="{{ $other -> facilities_qty }}" readonly>
                                                            </td>
                                                            <td class="text-center">

                                                                <div class="btn-group-vertical btn-action">
                                                                    <a type="button" class="btn btn-info btn-edit"><span class="">&nbsp;&nbsp;</span>Edit Qty</a>
                                                                </div>

                                                                <div class="btn-group-vertical btn-action">
                                                                    <a type="button" class="btn btn-warning btn-pastvalue"><span class="">&nbsp;&nbsp;</span>Original Qty</a>
                                                                </div>

                                                                <div class="btn-group-vertical btn-edit-yes d-none">
                                                                    <a type="button" class="btn btn-info btn-yes"><span class="">&nbsp;&nbsp;</span>Yes</a>
                                                                    <a type="button" class="btn btn-danger btn-no"><span class="">&nbsp;&nbsp;</span>No</a>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="card col-md-12">
                                                <div class="card-header">
                                                    <h3 class="card-title">Added Facilities Details </h3>
                                                </div>
                                                <div class="card-body table-responsive table-striped p-0">
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr class="text-center">
                                                            <th>Additionals Details</th>
                                                            <th>Additionals Quantity</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="additionTable">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-success" type="submit" id="btnSubmit"> Edit Schedule </button>
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
    {{-- Footer --}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

            $('.input').attr('readonly', true);

            $('#scheduledPlace').attr('disabled', true);

            $('.btn-edit').on('click', function(){
                $(this).closest('tr').find('input,button').prop('readonly', false);
                $(this).closest('tr').find('button, .btn-edit-yes').removeClass('d-none');
                $(this).closest('tr').find('button, .btn-action').addClass('d-none');
            });

            $('.btn-no').on('click', function(){
                $(this).closest('tr').find('input,button').prop('readonly', true);
                $(this).closest('tr').find('button, .btn-edit-yes').addClass('d-none');
                $(this).closest('tr').find('button, .btn-action').removeClass('d-none');
            });

            $('.btn-pastvalue').on('click', function(){
                var oldprice = $(this).closest('tr').find('.qty').attr("data-value");
                $(this).closest('tr').find('.qty').val(oldprice);
            });



            $('.btn-yes').on('click', function(){
                $(this).closest('tr').find('.qty').removeAttr('value');
                var price = $(this).closest('tr').find('.qty').val();
                $(this).closest('tr').find('input,button').prop('readonly', true);
                $(this).closest('tr').find('button, .btn-edit-yes').addClass('d-none');
                $(this).closest('tr').find('button, .btn-action').removeClass('d-none');
                $(this).closest('tr').find('.qty').attr("value", price);
            });

            function add_additional(){

                var facText = $('#facilities option:selected').text();
                var facValue = $('#facilities option:selected').val();
                var facQty = $('#quantity').val();

                var details = "<tr class='text-center'>" +
                    "<td class='text-center'>" +facText+" <input type='hidden' name='additional[]' value='"+facValue+"'></td>" +
                    "<td class='text-center'>" +facQty+" <input type='hidden' name='qty[]' value='"+facQty+"'></td>" +
                    "<td width='5' class='text-center'><button type='button' class='form-control btn-danger btn btn-sm' id='remove'>-</button></td>"+
                    "</tr>";

                $('#additionTable').append(details);


            }

            $('#scheduledForm').submit(function(e){


                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type:"POST",
                    url: '{{ route('editApproval') }}',
                    data: formData, // get all form field value in serialize form
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(response){

                        if(response.status == "success"){
                            swal.fire("Schedule Successfully Added","","success").then(function(){
                                window.location.href = "{{ route('viewEmoList') }}"
                            });

                        }else{
                            alert("Schedule Not Added");
                        }

                    }
                });
                return false;
            });



            $('#additionalButton').on('click', function(){
                add_additional();
                $('#facilities').prop('selectedIndex', 0);
                $('#quantity').val("");
            });

            $(document).on('click', '#remove', function(){
                $(this).closest('tr').remove();
            })

        });

    </script>
@endsection
