@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('content')

    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="align-items-center row">
                <div class="col">
                    <h5 class="mb-0 font-weight-bolder">Enrolled Modules</h5>
                </div>
                <div class="text-right col-auto">
{{--                    <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="">New</a>--}}
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover  mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Course</th>
                        <th scope="col">Module</th>
                        <th scope="col">Academic Year</th>
                        <th scope="col">Assessments</th>
                        <th scope="col">Attendances</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($enrolledModules = $employee->teachModules($employee->id) as $module)
                        <tr class="btn-reveal-trigger">
                            <td scope="row">{{$module->course->name}}</td>
                            <td><b>{{$module->code}}</b> {{$module->name}}</td>
                            <td><span data-toggle="tooltip" data-placement="top"
                                      title="{{$module->academic_year_status}}"
                                      class="{{($module->academic_year_status=='Active')? 'text-primary' : (($module->academic_year_status=='Planning')? 'text-dark':'text-secondary') }}"><i
                                        class="fas fa-check-circle"></i></span>
                                {{$module->academic_year_name}}</td>
                            <td><a data-toggle="tooltip" data-placement="top" title="Assessments Details"
                                   class="btn btn-sm"
                                   href="{{ route('attendance.manage',['mid'=>$module->id,'aid'=>$module->academic_year_id]) }}"><i
                                        class="fas fa-book""></i></i> Assessments</a>
                            </td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Attendance Sessions"
                                   class="btn btn-sm"
                                   href="{{ route('attendance.manage',['mid'=>$module->id,'aid'=>$module->academic_year_id]) }}"><i
                                        class="far fa-calendar-check"></i></i> Attendance</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="pt-1 no-gutters row">
                <div class="col">
                    <span>{{$enrolledModules->firstItem()}} to {{$enrolledModules->lastItem()}} of  {{$enrolledModules->total()}}</span>
                </div>
                <div class="col-auto">
                    {{ $enrolledModules->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
