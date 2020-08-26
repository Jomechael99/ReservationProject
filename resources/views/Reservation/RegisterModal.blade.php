<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Registration Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                            <div class="alert alert-danger" style="display:none"></div>
                            <form id="studentForm" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">First name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Last name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Email Address</label>
                                        <input type="email" class="form-control" id="emailaddress" name="emailaddress" placeholder="name@example.com">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">User Type</label>
                                        <select class="form-control" id="studentType" name="userType">
                                            <option value=""> Choose option </option>
                                            <option value="1"> Staff </option>
                                            <option value="2"> Teacher </option>
                                            <option value="3"> Student </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Student Type</label>
                                        <select class="form-control" id="studentType" name="studentType">
                                            <option value=""> Choose option </option>
                                            <option value="1"> Elementary </option>
                                            <option value="2"> Highschool </option>
                                            <option value="3"> College </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Division</label>
                                        <select class="form-control" id="division" name="division">
                                            <option value=""> Choose option </option>
                                            @foreach($division as $data)
                                                <option value="{{ $data -> id }}"> {{ $data -> division_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Office</label>
                                        <select class="form-control" id="office" name="office">
                                            <option value=""> Choose option </option>
                                            @foreach($office as $data)
                                                <option value="{{ $data -> id }}"> {{ $data -> office_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Department</label>
                                        <select class="form-control" id="department" name="department">
                                            <option value=""> Choose option </option>
                                            @foreach($department as $data)
                                                <option value="{{ $data -> id }}"> {{ $data -> department_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Organization</label>
                                        <select class="form-control" id="organization" name="organization">
                                            <option value=""> Choose option </option>
                                            {{--@foreach($organization as $data)
                                                <option value="{{ $data -> id }}"> {{ $data -> organization_name }} </option>
                                            @endforeach--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" id="form_submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
