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
                <h5>{{$teacher->first_name}}</h5>
            </div>
        </div>

<form method="POST" action="{{route('subject-add.submit',['userId' => $teacher->user_id])}}">
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col-3">
                <h5>1. First Name</h5>
            </div> 

            <div class="col-6" style="text-align:left;margin-left:-55px;">
            <input type="text" name="first_name" id="first_name" style="height:40px;width:500px;"></input>
            </div>
        </div>
        <br>
        <div class="row">
                    <div class="col-3">
                        <h5>2. Last Name</h5>
                    </div> 

                    <div class="col-6" style="text-align:left;margin-left:-55px;">
                    <input type="text" name="last_name" id="last_name" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
        <div class="row">
                    <div class="col-3">
                        <h5>3. Email</h5>
                    </div> 

                    <div class="col-6" style="text-align:left;margin-left:-55px;">
                    <input type="text" name="email" id="email" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
        <div class="row">
                    <div class="col-3">
                        <h5>4. NIP</h5>
                    </div> 

                    <div class="col-6" style="text-align:left;margin-left:-55px;">
                    <input type="text" name="nip" id="nip" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        {{-- <div class="row">
                    <div class="col-3">
                        <h5>4. Phone</h5>
                    </div> 

                    <div class="col-6" style="text-align:left;margin-left:-55px;">
                    <input type="text" name="phone" id="phone" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
        <div class="row">
                    <div class="col-3">
                        <h5>5. Address</h5>
                    </div> 

                    <div class="col-6" style="text-align:left;margin-left:-55px;">
                    <textarea name="address" id="address" style="height:80px;width:500px;"></textarea>
                    </div>
                </div> --}}
        
        <br>
        <div class="row">
            <div class="col-3">
                <h5>5. Level </h5>
            </div> 
            
            <div class="col-2" style="text-align:left;margin-left:-55px;">
                <select name="option" id="option">
                <option value="">--Select--</option>
                <option value="PYP" name="PYP">PYP</option>
                <option value="MYP" name="MYP">MYP</option>
                </select>
            </div>
        </div>

            <button type="button" class="btn btn-primary" >Save</button>

        <br>
        {{--  <div class="row">
                    <div class="col-3">
                        <h5>4. Homeroom</h5>
                    </div> 

                    <div class="col-6" style="text-align:left;margin-left:-55px;">
                    <input type="text" name="" id="" style="height:40px;width:500px;"></input>
                    </div>
                </div> --}}
        
    </div>
        
    </form>



    
    @endsection 