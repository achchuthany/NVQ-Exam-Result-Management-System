@extends('layouts.pdf')
@section('header')
@endsection

@section('footer')
<p>
@foreach ($exams as $exam)
    <small> | {{$exam->module_code}} : {{$exam->module_name}} ({{$exam_types[$exam->exam_type]}}) | </small>
@endforeach

   <br><small> This is a computer generated report and this will be not considered as an official document of Sri Lanka - German Training Institute    </small>
@endsection
@section('content')
<h5>Overview of TVEC Examinatin</h5>

<p> Course: {{$batch->course->name}} </p>

<p> Batch : {{$batch->name}} ({{$batch->academic_year->name}}) </p>

            <table class="table table-sm">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">NVQ Status</th>
                    @foreach($exams as $exam)
                    <th scope="col">{{$exam->module_code}}({{$exam->exam_type}})</th>
                    @endforeach
                </tr>
                </thead>
            <span hidden>{{$isPrint=null}} {{$isName=null}} {{$id=0}}</span>
                <tbody>  
                   @foreach($results as $result)
                    @if($isName!=$result->student_id)
                        </tr><tr>
                        <th> {{$result->student->reg_no}} </th>
                        <td> {{$result->student->shortname}} </td>
                        <td >
                        <span hidden>
                            {{$pass = $students[$id]->tvec_exam_pass}}
                            {{$total = $students[$id]->tvec_exam_modules}}
                            {{$id++}}
                        </span>
                            @if($pass==$total)
                            <span class="badge badge-success">{{round(($pass/$total)*100)}}%</span> 
                            @endif
                            @if($pass!=$total)
                            <span class="badge badge-danger"> {{round(($pass/$total)*100)}}%</span> 
                            @endif
                        </td>
                    @endif
                    @if(!($isPrint==$result->student_id.$result->module_code.$result->exam_type))
                        <span hidden>{{$isPrint =$result->student_id.$result->module_code.$result->exam_type }} {{$isName=$result->student_id}}</span>
                        <td data-toggle="tooltip" title="{{$result->module_code}} {{$exam_types[$result->exam_type]}}">  
                            {{$exam_pass[$result->result]}} <sup><span class="badge  {{ ($result->result == 'P') ? 'badge-success':'badge-danger'}}">{{$result->attempt}}</span></sup>
                        </td>           
                    @endif
                   @endforeach
                </tbody>
            </table>
@endsection