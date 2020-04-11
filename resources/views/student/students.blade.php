@extends('layouts.master')
@section('title')
    Students
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-md-4 col-xs-12">
    <h4 class="pt-2"> Students
      @if(Request::is('students/batch/*'))
      <span class="badge badge-pill badge-light"> Batch View </span>
      @endif
      @if(Request::is('students/course/*'))
      <span class="badge badge-pill badge-light"> Course View </span>
      @endif
      @if(Request::is('students/academic/*'))
      <span class="badge badge-pill badge-light"> Academic Year View </span>
      @endif
      @if(Request::is('students'))
      <span class="badge badge-pill badge-light"> All </span>
      @endif
    </div>
    <div class="col-md-8 col-xs-12">
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-sm btn-primary" href="{{route('students.create')}}">New</a>
      </div>
        <div class="btn-group float-right mx-2" role="group">
          <input type="text" class="form-control form-control-sm" placeholder="Registration No.">
        <button type="button" class="btn btn-sm btn-primary">Search</button>
        </div>
    </div>
</div>
<div class="row align-items-center mt-2">
    <div class="col-12 table-responsive">
        <table class="table table-sm table-hover table-borderless">
            <thead>
              <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Student Name</th>
                <th scope="col">Enrolled Course</th>
                <th scope="col">Batch</th>
                <th scope="col">Contact Number</th>
                <th scope="col">
                    Actions
                </th>
              </tr>
            </thead>
            <tbody>
              
              @foreach( $students as $student)
            <tr data-did="{{$student->id}}">
                <th scope="row">{{$student->reg_no}}</th>
                <td>{{$student->fullname}}</td>
                <td>{{$student->student_enroll->course->name}}</td>
                <td>{{App\Batch:: where([['academic_year_id','=' ,$student->student_enroll->academic_year_id],['course_id','=' ,$student->student_enroll->course_id]])->first()->name}}</td>
                <td>{{$student->phone}}</td>
                <td>                    
                    <div class="btn-group" role="group">
                      <a type="button" class="btn btn-sm btn-secondary" href="{{ route('tvec.results.student',['bid'=>App\Batch:: where([['academic_year_id','=' ,$student->student_enroll->academic_year_id],['course_id','=' ,$student->student_enroll->course_id]])->first()->id,'id'=>$student->id]) }}">TVEC Transcript</a>

                        <button type="button" class="btn btn-sm btn-warning department-edit">Edit</button>
                        <a type="button" class="btn btn-sm btn-danger" href="{{ route('students.delete',['id'=>$student->id]) }}">Delete</a>
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
                Showing {{$students->firstItem()}} to {{$students->lastItem()}} of  {{$students->total()}} entries
                </span>
              </li>
              <p>
              {{ $students->links() }}
              </p>
            </ul>
          </nav>
    </div>
</div>
 
  <!-- Modal -->
  <div class="modal fade" id="departmentEditModal" tabindex="-1" role="dialog" aria-labelledby="departmentEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="departmentEditModal">Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col">
                  <form method="post" action="">
                    <div class="form-group">
                      <label for="code">Department Code</label>
                      <input id="code" class="form-control" type="text" name="code" maxlength="3">
                      </div>
                      <div class="form-group">
                          <label for="d_name">Department Name</label>
                          <input id="d_name" class="form-control" type="text" name="d_name" maxlength="255">
                      </div>

                  </form>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="department_save" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

@include('includes.deletemodal')
  
  <script>
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('departments.edit') }}';
    
  </script>
@endsection