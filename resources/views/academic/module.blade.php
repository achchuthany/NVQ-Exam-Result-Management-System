@extends('layouts.master')
@section('title')
Create a Modle
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2">Create a Module</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-sm btn-dark" href="{{route('modules')}}">Back</a>
        </div>
    </div>
</div>
<form method="post" action="{{route('modules.create')}}">
  <div class="row">
    <div class="col-md-2 mb-3">
        <label for="code">Module Code</label>
        <input type="text" class="form-control" id="code" name="code" maxlength="20" required>
    </div>
      <div class="col-md-6 mb-3">
          <label for="modulename">Module Name</label>
          <input type="text" class="form-control" id="modulename" name="modulename" required>
      </div>
      <div class="col-md-4 mb-3">
          <label for="coursename">Course Name</label>
          <select class="custom-select d-block w-100" id="coursename" name="coursename" required>
          <option disabled selected >Select Course Name...</option>  
          @foreach ($courses as $course)
          <option value ="{{$course->id}}" >{{$course->name}}</option> 
          @endforeach                 
        </select>
      </div>
  </div>
  <div class="row">
      <div class="col-md-3 mb-3">
          <label for="notionalhours">Notional Hours</label>
          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text">Hrs</span>
              </div>
              <input type="text" class="form-control" id="notionalhours"  name="notionalhours" required>
          </div>
      </div>
      <div class="col-md-3 mb-3">
          <label for="lecturehours">Lecture Hours</label>
          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text">Hrs</span>
              </div>
              <input type="text" class="form-control" id="lecturehours"  name="lecturehours" required>
          </div>
      </div>
      <div class="col-md-3 mb-3">
          <label for="practicalhours">Practical & Site Visits</label>
          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text">Hrs</span>
              </div>
              <input type="text" class="form-control" id="practicalhours"  name="practicalhours"  required>
          </div>
      </div>
      <div class="col-md-3 mb-3">
          <label for="selfhours">Self Study</label>
          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text">Hrs</span>
              </div>
              <input type="text" class="form-control" id="selfhours" name="selfhours"  required>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-4 mb-3">
          <label for="semester">Semester</label>
          <select class="custom-select d-block w-100" id="semester" name="semester" required>
            <option disabled selected >Select Semester</option>
            @foreach($semesters as $id => $name) 
            <option value ="{{$id}}" >{{$name}}</option> 
            @endforeach
          </select>
      </div>
      <div class="col-md-4 mb-3">
        <label for="examtype">Examination Type</label>
        <select class="custom-select d-block w-100" id="examtype" name="examtype" required>
          <option disabled selected >Select Examination Type</option>
          @foreach($exams as $id => $name) 
          <option value ="{{$id}}" >{{$name}}</option> 
          @endforeach
        </select>
    </div>
      <div class="col-md-4 mb-3">
          <label for="relativeunit">Relative Unit(s)</label>
          <input type="text" class="form-control" id="relativeunit"  name="relativeunit" >
      </div>
  </div>
  <div class="row">
      <div class="col-md-3 mb-3">
          <label for="aim">Module aim</label>
          <textarea class="form-control" id="aim" rows="3" name="aim"></textarea>
      </div>
      <div class="col-md-3 mb-3">
          <label for="outcomes">Learning Outcomes</label>
          <textarea class="form-control" id="outcomes" rows="3" name="outcomes"></textarea>
      </div>
      <div class="col-md-3 mb-3">
          <label for="resources">Resources</label>
          <textarea class="form-control" id="resources" rows="3" name="resources" ></textarea>
      </div>
      <div class="col-md-3 mb-3">
          <label for="references">References</label>
          <textarea class="form-control" id="references" rows="3" name="references" ></textarea>
      </div>
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-sm btn-primary float-right" >Save</button>
       <input type="hidden" name="_token" value="{{Session::token()}}">
     </div>
    </div>
</form>
@endsection