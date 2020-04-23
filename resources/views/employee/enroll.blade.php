@extends('layouts.master')
@section('title')
    Enroll  Modules
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Enroll  Module</h5>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('employees.enroll')}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{route('employees.enroll.create')}}">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="employee"><span class="text-danger">*</span> Employee: </label>
                    <select name="employee" id="employee" class="custom-select" required>
                        <option selected="" disabled="">Select Employee</option>
                        @foreach($employees as $employee)
                    <option value="{{$employee->id}}">{{$employee->fullname}} ({{$employee->epf}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="academic_year_id"><span class="text-danger">*</span> Academic Year: </label>
                    <select name="academic_year_id" id="academic_year_id" class="custom-select" required>
                        <option selected="" disabled="">Select Academic Year</option>
                        @foreach($academic_years as $academic_year)
                        <option value="{{$academic_year->id}}">{{$academic_year->name}} ({{$academic_year->status}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="course_id"><span class="text-danger">*</span> Course: </label>
                    <select name="course_id" id="course_id" class="custom-select" required>
                        <option selected="" disabled="">Select Course</option>
                        @foreach($courses as $course)
                        <option value="{{$course->id}}">({{$course->code}}) {{$course->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="modules"><span class="text-danger">*</span> Module: </label>
                    <select name="modules" id="modules" class="custom-select" required>
                        <option selected="" disabled="">Select Course</option>
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
            </form>
    </div>
</div>

<script>
    var token = '{{ Session::token() }}';
    var urlModuleByCourse = '{{ route('ajax.modules') }}';
</script>
@endsection