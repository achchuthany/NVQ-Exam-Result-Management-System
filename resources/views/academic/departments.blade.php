@extends('layouts.master')
@section('title')
    Departments
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2"> Departments</h4>
    </div>
    @if(Auth::user()->hasAnyRole(['Admin']))
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-sm btn-primary" href="{{route('departments.create')}}">New</a>
        </div>
    </div>
    @endif
</div>
<div class="row align-items-center mt-2">
    <div class="col-12 table-responsive">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Code</th>
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
              <th scope="row">{{$department->code}}</th>
                <td>{{$department->name}}</td>
                @if(Auth::user()->hasAnyRole(['Admin']))
                <td>                    
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-warning department-edit">Edit</button>
                        <a type="button" class="btn btn-sm btn-danger" href="{{ route('departments.delete',['d_id'=>$department->id]) }}">Delete</a>       
                      </div>
                </td>
                @endif
              </tr>
              @endforeach
              
            </tbody>
          </table>
          <nav>
            <ul class="pagination pagination-sm justify-content-end">
              <li class="page-item">
                <span class="page-link">
                Showing {{$departments->firstItem()}} to {{$departments->lastItem()}} of  {{$departments->total()}} entries
                </span>
              </li>
              <p>
              {{ $departments->links() }}
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