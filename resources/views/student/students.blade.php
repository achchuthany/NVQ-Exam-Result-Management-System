@extends('layouts.master')
@section('title')
    Students
@endsection
@section('content')
    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="align-items-center row">
                <div class="col">
                    <h5 class="mb-0 font-weight-bolder">Students
                        @if(Request::is('students/batch/*'))
                            <span class="badge badge-pill badge-light"> Batch View </span>
                        @endif
                        @if(Request::is('students/course/*'))
                            <span class="badge badge-pill badge-light"> Course View </span>
                        @endif
                        @if(Request::is('students/academic/*'))
                            <span class="badge badge-pill badge-light"> Academic Year View </span>
                        @endif
                        @if(Request::is('students'))
                            <span class="badge badge-pill badge-light"> All </span></h5>
                    @endif
                </div>
                @if(Auth::user()->hasAnyRole(['Admin']))
                <div class="text-right col-auto">
                    <div class="btn-group  mx-2" role="group">
                        <input type="text" class="form-control form-control-sm" placeholder="Registration No.">
                        <button type="button" class="btn btn-sm btn-outline-primary">Search</button>
                    </div>
                    <a type="button" class="btn btn-sm btn-outline-primary shadow-sm"
                       href="{{route('students.create')}}">New</a>

                </div>
                    @endif
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover  mb-0">
                    <thead class="thead-light">
                    <tr>
                    <tr>
                        <th scope="col" class="pl-4">Student ID</th>
                        <th scope="col">Full name</th>
                        <th scope="col">NIC No.</th>
                        <th scope="col">District</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">
                            Actions
                        </th>
                    </tr>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $students as $student)
                        <tr data-did="{{$student->id}}">
                            <th scope="row" class="pl-4">{{$student->reg_no}}</th>
                            <td>{{$student->fullname}}</td>
                            <td>{{$student->nic}}</td>
                            <td>{{$student->district}}</td>
                            <td>{{$student->phone}}</td>
                            <td>
                                <div class="dropdown dropleft">
                                    <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">


                                        <a class="dropdown-item"
                                           href="{{ route('students.courses',['id'=>$student->id]) }}"><i
                                                class="fas fa-graduation-cap"></i> Courses</a>
                                        @if(Auth::user()->hasAnyRole(['Admin']))
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item"
                                           href="{{ route('students.enroll',['id'=>$student->id]) }}"><i
                                                class="fas fa-user-plus"></i> Enroll</a>
                                        <a class="dropdown-item"
                                           href="{{ route('students.edit',['id'=>$student->id]) }}"><i
                                                class="far fa-edit"></i> Edit</a>
                                        <a class="dropdown-item text-danger"
                                           href="{{ route('students.delete',['id'=>$student->id]) }}"><i
                                                class="far fa-trash-alt"></i> Delete</a>
                                            @endif
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
                    <span>{{$students->firstItem()}} to {{$students->lastItem()}} of  {{$students->total()}}</span>
                </div>
                <div class="col-auto">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="departmentEditModal" tabindex="-1" role="dialog" aria-labelledby="departmentEditModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="departmentEditModal">Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="code">Department Code</label>
                                    <input id="code" class="form-control" type="text" name="code" maxlength="3">
                                </div>
                                <div class="form-group">
                                    <label for="d_name">Department Name</label>
                                    <input id="d_name" class="form-control" type="text" name="d_name" maxlength="255">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="department_save" type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    @include('includes.deletemodal')

    <script>
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('departments.edit') }}';

    </script>
@endsection
