@extends('layouts.master')
@section('title')
    Departments
@endsection
@section('content')
<div class="card mb-3">
  <div class="card-header bg-white">
    <div class="align-items-center row">
      <div class="col">
        <h5 class="mb-0 font-weight-bolder">Departments</h5>
      </div>
      <div class="text-right col-auto">
      <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('departments.create')}}">New</a>
      </div>
    </div>
  </div>
  <div class="card-body p-0">
        <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
              <tr>
               <th scope="col" class="pl-4">Code</th>
                <th scope="col">Department Name</th>
                @if(Auth::user()->hasAnyRole(['Admin']))
                <th scope="col">
                    Actions
                </th>
                @endif
              </tr>
            </thead>
            <tbody>
            @foreach( $departments as $department)
            <tr data-did="{{$department->id}}">
              <th scope="row" class="pl-4">{{$department->code}}</th>
                <td>{{$department->name}}</td>
                @if(Auth::user()->hasAnyRole(['Admin']))
                <td> 
                  <div class="dropdown dropleft">
                    <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="department-edit dropdown-item" href="#">Edit</a>
                        <a class="dropdown-item text-danger" href="{{ route('departments.delete',['d_id'=>$department->id]) }}">Delete</a>
                    </div>
                  </div>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
  </div>
  <div class="card-footer bg-white">
  <div class="pt-1 no-gutters row">
    <div class="col">
     <span>{{$departments->firstItem()}} to {{$departments->lastItem()}} of  {{$departments->total()}}</span>
    </div>
    <div class="col-auto">
      {{ $departments->links() }}
    </div>
  </div>
  </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="departmentEditModal" tabindex="-1" role="dialog" aria-labelledby="departmentEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content bg-light">
        <div class="modal-header text-light bg-dark">
          <h5 class="modal-title" id="departmentEditModal">Department</h5>
          <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
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
        <div class="modal-footer border-0">
          <button id="department_save" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('departments.edit') }}';
    
  </script>
@endsection