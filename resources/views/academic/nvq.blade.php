@extends('layouts.master')
@section('title')
Create a NVQ Level
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2">Create a NVQ Level</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-sm btn-dark" href="{{route('nvqs')}}">Back</a>
        </div>
    </div>
</div>
<div class="row align-items-center mt-2">
    <div class="col-12">
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