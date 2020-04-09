@extends('layouts.master')
@section('title')
TVEC Exam Batch Results
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2">Academic Transcript</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-sm btn-dark" href="{{route('tvec.exams')}}">Back</a>
        </div>
    </div>
</div>
    <div class="row align-items-center mt-2">    
       <div class="col-12 table-responsive">
            <table class="table table-hover table-borderless">
                <thead>
                <tr class="border-bottom border-dark">
                    <th scope="col">Student ID</th>
                    <th scope="col">Name</th>
                    @foreach($exams as $exam)
                    <th scope="col">{{$exam->module_code}} <span class="badge badge-light"> {{$exam_types[$exam->exam_type]}} </span> </th>
                    @endforeach
                </tr>
                </thead>
            <span hidden>{{$isPrint=null}} {{$isName=null}}</span>
                <tbody>  
                   @foreach($results as $result)
                    @if($isName!=$result->student_id)
                        </tr><tr>
                        <th> {{$result->student->reg_no}} </th>
                        <td> {{$result->student->shortname}} </td>
                    @endif
                    @if(!($isPrint==$result->student_id.$result->module_code.$result->exam_type))
                        <span hidden>{{$isPrint =$result->student_id.$result->module_code.$result->exam_type }} {{$isName=$result->student_id}}</span>
                        <td data-toggle="tooltip" title="{{$result->module_code}} {{$exam_types[$result->exam_type]}}">  
                            {{$exam_pass[$result->result]}} <sup><span class="badge  {{ ($result->result == 'P') ? 'badge-success':'badge-danger'}}">{{$result->attempt}}</span></sup>
                        </td>           
                    @endif
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row align-items-center m-1 border-top border-info pt-2 text-weight-light">
        @foreach ($exams as $exam)
            <div class="col-md-4">
                {{$exam->module_code}} : {{$exam->module_name}} <span class="badge  badge-light">{{$exam_types[$exam->exam_type]}}</span>
            </div>
            
        @endforeach
    </div>
@endsection