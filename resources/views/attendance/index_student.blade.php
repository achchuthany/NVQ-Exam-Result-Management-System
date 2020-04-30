@extends('layouts.master')
@section('title')
    Attendances
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder"> Attendances {{Auth::user()}}</h5>
            </div>
            <div class="col">
               
            </div>
            <div class="col-auto">
           
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover  mb-0">
                <thead class="thead-light">
                    <tr>
                    <th scope="col" class="pl-4">ID</th>
                      <th scope="col">Module</th>
                      <th scope="col">Academic Year</th>
                      <th scope="col">Sessions</th>
                      <th scope="col">Points</th>
                      <th scope="col">Percentage</th>
                      <th scope="col">
                          All Logs
                      </th>                     
                    </tr>
                </thead>
                <tbody>
                
                    <tr>
                        <span hidden>{{$id = $logs->firstItem()}}</span>
                        @foreach( $logs as $log)
                          <tr >
                              <th class="pl-4">{{$id++}}</th>
                              <td data-toggle="tooltip" data-placement="top" title="{{$log->module->course->name}}">{{$log->module->code}} {{$log->module->name}}</td>
                              <td><span class="{{($log->academic_year->status=='Active')? 'text-primary' : (($log->academic_year->status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span>{{$log->academic_year->name }}  </td>
                               <td>{{$log->present}}</td>
                              <td>{{$log->present}}/{{($log->total)}}</td>
                              <td>
                                <div class="progress">
                                    <span hidden> {{$per = round(($log->present == 0)? 0 : ($log->present/($log->total))*100)}}</span>
                                    <div class="progress-bar {{($per>=60 && $per<80)? 'bg-warning':(($per<60)?'bg-danger':'')}} " role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$per}}" aria-valuemin="0" aria-valuemax="100">{{$per}}%</div>
                                </div>                  
                              </td>
                           
                              <td><a href="{{ route('student.attendance.view',['sid'=>'6','mid'=>$log->module->id,'aid'=>$log->academic_year->id]) }}">All Logs</a></td> 

                                                                     
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
                <span>{{$logs->firstItem()}} to {{$logs->lastItem()}} of  {{$logs->total()}}</span>
            </div>
            <div class="col-auto">
                {{ $logs->links() }}
            </div>
             <div class="ml-3 col-auto">
                
            </div>
        </div>
    </div>
</div> 
@endsection