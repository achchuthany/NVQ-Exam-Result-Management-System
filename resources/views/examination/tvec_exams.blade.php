@extends('layouts.master')
@section('title')
    TVEC Exams
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-6">
        <h4 class="pt-2"> TVEC Exams Summary</h4>
    </div>
    <div class="col-5">
    <form class="form-inline my-2 my-lg-0" action="{{route('tvec.exams.batch')}}" method="POST">
        <select class="custom-select custom-select-sm  col-5" name="batch_couese_id" id="batch_couese_id" required>
          <option value="" selected>Select Course</option>
            @foreach ($courses as $course)
              <option value="{{$course->id}}">{{$course->name}}</option>
             @endforeach
        </select>
        <select class="custom-select custom-select-sm my-2 my-sm-0 col-5" name="batch_id" id="batch_id">
          <option value="" selected>Select Batch</option>
        </select>
        <button type="submit" class="btn btn-sm btn-primary my-2 my-sm-0 col-2"><i class="fas fa-search"></i></button>
        <input type="hidden" name="_token" value="{{Session::token()}}">

      </form>
    </div>
    <div class="col-1">
      <a type="button" class="btn btn-sm btn-primary " href="{{route('tvec.exams.create')}}"><i class="fas fa-plus-circle"></i> New</a>
    </div>
</div>
<div class="row align-items-center mt-2">
    <div class="col-12 table-responsive">
        <table class="table table-hover table-borderless">
            <thead>
              <tr class="thead-light">
                <th scope="col" hidden>ID</th>
                <th scope="col">Module</th>
                <th scope="col">Academic Year</th>
                <th scope="col">Students</th>
                <th scope="col">Pass Rate</th>
                <th scope="col">Date</th>
                <th scope="col">
                    Actions
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach( $tvecexams as $tvecexam)
            <tr data-did="{{$tvecexam->id}}">
              <th hidden>{{$tvecexam->id}}</th>
                <td>{{$tvecexam->module->name}} <span class="badge badge-pill badge-secondary">{{$exams[$tvecexam->exam_type]}}</span> </td>
                <td>{{$tvecexam->academic_year->name}}</td>
                <td>{{$tvecexam->number_pass}} Pass  of {{$tvecexam->number_students}} 
                
                  <span class="badge badge-pill  badge-secondary"> {{round(($tvecexam->number_students == 0)? 0 : ($tvecexam->number_pass/$tvecexam->number_students)*100)}}%</span>
                </td>
                <td>
                  <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{($tvecexam->number_students == 0)? 0 : ($tvecexam->number_pass/$tvecexam->number_students)*100}}%" aria-valuenow="{{($tvecexam->number_students == 0)? 0 : ($tvecexam->number_pass/$tvecexam->number_students)*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>                </td>
                <td>{{$tvecexam->exam_date}}</td>
                <td>                    
                    <div class="btn-group" role="group">
                        <a class="btn btn-sm btn-secondary" href="{{ route('tvec.exams.results',['id'=>$tvecexam->id]) }}"><i class="fas fa-chart-area"></i> Results</a>
                        <button type="button" class="btn btn-sm btn-warning department-edit"><i class="fas fa-edit"></i></button>
                        <a type="button" class="btn btn-sm btn-danger" href="{{ route('tvec.exams.delete',['id'=>$tvecexam->id]) }}"><i class="fas fa-trash"></i></a>
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
    var urlBatchesByCourse = '{{ route('ajax.batches') }}';
    
  </script>
@endsection