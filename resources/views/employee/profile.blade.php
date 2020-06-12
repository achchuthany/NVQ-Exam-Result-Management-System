@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('content')
<div class="row">
    <div class="pr-lg-2 col-lg-12">
        <div class="card mb-3">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-12">
                    <h4 >{{$employee->fullname}}</h4>
                    <p >{{$employee->position}}</p>

                </div>
                 <div class="col-md-6 col-sm-12">
                     <h6>{{$employee->department->name}}</h6>
                    <p>Joint {{Carbon\Carbon::parse($employee->date_join)->diffForHumans()}} </p>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="pr-lg-2 col-lg-8">
        <div class="card mb-3">
            <div class="card-header bg-light">
                <div class="pt-1 no-gutters row">
                    <div class="col">
                        <h5 class="mb-0 font-weight-bolder">Enrolled Modules</h5>
                    </div>
                    <div class="col-auto">
                        @if(Auth::user()->hasRole('lecturer'))
                        <a data-toggle="tooltip" data-placement="top" title="All Enrolled Modules"  class="text-primary" href="{{route('lecturer.modules')}}">All Modules</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                @foreach($employee->teachModules($employee->id) as $module)
                {{-- {{$module}} --}}
                <div class="row py-2 align-items-center">
                    <div class="col" data-toggle="tooltip" data-placement="top" title="{{$module->course->name}}">
                        <b>{{$module->code}}</b> {{$module->name}}
                    </div>
                    <div class="col-auto">
                        <span data-toggle="tooltip" data-placement="top" title="{{$module->academic_year_status}}" class="{{($module->academic_year_status=='Active')? 'text-primary' : (($module->academic_year_status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span>
                        {{$module->academic_year_name}}
                    </div>
                    <div class="col-auto">
                        <a data-toggle="tooltip" data-placement="top" title="Attendance Sessions"  class="btn btn-sm" href="{{ route('attendance.manage',['mid'=>$module->id,'aid'=>$module->academic_year_id]) }}"><i class="fas fa-book""></i></i> Assessments</a>
                        <a data-toggle="tooltip" data-placement="top" title="Attendance Sessions"  class="btn btn-sm" href="{{ route('attendance.manage',['mid'=>$module->id,'aid'=>$module->academic_year_id]) }}"><i class="far fa-calendar-check"></i></i> Attendance</a>
                        <a data-toggle="tooltip" data-placement="top" title="Delete"  class="text-danger btn btn-sm btn-light" href="{{route('employees.enroll.delete',['id'=>$module->id])}}"><i class="fas fa-times-circle"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <div class="card mb-3">
            <div class="card-header bg-light">
                <div class="pt-1 no-gutters row">
                    <div class="col">
                        <h5 class="mb-0 font-weight-bolder">Activity Log</h5>
                    </div>
                    <div class="col-auto">
                        <a data-toggle="tooltip" data-placement="top" title="All Enrolled Modules"  class="text-primary" href="#">All Activities</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>

    <div class="pr-lg-2 col-lg-4">
        <div class="sticky-top sticky-sidebar">
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h5 class="mb-0 font-weight-bolder">About</h5>
                </div>
                <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <label>Date of Birth</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{Carbon\Carbon::parse($employee->date_birth)->toFormattedDateString()}}</p>
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
                                <p>{{Carbon\Carbon::parse($employee->date_join)->toFormattedDateString()}}</p>
                            </div>
                        </div>

                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h5 class="mb-0 font-weight-bolder">Contact</h5>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Address</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{$employee->address}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{$employee->phone}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>E-mail</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{$employee->email}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Zip</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{$employee->zip}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>District</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{$employee->district}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Province</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{$employee->province}}</p>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
