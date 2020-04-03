@extends('layouts.master')
@section('title')
Create a Batch
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2">Create a Batch</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-sm btn-dark" href="{{route('batches')}}">Back</a>
        </div>
    </div>
</div>
<form method="post" action="{{route('batches.create')}}">
<div class="row align-items-center mt-2">

            <div class="form-group col-md-4">
                <label for="name">Batch Name</label>
                <input id="name" class="form-control" type="text" name="name" placeholder="Batch 01" pattern="[Batch]{5}[\s]{1}[0-9]{2}" required>
            </div>
            <div class="form-group col-md-4">
                <label for="course_id">Course</label>
                <select id="course_id" class="custom-select" name="course_id" required>
                    <option value="null" disabled selected>--Select Course--</option>
                    @foreach ($courses as $course)
                        <option value="{{$course->id}}">{{$course->name}}</option>
                    @endforeach     
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="academic_year_id">Academic Year</label>
                <select id="academic_year_id" class="custom-select" name="academic_year_id" required>
                    <option value="null" disabled selected>--Select Academic Year--</option>
                    @foreach ($academicyears as $academicyear)
                        <option value="{{$academicyear->id}}">{{$academicyear->name}}</option>
                    @endforeach     
                </select>
            </div>
            <div class="form-group col-md-12">
               <button type="submit" class="btn btn-sm btn-primary float-right" >Save</button>
              <input type="hidden" name="_token" value="{{Session::token()}}">
            </div>

</div>
</form>
@endsection