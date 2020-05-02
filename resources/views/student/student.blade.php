@extends('layouts.master')
@section('title')
    Add a Student
@endsection
@section('content')
<form method="post" action="{{route('students.create')}}">
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Add a Student</h5>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('students')}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2 form-group">
                <label for="title">Title: </label>
                <select name="title" id="title" class="custom-select" value="">
                    <option disabled="">Select Title</option>
                    <option value="Mr" {{(isset($student)&&!Request::old('title'))? (($student->title == 'Mr')? 'selected':'') : ( (Request::old('title') == 'Mr')? 'selected':'')}}>Mr</option>
                    <option value="Miss" {{(isset($student)&&!Request::old('title'))? (($student->title == 'Miss')? 'selected':'') : ( (Request::old('title') == 'Miss')? 'selected':'')}}>Miss</option>
                    <option value="Mrs" {{(isset($student)&&!Request::old('title'))? (($student->title == 'Mrs')? 'selected':'') : ( (Request::old('title') == 'Mrs')? 'selected':'')}}>Mrs</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label for="fullname"><span class="text-danger">*</span> Full Name: </label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="{{(isset($student)&&!Request::old('fullname'))? $student->fullname : Request::old('fullname')}}" required="">
                <input type="hidden" class="form-control" id="student_id" name="student_id" value="{{ (isset($student))? $student->id : "" }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="shortname"><span class="text-danger">*</span> Name with Initials: </label>
                <input type="text" class="form-control" id="shortname" name="shortname" value="{{(isset($student)&&!Request::old('shortname'))? $student->shortname : Request::old('shortname')}}"  required="">
            </div>
            <div class="col-md-2 form-group">
                <label for="custom-select"><span class="text-danger">*</span> Gender: </label>
                <select name="gender" id="gender" class="custom-select"  required="">
                    <option  disabled="">Select Gender</option>
                    <option value="Male" {{(isset($student)&&!Request::old('gender'))? (($student->gender == 'Male')? 'selected':'') : ( (Request::old('gender') =='Male')? 'selected':'')}}>Male</option>
                    <option value="Female" {{(isset($student)&&!Request::old('gender'))? (($student->gender == 'Female')? 'selected':'') : ( (Request::old('gender') =='Female')? 'selected':'')}}>Female</option>
                </select>
            </div>

            <div class="col-md-2 form-group">
                <label for="civil"> Civil Status: </label>
                <select name="civil" id="civil" class="custom-select" >
                    <option  disabled="">Select Status</option>
                    <option value="Single" {{(isset($student)&&!Request::old('civil'))? (($student->civil == "Single")? 'selected':'') : ( (Request::old('civil') =="Single")? 'selected':'')}}>Single</option>
                    <option value="Married" {{(isset($student)&&!Request::old('civil'))? (($student->civil == "Married")? 'selected':'') : ( (Request::old('civil') =="Married")? 'selected':'')}}>Married</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="email"><span class="text-danger">*</span> Email: </label>
                <div class="input-group-prepend">
                    <input type="email" class="form-control" id="email" name="email" value="{{(isset($student)&&!Request::old('email'))? $student->email : Request::old('email')}}" required="">
                </div>
            </div>

            <div class="col-md-2 form-group">
                <label for="nic"><span class="text-danger">*</span> NIC: </label>
                <input type="text" class="form-control" id="nic" name="nic" max="12" min="10" value="{{(isset($student)&&!Request::old('nic'))? $student->nic : Request::old('nic')}}" required="">
            </div>

            <div class="col-md-2 form-group">
                <label for="date_birth"><span class="text-danger">*</span> Date of Birth: </label>
                <input type="date" class="form-control" id="date_birth" name="date_birth" value="{{(isset($student)&&!Request::old('date_birth'))? $student->date_birth : Request::old('date_birth')}}" required="">
            </div>

            <div class="col-md-2 form-group">
                <label for="phone"><span class="text-danger">*</span> Phone No: </label>
                <input type="text" class="form-control" id="phone" name="phone" maxlength="10" minlength="10" value="{{(isset($student)&&!Request::old('phone'))? $student->phone : Request::old('phone')}}" required="">
            </div>

            <div class="col-md-6 form-group">
                <label for="address"><span class="text-danger">*</span> Address: </label>
                <input type="textarea" class="form-control" id="address" name="address" value="{{(isset($student)&&!Request::old('address'))? $student->address : Request::old('address')}}" required="">
            </div>
            <div class="col-md-2 form-group">
                <label for="zip"> ZIP-Code:</label>
                <input type="text" class="form-control" id="zip" name="zip" value="{{(isset($student)&&!Request::old('zip'))? $student->zip : Request::old('zip')}}" >
            </div>

            <div class="col-md-2 form-group">
                <label for="district"> District: </label>
                <select name="district" id="district" class="custom-select" >
                    <option disabled selected>Select District</option>
                    @foreach($districts as $district)
                    <option value="{{$district}}" {{(isset($student)&&!Request::old('district'))? (($student->district == $district)? 'selected':'') : ( (Request::old('district') ==$district)? 'selected':'')}}>{{$district}}</option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-2 form-group">
                <label for="divisional"> Divisional Secretariat: </label>
                <input type="text" name="divisional" class="form-control" id="divisional" value="{{(isset($student)&&!Request::old('divisional'))? $student->divisional : Request::old('divisional')}}">
            </div>

            <div class="col-md-2 form-group">
                <label for="province"> Province: </label>
                <select name="province" id="province" class="custom-select">
                    <option disabled selected>Select Province</option>
                    @foreach($provinces as $province)
                    <option value="{{$province}}" {{(isset($student)&&!Request::old('province'))? (($student->province == $province)? 'selected':'') : ( (Request::old('province') ==$province)? 'selected':'')}}>{{$province}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 form-group">
                <label for="blood"> Blood Group: </label>
                <select name="blood" id="blood" class="custom-select" value="">
                    <option selected="" disabled=""> Blood Group </option>
                    <option value="A+" {{(isset($student)&&!Request::old('blood'))? (($student->blood == "A+")? 'selected':'') : ( (Request::old('blood') =="A+")? 'selected':'')}}>A positive (A+) </option>
                    <option value="A-" {{(isset($student)&&!Request::old('blood'))? (($student->blood == "A-")? 'selected':'') : ( (Request::old('blood') =="A-")? 'selected':'')}}>A negative (A-) </option>
                    <option value="B+" {{(isset($student)&&!Request::old('blood'))? (($student->blood == "B+")? 'selected':'') : ( (Request::old('blood') =="B+")? 'selected':'')}}>B positive (B+) </option>
                    <option value="B-" {{(isset($student)&&!Request::old('blood'))? (($student->blood == "B-")? 'selected':'') : ( (Request::old('blood') =="B-")? 'selected':'')}}>B negative (B-) </option>
                    <option value="O+" {{(isset($student)&&!Request::old('blood'))? (($student->blood == "O+")? 'selected':'') : ( (Request::old('blood') =="O+")? 'selected':'')}}>O positive (O+) </option>
                    <option value="O-" {{(isset($student)&&!Request::old('blood'))? (($student->blood == "O-")? 'selected':'') : ( (Request::old('blood') =="O-")? 'selected':'')}}>O negative (O-) </option>
                    <option value="AB+" {{(isset($student)&&!Request::old('blood'))? (($student->blood == "AB+")? 'selected':'') : ( (Request::old('blood') =="AB+")? 'selected':'')}}>AB positive (AB+) </option>
                    <option value="AB-" {{(isset($student)&&!Request::old('blood'))? (($student->blood == "AB-")? 'selected':'') : ( (Request::old('blood') =="AB-")? 'selected':'')}}>AB negative (AB-) </option>
                </select>
            </div>
        </div>
    </div>
</div>


{{-- Edit Enrolled Courses--}}
@if(isset($enrolls))
    @foreach ($enrolls as $enroll)
        <div class="card mb-3">
            <div class="card-header bg-white">
                <div class="align-items-center row">
                    <div class="col">
                        <h5 class="mb-0">Enrolled Course #{{$enroll->id}}</h5>
                         <input type="hidden" class="form-control" value="{{(isset($enroll))? $enroll->id : ''}}" id="enroll_id" name="enroll_id[]" >
                    </div>
                    <div class="text-right col-auto">
                        <a type="button" class="btn btn-sm btn-outline-danger shadow-sm" href="">Disenroll</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="course_id"><span class="text-danger">*</span> Course Name: </label>
                        <select name="course_id[]" id="course_id" class="custom-select" required>
                            <option value="null" disabled>Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{$course->id}}" {{(isset($enroll)&&!Request::old('course_id'))? (($enroll->course_id == $course->id)? 'selected':'') : ( (Request::old('course_id') ==$course->id)? 'selected':'')}}>{{$course->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="academic_year_id"><span class="text-danger">*</span> Academic Year: </label>
                        <select name="academic_year_id[]" id="academic_year_id" class="custom-select" required>
                            <option value="null" disabled selected>Select Course</option>
                            @foreach ($academicyears as $academicyear)
                                <option value="{{$academicyear->id}}" {{(isset($enroll)&&!Request::old('academic_year_id'))? (($enroll->academic_year_id == $academicyear->id)? 'selected':'') : ( (Request::old('academic_year_id') ==$academicyear->id)? 'selected':'')}}>{{$academicyear->name}} ({{$academicyear->status}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="course_mode"><span class="text-danger">*</span> Course Mode: </label>
                        <select name="course_mode[]" id="course_mode" class="custom-select" required>
                            <option disabled selected>Select Mode</option>
                            @foreach($modes as $mode)
                            <option value="{{$mode}}" {{(isset($enroll)&&!Request::old('course_mode'))? (($enroll->course_mode == $mode)? 'selected':'') : ( (Request::old('course_mode') ==$mode)? 'selected':'')}}>{{$mode}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="reg_no"><span class="text-danger">*</span> Registration No.:</label>
                        <input type="text" pattern="[0-9]{4}[/][a-zA-Z]{3}[/][0-9a-zA-Z]{3}[0-9]{2}"  class="form-control" name="reg_no" value="{{(isset($student)&&!Request::old('reg_no'))? $student->reg_no : Request::old('reg_no')}}" id="reg_no" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="status"><span class="text-danger">*</span> Status:</label>
                        <select name="status[]" id="status" class="custom-select" value="" required>
                            @foreach($statuses as $status)
                            <option value="{{$status}}" {{(isset($enroll)&&!Request::old('status'))? (($enroll->status == $status)? 'selected':'') : ( (Request::old('status') ==$status)? 'selected':'')}}>{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="enroll_date"><span class="text-danger">*</span>Enroll Date:</label>
                        <input type="date" class="form-control" value="{{(isset($enroll)&&!Request::old('enroll_date'))? $enroll->enroll_date : Request::old('enroll_date')}}" id="enroll_date" name="enroll_date[]" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="completion_date">Exit Date:</label>
                        <input type="date" class="form-control" value="{{(isset($enroll)&&!Request::old('completion_date'))? $enroll->completion_date : Request::old('completion_date')}}" id="completion_date" name="completion_date[]" >
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

{{-- Create --}}
@if(!isset($student))
<div class="card mb-3">
     <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0">Enroll Course</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
       <div class="row">
            <div class="col-md-6 form-group">
                <label for="course_id"><span class="text-danger">*</span> Course Name: </label>
                <select name="course_id[]" id="course_id" class="custom-select" value="" required>
                    <option value="null" disabled selected>Select Course</option>
                    @foreach ($courses as $course)
                        <option value="{{$course->id}}" {{ (Request::old('course_id') ==$course->id)? 'selected':''}}>{{$course->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label for="academic_year_id"><span class="text-danger">*</span> Academic Year: </label>
                <select name="academic_year_id[]" id="academic_year_id" class="custom-select" required>
                <option value="null" disabled selected>Select Course</option>
                @foreach ($academicyears as $academicyear)
                    <option value="{{$academicyear->id}}" {{ (Request::old('academic_year_id') ==$academicyear->id)? 'selected':''}}>{{$academicyear->name}} ({{$academicyear->status}})</option>
                @endforeach    </select>
            </div>

            <div class="col-md-3 form-group">
                <label for="course_mode"><span class="text-danger">*</span> Course Mode: </label>
                <select name="course_mode[]" id="course_mode" class="custom-select" required>
                    <option disabled selected>Select Mode</option>
                    @foreach($modes as $mode)
                    <option value="{{$mode}}">{{$mode}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="reg_no"><span class="text-danger">*</span> Registration No.:</label>
                <input type="text" pattern="[0-9]{4}[/][a-zA-Z]{3}[/][0-9a-zA-Z]{3}[0-9]{2}" class="form-control" name="reg_no" value="" id="reg_no" required="">
            </div>
            <div class="col-md-3 form-group">
                <label for="status"><span class="text-danger">*</span> Status:</label>
                <select name="status[]" id="status" class="custom-select" value="" required="">
                    @foreach($statuses as $status)
                    <option value="{{$status}}">{{$status}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="enroll_date"><span class="text-danger">*</span>Enroll Date:</label>
            <input type="date" class="form-control" id="enroll_date" name="enroll_date[]" required="">
            </div>
            <div class="col-md-3 form-group">
                <label for="completion_date">Exit Date:</label>
                <input type="date" class="form-control" id="completion_date" name="completion_date[]" >
            </div>
        </div>
    </div>
</div>
@endif


<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0">Emergency Contact</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="emergency_name">Name :</label>
                <input type="text" class="form-control" id="emergency_name" name="emergency_name" value="{{(isset($student)&&!Request::old('emergency_name'))? $student->emergency_name  : Request::old('emergency_name')}}">
            </div>
            <div class="col-md-4 form-group">
                <label for="emergency_address">Address :</label>
                <input type="text" class="form-control" id="emergency_address" name="emergency_address" value="{{(isset($student)&&!Request::old('emergency_address'))? $student->emergency_address : Request::old('emergency_address')}}" >
            </div>
            <div class="col-md-2 form-group">
                <label for="emergency_phone">Phone No :</label>
                <input type="text" class="form-control" id="emergency_phone" maxlength="10" minlength="10" name="emergency_phone" value="{{(isset($student)&&!Request::old('emergency_phone'))? $student->emergency_phone : Request::old('emergency_phone')}}">
            </div>
            <div class="col-md-2 form-group">
                <label for="emergency_relationship">Relationship :</label>
                <select name="emergency_relationship" id="emergency_relationship"  class="custom-select">
                        <option disabled>Select Relationship</option>
                        <option value="Mother" {{(isset($student)&&!Request::old('emergency_relationship'))? (($student->emergency_relationship == "Mother")? 'selected':'') : ( (Request::old('emergency_relationship') =="Mother")? 'selected':'')}}> Mother </option>
                        <option value="Father" {{(isset($student)&&!Request::old('emergency_relationship'))? (($student->emergency_relationship == "Father")? 'selected':'') : ( (Request::old('emergency_relationship') =="Father")? 'selected':'')}}> Father </option>
                        <option value="Guardian" {{(isset($student)&&!Request::old('emergency_relationship'))? (($student->emergency_relationship == "Guardian")? 'selected':'') : ( (Request::old('emergency_relationship') =="Guardian")? 'selected':'')}}> Guardian </option>
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
</form>
@endsection
