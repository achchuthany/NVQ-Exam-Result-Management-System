@extends('layouts.master')
@section('title')
    Add a Employee
@endsection
@section('content')
<form method="post" action="{{route('employees.create')}}">
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Add a Employee</h5>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('employees')}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
            <div class="row">
                <div class="col-md-2 form-group">
                    <label for="title">Title: </label>
                    <select name="title" id="title" class="custom-select" required>
                        <option selected="" disabled="">Select Title</option>
                        <option value="Mr">Mr</option> 
                        <option value="Miss">Miss</option>
                        <option value="Mrs">Mrs</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="fullname"><span class="text-danger">*</span> Full Name: </label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="" required>
                </div>
                <div class="col-md-4 form-group">
                    <label for="shortname"><span class="text-danger">*</span> Name with Initials: </label>
                    <input type="text" class="form-control" id="shortname" name="shortname" value=""  required="">
                </div>
                <div class="col-md-3 form-group">
                    <label for="custom-select"><span class="text-danger">*</span> Gender: </label>
                    <select name="gender" id="gender" class="custom-select" value="" required="">
                        <option selected="" disabled="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="civil"> Civil Status: </label>
                    <select name="civil" id="civil" class="custom-select" value="" >
                        <option selected="" disabled="">Select Status</option>
                        <option value="Single">Single</option> 
                        <option value="Married">Married</option>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="date_birth"><span class="text-danger">*</span> Date of Birth: </label>
                    <input type="date" class="form-control" id="date_birth" name="date_birth" value="" placeholder="" required="">
                </div>
                <div class="col-md-3 form-group">
                    <label for="email"><span class="text-danger">*</span> Email: </label>
                    <div class="input-group-prepend">
                        <input type="email" class="form-control" id="email" name="email" value="" placeholder="nimal89@gmail.com" required="">
                    </div>
                </div>
                <div class="col-md-3 form-group">
                    <label for="phone"><span class="text-danger">*</span> Phone No: </label>
                    <input type="text" class="form-control" id="phone" name="phone" maxlength="10" minlength="10" value="" placeholder="" required="">
                </div>
                <div class="col-md-3 form-group">
                    <label for="province"> Province: </label>
                    <select name="province" id="province" class="custom-select" value="" >
                        <option disabled selected>Select Province</option>
                        @foreach($provinces as $province)
                        <option value="{{$province}}">{{$province}}</option>
                        @endforeach
                    </select>
                </div>  
                <div class="col-md-6 form-group">
                    <label for="address"><span class="text-danger">*</span> Address: </label>
                    <input type="textarea" class="form-control" id="address" name="address" value="" placeholder="No, Street, Hometown." required="">
                </div>
                
                <div class="col-md-3 form-group">
                    <label for="zip"> ZIP-Code:</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="" >
                </div>
                <div class="col-md-3 form-group">
                    <label for="district"> District: </label>
                    <select name="district" id="district" class="custom-select" >
                        <option disabled selected>Select District</option>
                        @foreach($districts as $district)
                        <option value="{{$district}}">{{$district}}</option>
                        @endforeach
            
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="ds"> Divisional Secretariat: </label>
                    <input type="text" name="ds" class="form-control" id="ds" value="" >
                </div>
                
                <div class="col-md-3 form-group">
                    <label for="blood"> Blood Group: </label>
                    <select name="blood" id="blood" class="custom-select" value="">
                        <option selected="" disabled=""> Blood Group </option>
                        <option value="A+">A RhD positive (A+) </option>
                        <option value="A-">A RhD negative (A-) </option>
                        <option value="B+">B RhD positive (B+) </option>
                        <option value="B-">B RhD negative (B-) </option>
                        <option value="O+">O RhD positive (O+) </option>
                        <option value="O-">O RhD negative (O-) </option>
                        <option value="AB+">AB RhD positive (AB+) </option>
                        <option value="AB-">AB RhD negative (AB-) </option> 
                    </select>
                </div>
            </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="department_id"><span class="text-danger">*</span> Department Name: </label>
                <select name="department_id" id="department_id" class="custom-select" value="" required>
                                <option value="null" disabled selected>Select Department</option>
                                @foreach ($departments as $separtment)
                                    <option value="{{$separtment->id}}">{{$separtment->name}}</option>
                                @endforeach    
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="position"><span class="text-danger">*</span> Position:</label>
                <select name="position" id="position" class="custom-select" value="" required="">
                                <option selected="" disabled=""> Select Position </option>
                                @foreach($positions as $position)
                                <option value="{{$position}}">{{$position}}</option>
                                @endforeach
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="position_type"><span class="text-danger">*</span> Position Type: </label>
                <select name="position_type" id="position_type" class="custom-select" value="" required="">
                                <option disabled selected>Select Mode</option>
                                @foreach($modes as $mode)
                                <option value="{{$mode}}">{{$mode}}</option>
                                @endforeach
                            </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="epf"><span class="text-danger">*</span> EPF No.:</label>
                <input type="text" class="form-control" name="epf" value="" id="epf" required="">
            </div>
            <div class="col-md-4 form-group">
                <label for="nic"><span class="text-danger">*</span> NIC: </label>
                <input type="text" class="form-control" id="nic" name="nic" max="12" min="10" value="" placeholder="" required="">
            </div>
            <div class="col-md-4 form-group">
                <label for="date_join"><span class="text-danger">*</span> Date of Join:</label>
                <input type="date" class="form-control" value="" id="date_join" name="date_join" required>
            </div>
            <div class="col-md-4 form-group">
                <label for="date_end">Date of Exit :</label>
                <input type="date" class="form-control" value="" id="date_end" name="date_end">
            </div>
            <div class="col-md-4 form-group">
                <label for="status"><span class="text-danger">*</span> Status:</label>
                <select name="status" id="status" class="custom-select" value="" required="">
                                @foreach($statuses as $status)
                                <option value="{{$status}}">{{$status}}</option>
                                @endforeach
                </select>
            </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary float-right" >Save</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </div>
        </div>
    </div>
    </div>
</div>
</form>
@endsection