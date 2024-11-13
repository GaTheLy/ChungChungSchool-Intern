@extends('base.base')
<!-- section content -> yield content base.blade -->
@section('content')
<style>
    h1{
        font-family:'Space Grotesk';
        font-size: 40px;
    }
    h5{
        padding-left: 10px;
        padding-top: -20px;
        font-family:'Lexend Deca';
        font-weight: 400;
        font-size: 25px;
    }
</style>

<h1> 
    Teacher's Dashboard
</h1>
<div class="row">
    <div class="col-3">
        <h5>Hi, {{ $teacher->first_name }}</h5>
    </div>
</div>

<br>

{{-- Homerooms Section --}}
@if (!$homerooms->isEmpty())
    <h5 style="font-weight:200; font-size:25px">Homeroom</h5>
    <div class="row" id="homeroom-list" style="margin-left:10px">
        @foreach($homerooms as $homeroom)
        <div class="card text-center mb-3 d-flex justify-content-center align-items-center" style="width: 18rem;height:11rem;font-weight:bold;font-size:large;margin:10px;">
            <div class="card-body d-flex justify-content-center align-items-center" style="height:100%">

            @if ($homeroom->class->class_level == 'PYP')
                    <a style="text-decoration:none;color:black;" href="{{ route('class.show', ['id' => $homeroom->class_id]) }}">
                        <div class="card-body">
                            {{ $homeroom->class->class_name }}
                        </div>
                    </a>
            @elseif ($homeroom->class->class_level == 'MYP')
                    <a style="text-decoration:none;color:black;" href="{{ route('class.show.myp', ['id' => $homeroom->class_id]) }}">
                        <div class="card-body">
                            {{ $homeroom->class->class_name }}
                        </div>
                    </a>
            @endif
            </div>
        </div>

        @endforeach
    </div>
    <br><br>
@endif



{{-- Subjects Section --}}
@if (!$subjects->isEmpty())
    <h5 style="font-weight:200; font-size:25px">Teaching</h5>
    <div class="row" id="teaching-list" style="margin-left:10px">
        @foreach($subjects as $subject)
            @foreach($subject->classes as $class)
                <div class="card text-center mb-3 d-flex justify-content-center align-items-center" style="width: 18rem;height:11rem;font-weight:bold;font-size:large;">
                    <a href="{{ route('subject.show', [
                        'teacher_id' => $teacher->nip_pyp,
                        'sub_id' => $subject->subject->id,
                        'class_id' => $class->class_id
                    ]) }}">
                        <div class="card-body d-flex justify-content-center align-items-center" style="height:100%">
                        {{ $subject->subject->subject_name }}
                        <br> ({{ $class->class_name }})
                        </div>
                    </a>
                </div>
            @endforeach
        @endforeach
    </div>
@endif

{{-- No Data Available --}}
@if ($homerooms->isEmpty() && $subjects->isEmpty())
    <b>No homeroom or teaching assignments are available for you at the moment.</b>
@endif

@endsection
