@extends('layouts.master')
@section('title')
TVEC Exam Batch Results
@endsection
@section('content')
<div class="card mb-3">
<div class="card-header bg-white">
    <div class="align-items-center row">
      <div class="col">
        <h5 class="mb-0 font-weight-light text-uppercase">student's academic transcript - TVEC Examination</h5>
      </div>
      <div class="text-right col-auto">
        <a type="button" class="btn btn-sm btn-light shadow-sm" href="{{route('students.create')}}"><i class="fas fa-file-pdf"></i> Download</a>
      </div>
    </div>
  </div>
  <div class="card-body">
       <div class="row mx-2">
            <div class="col-md-2">
                <p class="font-weight-bold">Full Name</p>
            </div>
            <div class="col-md-10">
                <p class="font-weight-light">{{$student->fullname}}</p>
            </div>
            <div class="col-md-2">
                <p class="font-weight-bold">Student ID</p>
            </div>
            <div class="col-md-10">
                <p class="font-weight-light">{{$student->reg_no}}</p>
            </div>

            <div class="col-md-2">
                <p class="font-weight-bold">Student NIC</p>
            </div>
            <div class="col-md-10">
                <p class="font-weight-light">{{$student->nic}}</p>
            </div>

            <div class="col-md-2">
                <p class="font-weight-bold">Course</p>
            </div>
            <div class="col-md-10">
                <p class="font-weight-light">{{$batch->course->name}}</p>
            </div>
            <div class="col-md-2">
                <p class="font-weight-bold">Batch</p>
            </div>
            <div class="col-md-10">
                <p class="font-weight-light">{{$batch->name}} ({{$batch->academic_year->name}})</p>
            </div>
        </div>

        <div class="col-12 table-responsive">
            <table class="table table-hover table-sm table-borderless">
                <thead>
                <tr class="thead-light">
                    <th scope="col">Code</th>
                    <th scope="col">Module</th>
                    <th scope="col">Result</th>
                    <th scope="col">Attempt</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <span hidden>{{$isPrint=null}}</span>
                <tbody>
                   @foreach($results as $result)
                   @if(!($isPrint==$result->module_code.$result->exam_type))
                   <span hidden>{{$isPrint =$result->module_code.$result->exam_type }}</span>
                       <tr>
                        <td> {{$result->module_code}} </td>
                        <td> {{$result->module_name}} <span class="badge badge-pill badge-light">{{$exam_types[$result->exam_type]}}</span></td>
                       <td><i class="fas {{($result->result == 'P')? 'fa-check-circle text-success' : 'text-danger fa-times-circle'}}"></i> {{$exam_pass[$result->result]}}</td>
                       <td>Attempt {{$result->attempt}} </td>
                       <td>{{Carbon\Carbon::parse($result->exam_date)->toFormattedDateString()}}</td>
                       </tr>
                       @endif
                   @endforeach
                </tbody>
            </table>
        </div>
  </div>
</div>

<script>
    var token = '{{ Session::token() }}';
    var urlStudentsByBatch = '{{ route('ajax.students.batch') }}';
    var urlStudentByReg = '{{ route('ajax.students.reg') }}';

  </script>
@endsection
