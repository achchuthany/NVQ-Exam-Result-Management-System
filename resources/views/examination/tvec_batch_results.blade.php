@extends('layouts.master')
@section('title')
TVEC Exam Batch Results
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2 text-weight-light">Academic Transcript</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-sm btn-light mx-1" href="{{route('tvec.exams.results.batch.pdf',['id'=>$batch->id])}}"><i class="fas fa-print"></i></a>
            <a type="button" class="btn btn-sm btn-dark" href="{{route('tvec.exams')}}"><i class="fas fa-chevron-circle-left"></i> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-1">
       <p class="text-weight-light">Course</p> 
    </div>
    <div class="col-md-5">
        : {{$batch->course->name}}
    </div>
    <div class="col-md-1">
        <p class="text-weight-light">Course</p> 
     </div>
     <div class="col-md-5">
         : {{$batch->name}} ({{$batch->academic_year->name}})
     </div>
</div>
    <div class="row align-items-center mt-2">    
       <div class="col-12 table-responsive">
            <table class="table table-hover table-sm">
                <thead class="thead-light">
                <tr class="border-bottom border-dark">
                    <th scope="col">Student ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">NVQ Status</th>
                    @foreach($exams as $exam)
                    <th scope="col">{{$exam->module_code}} <span class="badge badge-light"> {{$exam_types[$exam->exam_type]}} </span> </th>
                    @endforeach
                </tr>
                </thead>
            <span hidden>{{$isPrint=null}} {{$isName=null}} {{$id=0}}</span>
                <tbody>  
                   @foreach($results as $result)
                    @if($isName!=$result->student_id)
                        </tr><tr>
                        <th> {{$result->student->reg_no}} </th>
                        <td> {{$result->student->shortname}} </td>
                        <td >
                        <span hidden>
                            {{$pass = $students[$id]->tvec_exam_pass}}
                            {{$total = $students[$id]->tvec_exam_modules}}
                            {{$id++}}
                        </span>
                            @if($pass==$total)
                            <span class="badge badge-success"> <i class="fas fa-check-circle"></i></span> 
                            @endif
                            @if($pass!=$total)
                            <span class="badge badge-danger"> <i class="fas fa-exclamation-circle"></i></span> 
                            @endif
                    <span data-toggle="tooltip" title="{{$pass}} of {{$total}}" >{{ ($total != 0 ) ? round(($pass/$total)*100): 0}}%</span>
                        </td>
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
    <div class="row mt-1 pt-2 text-weight-light text-secondary">
        @foreach ($exams as $exam)
            <div class="col-md-4">
                {{$exam->module_code}} : {{$exam->module_name}}<span class="badge badge-light">{{$exam_types[$exam->exam_type]}}</span>
            </div>
            
        @endforeach
    </div>
@endsection