@extends('layouts.pdf')
@section('header')
    <p class="text-center"><b>TVEC Academic Transcript</b></p>
    <table class="table-sm">
        <tr>
            <td><b class="text-dark">Course </b> {{$batch->course->name}} </td>

            <td class="text-right"><b class="text-dark">Batch </b> {{$batch->name}} ({{$batch->academic_year->name}}) </td>
        </tr>
    </table>


@endsection

@section('footer')
    <p>
        <small> This is a computer generated report and this will be not considered as an official document of Sri
            Lanka - German Training Institute </small>
@endsection
@section('content')
    <table class="table-sm table-bordered ">
        <thead class="bg-light">
        <tr>
            <th scope="col">Student ID</th>
            <th scope="col">Name</th>
            <th scope="col">NVQ Status</th>
            @foreach($exams as $exam)
                <th scope="col" class="text-center text-primary">{{$exam->module_code}}<span> ({{$exam->exam_type}})</span></th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        <span hidden>{{$id=1}}</span>
        @foreach($results as $index => $result_row)
            <tr class="text-center">
                <th> {{$students[$index]->reg_no}} </th>
                <td class="text-left"> {{$students[$index]->shortname}} </td>
                <span hidden>
                                        {{$pass = $students[$index]->tvec_exam_pass}}
                    {{$total = $students[$index]->tvec_exam_modules}}
                                </span>
                <td>
                    @if($pass==$total)
                        <small class="text-success">Pass</small>
                    @endif
                    @if($pass!=$total)
                        <small class="text-danger">Fail</small>
                    @endif
                </td>
                @foreach($result_row as $result)
                    <td>
                                        <span
                                            class="{{ ($result->result == 'P') ? 'text-success':'text-danger'}}">{{$result->result}}</span>
                        <small>{{$result->attempt}}</small>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    <p class="text-center">
    @foreach ($exams as $exam)
        <small> <b class="text-primary">{{$exam->module_code}}</b>:{{$exam->module_name}} ({{$exam_types[$exam->exam_type]}})</small>
    @endforeach
    </p>
@endsection
