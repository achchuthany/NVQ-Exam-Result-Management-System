@extends('layouts.master')
@section('title')
    Create a Student
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2"><i class="fab fa-apple"></i>Create a Students</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-sm btn-dark" href="{{route('students')}}">Back</a>
        </div>
    </div>
</div>
<form method="post" action="{{route('students.create')}}">
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Enroll </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Emergency Contact</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row mt-3">
                    <div class="col-md-2 form-group">
                        <label for="title">Title: </label>
                        <select name="title" id="title" class="custom-select" value="">
                            <option selected="" disabled="">Select Title</option>
                            <option value="Mr">Mr</option> 
                            <option value="Miss">Miss</option>
                            <option value="Mrs">Mrs</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="fullname"><span class="text-danger">*</span> Full Name: </label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="" required="">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="shortname"><span class="text-danger">*</span> Name with Initials: </label>
                        <input type="text" class="form-control" id="shortname" name="shortname" value=""  required="">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="custom-select"><span class="text-danger">*</span> Gender: </label>
                        <select name="gender" id="gender" class="custom-select" value="" required="">
                            <option selected="" disabled="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="civil"> Civil Status: </label>
                        <select name="civil" id="civil" class="custom-select" value="" >
                            <option selected="" disabled="">Select Status</option>
                            <option value="Single">Single</option> 
                            <option value="Married">Married</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="email"><span class="text-danger">*</span> Email: </label>
                        <div class="input-group-prepend">
                            <input type="email" class="form-control" id="email" name="email" value="" placeholder="nimal89@gmail.com" required="">
                        </div>
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="nic"><span class="text-danger">*</span> NIC: </label>
                        <input type="text" class="form-control" id="nic" name="nic" max="12" min="10" value="" placeholder="" required="">
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="date_birth"><span class="text-danger">*</span> Date of Birth: </label>
                        <input type="date" class="form-control" id="date_birth" name="date_birth" value="" placeholder="" required="">
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="phone"><span class="text-danger">*</span> Phone No: </label>
                        <input type="text" class="form-control" id="phone" name="phone" maxlength="10" minlength="10" value="" placeholder="" required="">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="address"><span class="text-danger">*</span> Address: </label>
                        <input type="textarea" class="form-control" id="address" name="address" value="" placeholder="No, Street, Hometown." required="">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="zip"> ZIP-Code:</label>
                        <input type="text" class="form-control" id="zip" name="zip" value="" >
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="district"> District: </label>
                        <select name="district" id="district" class="custom-select" >
                            <option disabled selected>Select District</option>
                            @foreach($districts as $district)
                            <option value="{{$district}}">{{$district}}</option>
                            @endforeach
               
                        </select>
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="ds"> Divisional Secretariat: </label>
                        <input type="text" name="ds" class="form-control" id="ds" value="" >
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="province"> Province: </label>
                        <select name="province" id="province" class="custom-select" value="" >
                            <option disabled selected>Select Province</option>
                            @foreach($provinces as $province)
                            <option value="{{$province}}">{{$province}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 form-group">
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
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="course_id"><span class="text-danger">*</span> Course Name: </label>
                        <select name="course_id" id="course_id" class="custom-select" value="" required>
                            <option value="null" disabled selected>Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{$course->id}}">{{$course->name}}</option>
                            @endforeach    
                        </select>
                    </div>
                
                    <div class="col-md-3 form-group">
                        <label for="academic_year_id"><span class="text-danger">*</span> Academic Year: </label>
                       <select name="academic_year_id" id="academic_year_id" class="custom-select" data-live-search="true" data-width="100%" value="" required="" tabindex="-98">
                        <option value="null" disabled selected>Select Course</option>
                        @foreach ($academicyears as $academicyear)
                            <option value="{{$academicyear->id}}">{{$academicyear->name}} ({{$academicyear->status}})</option>
                        @endforeach    </select>
                    </div>
                
                    <div class="col-md-2 form-group">
                        <label for="course_mode"><span class="text-danger">*</span> Course Mode: </label>
                        <select name="course_mode" id="course_mode" class="custom-select" value="" required="">
                            <option disabled selected>Select Mode</option>
                            @foreach($modes as $mode)
                            <option value="{{$mode}}">{{$mode}}</option>
                            @endforeach
                     </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="reg_no"><span class="text-danger">*</span> Registration No.:</label>
                        <input type="text" class="form-control" name="reg_no" value="" id="reg_no" required="">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="status"><span class="text-danger">*</span> Status:</label>
                        <select name="status" id="status" class="custom-select" value="" required="">
                            @foreach($statuses as $status)
                            <option value="{{$status}}">{{$status}}</option>
                            @endforeach
                      </select> 
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="enroll_date"><span class="text-danger">*</span>Enroll Date:</label>
                    <input type="date" class="form-control" value="{{date("m/d/yy")}}" id="enroll_date" name="enroll_date" placeholder="" aria-describedby="enrolldatePrepend" required="">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="exitdate">Exit Date:</label>
                        <input type="date" class="form-control" value="" id="exitdate" name="exitdate" >
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="Ename">Name :</label>
                        <input type="text" class="form-control" id="Ename" name="Ename" value="">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="addressE">Address :</label>
                        <input type="text" class="form-control" id="addressE" name="addressE" value="" >
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="Ephone">Phone No :</label>
                        <input type="text" class="form-control" id="Ephon" maxlength="10" minlength="10" name="Ephone" value="">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="relation">Relationship :</label>
                        <select name="relation" id="relation" value="" class="custom-select">
                              <option value="">Select</option>
                              <option value="mother"> Mother </option>
                              <option value="father"> Father </option>
                              <option value="guardian"> Guardian </option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary float-right" >Save</button>
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection