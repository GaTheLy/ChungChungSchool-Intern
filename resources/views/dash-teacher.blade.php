@extends('base.base-pyp')
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
    </style>
    
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-3">
                <h5>Hi, {{ $teacher->first_name }}</h5>
            </div>
            <div class="col">
                <span>role</span>
            </div>
        </div>

    <br>
    <h5 style="font-weight:200; font-size:25px" >Homeroom</h5>
        <div class="row" id="homeroom-list" style="margin-left:10px">
             @foreach($homerooms as $homeroom)
                <div class="card text-center mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <a href="{{ route('class.show', ['id' => $homeroom->class_id]) }}">
                            {{ $homeroom->class->class_name }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <br>
    <h5 style="font-weight:200; font-size:25px" >Teaching</h5>
        <div class="row" id="homeroom-list" style="margin-left:10px">
            @foreach($subjects as $subject)
                <div class="card text-center mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <a href="{{ route('subject.show', ['id' => $teacher->nip_pyp, 'sub_id' => $subject->subject_pyp_id]) }}">
                            {{ $subject->subject->subject_name }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    
    @endsection 