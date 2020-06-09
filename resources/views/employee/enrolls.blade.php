@extends('layouts.master')
@section('title')
Employees Enrolled Modules
@endsection
@section('content')

<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                @if($academic_year)
                <h5 class="mb-0 font-weight-bolder"> Enrolled Modules in {{$academic_year->name}} <span class="{{($academic_year->status=='Active')? 'text-primary' : (($academic_year->status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span></h5>
                @endif
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('employees.enroll.create')}}">Enroll</a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover  mb-0">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="pl-4">EPF No.</th>
                        <th scope="col" >Name</th>
                        <th scope="col">Enrolled Modules</th>
                        <th scope="col">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $employees as $employee)
                      <tr data-did="{{$employee->id}}">
                        <th class="pl-4">{{$employee->epf}}</th>
                        <td>{{$employee->fullname}}</td>
                        <td>
                            @foreach($employee->teachModulesActive($employee->id) as $module)
                              <button class="btn btn-sm btn-light">{{$module->name}}</button>
                            @endforeach
                        </td>
                        <td>
                          <div class="dropdown dropleft">
                              <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-h"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="{{route('employee.profile',['id'=>$employee->id])}}"><i class="fas fa-user-tie"></i> Profile</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item " href="#"><i class="far fa-edit"></i> Edit</a>
                              </div>
                          </div>
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
                <span>{{$employees->firstItem()}} to {{$employees->lastItem()}} of  {{$employees->total()}}</span>
            </div>
            <div class="col-auto">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
