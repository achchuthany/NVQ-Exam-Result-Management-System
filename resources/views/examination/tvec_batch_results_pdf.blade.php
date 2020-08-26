@extends('layouts.pdf')
@section('header')
@endsection

@section('footer')
    <p>
        @foreach ($exams as $exam)
            <small> <b>{{$exam->module_code}}</b>:{{$exam->module_name}} ({{$exam_types[$exam->exam_type]}})</small>
        @endforeach

        <br><small> This is a computer generated report and this will be not considered as an official document of Sri
            Lanka - German Training Institute </small>
@endsection
@section('content')
    <p class="text-center"><b>TVEC Academic Transcript</b></p>
    <p> <b>Course </b> {{$batch->course->name}} </p>
    <p> <b>Batch </b> {{$batch->name}} ({{$batch->academic_year->name}}) </p>
    <table class="table-sm">
        <thead class="thead-light">
        <tr>
            <th scope="col">Student ID</th>
            <th scope="col">Name</th>
            <th scope="col">NVQ Status</th>
            @foreach($exams as $exam)
                <th scope="col">{{$exam->module_code}} <span> ({{$exam->exam_type}}) </span></th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        <span hidden>{{$id=1}}</span>
        @foreach($results as $index => $result_row)
            <tr>
                <th> {{$students[$index]->reg_no}} </th>
                <td> {{$students[$index]->shortname}} </td>
                <span hidden>
                                        {{$pass = $students[$index]->tvec_exam_pass}}
                    {{$total = $students[$index]->tvec_exam_modules}}
                                </span>
                <td>
                    @if($pass==$total)
                        <b class="text-primary">Pass</b>
                    @endif
                    @if($pass!=$total)
                        <b class="text-danger">Fail</b>
                    @endif
                </td>
                @foreach($result_row as $result)
                    <td>
                                        <b
                                            class="{{ ($result->result == 'P') ? 'text-dark':'text-secondary'}}">{{$exam_pass[$result->result]}}</b>
                        <sup>{{$result->attempt}}</sup>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
