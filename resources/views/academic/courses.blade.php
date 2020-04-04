@extends('layouts.master')
@section('title')
    Courses
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2"> Courses</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-sm btn-primary" href="{{route('courses.create')}}">New</a>
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
                <th scope="col">Department Name</th>
                <th scope="col">NVQ</th>
                <th scope="col">Duration</th>
                <th scope="col">OJT Duration</th>
                <th scope="col">
                    Actions
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach( $courses as $course)
              <tr data-cid="{{$course->id}}">
              <th scope="row">{{$course->code}}</th>
                <td>{{$course->name}}</td>
                <td>{{$course->department->name}}</td>
                <td>{{$course->nvq->name}}</td>
                <td>{{$course->duration}}</td>
                <td>{{$course->ojt_duration}}</td>
                <td>                    
                    <div class="btn-group" role="group">
                        <a type="button" class="btn btn-sm btn-secondary" href="{{ route('students.course',['id'=>$course->id]) }}">Students</a>
                        <a type="button" class="btn btn-sm btn-secondary" href="{{ route('modules.course',['id'=>$course->id]) }}">Modules</a>
                        <button type="button" class="btn btn-sm btn-warning course-edit">Edit</button>
                        <a type="button" class="btn btn-sm btn-danger" href="{{ route('courses.delete',['id'=>$course->id]) }}">Delete</a>
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
                Showing {{$courses->firstItem()}} to {{$courses->lastItem()}} of  {{$courses->total()}} entries
                </span>
              </li>
              <p>
              {{ $courses->links() }}
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
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="code">Course Code</label>
                        <input id="code" class="form-control" type="text" name="code" maxlength="20">
                    </div>
                  </div>
                    <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <label for="name">Course Name</label>
                                <input id="name" class="form-control" type="text" name="name">
                            </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="department_id">Department </label>
                            <select id="department_id" class="custom-select" name="department_id">
                                <option value="null" disabled selected>--Select Department--</option>
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach     
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="nvq_id">NVQ Level</label>
                            <select id="nvq_id" class="custom-select" name="nvq_id">
                                <option value="null" disabled selected>--Select NVQ Level--</option>
                                @foreach ($nvqs as $nvq)
                                    <option value="{{$nvq->id}}">{{$nvq->name}}</option>
                                @endforeach      
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