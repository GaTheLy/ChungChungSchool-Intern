@extends('base.base-admin')
    <!-- section content -> yield content base.blade -->
    @section('content')
    <style>
        h1{
            font-family:'Space Grotesk';
            /* font-weight: bold; */
            font-size: 40px;
        }
        h5{
            padding-left: 10px;
            padding-top: -20px;
            font-family:'Lexend Deca';
            font-weight: 400;
            font-size: 25px;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 0.8rem;
            color: #fff;
            background-color: #28a745;
            border-radius: 12px;
        }

        .main-content {
            margin-top: 30px;
        }

        .main-content h2 {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .programs {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            gap: 40px;
            font-family:'Space Grotesk';
        }

        .program {
            background-color: #d0ebff;
            border: 1px solid #ced4da;
            border-radius: 8px;
            width: 250px;
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 2.1rem;
            font-weight: 600;
        }
        a{
            text-decoration: none;
            color: black;
        }
    </style>
    
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-3">
                <h5>Hi, {{ $teacher->first_name }}!</h5>
            </div>
            <div class="col">
                <span>role {{$role}}</span>
            </div>
        </div>

    <br>

    <div class="main-content">
            <h2>Report Customization</h2>
            <div class="programs">
                <div class="program"><a href="{{ route('pypCustom.show', ['userId' => $teacher->user_id]) }}" > Primary Year Program</a></div>
                <div class="program"><a href="{{ route('mypCustom.show', ['userId' => $teacher->user_id]) }}" >Middle Year Program</a></div>
            </div>
    </div>

    {{-- if admin also teaches some subjects or being a homeroom... --}}    
<br><br>    
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