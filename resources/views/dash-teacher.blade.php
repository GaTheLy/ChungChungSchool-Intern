@extends('base.base')
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
                <h5>Hi, [first name]!</h5>
            </div>
            <div class="col">
                <span>role</span>
            </div>
        </div>

    <br>
    <h5 style="font-weight:200; font-size:25px" >Homeroom</h5>
        <div class="row" id="homeroom-list" style="margin-left:10px">
            <div class="card text-center mb-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
            </div>
            </div>
        </div>

        <br>
    <h5 style="font-weight:200; font-size:25px" >Teaching</h5>
        <div class="row" id="homeroom-list" style="margin-left:10px">
            <div class="card text-center mb-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
            </div>
            </div>
        </div>
    
    @endsection 