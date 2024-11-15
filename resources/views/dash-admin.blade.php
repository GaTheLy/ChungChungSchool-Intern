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

        

        
    
    @endsection 