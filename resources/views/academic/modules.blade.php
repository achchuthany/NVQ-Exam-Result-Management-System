@extends('layouts.master')
@section('title')
    Modules
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Modules</h5>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('modules.create')}}">New</a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover  mb-0">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="pl-4">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Hours</th>
                        <th scope="col">Exam Type</th>
                        <th scope="col">Semester</th>
                        <th scope="col">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                   @foreach( $modules as $module)
                    <tr data-mid="{{$module->id}}">
                      <th class="pl-4">{{$module->code}}</th>        
                      <td>{{$module->name}}</td>        
                      <td>{{$module->course->name}}</td>
                      <td data-toggle="tooltip" data-placement="top" title="{{$module->learning_hours}} Notional Hours">{{$module->learning_hours}}</td>
                      <td>{{$exams["$module->exam_type"]}}</td>
                      <td>{{$semesters["$module->semester_id"]}}</td>
                      <td> 
                      <div class="dropdown dropleft">
                            <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item module-edit" href="#">Edit</a>
                                <a class="dropdown-item text-danger" href="{{ route('modules.delete',['id'=>$module->id]) }}">Delete</a>
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
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="courseEditModal" tabindex="-1" role="dialog" aria-labelledby="courseEditModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="courseEditModal">Course</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form >
                <div class="row align-items-center mt-2">
                    <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Course Name</label>
                                <input id="name" class="form-control" type="text" name="name">
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="department_id">Department </label>
                            <select id="department_id" class="custom-select" name="department_id">
                                <option value="null" disabled selected>--Select Department--</option>
                                   
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="nvq_id">NVQ Level</label>
                            <select id="nvq_id" class="custom-select" name="nvq_id">
                                <option value="null" disabled selected>--Select NVQ Level--</option>
                                   
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="duration">Duration (Months) </label>
                            <input id="duration" class="form-control" type="number" name="duration">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="ojt_duration">OJT Duration (Months)</label>
                            <input id="ojt_duration" class="form-control" type="number" name="ojt_duration">
                        </div>
                    </div>
                </div>
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="course_save" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

@include('includes.deletemodal')
  
  <script>
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('courses.edit') }}';
    
  </script>
@endsection