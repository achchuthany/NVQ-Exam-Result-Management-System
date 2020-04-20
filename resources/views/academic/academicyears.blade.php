@extends('layouts.master')
@section('title')
    Academic Years
@endsection
@section('content')
<div class="card mb-3">
  <div class="card-header bg-white">
    <div class="align-items-center row">
      <div class="col">
        <h5 class="mb-0 font-weight-bolder">Academic Years </h5>
      </div>
      <div class="text-right col-auto">
      <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('academics.create')}}">New</a>
      </div>
    </div>
  </div>
  <div class="card-body p-0">
        <div class="table-responsive">
        <table class="table table-hover table-sm  mb-0">
            <thead class="thead-light">
              <tr>
                <tr>
                <th scope="col" class="pl-4">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Start Date</th>
                <th scope="col">Completion Date</th>
                <th scope="col">Status</th>
                <th scope="col">
                    Actions
                </th>
              </tr>
              </tr>
            </thead>
            <tbody>
               @foreach( $academicyears as $academicyear)
              <tr>
              <th class="pl-4">{{$academicyear->id}}</th>
                <td>{{$academicyear->name}}</td>
                <td>{{$academicyear->start}}</td>
                <td>{{$academicyear->end}}</td>
                <td>
                <span class="rounded badge {{($academicyear->status=='Active')? 'badge-success' : (($academicyear->status=='Planning')? 'badge-primary':'badge-danger') }} p-1">{{$academicyear->status}} </span> 
                </td>
                <td> 
                  <div class="dropdown dropleft">
                  <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-h"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{ route('students.academic',['id'=>$academicyear->id]) }}">Students</a>
                  <div class="dropdown-divider"></div>
                  <a class="nvq-edit dropdown-item" href="#">Edit</a>
                  <a class="dropdown-item text-danger" href="{{ route('academics.delete',['id'=>$academicyear->id]) }}">Delete</a>
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
     <span>{{$academicyears->firstItem()}} to {{$academicyears->lastItem()}} of  {{$academicyears->total()}}</span>
    </div>
    <div class="col-auto">
      {{ $academicyears->links() }}
    </div>
  </div>
  </div>
</div>



 
  <!-- Modal -->
  <div class="modal fade" id="nvqEditModal" tabindex="-1" role="dialog" aria-labelledby="nvqEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="nvqEditModal">NVQ Level</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col">
                  <form method="post" action="">
                      <div class="form-group">
                          <label for="n_name">NVQ Level Name</label>
                          <input id="n_name" class="form-control" type="text" name="n_name">
                      </div>

                  </form>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="nvq_save" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

@include('includes.deletemodal')
  
  <script>
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('academics.edit') }}';
  </script>
@endsection