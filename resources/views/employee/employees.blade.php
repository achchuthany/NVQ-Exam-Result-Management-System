@extends('layouts.master')
@section('title')
Employees
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Employees</h5>
            </div>
            <div class="text-right col-auto">
                <form method="post" action="{{route('employees.search')}}">
                  <div class="btn-group float-right mr-2" role="group">      
                    <input type="text" name="fullname" class="form-control form-control-sm" placeholder="Full name">
                    <button type="submit" class="btn btn-sm btn-outline-secondary">Search</button>
                    <input type="hidden" name="_token" value="{{Session::token()}}">      
                  </div>
                </form>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-secondary" href="{{route('employees')}}">All</a>
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('employees.create')}}">New</a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover  mb-0">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="pl-4">EPF No.</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Position</th>
                        <th scope="col">Department</th>
                        <th scope="col">Status</th>
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
                          <td>{{$employee->position}}</td>
                          <td>{{$employee->department->name}}</td>
                          <td>{{$employee->status}}</td>
                          <td>
                            <div class="dropdown dropleft">
                              <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-h"></i>
                              </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="{{route('employee.profile',['id'=>$employee->id])}}"><i class="fas fa-user-tie"></i> Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item " href="#"><i class="far fa-edit"></i> Edit</a>
                                    <a class="dropdown-item text-danger" href=""><i class="far fa-trash-alt"></i> Delete</a>
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