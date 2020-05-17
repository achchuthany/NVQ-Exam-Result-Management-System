@extends('layouts.master')
@section('title')
    Enrolled Courses
@endsection
@section('content')

    <div class="card mb-3">
        <div class="card-header bg-white border-0">
            <div class="align-items-center row">
                <div class="col">
                    <h5 class="mb-0 font-weight-bolder"> Enrolled Courses</h5>
                </div>
                <div class="text-right col-auto">
                </div>
            </div>
        </div>
    @foreach($enrolls as $enroll)
            <div class="card-header bg-light border-0">
                <div class="align-items-center row">
                    <div class="col">
                        <h5 class="mb-0 font-weight-bolder"> {{$enroll->course->name}} <small> {{$enroll->status}}</small></h5>
                    </div>
                    <div class="col-auto">
                        <span data-toggle="tooltip" data-placement="top" title="{{$enroll->academic_year->status}}" class="{{($enroll->academic_year->status=='Active')? 'text-primary' : (($enroll->academic_year->status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span> {{$enroll->academic_year->name}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">

                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header  border-0">
                                    <div class="align-items-center row">
                                        <div class="col">
                                            <h5 class="mb-0  font-weight-lighter"> TVEC Examination</h5>
                                        </div>
                                        <div class="col-auto">
                                            <a
                                               href="{{ route('tvec.results.student',['bid'=>App\Batch:: where([['academic_year_id','=', $enroll->academic_year_id],['course_id','=',$enroll->course_id]])->first()->id,'id'=>$enroll->student_id]) }}"><i
                                                    class="fas fa-graduation-cap"></i> Transcript</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header  border-0">
                                <div class="align-items-center row">
                                    <div class="col">
                                        <h5 class="mb-0  font-weight-lighter"> Assessments</h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#">Report</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header  border-0">
                                <div class="align-items-center row">
                                    <div class="col">
                                        <h5 class="mb-0  font-weight-lighter"> Attendance</h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#">Report</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer bg-white border-0">
                <div class="row ">
                    <div class="col">
                    </div>
                    <div class="col-auto">
                        <p>This {{$enroll->course_mode}} course has been enrolled in {{$enroll->enroll_date}} <small class="text-muted">{{Carbon\Carbon::parse($enroll->enroll_date)->diffForHumans()}}</small> </p>
                    </div>
                </div>
            </div>
    @endforeach
    </div>
@endsection
