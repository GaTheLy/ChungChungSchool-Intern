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

        a{
            text-decoration: none;
        }
    </style>
    
        <!-- <h1>Subject List</h1> -->
        <h1>{{ $subject->subject_name }}</h1>
            

    <br>
    <h5 style="font-weight:200; font-size:25px" >Teaching</h5>
        <div class="row" id="homeroom-list" style="margin-left:10px">
            @foreach($classes as $class)
            <div class="card text-center mb-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><a href="/subject-teacher-detail-pyp">Special title treatment</a></h5>
            </div>
            </div>
            @endforeach
        </div>
    
    @endsection 