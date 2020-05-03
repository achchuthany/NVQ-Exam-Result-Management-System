@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('content')
    <div class="row align-items-center mb-3">
        <div class="col text-center">
                            <span
                                class="btn btn-primary shadow btn-circle btn-xl">{{strtoupper(substr($student->fullname,0,1))}}</span>
            <h1 class="font-weight-lighter">{{$student->fullname}} </h1>
        </div>
    </div>
    <div class="row">
        <div class="pr-lg-2 col-lg-12">
            <div class="card mb-3">
                <div class="card-body">

                    <div class="row">
                        <div class="col-3 border-right">
                            <div class="nav flex-column nav-pills bg-white" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                   role="tab" aria-controls="v-pills-home" aria-selected="true">Login Details</a>
                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                                   role="tab" aria-controls="v-pills-profile" aria-selected="false">About</a>
                                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill"
                                   href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                   aria-selected="false">Contact</a>
                                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill"
                                   href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                                   aria-selected="false">Emergencyy Contact</a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                     aria-labelledby="v-pills-home-tab">
                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h2><i class="far fa-envelope-open"></i></h2>
                                        </div>
                                        <div class="col-11">
                                            <h5 class="mb-0">{{$student->email}} </h5>
                                            <h6 class="text-muted p-0 m-0"><small>E-mail</small></h6>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h2><i class="fas fa-sign-in-alt"></i></h2>
                                        </div>
                                        <div class="col-11">
                                            <h5 class="mb-0">{{Auth::user()->username}}</h5>
                                            <h6 class="text-muted p-0 m-0"><small>Username</small></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                     aria-labelledby="v-pills-profile-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->title}}. {{$student->shortname}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Birth</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->date_birth}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Gender</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->gender}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Student ID</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->reg_no}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>NIC No.</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->nic}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Civil Status</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->civil_status}} </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                     aria-labelledby="v-pills-messages-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Address</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->address}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Phone</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->phone}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Divisional</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->divisional}} </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>District</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->district}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Province</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->province}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Zip</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->zip}} </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                     aria-labelledby="v-pills-settings-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->emergency_name }} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Address</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->emergency_address }} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Phone</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->emergency_phone }} </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Relationship</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label>{{$student->emergency_relationship}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
