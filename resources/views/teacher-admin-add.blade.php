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
    
        <h1>Teacher</h1>
        <div class="row">
            <div class="col-6" style="text-align:left;">
                <h5>[full name]</h5>
            </div>
        </div>

        <br><br>
        <div class="row">
            <div class="col-3">
                <h5>1. First Name</h5>
            </div> 

            <div class="col-6" style="text-align:left;margin-left:-55px;">
            <input type="text" name="" id="" style="height:40px;width:500px;"></input>
            </div>
        </div>
        <br>
        <div class="row">
                    <div class="col-3">
                        <h5>2. Last Name</h5>
                    </div> 

                    <div class="col-6" style="text-align:left;margin-left:-55px;">
                    <input type="text" name="" id="" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
        <div class="row">
                    <div class="col-3">
                        <h5>3. Email</h5>
                    </div> 

                    <div class="col-6" style="text-align:left;margin-left:-55px;">
                    <input type="text" name="" id="" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
        <div class="row">
                    <div class="col-3">
                        <h5>4. Phone</h5>
                    </div> 

                    <div class="col-6" style="text-align:left;margin-left:-55px;">
                    <input type="text" name="" id="" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
        <div class="row">
                    <div class="col-3">
                        <h5>5. Address</h5>
                    </div> 

                    <div class="col-6" style="text-align:left;margin-left:-55px;">
                    <textarea name="" id="" style="height:80px;width:500px;"></textarea>
                    </div>
                </div>
        <br>
        <div class="row">
            <div class="col-3">
                <h5>6. Level </h5>
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
                        <h5>4. Homeroom</h5>
                    </div> 

                    <div class="col-6" style="text-align:left;margin-left:-55px;">
                    <input type="text" name="" id="" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>




<br>

        <br>
        <div class="row">
            <div class="col" style="text-align:right;margin-right:100px;">
            <button type="button" class="btn btn-primary" ><a href="http://ccs-report-development.test:8080/teacher-admin">Save</a></button>
            </div>
        </div>



    
    @endsection 