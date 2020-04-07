@extends('layouts.master')
@section('title')
    TVEC Exams
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2"> TVEC Exams</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-sm btn-primary" href="{{route('tvec.exams.create')}}">New</a>
        </div>
    </div>
</div>
<div class="row align-items-center mt-2">
    <div class="col-12 table-responsive">
        <table class="table table-hover table-borderless">
            <thead>
              <tr class="thead-light">
                <th scope="col">ID</th>
                <th scope="col">Module</th>
                <th scope="col">Academic Year</th>
                <th scope="col">Exam Type</th>
                <th scope="col">Date</th>
                <th scope="col">
                    Actions
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach( $tvecexams as $tvecexam)
            <tr data-did="{{$tvecexam->id}}">
              <th>{{$tvecexam->id}}</th>
                <td>{{$tvecexam->module->name}}</td>
                <td>{{$tvecexam->academic_year->name}}</td>
                <td>{{$exams[$tvecexam->exam_type]}}</td>
                <td>{{$tvecexam->exam_date}}</td>
                <td>                    
                    <div class="btn-group" role="group">
                        <a class="btn btn-sm btn-secondary" href="{{ route('tvec.exams.results',['id'=>$tvecexam->id]) }}">Results</a>
                        <button type="button" class="btn btn-sm btn-warning department-edit">Edit</button>
                        <a type="button" class="btn btn-sm btn-danger" href="{{ route('tvec.exams.delete',['id'=>$tvecexam->id]) }}">Delete</a>
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
                Showing {{$tvecexams->firstItem()}} to {{$tvecexams->lastItem()}} of  {{$tvecexams->total()}} entries
                </span>
              </li>
              <p>
              {{ $tvecexams->links() }}
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