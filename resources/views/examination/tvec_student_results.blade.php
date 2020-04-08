@extends('layouts.master')
@section('title')
TVEC Exam Batch Results
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2 text-uppercase">student's academic transcript</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-sm btn-dark" href="{{route('tvec.exams')}}">Back</a>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-2">
        <p class="font-weight-bold">Full Name</p>
    </div>
    <div class="col-md-5">
        <p class="font-weight-light">: {{$student->fullname}}</p>
    </div>
    <div class="col-md-2">
        <p class="font-weight-bold">Student ID</p>
    </div>
    <div class="col-md-3">
        <p class="font-weight-light">: {{$student->reg_no}}</p>
    </div>
    <div class="col-md-2">
        <p class="font-weight-bold">Course</p>
    </div>
    <div class="col-md-5">
        <p class="font-weight-light">: {{$batch->course->name}}</p>
    </div>
    <div class="col-md-2">
        <p class="font-weight-bold">Batch</p>
    </div>
    <div class="col-md-3">
        <p class="font-weight-light">: {{$batch->name}} ({{$batch->academic_year->name}})</p>
    </div>
</div>

<form method="post" action="{{route('tvec.exams.results.create')}}">
    <div class="row align-items-center mt-2">    
       <div class="col-12 table-responsive">
            <table class="table table-hover table-borderless">
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
                        <td> {{$result->module_name}} <span class="badge badge-pill badge-primary">{{$exam_types[$result->exam_type]}}</span></td>
                       <td> {{$exam_pass[$result->result]}} </td>           
                       <td>Attempt {{$result->attempt}} </td> 
                       <td>{{$result->exam_date}}</td>                               
                       </tr>
                       @endif
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>


<script>
    var token = '{{ Session::token() }}';
    var urlStudentsByBatch = '{{ route('ajax.students.batch') }}';
    var urlStudentByReg = '{{ route('ajax.students.reg') }}';
    
  </script>
@endsection