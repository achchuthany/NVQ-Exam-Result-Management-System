@extends('layouts.master')
@section('title')
   Attendance Logs
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Attendance Student's Logs</h5>
            </div>
            <div class="col">
               
            </div>
            <div class="text-right col-auto">
                <a   class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('attendance.report',['mid'=>$module->id,'aid'=>$academic->id])}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
          <div class="row">
          <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Student Name</h6>
            </div>
            <div class="col-4 py-1">
                 <h6 class="font-weight-lighter">{{$student->reg_no}} - {{$student->fullname}}</h6>
            </div>

            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Module</h6>
            </div>
            <div class="col-4 py-1">
                 <h6 class="font-weight-lighter">{{$module->code}} - {{$module->name}}</h6>
            </div>
            
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Teacher(s)</h6>
            </div>
            <div class="col-4 py-1">
                 <h6 class="font-weight-lighter">
                  @foreach( $employees as $employee)
                  {{$employee->fullname}}
                  @endforeach
                 </h6>
            </div>
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Academic Year</h6>
            </div>
            <div class="col-4 py-1">
                 <h6 class=ont-weight-lighter"><span class="{{($academic->status=='Active')? 'text-primary' : (($academic->status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span>{{$academic->name}}</h6>
            </div>
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Course</h6>
            </div>
            <div class="col-10 py-1">
                 <h6 class="font-weight-lighter">{{$module->course->code}} - {{$module->course->name}}</h6>
            </div>
             <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Percentage </h6>
            </div>
            <div class="col-1 py-1">
                 <h6 class="font-weight-lighter">{{$attendance->present}}/{{$attendance->total}}</h6>
            </div>
            <div class="col-9 py-1">
                <div class="progress">
                    <span hidden> {{$per = round(($attendance->present == 0)? 0 : ($attendance->present/($attendance->total))*100)}}</span>
                    <div class="progress-bar {{($per>=60 && $per<80)? 'bg-warning':(($per<60)?'bg-danger':'')}} " role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$per}}" aria-valuemin="0" aria-valuemax="100">{{$per}}%</div>
                </div> 
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover  mb-0">
                <thead class="thead-light">
                    <tr>
                    <th scope="col" class="pl-4">ID</th>
                    <th scope="col">Date</th>
                      <th scope="col">Time</th>
                      <th scope="col">Description</th>
                      <th scope="col">Status</th>
                      <th scope="col">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                        <span hidden>{{$id = $logs->firstItem()}}</span>
                        @foreach($logs as $log)
                          <tr>
                              <th class="pl-4"> {{$id++}}</th>
                               <td>{{date_format(date_create($log->date),"D d/M/Y") }}</td>
                                <td>{{date_format(date_create($log->time_from),"H:iA") }} {{date_format(date_create($log->time_to),"H:iA") }} </td> 
                                <td>{{$log->description}} </td>
                                <td><span class="{{($log->is_present)? 'text-primary' :  'text-danger'}}"><i class="fas fa-check"></i></span> {{($log->is_present)?'Present':'Absent'}} </td>
                                <td>{{$log->remark}} </td>          
                          </tr>
                          @endforeach             
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        <div class="pt-1 no-gutters row">
            <div class="col">
                <span>{{$logs->firstItem()}} to {{$logs->lastItem()}} of  {{$logs->total()}}</span>     
            </div>
             <div class="col-auto">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div> 
</form>
@endsection