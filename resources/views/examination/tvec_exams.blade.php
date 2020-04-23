@extends('layouts.master')
@section('title')
    TVEC Exams Summary
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">TVEC Exams Summary</h5>
            </div>
            <div class="col">
              <form class="form-inline my-2 my-lg-0" action="{{route('tvec.exams.batch')}}" method="POST">
                  <select class="custom-select custom-select-sm  col-8" name="batch_couese_id" id="batch_couese_id" required>
                    <option value="" selected>Select Course</option>
                      @foreach ($courses as $course)
                        <option value="{{$course->id}}" >{{$course->name}}</option>
                      @endforeach
                  </select>
                  <select class="custom-select custom-select-sm col-3" name="batch_id" id="batch_id">
                    <option value="" selected>Select Batch</option>
                  </select>
                  <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-search"></i></button>
                  <input type="hidden" name="_token" value="{{Session::token()}}">
              </form>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('tvec.exams.create')}}">New</a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover  mb-0">
                <thead class="thead-light">
                    <tr>
                      <th scope="col" class="pl-4">Module</th>
                      <th scope="col">Academic Year</th>
                      <th scope="col">Students</th>
                      <th scope="col">Pass Rate</th>
                      <th scope="col">Exam Date</th>
                      <th scope="col">
                          Actions
                      </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach( $tvecexams as $tvecexam)
                          <tr data-did="{{$tvecexam->id}}">
                      
                              <td class="pl-4" data-toggle="tooltip" data-placement="top" title="{{$tvecexam->module->course->name}}" ><b>{{$tvecexam->module->code}}</b> {{$tvecexam->module->name}} <small class="text-primary">{{$exams[$tvecexam->exam_type]}}</small> </td>
                              <td><span data-toggle="tooltip" data-placement="top" title="{{$tvecexam->academic_year->status}}" class="{{($tvecexam->academic_year->status=='Active')? 'text-primary' : (($tvecexam->academic_year->status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span> {{$tvecexam->academic_year->name}}</td>
                              <td>{{$tvecexam->number_pass}} Pass  of {{$tvecexam->number_students}} 
                              </td>
                              <td>
                                <div class="progress">
                                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{($tvecexam->number_students == 0)? 0 : ($tvecexam->number_pass/$tvecexam->number_students)*100}}%" aria-valuenow="{{($tvecexam->number_students == 0)? 0 : ($tvecexam->number_pass/$tvecexam->number_students)*100}}" aria-valuemin="0" aria-valuemax="100">{{round(($tvecexam->number_students == 0)? 0 : ($tvecexam->number_pass/$tvecexam->number_students)*100)}}%</div>
                                </div>                </td>
                              <td>{{$tvecexam->exam_date}}</td>
                              <td>
                               <div class="dropdown dropleft" tabindex="1">
                                  <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-ellipsis-h"></i>
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="{{ route('tvec.exams.results',['id'=>$tvecexam->id]) }}"><i class="fas fa-graduation-cap"></i> Results</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item " href="{{ route('tvec.exams.results',['id'=>$tvecexam->id]) }}"><i class="far fa-edit"></i> Edit</a>
                                      <a class="dropdown-item text-danger" href="{{ route('tvec.exams.delete',['id'=>$tvecexam->id]) }}"><i class="far fa-trash-alt"></i> Delete</a>
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
                <span>{{$tvecexams->firstItem()}} to {{$tvecexams->lastItem()}} of  {{$tvecexams->total()}}</span>
            </div>
            <div class="col-auto">
                {{ $tvecexams->links() }}
            </div>
        </div>
    </div>
</div> 
  <script>
    var token = '{{ Session::token() }}';
    var urlBatchesByCourse = '{{ route('ajax.batches') }}';
    
  </script>
@endsection