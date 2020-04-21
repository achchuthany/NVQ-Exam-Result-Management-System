@extends('layouts.master')
@section('title')
Add a Module
@endsection
@section('content')
<form method="post" action="{{route('modules.create')}}">
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Add a Module</h5>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('modules')}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2 mb-3">
                <label for="code"><span class="text-danger">*</span> Module Code</label>
                <input type="hidden" class="form-control" id="id" name="id" value="{{(isset($module))? $module->id : ''}}">
                <input type="text" class="form-control" id="code" name="code" maxlength="20" value="{{(isset($module)&&!Request::old('code'))? $module->code : Request::old('code')}}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="modulename"><span class="text-danger">*</span> Module Name</label>
                <input type="text" class="form-control" id="modulename" name="modulename" value="{{(isset($module)&&!Request::old('modulename'))? $module->name : Request::old('modulename')}}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="coursename"><span class="text-danger">*</span> Course Name</label>
                <select class="custom-select d-block w-100" id="coursename" name="coursename" required>
                <option disabled selected >Select Course Name...</option>  
                @foreach ($courses as $course)
                <option value ="{{$course->id}}" {{(isset($module)&&!Request::old('coursename'))? (($module->course_id == $course->id)? 'selected':'') : ( (Request::old('coursename') ==$course->id)? 'selected':'')}}>{{$course->name}}</option> 
                @endforeach                 
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
          <div class="row">
            <div class="col-md-3 mb-3">
                <label for="notionalhours"><span class="text-danger">*</span> Notional Hours</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">N.Hrs</span>
                    </div>
                    <input type="text" class="form-control" id="notionalhours"  name="notionalhours" value="{{(isset($module)&&!Request::old('notionalhours'))? $module->learning_hours  : Request::old('notionalhours')}}" required>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="lecturehours"><span class="text-danger">*</span> Lecture Notional Hours</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">N.Hrs</span>
                    </div>
                    <input type="text" class="form-control" id="lecturehours"  name="lecturehours" value="{{(isset($module)&&!Request::old('lecturehours'))? $module->lecture_hours   : Request::old('lecturehours')}}" required>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="practicalhours"><span class="text-danger">*</span> Practical/Site Visits Notional Hours</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">N.Hrs</span>
                    </div>
                    <input type="text" class="form-control" id="practicalhours"  name="practicalhours"  value="{{(isset($module)&&!Request::old('practicalhours'))? $module->practical_hours   : Request::old('practicalhours')}}" required>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="selfhours"><span class="text-danger">*</span> Self Study Notional Hours</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">N.Hrs</span>
                    </div>
                    <input type="text" class="form-control" id="selfhours" name="selfhours"  value="{{(isset($module)&&!Request::old('selfhours'))? $module->self_study_hours   : Request::old('selfhours')}}" required>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
          <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="semester"><span class="text-danger">*</span> Semester</label>
                    <select class="custom-select d-block w-100" id="semester" name="semester" required>
                        <option disabled>Select Semester</option>
                        @foreach($semesters as $id => $name) 
                        <option value ="{{$id}}" {{(isset($module)&&!Request::old('semester'))? (($module->semester_id  == $id)? 'selected':'') : ( (Request::old('semester') ==$id)? 'selected':'')}}>{{$name}}</option> 
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="examtype"><span class="text-danger">*</span> Examination Type</label>
                    <select class="custom-select d-block w-100" id="examtype" name="examtype" required>
                    <option disabled>Select Examination Type</option>
                    @foreach($exams as $id => $name) 
                    <option value ="{{$id}}" {{(isset($module)&&!Request::old('examtype'))? (($module->exam_type  == $id)? 'selected':'') : ( (Request::old('examtype') ==$id)? 'selected':'')}}>{{$name}}</option> 
                    @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="relativeunit">Relative Unit(s)</label>
                    <input type="text" class="form-control" id="relativeunit"  name="relativeunit" value="{{(isset($module)&&!Request::old('relativeunit'))? $module->relative_units   : Request::old('relativeunit')}}">
                </div>
            </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
          <div class="row">
            <div class="col-md-12 mb-3">
                <label for="aim">Module Aim(s)</label>
                <textarea class="form-control" id="aim" rows="3" name="aim">{{(isset($module)&&!Request::old('aim'))? $module->aim  : Request::old('aim')}}</textarea>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="resources">Resources</label>
                <textarea class="form-control" id="resources" rows="3" name="resources" >{{(isset($module)&&!Request::old('resources'))? $module->resources  : Request::old('resources')}}</textarea>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 mb-3">
                 <label for="references">References</label>
                <textarea class="form-control" id="references" rows="3" name="references" >{{(isset($module)&&!Request::old('references'))? $module->reference   : Request::old('references')}}</textarea>
            </div>
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-sm btn-primary float-right" >Save</button>
                 <input type="hidden" name="_token" value="{{Session::token()}}">
            </div>
        </div>
    </div>
</div>
</form>
@endsection