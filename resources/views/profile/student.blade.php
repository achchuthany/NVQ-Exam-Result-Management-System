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

                    <div class="row my-3">
                        <div class="col-md-3 border-right">
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
                        <div class="col-md-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                     aria-labelledby="v-pills-home-tab">
                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="far fa-envelope-open"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->email}} </h6>
                                            <h6 class="text-muted p-0 m-0"><small>E-mail</small></h6>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-sign-in-alt"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{Auth::user()->username}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Username</small></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                     aria-labelledby="v-pills-profile-tab">
                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-user-graduate"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->title}}. {{$student->shortname}} </h6>
                                            <h6 class="text-muted p-0 m-0"><small>Name</small></h6>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-gift"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{Carbon\Carbon::parse($student->date_birth)->toFormattedDateString()}}  </h6>
                                            <h6 class="text-muted p-0 m-0"><small>Date of Birth</small></h6>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-user"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->gender}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Gender</small></h6>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-id-card"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->reg_no}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Student ID</small></h6>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-id-badge"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->nic}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>NIC No.</small></h6>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-ring"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->civil_status}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Civil Status</small></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                     aria-labelledby="v-pills-messages-tab">
                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-location-arrow"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->address}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Address</small></h6>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-phone"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->phone}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Phone</small></h6>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-road"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->divisional}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Divisional</small></h6>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-map"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->district}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>District</small></h6>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-globe-asia"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->province}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Province</small></h6>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-atlas"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->zip}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Zip</small></h6>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                     aria-labelledby="v-pills-settings-tab">
                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-person-booth"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->emergency_name}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Name</small></h6>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-location-arrow"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->emergency_address}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Address</small></h6>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-phone"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->emergency_phone}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Phone</small></h6>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-1 text-right p-0 text-secondary">
                                            <h3><i class="fas fa-heart"></i></h3>
                                        </div>
                                        <div class="col-11">
                                            <h6 class="mb-0">{{$student->emergency_relationship}}</h6>
                                            <h6 class="text-muted p-0 m-0"><small>Relationship</small></h6>
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
