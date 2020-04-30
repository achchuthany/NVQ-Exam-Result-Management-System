@extends('layouts.master')
@section('title')
    Attendances
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder"> Attendances</h5>
            </div>
            <div class="col">
               
            </div>
            <div class="col-auto">
            <form class="form-inline my-2 my-lg-0" action="{{route('attendances.batch')}}" method="POST">
                  <select class="custom-select custom-select-sm  col-8" name="batch_couese_id" id="batch_couese_id" required>
                    <option value="" selected>Select Course</option>
                      @foreach ($courses as $course)
                        <option value="{{$course->id}}" >{{$course->name}}</option>
                      @endforeach
                  </select>
                  <select class="custom-select custom-select-sm col-3" name="batch_id" id="batch_id" required>
                    <option value="" selected>Select Batch</option>
                  </select>
                  <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-search"></i></button>
                  <input type="hidden" name="_token" value="{{Session::token()}}">
              </form>
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
                          Actions
                      </th>                     
                    </tr>
                </thead>
                <tbody>
                
                    <tr>
                        <span hidden>{{$id = $modules->firstItem()}}</span>
                        @foreach( $modules as $module)
                          <tr >
                              <th class="pl-4">{{$id++}}</th>
                              <td>{{$module->module->code}} {{$module->module->name}}</td>
                              <td><span class="{{($module->academic_year->status=='Active')? 'text-primary' : (($module->academic_year->status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span>{{$module->academic_year->name }}  </td>
                               <td>{{$module->total}}</td>
                              <td>{{$module->present}}/{{($module->absent+$module->present)}}</td>
                              <td>
                                <div class="progress">
                                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{($module->present == 0)? 0 : ($module->present/($module->present+$module->absent))*100}}%" aria-valuenow="{{($module->present == 0)? 0 : ($module->present/($module->present+$module->absent))*100}}" aria-valuemin="0" aria-valuemax="100">{{round(($module->present == 0)? 0 : ($module->present/($module->present+$module->absent))*100)}}%</div>
                                </div>                
                              </td>
                              <td >
                               <div class="dropdown dropleft">
                                  <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-ellipsis-h"></i>
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="{{ route('attendance.manage',['mid'=>$module->module_id,'aid'=>$module->academic_year_id]) }}">Attendance Sessions</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item " href=""><i class="far fa-edit"></i> Edit</a>
                                      <a class="dropdown-item text-danger" href=""><i class="far fa-trash-alt"></i> Delete</a>
                                  </div>
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
                <span>{{$modules->firstItem()}} to {{$modules->lastItem()}} of  {{$modules->total()}}</span>
            </div>
            <div class="col-auto">
                {{ $modules->links() }}
            </div>
             <div class="ml-3 col-auto">
                
            </div>
        </div>
    </div>
</div> 
    <script>
    var token = '{{ Session::token() }}';
    var urlBatchesByCourse = '{{ route('ajax.batches') }}';
    
  </script>
@endsection