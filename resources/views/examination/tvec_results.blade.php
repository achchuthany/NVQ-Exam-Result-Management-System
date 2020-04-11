@extends('layouts.master')
@section('title')
    TVEC Examination Results Summary
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-6">
        <h4 class="pt-2"> TVEC Examination Results Summary</h4>
    </div>
    <div class="col-5">

    </div>
    <div class="col-1">
      <a type="button" class="btn btn-sm btn-primary " href="{{route('tvec.exams.create')}}"><i class="fas fa-plus-circle"></i> New</a>
    </div>
</div>
<div class="row align-items-center mt-2">
    <div class="col-6">
        <div class="card tborder-light mb-3">
            <div class="card-header">View Results by Course</div>
            <div class="card-body">  
              <form class=" my-2 my-lg-0" action="{{route('tvec.results.batch')}}" method="POST">
                <div class="form-group">
                    <h5 class="card-title">Course</h5>
                    <select class="custom-select" name="batch_couese_id" id="batch_couese_id" required>
                      <option value="" selected>Select Course</option>
                        @foreach ($courses as $course)
                          <option value="{{$course->id}}">{{$course->name}}</option>
                         @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <h5 class="card-title">Batch</h5>
                    <select class="custom-select my-2 my-sm-0" name="batch_id" id="batch_id">
                    <option value="" selected>Select Batch</option>
                    </select>
                </div>
                <div class="form-group">            
                    <button type="submit" class="btn btn-sm btn-primary my-2 my-sm-0"><i class="fas fa-search"></i></button>
                    <input type="hidden" name="_token" value="{{Session::token()}}">  
                </div>
              </form>
            </div>
          </div>
    </div>
    <div class="col-6">
        
    </div>
</div>

  <script>
    var token = '{{ Session::token() }}';
    var urlBatchesByCourse = '{{ route('ajax.batches') }}';
  </script>
@endsection