@extends('layouts.master')
@section('title')
    Attendance Sessions
@endsection
@section('content')
<form method="post" action="{{route('attendance.sessions.detete')}}">
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder"> Attendance Sessions</h5>
            </div>
            <div class="col">
               
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-secondary shadow-sm" href="{{route('attendances')}}">Back</a>
                <a type="button" class="btn btn-sm btn-outline-secondary shadow-sm" href="{{route('attendance.report',['mid'=>$module->id,'aid'=>$academic->id])}}">Report</a>
                <a type="button" class="btn btn-sm btn-outline-secondary shadow-sm" href="{{route('attendances')}}">Export</a>
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('attendance.session',['mid'=>$module->id,'aid'=>$academic->id])}}">New</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Module</h6>
            </div>
            <div class="col-10 py-1">
                 <h6 class="font-weight-lighter">{{$module->code}} - {{$module->name}}</h6>
            </div>
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Course</h6>
            </div>
            <div class="col-10 py-1">
                 <h6 class="font-weight-lighter">{{$module->course->code}} - {{$module->course->name}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Teacher(s)</h6>
            </div>
            <div class="col-10 py-1">
                 <h6 class="font-weight-lighter">
                  @foreach( $employees as $employee)
                  {{$employee->fullname}}
                  @endforeach
                 </h6>
            </div>
            <div class="col-2 py-1">
                <h6 class="font-weight-bolder"> Academic Year</h6>
            </div>
            <div class="col-10 py-1">
                 <h6 class=ont-weight-lighter"><span class="{{($academic->status=='Active')? 'text-primary' : (($academic->status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span>{{$academic->name}}</h6>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover  mb-0">
                <thead class="thead-light">
                    <tr>
                    <th scope="col" class="pl-4">ID</th>
                      <th scope="col">Date</th>
                      <th scope="col">Time</th>
                      <th scope="col">Description</th>
                      <th scope="col">Points</th>
                      <th scope="col">Percentage</th>
                      <th scope="col">
                          Actions
                      </th>
                      <th scope="col"> 
                        <div class="custom-control custom-checkbox" data-toggle="tooltip" data-placement="top" title="Select All">
                            <input type="checkbox" class="custom-control-input" id="selectAll">
                            <label class="custom-control-label" for="selectAll"></label>
                        </div>
                      </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <span hidden>{{$id = $sessions->firstItem()}}</span>
                        @foreach( $sessions as $session)
                          <tr data-did="{{$session->id}}">
                              <th class="pl-4">{{$id++}}</th>
                              <td>{{date_format(date_create($session->date),"D d/M/Y") }}</td>
                              <td>{{date_format(date_create($session->time_from),"H:iA") }} {{date_format(date_create($session->time_to),"H:iA") }}</td>
                              <td>{{$session->description }}</td>
                             <td>{{$session->present}}/{{($session->present+$session->absent)}}</td>
                              <td>
                                <div class="progress">
                                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{($session->present == 0)? 0 : ($session->present/($session->present+$session->absent))*100}}%" aria-valuenow="{{($session->present == 0)? 0 : ($session->present/($session->present+$session->absent))*100}}" aria-valuemin="0" aria-valuemax="100">{{round(($session->present == 0)? 0 : ($session->present/($session->present+$session->absent))*100)}}%</div>
                                </div>                
                              </td>
                              <td >
                               <div class="dropdown dropleft">
                                  <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-ellipsis-h"></i>
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="{{ route('attendance.take',['id'=>$session->id]) }}">Take Attendance</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item " href=""><i class="far fa-edit"></i> Edit</a>
                                      <a class="dropdown-item text-danger"data-record-url="{{route('attendance.session.detete',['id'=>$session->id])}}" data-record-title="{{date_format(date_create($session->date),"D d/M/Y") }} Sessions " data-toggle="modal" data-target="#delete-modal"><i class="far fa-trash-alt"></i> Delete</a>
                                  </div>
                              </div>                                                
                              </td>
                              <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="s{{$session->id}}" name="selected[]" value="{{$session->id}}">
                                    <label class="custom-control-label" for="s{{$session->id}}">  <i class="{{($session->present!=0 || $session->absent!=0)?'fas fa-check text-primary':''}}"></i>  </label>
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
                <span>{{$sessions->firstItem()}} to {{$sessions->lastItem()}} of  {{$sessions->total()}}</span>
            </div>
            <div class="col-auto">
                {{ $sessions->links() }}
            </div>
             <div class="ml-3 col-auto">
                <div class="form-group">
                    <input type="submit" id="delete" name="delete" value="Delete" class="confirm-delete-modal btn btn-danger" />              
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                </div>
            </div>
        </div>
    </div>
</div> 
</form>

@include('includes.deletemodal')
<script>
    var token = '{{ Session::token() }}';   
</script>
@endsection

@section('script')
        <script>
        $('.confirm-delete-modal').on('click', function(e){
            if($(this).closest('form').attr('data-submit') == "true")
            {
                $(this).closest('form').removeAttr('data-submit');
                $('.modal-delete').closest('.modal').removeClass('modal-show');
                return true;
            } else {
                $('#confirm-delete').modal('show');
                return false;
            }
        });

        $('.btn-ok').on('click', function(){
            $(this).closest('.modal').prev('form').attr('data-submit', 'true');
            $('.confirm-delete-modal').trigger('click');
        });

        $('#delete-modal').on('click', '.btn-delete', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var url = $(this).data('recordUrl');
            
            $.ajax({
            method: 'POST',
            url: url,
            data: {  _token: token }
            }).done(function(msg) {
             $modalDiv.modal('hide');
        });
    
            setTimeout(function() {
                $modalDiv.modal('hide');
            }, 1000)
        });
        $('#delete-modal').on('show.bs.modal', function(e) {
            var data = $(e.relatedTarget).data();
            $('.modaltitle', this).text(data.recordTitle);
            $('.btn-delete', this).data('recordUrl', data.recordUrl);
        });
    </script>
@endsection