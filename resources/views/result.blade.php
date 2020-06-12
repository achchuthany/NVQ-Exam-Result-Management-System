@extends('layouts.index')
@section('title')
    Online Exam Result Management System
@endsection
@section('content')
    <section id="cover">
        <div id="cover-caption">
            <div class="container">
                <div class="row">
                    <div class="form col">
                        <div class="card">
                            <div class="card-header bg-white">
                                <div class="align-items-center row">
                                    <div class="col">
                                        <h5 class="mb-0 font-weight-bolder">Online Exam Result Management System -
                                            Academic Transcript</h5>
                                    </div>
                                    <div class="text-right col-auto">
                                        <a type="button" class="btn btn-sm btn-outline-secondary shadow-sm"
                                           href="{{route('index')}}">Back to Home</a>
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
                                </div>
                                @foreach($results as $index=>$rows)
                                    <div class="row mx-2 mb-2 border-bottom">
                                        <div class="col-md-2">
                                            <p class="font-weight-bold">Course</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="font-weight-light">{{$batches[$index]->course->name}}</p>
                                        </div>
                                        <div class="col-md-1">
                                            <p class="font-weight-bold">Batch</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="font-weight-light">{{$batches[$index]->name}} ({{$batches[$index]->academic_year->name}})</p>
                                        </div>
                                    </div>
                                    <div class="col-12 table-responsive">
                                        <table class="table table-sm table-hover table-borderless">
                                            <thead>
                                            <tr class="thead-light">
                                                <th scope="col">Code</th>
                                                <th scope="col">Module</th>
                                                <th scope="col">Result</th>
                                                <th scope="col">Attempt</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($rows as $result)
                                                <tr>
                                                    <td> {{$result->module_code}} </td>
                                                    <td> {{$result->module_name}} <span
                                                            class="badge badge-pill badge-light">{{$exam_types[$result->exam_type]}}</span>
                                                    </td>
                                                    <td>
                                                        <i class="{{($result->result == 'P')? 'fa fa-check text-success' : 'fa fa-times text-danger'}}"></i> {{$exam_pass[$result->result]}}
                                                    </td>
                                                    <td>Attempt {{$result->attempt}} </td>
                                                    <td>{{Carbon\Carbon::parse($result->exam_date)->toFormattedDateString()}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
