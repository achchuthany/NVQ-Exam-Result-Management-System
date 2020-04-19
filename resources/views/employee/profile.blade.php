@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('content')
<div class="emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-img ">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt="" class="rounded"/>
                    <div class="file btn btn-lg btn-primary ">
                        Change Photo
                        <input type="file" name="file" />
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="profile-head">
                    <h5>
                        {{$employee->title}} {{$employee->fullname}}
                    </h5>
                    <h6>
                        {{$employee->position}}<small> ({{$employee->position_type}})</small>
                    </h6>
                    <h6>
                        {{$employee->status}}
                    </h6>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Enrolled Modules</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                {{-- <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile" /> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="profile-work">
                    <h6 class="text-primary  mt-1">Email</h6>   
                    <h6>{{$employee->email}}</h6>

                    <h6 class="text-primary  mt-1">Phone</h6>   
                    <h6>{{$employee->phone}}</h6>
                    
                    <h6 class="text-primary  mt-1">Address</h6>   
                    <h6>{{$employee->address}}</h6>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>User Id</label>
                            </div>
                            <div class="col-md-6">
                                <p>##Kshiti123</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Date of Birth</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$employee->date_birth}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Gender</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$employee->gender}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>E.P.F. No.</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$employee->epf}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>NIC No.</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$employee->nic}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Working Type</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$employee->position_type}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Appointment Date</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$employee->date_join}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Province</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$employee->province}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @foreach($employee->teachModules($employee->id) as $module)
                        {{-- {{$module}} --}}
                        <div class="row py-2">
                            <div class="col-md-6">
                                {{$module->course_name}}
                            </div>
                            
                            <div class="col-md-3">
                                {{$module->name}} 
                            </div>
                            <div class="col-md-3">
                                @if($module->academic_year_status == 'Active')
                                <span class="badge badge-secondary p-2">{{$module->academic_year_name}}</span>
                                @endif
                                @if($module->academic_year_status == 'Completed')
                                <span class="badge badge-light p-2">{{$module->academic_year_name}}</span>
                                @endif
                                @if($module->academic_year_status == 'Planning')
                                <span class="badge badge-dark p-2">{{$module->academic_year_name}}</span>
                                @endif
                                <a type="button" class="btn btn-sm btn-danger" href="{{route('employees.enroll.delete',['id'=>$module->id])}}"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection