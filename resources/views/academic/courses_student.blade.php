@extends('layouts.master')
@section('title')
    Enrolled Courses
@endsection
@section('content')

    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="align-items-center row">
                <div class="col">
                    <h5 class="mb-0 font-weight-bolder"> Enrolled Courses</h5>
                </div>
                <div class="text-right col-auto">
                </div>
            </div>
        </div>
    </div>
    @foreach($enrolls as $enroll)
    <div class="card mb-3">
        <div class="card-header bg-white border-0">
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
                   @foreach($enroll->course->modules as $module)
                   <div class="col-md-4">
                       <div class="card mb-3  text-center">
                           <div class="card-header bg-gradient-primary text-light border-0">
                               <div class="align-items-center row">
                                   <div class="col">
                                       <p class="mb-0  font-weight-lighter"> {{$module->code}} {{$module->name}}</p>
                                   </div>
                               </div>
                           </div>
                           <div class="card-body">
                               <div class="align-items-center row">
                                   <div class="col-12">
                                        <div class="display-4 font-weight-lighter ">{{$module->learning_hours}}<span class="text-muted h4">NHrs</span></div>
                                   </div>
                                   <div class="col-12 text-center">
                                       <div>Lectures {{$module->lecture_hours }}<span class="text-muted small"> NHrs</span></div>
                                       <div>  Practical {{$module->practical_hours }}<span class="text-muted small"> NHrs</span>  </div>
                                       <div>  Self Study {{$module->self_study_hours }}<span class="text-muted small"> NHrs</span>  </div>
                                       <div>Examination Type {{$exams[$module->exam_type] }}</div>
                                       <div>{{$semesters[$module->semester_id] }}</div>
                                   </div>
                               </div>
                           </div>
                           <div class="card-footer border-0">
                               <div class="row ">
                                   <div class="col">
                                       <a href="#">View More</a>
                                   </div>
                               </div>
                           </div>

                       </div>
                   </div>
                   @endforeach
               </div>
        </div>
        <div class="card-footer border-0">
            <div class="row ">
                <div class="col">
                    NHrs - Notional Hours (equal to 45 Minutes)
                </div>
                <div class="col-auto">
                         <p>This {{$enroll->course_mode}} course has been enrolled in {{$enroll->enroll_date}} <small class="text-muted">{{Carbon\Carbon::parse($enroll->enroll_date)->diffForHumans()}}</small> </p>
                </div>
            </div>
        </div>
    </div>

    @endforeach

@endsection
