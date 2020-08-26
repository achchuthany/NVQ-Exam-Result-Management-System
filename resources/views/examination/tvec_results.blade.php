@extends('layouts.master')
@section('title')
    TVEC Examination Results Summary
@endsection
@section('content')

<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">TVEC Examination Results Summary</h5>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('tvec.exams.create')}}">New</a>
            </div>
        </div>
    </div>
</div>

<div class="row align-items-center mt-2">
    <div class="col-6">
         <form class=" my-2 my-lg-0" action="{{route('tvec.results.batch')}}" method="POST">
        <div class="card mb-3 tborder-light mb-3">
            <div class="card-header">
                <h5 class="mb-0 font-weight-light">View Results by Course</h5>
            </div>
            <div class="card-body">
                    <div class="form-group">
                        <h6 class="card-title">Course</h6>
                        <select class="custom-select" name="batch_couese_id" id="batch_couese_id" required>
                      <option value="" selected>Select Course</option>
                        @foreach ($courses as $course)
                          <option value="{{$course->id}}">{{$course->name}}</option>
                         @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <h6 class="card-title">Batch</h6>
                        <select class="custom-select" name="batch_id" id="batch_id">
                    <option value="" selected>Select Batch</option>
                    </select>
                    </div>
                    <div class="form-group">

                    </div>
            </div>
            <div class="card-footer bg-white">
                <div class="pt-1 no-gutters row">
                    <div class="col">

                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-sm btn-primary my-2 my-sm-0"><i class="fas fa-search"></i> View Results</button>
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </div>
                </div>
            </div>
        </div>
         </form>
{{--    </div>--}}
{{--    <div class="col-6">--}}
{{--                 <form class=" my-2 my-lg-0" action="{{route('tvec.results.batch')}}" method="POST">--}}
{{--        <div class="card mb-3 tborder-light mb-3">--}}
{{--            <div class="card-header">--}}
{{--                <h5 class="mb-0 font-weight-light">View Results by Student</h5>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}

{{--                    <div class="form-group">--}}
{{--                        <h6 class="card-title">Student</h6>--}}
{{--                          <input type="text" class="form-control" placeholder="Search by Student ID E.g. 2020/ICT/5IT01" >--}}
{{--                        <ul class="list-group list-group-flush mt-2">--}}
{{--                          <li class="list-group-item d-flex justify-content-between align-items-center">--}}
{{--                          Cras justo odio--}}
{{--                          <span class="badge badge-primary badge-pill">14</span>--}}
{{--                          </li>--}}
{{--                         --}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--         </form>--}}
{{--    </div>--}}
    </div>
</div>

  <script>
    var token = '{{ Session::token() }}';
    var urlBatchesByCourse = '{{ route('ajax.batches') }}';
  </script>
@endsection
