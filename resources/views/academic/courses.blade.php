@extends('layouts.master')
@section('title')
    Courses
@endsection
@section('content')

<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Courses</h5>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('courses.create')}}">New</a>
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
                    <th class="pl-4">{{$course->code}}</th>
                      <td>{{$course->name}}</td>
                      <td>{{$course->department->name}}</td>
                      <td>{{$course->nvq->name}}</td>
                      <td data-toggle="tooltip" data-placement="top" title="{{$course->duration}} Months">{{$course->duration}}</td>
                      <td data-toggle="tooltip" data-placement="top" title="{{$course->ojt_duration}} Months">{{$course->ojt_duration}}</td>
                      <td>                    
                          <div class="dropdown dropleft">
                            <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('students.course',['id'=>$course->id]) }}">Students</a>
                                <a class="dropdown-item" href="{{ route('modules.course',['id'=>$course->id]) }}">Modules</a>
                                <a  class="dropdown-item course-edit" href="#">Edit</a>
                                <a class="dropdown-item text-danger" href="{{ route('courses.delete',['id'=>$course->id]) }}">Delete</a>
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
                <span>{{$courses->firstItem()}} to {{$courses->lastItem()}} of  {{$courses->total()}}</span>
            </div>
            <div class="col-auto">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="courseEditModal" tabindex="-1" role="dialog" aria-labelledby="courseEditModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content bg-light">
        <div class="modal-header text-light bg-dark">
          <h5 class="modal-title" id="courseEditModal">Course</h5>
          <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
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
        <div class="modal-footer border-0">
          <button id="course_save" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('courses.edit') }}'; 
  </script>
@endsection