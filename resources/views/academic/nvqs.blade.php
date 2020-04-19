@extends('layouts.master')
@section('title')
    NVQ Levels
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2"> NVQ Levels</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-sm btn-primary" href="{{route('nvqs.create')}}">New</a>
        </div>
    </div>
</div>
<div class="row align-items-center mt-2">
    <div class="col-12 table-responsive">
        <table class="table table-striped table-borderless table-hover shadow-sm">
            <thead class="table-primary">
              <tr>
                <th scope="col">#ID</th>
                <th scope="col">NVQ Name</th>
                <th scope="col">
                    Actions
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach( $nvqs as $nvq)
              <tr>
              <th scope="row">{{$nvq->id}}</th>
                <td>{{$nvq->name}}</td>
                <td>                    
                    <div class="btn-group" role="group">
                        <a  class="btn btn-sm btn-warning nvq-edit"> Edit</a>
                        <a  class="btn btn-sm btn-danger" href="{{ route('nvqs.delete',['n_id'=>$nvq->id]) }}"> Delete</a>
                    </div>
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
    </div>
</div>
 
  <!-- Modal -->
  <div class="modal fade" id="nvqEditModal" tabindex="-1" role="dialog" aria-labelledby="nvqEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content bg-light">
        <div class="modal-header text-light bg-dark">
          <h5 class="modal-title" id="nvqEditModal">Edit NVQ Level</h5>
          <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
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
        <div class="modal-footer border-0">
          <button id="nvq_save" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('nvqs.edit') }}';
  </script>
@endsection