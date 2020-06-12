@extends('layouts.master')
@section('title')
TVEC Exam Results Module
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Module TVEC Examination Results </h5>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('lecturer.tvec.exams')}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">

            <input type="hidden" value="{{$tvecexam->id}}" name="tvec_exam_id">
            <div class="row align-items-center mt-2">
                <div class="col-md-2">
                    <p class="font-weight-bold"> Course </p>
                </div>
                <div class="col-md-10">
                    <p class="font-weight-light"> {{$tvecexam->module->course->name}} </p>
                </div>

                <div class="col-md-2">
                    <p class="font-weight-bold"> Module </p>
                </div>
                <div class="col-md-10">
                    <p class="font-weight-light"> {{$tvecexam->module->name}} ({{$exams[$tvecexam->exam_type]}})</p>
                </div>
                <div class="col-md-2">
                    <p class="font-weight-bold"> Semester </p>
                </div>
                <div class="col-md-10">
                    <p class="font-weight-light"> {{$semesters[$tvecexam->module->semester_id]}}</p>
                </div>
                <div class="col-md-2">
                    <p class="font-weight-bold"> Examination Date </p>
                </div>
                <div class="col-md-10">
                    <p class="font-weight-light"> {{Carbon\Carbon::parse($tvecexam->exam_date)->toFormattedDateString()}}  {{Carbon\Carbon::parse($tvecexam->exam_time)->format('g:i A')}}</p>
                </div>
                <div class="col-md-2">
                    <p class="font-weight-bold"> Batch </p>
                </div>
                <div class="col-md-10">
                    <p class="font-weight-light"> {{$batch->name}} ({{$batch->academic_year->name}})</p>
                </div>

            <div class="col-12 table-responsive">
                    <table class="table table-sm table-hover table-borderless">
                        <thead>
                        <tr class="bg-light text-dark">
                            <th scope="col">Student ID</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Result</th>
                            <th scope="col">Attempt</th>
                        </tr>
                        </thead>
                        <tbody id="tvec_exam_results">
                            @if(count($students)>0)
                            <span hidden> {{$student_id = 0}}}</span>
                            @foreach($students as $student)
                            @if($student_id != $student->id)
                            <span hidden>{{$student_id = $student->id}}</span>
                            <tr>
                            <td>{{$student->reg_no}}</td>
                                <td>{{$student->shortname}}</td>
                                <td>
                                    <i class="{{($student->result == 'P')? 'fa fa-check text-success' : 'fa fa-times text-danger'}}"></i> {{$exam_pass[$student->result]}}
                                </td>
                                <td>
                                    Attempt {{$student->attempt}}
                                </td>
                                </tr>
                                @endif
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
@endsection
