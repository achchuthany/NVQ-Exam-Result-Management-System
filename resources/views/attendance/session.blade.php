@extends('layouts.master')
@section('title')
   Add a Attendance Sessions
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Add a Attendance Sessions</h5>
            </div>
            <div class="col">             
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('attendance.manage',['mid'=>$module->id,'aid'=>$academic->id])}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-2">
                <h6 class="font-weight-bolder"> Module</h6>
            </div>
            <div class="col-10">
                 <h6 class="font-weight-lighter">{{$module->code}} - {{$module->name}}</h6>
            </div>
            <div class="col-2 pt-1">
                <h6 class="font-weight-bolder"> Course</h6>
            </div>
            <div class="col-10 pt-1">
                 <h6 class="font-weight-lighter">{{$module->course->code}} - {{$module->course->name}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-2 pt-1">
                <h6 class="font-weight-bolder"> Academic Year</h6>
            </div>
            <div class="col-10 pt-1">
                 <h6 class=ont-weight-lighter"><span class="{{($academic->status=='Active')? 'text-primary' : (($academic->status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span>{{$academic->name}}</h6>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
      <form method="post" action="{{route('attendance.session')}}">
      <div class="row">
          <div class="col-md-6">
            <h6 class="pb-3" > Add a session</h6>
              <div class="row form-group">
                    <div class="col-md-3">
                        <label for="date">Date</label>
                    </div>
                    <div class="col-md-4">
                        <input id="date" class="form-control" type="date" name="date">
                         <input id="module_id" class="form-control" type="text" name="module_id" value="{{$module->id}}">
                          <input id="academic_year_id" class="form-control" type="text" name="academic_year_id" value="{{$academic->id}}">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="time">Time</label>
                    </div>
                    <div class="col-4">
                        <label for="time_from">From</label>
                        <input id="time_from" class="form-control" type="time" name="time_from">
                    </div>
                    <div class="col-4">
                        <label for="time_to">To</label>
                        <input id="time_to" class="form-control" type="time" name="time_to">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <label for="description">Description</label>
                    </div>
                    <div class="col-8">
                        <input id="description" class="form-control" type="text" name="description">
                    </div>
                </div>
          </div>       
          <div class="col-md-6">
          <h6  class="pb-3" >Multiple sessions</h6>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="repeat">Repeat on</label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="repeats[]" value="Monday" id="Monday">
                            <label class="form-check-label" for="Monday">Monday</label>
                        </div>
                         <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="repeats[]" value="Tuesday" id="Tuesday">
                        <label class="form-check-label" for="Tuesday">Tuesday</label>
                        </div>
                         <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="repeats[]" value="Wednesday" id="Wednesday">
                        <label class="form-check-label" for="Wednesday">Wednesday</label>
                         </div>
                         <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="repeats[]" value="Thursday" id="Thursday">
                        <label class="form-check-label" for="Thursday">Thursday</label>
                        </div>
                         <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="repeats[]"  value="Friday" id="Friday">
                        <label class="form-check-label" for="Friday">Friday</label>
                        </div>
                         <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="repeats[]" value="Saturday" id="Saturday">
                        <label class="form-check-label" for="Saturday">Saturday</label>
                        </div>
                         <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="repeats[]" value="Sunday" id="Sunday">
                        <label class="form-check-label" for="Sunday">Sunday</label>
                    </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="repeat_date">Repeat until </label>
                    </div>
                    <div class="col-md-4">
                        <input id="repeat_date" class="form-control" type="date" name="repeat_date">
                    </div>
                </div>

          </div>
      </div>
        
            <div class="form-group">
               <button type="submit" class="btn btn-sm btn-primary float-right" >Save</button>
              <input type="hidden" name="_token" value="{{Session::token()}}">
            </div>
        </form>
    </div>
</div> 
@endsection