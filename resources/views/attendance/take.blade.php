@extends('layouts.master')
@section('title')
    Take Attendance
@endsection
@section('content')
<form method="post" action="{{route('attendance.take.create')}}">
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Take Attendance</h5>
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
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Module</h6>
            </div>
            <div class="col-4 py-1">
                 <h6 class="font-weight-lighter">{{$module->code}} - {{$module->name}}</h6>
            </div>
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Course</h6>
            </div>
            <div class="col-4 py-1">
                 <h6 class="font-weight-lighter">{{$module->course->code}} - {{$module->course->name}}</h6>
            </div>
             <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Date and Time</h6>
            </div>
            <div class="col-4 py-1">
                 <h6 class="font-weight-lighter">{{date_format(date_create($session->date),"D d/M/Y") }} - {{date_format(date_create($session->time_from),"H:iA") }}  {{date_format(date_create($session->time_to),"H:iA") }}</h6>
            </div>
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Academic Year</h6>
            </div>
            <div class="col-4 py-1">
                 <h6 class="font-weight-lighter">{{$academic->name}}</h6>
            </div>

            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Number of Presents</h6>
            </div>
            <div class="col-1 py-1">
                 <h6 class="font-weight-lighter">{{$session->present}}</h6>       
            </div>
            <div class="col-3 py-1">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{($session->present == 0)? 0 : ($session->present/($session->present+$session->absent))*100}}%" aria-valuenow="{{($session->present == 0)? 0 : ($session->present/($session->present+$session->absent))*100}}" aria-valuemin="0" aria-valuemax="100">{{round(($session->present == 0)? 0 : ($session->present/($session->present+$session->absent))*100)}}%</div>
                </div>                                    
            </div>

            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Number of Absents</h6>
            </div>
            <div class="col-4 py-1">
                 <h6 class="font-weight-lighter">{{$session->absent}}</h6>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover  mb-0">
                <thead class="thead-light">
                    <tr>
                    <th scope="col" class="pl-4">Reg. No</th>
                      <th scope="col">Fullname</th>
                      <th scope="col">Email</th>
                      <th scope="col">
                       <div class="custom-control custom-radio">
                        <input type="radio" id="allPresent" name="attendanceAll" class="custom-control-input" value="1">
                        <label class="custom-control-label" for="allPresent">Present</label>
                        </div>
                      </th>
                     <th scope="col">
                        <div class="custom-control custom-radio">
                        <input type="radio" id="allAbsent" name="attendanceAll" class="custom-control-input" value="0">
                        <label class="custom-control-label" for="allAbsent">Absent</label>
                        </div>
                      </th>
                     
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($students as $student)
                          <tr data-did="{{$student->id}}">
                              <th class="pl-4"> {{$student->reg_no}}</th>
                               <td>{{$student->fullname }}</td>
                                <td>{{$student->email }}</td>                             
                              <td>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="p{{$student->id}}" name="take[{{$student->id}}][]" value="1" class="custom-control-input" {{($student->hasAttend($session->id))? (($student->hasAttend($session->id)->is_present == 1)?'checked':'') :'' }}>
                                    <label class="custom-control-label" for="p{{$student->id}}">Present</label>
                                </div>                               
                              </td>
                              <td>
                               <div class="custom-control custom-radio">
                                    <input type="radio" id="a{{$student->id}}" name="take[{{$student->id}}][]" value="0" class="custom-control-input" {{($student->hasAttend($session->id))? (($student->hasAttend($session->id)->is_present == 0)?'checked':'') :'' }}>
                                    <label class="custom-control-label" for="a{{$student->id}}">Absent</label>
                                </div>   
                              </td>
                          </tr>
                          @endforeach             
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        <div class="pt-1 no-gutters row">
            <div class="col">           
            </div>
             <div class="ml-3 col-auto">
                <div class="form-group">
                    <input type="hidden" name="session_id" value="{{$session->id}}">
                    <button type="submit" class="btn btn-sm btn-primary" >Save</button>
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                </div>
            </div>
        </div>
    </div>
</div> 
</form>
@endsection