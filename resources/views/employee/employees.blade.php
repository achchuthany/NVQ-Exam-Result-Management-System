@extends('layouts.master')
@section('title')
Employees
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-md-4 col-xs-12">
    <h4 class="pt-2"> Employees </div>
    <div class="col-md-8 col-xs-12">
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-sm btn-secondary" href="{{route('employees')}}">All</a>
        <a type="button" class="btn btn-sm btn-primary" href="{{route('employees.create')}}">New</a>
        
      </div>
      <form method="post" action="{{route('employees.search')}}">
        <div class="btn-group float-right mr-2" role="group">      
          <input type="text" name="fullname" class="form-control form-control-sm" placeholder="Full name">
          <button type="submit" class="btn btn-sm btn-secondary">Search</button>
          <input type="hidden" name="_token" value="{{Session::token()}}">      
        </div>
      </form>
    </div>
</div>
<div class="row align-items-center mt-2">
    <div class="col-12 table-responsive">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">EPF No.</th>
                <th scope="col">Name</th>
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
                <th scope="row">{{$employee->epf}}</th>
                <td>{{$employee->fullname}}</td>
                <td>{{$employee->position}}</td>
                <td>{{$employee->department->name}}</td>
                <td>{{$employee->status}}</td>
                <td>                    
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-warning department-edit">Edit</button>
                        <a type="button" class="btn btn-sm btn-danger" href="{{ route('departments.delete',['d_id'=>$employee->id]) }}">Delete</a>
                    </div>
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          <nav>
            <ul class="pagination pagination-sm justify-content-end">
              <li class="page-item">
                <span class="page-link">
                Showing {{$employees->firstItem()}} to {{$employees->lastItem()}} of  {{$employees->total()}} entries
                </span>
              </li>
              <p>
              {{ $employees->links() }}
              </p>
            </ul>
          </nav>
    </div>
</div>
 
  <!-- Modal -->
  <div class="modal fade" id="departmentEditModal" tabindex="-1" role="dialog" aria-labelledby="departmentEditModal" aria-hidden="true">
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