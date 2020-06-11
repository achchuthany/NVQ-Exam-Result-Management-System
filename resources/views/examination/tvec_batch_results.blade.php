@extends('layouts.master')
@section('title')
TVEC Examination Batch Result
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Batch Result of the Final TVEC Examination</h5>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('tvec.exams.results.batch.pdf',['id'=>$batch->id])}}"><i class="fas fa-print"></i></a>
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('tvec.exams')}}"><i class="fas fa-chevron-circle-left"></i> Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-auto">
            <p class="font-weight-bolder">Course</p>
            </div>
            <div class="col">
                {{$batch->course->name}}
            </div>
        </div>
        <div class="row">
            <div class="col-auto">
                <p class="font-weight-bolder">Batch</p>
            </div>
            <div class="col">
                {{$batch->name}} ({{$batch->academic_year->name}})
            </div>
        </div>


    <div class="row align-items-center mt-2">
       <div class="col-12 table-responsive">
            <table class="table">
                <thead class="bg-light">
                <tr class="border-bottom border-dark">
                    <th scope="col">Student ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Overview</th>
                    <th scope="col">Pass Rate</th>
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
                            <span class="text-primary"> <i class="fas fa-check-circle"></i></span> Pass
                            @endif
                            @if($pass!=$total)
                            <span class="text-secondary"> <i class="fas fa-times-circle"></i></span> Fail
                            @endif
                        </td>
                        <td>
                            <div class="progress" data-toggle="tooltip" title="{{$pass}} of {{$total}}" >
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ ($total != 0 ) ? round(($pass/$total)*100): 0}}%;" aria-valuemin="0" aria-valuemax="100">{{ ($total != 0 ) ? round(($pass/$total)*100): 0}}%</div>
                            </div>
                        </td>
                    @endif
                    @if(!($isPrint==$result->student_id.$result->module_code.$result->exam_type))
                        <span hidden>{{$isPrint =$result->student_id.$result->module_code.$result->exam_type }} {{$isName=$result->student_id}}</span>
                        <td data-toggle="tooltip" title="{{$result->module_code}} {{$exam_types[$result->exam_type]}}">
                            <span class="{{ ($result->result == 'P') ? 'text-primary':'text-secondary'}}"> <i class="fas {{ ($result->result == 'P') ? 'fa-check-circle':'fa-times-circle'}}"></i></span> {{$exam_pass[$result->result]}} <sup>{{$result->attempt}}</sup>
                        </td>
                    @endif
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>
    <div class="card-footer bg-white">
        <div class="row">
           @foreach ($exams as $exam)
            <div class="col-md-4">
                {{$exam->module_code}} : {{$exam->module_name}}<span class="badge badge-light">{{$exam_types[$exam->exam_type]}}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
