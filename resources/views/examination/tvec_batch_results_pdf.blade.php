@extends('layouts.pdf')
@section('header')
    <p class="text-center"><b>TVEC Academic Transcript</b></p>
    <table class="table table-sm table-borderless">
        <tr>
            <td><b class="text-dark">Course </b></td>
            <td>{{$batch->course->name}} </td>

            <td class="text-right"><b class="text-dark">Batch </b></td>
            <td class="text-left"> {{$batch->name}} ({{$batch->academic_year->name}}) </td>
        </tr>
    </table>
@endsection

@section('footer')
    <p>
        <small> This is a computer generated report and this will be not considered as an official document of Sri
            Lanka - German Training Institute </small></p>
@endsection
@section('content')
    <br>
    <table class="table table-sm table-striped table-borderless">
        <thead class="bg-primary text-light">
        <tr>
            <th scope="col"><small>Student ID</small></th>
            <th scope="col"><small>Name</small></th>
            <th scope="col" class="text-center"><small>NVQ Status</small></th>
            @foreach($exams as $exam)
                <th scope="col" class="text-center"><small>{{$exam->module_code}}<span> ({{$exam->exam_type}})</span></small></th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($results as $index => $result_row)
            <tr class="border-bottom border-info">
                <th><small> {{$students[$index]->reg_no}}</small> </th>
                <td class="text-left"><small>{{$students[$index]->shortname}}</small></td>
                <td class="text-center">
                    @if($students[$index]->tvec_exam_pass == $students[$index]->tvec_exam_modules)
                        <small>Pass</small>
                    @else
                        <small class="text-danger">Fail</small>
                    @endif
                </td>
                @foreach($result_row as $result)
                    <td class="text-center">
                                        <small
                                            class="{{ ($result->result == 'P') ? 'text-dark':'text-danger'}}">{{$result->result}}</small>
                        <small class="text-info"> / {{$result->attempt}}</small>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    <p>
    @foreach ($exams as $exam)
        <small><b class="text-dark">{{$exam->module_code}}</b> - {{$exam->module_name}} ({{$exam_types[$exam->exam_type]}})</small>
    @endforeach
    </p>
@endsection
