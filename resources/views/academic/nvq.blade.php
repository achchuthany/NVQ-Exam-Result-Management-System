@extends('layouts.master')
@section('title')
Add a NVQ Level
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Add a NVQ Level</h5>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('nvqs')}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
            <form method="post" action="{{route('nvqs.create')}}">
            <div class="form-group">
                <label for="n_name">NVQ Level Name</label>
                <input id="n_name" class="form-control" type="text" name="n_name">
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-sm btn-primary float-right" >Save</button>
              <input type="hidden" name="_token" value="{{Session::token()}}">
            </div>
        </form>
    </div>   
</div>
@endsection