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
                    <a type="button" class="btn btn-sm btn-primary shadow-sm"
                       href="{{route('tvec.exams.results.batch.pass',['id'=>$batch->id])}}"><i class="fas fa-check-circle"></i> Passed Students</a>
                    <a type="button" class="btn btn-sm btn-outline-primary shadow-sm"
                       href="{{route('tvec.exams.results.batch.pdf',['id'=>$batch->id])}}"><i class="fas fa-file-pdf"></i> Export PDF</a>
                    <a type="button" class="btn btn-sm btn-outline-dark shadow-sm" href="{{route('tvec.results')}}"><i
                            class="fas fa-chevron-circle-left"></i> Back to Results</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-1">
                    <p class="font-weight-bolder">Course</p>
                </div>
                <div class="col-11">
                    {{$batch->course->name}}
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <p class="font-weight-bolder">Batch</p>
                </div>
                <div class="col-11">
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
                                <th scope="col">{{$exam->module_code}} <span
                                        class="badge badge-light"> {{$exam_types[$exam->exam_type]}} </span></th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <span hidden>{{$id=1}}</span>
                        @foreach($results as $index => $result_row)
                            <tr>
                                <th> {{$students[$index]->reg_no}} </th>
                                <td> {{$students[$index]->shortname}} </td>
                                <span hidden>
                                        {{$pass = $students[$index]->tvec_exam_pass}}
                                    {{$total = $students[$index]->tvec_exam_modules}}
                                </span>
                                <td>
                                    @if($pass==$total)
                                        <span class="text-primary"> <i class="fas fa-check-circle"></i></span> Pass
                                    @endif
                                    @if($pass!=$total)
                                        <span class="text-secondary"> <i class="fas fa-times-circle"></i></span> Fail
                                    @endif
                                </td>
                                <td>
                                    <div class="progress" data-toggle="tooltip" title="{{$pass}} of {{$total}}">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                             role="progressbar"
                                             style="width: {{ ($total != 0 ) ? round(($pass/$total)*100): 0}}%;"
                                             aria-valuemin="0"
                                             aria-valuemax="100">{{ ($total != 0 ) ? round(($pass/$total)*100): 0}}%
                                        </div>
                                    </div>
                                </td>
                                @foreach($result_row as $result)
                                    <td data-toggle="tooltip"
                                        title="{{$result->module_code}} {{$exam_types[$result->exam_type]}}">
                                        <span
                                            class="{{ ($result->result == 'P') ? 'text-primary':'text-secondary'}}"> <i
                                                class="fas {{ ($result->result == 'P') ? 'fa-check-circle':'fa-times-circle'}}"></i></span> {{$exam_pass[$result->result]}}
                                        <sup>{{$result->attempt}}</sup>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="row">
                @foreach ($exams as $exam)
                    <div class="col-auto">
                       <span
                           class="badge badge-dark"> {{$exam->module_code}} </span> {{$exam->module_name}} ({{$exam_types[$exam->exam_type]}})
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
