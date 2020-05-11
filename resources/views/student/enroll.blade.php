@extends('layouts.master')
@section('title')
    Enroll a New Course
@endsection
@section('content')
    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="align-items-center row">
                <div class="col">
                    <h5 class="mb-0 font-weight-bolder">Enroll a New Course - {{$student->fullname}}</h5>
                </div>
                <div class="text-right col-auto">
                    <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('students')}}">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('students.enroll.create')}}">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="course_id"><span class="text-danger">*</span> Course Name: </label>
                        <select name="course_id" id="course_id" class="custom-select" value="" required>
                            <option value="null" disabled selected>Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{$course->id}}" {{ (Request::old('course_id') ==$course->id)? 'selected':''}}>{{$course->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="academic_year_id"><span class="text-danger">*</span> Academic Year: </label>
                        <select name="academic_year_id" id="academic_year_id" class="custom-select" required>
                            <option value="null" disabled selected>Select Course</option>
                            @foreach ($academicyears as $academicyear)
                                <option value="{{$academicyear->id}}" {{ (Request::old('academic_year_id') ==$academicyear->id)? 'selected':''}}>{{$academicyear->name}} ({{$academicyear->status}})</option>
                            @endforeach    </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="course_mode"><span class="text-danger">*</span> Course Mode: </label>
                        <select name="course_mode" id="course_mode" class="custom-select" required>
                            <option disabled selected>Select Mode</option>
                            @foreach($modes as $mode)
                                <option value="{{$mode}}">{{$mode}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="reg_no"><span class="text-danger">*</span> Registration No.:</label>
                        <input type="text" pattern="[0-9]{4}[/][a-zA-Z]{3}[/][0-9a-zA-Z]{3}[0-9]{2}" class="form-control" name="reg_no" value="{{$student->reg_no}}" id="reg_no" required="" readonly>
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
                        <input type="date" class="form-control" id="enroll_date" name="enroll_date" required="">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="completion_date">Exit Date:</label>
                        <input type="date" class="form-control" id="completion_date" name="completion_date" >
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary float-right" >Save</button>
                        <input type="hidden" name="student_id" value="{{$student->id}}">
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
