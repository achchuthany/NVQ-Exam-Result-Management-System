@extends('layouts.master')
@section('title')
    TVEC Examination Results
@endsection
@section('content')
    <div class="card mb-3">
        <div class="card-header bg-white border-0">
            <div class="align-items-center row">
                <div class="col">
                    <h5 class="mb-0 font-weight-bolder">TVEC Examination Results  </h5>
                </div>
                <div class="col-auto">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($results as $result)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header  border-0">
                                <div class="align-items-center row">
                                    <div class="col">
                                        <p class="mb-0  font-weight-lighter"> {{$result->module_code}} {{$result->module_name}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body ">
                                <div class="align-items-center row">
                                    <div class="col">
                                    <div class="h1 font-weight-lighter {{($result->result!='P'?'text-danger':'text-primary')}}">{{$exam_results[$result->result]}}</div>

                                </div>
                                <div class="col-auto text-right">
                                    <div>{{$exam_types[$result->exam_type]}}</div>
                                    <div>Attempt <span class="text-muted">{{$result->attempt}}</span></div>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer border-0">
            <div class="row ">
                <div class="col">

                </div>
                <div class="col-auto">
                </div>
            </div>
        </div>
    </div>
@endsection
