@extends('layouts.master')
@section('title')
Create a  TVEC Exams
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2">Create a  TVEC Exams</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-sm btn-dark" href="{{route('tvec.exams')}}">Back</a>
        </div>
    </div>
</div>

    
<form method="post" action="{{route('tvec.exams.create')}}">
    <div class="row align-items-center mt-2">
        <div class="col-md-6">
            <div class="form-group">
                <label for="code">Course</label>
                <select class="custom-select" id="course_id" name="course_id" required>
                    <option disabled selected >Select Course Name...</option>  
                    @foreach ($courses as $course)
                    <option value ="{{$course->id}}" >{{$course->name}}</option> 
                    @endforeach                 
                  </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="modules">Module</label>
                <select class="custom-select" id="modules" name="modules" required>
                    <option disabled selected >Select Course Name</option>  
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="academic_year_id">Academic Year</label>
                <select class="custom-select" id="academic_year_id" name="academic_year_id" required>
                    <option disabled selected >Select Academic Year</option>  
                    @foreach ($academicyears as $academicyear)
                <option value ="{{$academicyear->id}}" >{{$academicyear->name}} {{$academicyear->status}}</option> 
                    @endforeach                 
                  </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exam_type">Exam Type</label>
                <select class="custom-select" id="exam_type" name="exam_type" required>
                    <option disabled selected >Select Examination Type</option>
                    @foreach($exams as $id => $name) 
                    <option value ="{{$id}}" >{{$name}}</option> 
                    @endforeach
                  </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exam_date">Date</label>
                <input id="exam_date" class="form-control" type="date" name="exam_date" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exam_time">Time</label>
                <input id="exam_time" class="form-control" type="time" name="exam_time" >
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary float-right" >Save</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </div>
        </div>
    </div>
</form>

<script>
    var token = '{{ Session::token() }}';
    var urlModuleByCourse = '{{ route('ajax.modules') }}';
    
  </script>
@endsection