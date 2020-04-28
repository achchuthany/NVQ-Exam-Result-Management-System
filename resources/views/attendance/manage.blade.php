@extends('layouts.master')
@section('title')
    Attendance Sessions
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder"> Attendance Sessions</h5>
            </div>
            <div class="col">
               
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('attendance.session',['mid'=>$module->id,'aid'=>$academic->id])}}">New</a>
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
                      <th scope="col" class="pl-4">Date</th>
                      <th scope="col">Time</th>
                      <th scope="col">Description</th>
                      <th scope="col">Percentage</th>
                      <th scope="col">
                          Actions
                      </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {{-- @foreach( $tvecexams as $tvecexam)
                          <tr data-did="{{$tvecexam->id}}">
                      
                              <td class="pl-4" data-toggle="tooltip" data-placement="top" title="{{$tvecexam->module->course->name}}" ><b>{{$tvecexam->module->code}}</b> {{$tvecexam->module->name}} <small class="text-primary">{{$exams[$tvecexam->exam_type]}}</small> </td>
                              <td><span data-toggle="tooltip" data-placement="top" title="{{$tvecexam->academic_year->status}}" class="{{($tvecexam->academic_year->status=='Active')? 'text-primary' : (($tvecexam->academic_year->status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span> {{$tvecexam->academic_year->name}}</td>
                              <td>{{$tvecexam->number_pass}} Pass  of {{$tvecexam->number_students}} 
                              </td>
                              <td>
                                <div class="progress">
                                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{($tvecexam->number_students == 0)? 0 : ($tvecexam->number_pass/$tvecexam->number_students)*100}}%" aria-valuenow="{{($tvecexam->number_students == 0)? 0 : ($tvecexam->number_pass/$tvecexam->number_students)*100}}" aria-valuemin="0" aria-valuemax="100">{{round(($tvecexam->number_students == 0)? 0 : ($tvecexam->number_pass/$tvecexam->number_students)*100)}}%</div>
                                </div>                </td>
                              <td>{{$tvecexam->exam_date}}</td>
                              <td>
                               <div class="dropdown dropleft" tabindex="1">
                                  <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-ellipsis-h"></i>
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="{{ route('tvec.exams.results',['id'=>$tvecexam->id]) }}"><i class="fas fa-graduation-cap"></i> Results</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item " href="{{ route('tvec.exams.results',['id'=>$tvecexam->id]) }}"><i class="far fa-edit"></i> Edit</a>
                                      <a class="dropdown-item text-danger" href="{{ route('tvec.exams.delete',['id'=>$tvecexam->id]) }}"><i class="far fa-trash-alt"></i> Delete</a>
                                  </div>
                              </div>                                                     
                              </td>
                          </tr>
                          @endforeach              --}}
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        <div class="pt-1 no-gutters row">
            <div class="col">
                {{-- <span>{{$tvecexams->firstItem()}} to {{$tvecexams->lastItem()}} of  {{$tvecexams->total()}}</span> --}}
            </div>
            <div class="col-auto">
                {{-- {{ $tvecexams->links() }} --}}
            </div>
        </div>
    </div>
</div> 
  <script>
    var token = '{{ Session::token() }}';
    var urlBatchesByCourse = '{{ route('ajax.batches') }}';  
  </script>
@endsection