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
        a{
            color:white;
            text-decoration: none;
        }
    </style>
    
        <h1>Subject</h1>
        <div class="row">
            <div class="col-6" style="text-align:left;">
                <h5>[full name]</h5>
            </div>
        </div>

        <br><br>
        <div class="row">
            <div class="col-3">
                <h5>1. Subject's Name</h5>
            </div> 

            <div class="col-6" style="text-align:left;margin-left:-55px;">
            <input type="text" name="" id="" style="height:40px;width:500px;"></input>
            </div>
        </div>
<br>
        <div class="row">
            <div class="col-3">
                <h5>2. Level </h5>
            </div> 
            
            <div class="col-2" style="text-align:left;margin-left:-55px;">
                <select id="inputState" class="form-select">
                <option selected>Choose...</option>
                <option>MYP</option>
                <option>PYP</option>
                </select>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-3">
                <h5>3. Grade Input </h5>
            </div> 
            
            <div class="row">
                <div class="col-3" style="margin-left:80px;">
                    <span>Criteria </span>
                    <div class="row">
                        <div class="col-2">
                        <span style="height:35px;width:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:10px;"></span>
                        </div>
                        <div class="col-4">
                            <span style="height:35px;width:155px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:10px;"></span>
                        </div>
                    </div>
                    

                </div> 
                <div class="col-1">
                    <span>Range </span>
                        <div class="row">
                        <span style="height:35px;width:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;">1</span>
                        </div>
                        <div class="row">
                        <span style="height:35px;width:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;">2</span>
                        </div>
                        <div class="row">
                        <span style="height:35px;width:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;">3</span>
                        </div>
                        <div class="row">
                        <span style="height:35px;width:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;">4</span>
                        </div>
                        <div class="row">
                        <span style="height:35px;width:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;">5</span>
                        </div>
                        <div class="row">
                        <span style="height:35px;width:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;">6</span>
                        </div>
                        <div class="row">
                        <span style="height:35px;width:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;">7</span>
                        </div>
                        <div class="row">
                        <span style="height:35px;width:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;">8</span>
                        </div>
                </div> 
                <div class="col-4">
                    <span>Descriptor</span>
                    <div class="row">
                        <span style="height:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;"></span>
                        </div>
                        <div class="row">
                        <span style="height:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;"></span>
                        </div>
                        <div class="row">
                        <span style="height:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;"></span>
                        </div>
                        <div class="row">
                        <span style="height:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;"></span>
                        </div>
                        <div class="row">
                        <span style="height:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;"></span>
                        </div>
                        <div class="row">
                        <span style="height:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;"></span>
                        </div>
                        <div class="row">
                        <span style="height:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;"></span>
                        </div>
                        <div class="row">
                        <span style="height:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;"></span>
                        </div>
                </div> 
            </div>
        </div>




<br>
        <div class="row">
            <div class="col" style="text-align:right;margin-right:100px;">
            <a href="" style="color:black">add more criteria</a>
            <i class="lni lni-circle-plus"></i>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col" style="text-align:right;margin-right:100px;">
            <button type="button" class="btn btn-primary" ><a href="http://ccs-report-development.test:8080/subject-admin">Save</a></button>
            </div>
        </div>



    
    @endsection 