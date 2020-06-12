@extends('layouts.master')
@section('title')
    TVEC Exams Summary
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">TVEC Exams</h5>
            </div>
            <div class="col">

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
                                  <a  class="btn btn-sm btn-light" href="{{ route('tvec.exams.results',['id'=>$tvecexam->id]) }}"><i class="fas fa-eye"></i> Results</a>
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
