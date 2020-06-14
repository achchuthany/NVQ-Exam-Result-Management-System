@extends('layouts.master')
@section('title')
    Batches
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Batches</h5>
            </div>
            @if(Auth::user()->hasAnyRole(['Admin']))
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('batches.create')}}">New</a>
            </div>
            @endif
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover  mb-0">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="pl-4">Name</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Academic Year</th>
                        <th scope="col">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $batches as $batch)
                    <tr data-bid="{{$batch->id}}">
                      <th class="pl-4">{{$batch->name}}</th>
                      <td>{{$batch->course->name}}</td>
                      <td><span data-toggle="tooltip" data-placement="top" title="{{$batch->academic_year->status}}" class="{{($batch->academic_year->status=='Active')? 'text-primary' : (($batch->academic_year->status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span> {{$batch->academic_year->name}}</td>
                      <td>
                          <div class="dropdown dropleft">
                            <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a  class="dropdown-item" href="{{ route('tvec.exams.results.batch',['id'=>$batch->id]) }}"><i class="fas fa-graduation-cap"></i> TVEC Results</a>
                              <a  class="dropdown-item" href="{{ route('students.batch',['id'=>$batch->id]) }}"><i class="fas fa-user-graduate"></i> Students</a>
                                @if(Auth::user()->hasAnyRole(['Admin']))
                                <div class="dropdown-divider"></div>
                              <a class="dropdown-item " href="{{ route('batches.edit',['id'=>$batch->id]) }}"><i class="far fa-edit"></i> Edit</a>
                              <a class="dropdown-item text-danger" href="{{ route('batches.delete',['id'=>$batch->id]) }}"><i class="far fa-trash-alt"></i> Delete</a>
                                @endif
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
                <span>{{$batches->firstItem()}} to {{$batches->lastItem()}} of  {{$batches->total()}}</span>
            </div>
            <div class="col-auto">
                {{ $batches->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
