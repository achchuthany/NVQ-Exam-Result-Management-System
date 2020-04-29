@extends('layouts.master')
@section('title')
    Attendance Report
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Attendance Report</h5>
            </div>
            <div class="col">
               
            </div>
            <div class="text-right col-auto">
                <a   class="btn btn-sm btn-outline-primary shadow-sm" href=" ">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
          <div class="row">
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Module</h6>
            </div>
            <div class="col-10 py-1">
                 <h6 class="font-weight-lighter">{{$module->code}} - {{$module->name}}</h6>
            </div>
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Course</h6>
            </div>
            <div class="col-10 py-1">
                 <h6 class="font-weight-lighter">{{$module->course->code}} - {{$module->course->name}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Teacher(s)</h6>
            </div>
            <div class="col-10 py-1">
                 <h6 class="font-weight-lighter">
                  @foreach( $employees as $employee)
                  {{$employee->fullname}}
                  @endforeach
                 </h6>
            </div>
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Academic Year</h6>
            </div>
            <div class="col-10 py-1">
                 <h6 class=ont-weight-lighter"><span class="{{($academic->status=='Active')? 'text-primary' : (($academic->status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span>{{$academic->name}}</h6>
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
                      <th scope="col">Sessions</th>
                      <th scope="col">Present</th>
                      <th scope="col">Absent</th>
                      <th scope="col">Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($attendances as $attendance)
                          <tr>
                              <th class="pl-4"> {{$attendance->student->reg_no}}</th>
                               <td>{{$attendance->student->fullname }}</td>
                                <td>{{$attendance->student->email }}</td> 
                                <td>{{$attendance->total }}</td>
                                <td>{{$attendance->present }}</td>
                                <td>{{($attendance->total-$attendance->present)}}</td>                             
                              <td>
                                <div class="progress">
                                    <span hidden> {{$per = round(($attendance->present == 0)? 0 : ($attendance->present/($attendance->total))*100)}}</span>
                                    <div class="progress-bar {{($per>=60 && $per<80)? 'bg-warning':(($per<60)?'bg-danger':'')}} " role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$per}}" aria-valuemin="0" aria-valuemax="100">{{$per}}%</div>
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

            </div>
        </div>
    </div>
</div> 
</form>
@endsection