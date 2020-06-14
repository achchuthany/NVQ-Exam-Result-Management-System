@extends('layouts.master')
@section('title')
    NVQ Levels
@endsection
@section('content')

<div class="card mb-3">
  <div class="card-header bg-white">
    <div class="align-items-center row">
      <div class="col">
        <h5 class="mb-0 font-weight-bolder">NVQ Levels</h5>
      </div>
        @if(Auth::user()->hasAnyRole(['Admin']))
      <div class="text-right col-auto">
      <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('nvqs.create')}}">New</a>
      </div>
        @endif
    </div>
  </div>
  <div class="card-body p-0">
        <div class="table-responsive">
        <table class="table table-hover  mb-0">
            <thead class="thead-light">
              <tr>
                <th scope="col" hidden>#ID</th>
                <th scope="col" class="pl-4">NVQ Name</th>
                  @if(Auth::user()->hasAnyRole(['Admin']))
                <th scope="col">
                    Actions
                </th>
                  @endif
              </tr>
            </thead>
            <tbody>
              @foreach( $nvqs as $nvq)
              <tr class="btn-reveal-trigger">
              <th scope="row" hidden>{{$nvq->id}}</th>
                <td class="pl-4">{{$nvq->name}}</td>
                  @if(Auth::user()->hasAnyRole(['Admin']))
                <td>
                  <div class="dropdown dropleft">
                      <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item nvq-edit" href="#">Edit</a>
                          <a class="dropdown-item text-danger" href="{{ route('nvqs.delete',['n_id'=>$nvq->id]) }}">Delete</a>
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
     <span>{{$nvqs->firstItem()}} to {{$nvqs->lastItem()}} of  {{$nvqs->total()}}</span>
    </div>
    <div class="col-auto">
      {{ $nvqs->links() }}
    </div>
  </div>
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
