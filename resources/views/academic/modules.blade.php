@extends('layouts.master')
@section('title')
    Modules
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2"> Modules</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-sm btn-primary" href="{{route('modules.create')}}">New</a>
        </div>
    </div>
</div>
<div class="row align-items-center mt-2">
    <div class="col-12 table-responsive">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Course Name</th>
                <th scope="col">Learning Hours</th>
                <th scope="col">Exam Type</th>
                <th scope="col">Semester</th>
                <th scope="col">
                    Actions
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach( $modules as $module)
              <tr>
                <th>{{$module->code}}</th>        
                <td>{{$module->name}}</td>        
                <td>{{$module->course->name}}</td>
                <td>{{$module->learning_hours}}</td>
                <td>{{$exams["$module->exam_type"]}}</td>
                <td>{{$semesters["$module->semester_id"]}}</td>
                <td>                    
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-warning course-edit">Edit</button>
                    <a type="button" class="btn btn-sm btn-danger" href="{{ route('modules.delete',['id'=>$module->id]) }}">Delete</a>
                </div>
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          <nav>
            <ul class="pagination pagination-sm justify-content-end">
              <li class="page-item">
                <span class="page-link">
                Showing {{$modules->firstItem()}} to {{$modules->lastItem()}} of  {{$modules->total()}} entries
                </span>
              </li>
              <p>
              {{ $modules->links() }}
              </p>
            </ul>
          </nav>
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