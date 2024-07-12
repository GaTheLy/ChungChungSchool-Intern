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
    
        <h1>Student</h1>
        <div class="row">
            <div class="col-6" style="text-align:left;">
                <h5>{{ $teacher->first_name }}</h5>
            </div>
        </div>

        <br><br>
        <form method="POST" action="{{route('student-edit.submit',['userId' => $teacher->user_id, 'studentId' => $selectedStudent->nim_pyp])}}">
            @csrf
            <br>
                <div class="row">
                    <div class="col-3">
                        <h5>1. NIS</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" value="{{$selectedStudent->nim_pyp}}" name="nim_pyp" id="nim_pyp" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>        
                <div class="row">
                    <div class="col-3">
                        <h5>2. First Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" value="{{$selectedStudent->first_name}}" name="first_name" id="first_name" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>3. Last Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" value="{{$selectedStudent->last_name}}" name="last_name" id="last_name" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>4. Date of Birth</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="date" value="{{$selectedStudent->dob}}" name="dob" id="dob" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>5. Father's Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" value="{{$selectedStudent->fathers_name}}" name="dad_name" id="dad_name" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>6. Father's Phone</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" value="{{$selectedStudent->fathers_phone}}" name="dad_phone" id="dad_phone" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>7. Mother's Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" value="{{$selectedStudent->mothers_name}}" name="mom_name" id="mom_name" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>8. Mother's Phone</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" value="{{$selectedStudent->mothers_phone}}" name="mom_phone" id="mom_phone" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>9. Parent's Email</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" value="{{$selectedStudent->parents_email}}" name="email" id="email" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>10. Address</h5>
                    </div> 

                    <div class="col-6" >
                    <input value="{{$selectedStudent->address}}" name="address" id="address" style="height:80px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>11. Previous School</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" value="{{$selectedStudent->previous_school}}" name="prev_school" id="prev_school" style="height:80px;width:500px;"></inpu>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>12. Level</h5>
                    </div>
                    <div class="col-3">
                    <select name="option" id="option">
                        <option value="{{$selectedStudent->level}}" name="{{$selectedStudent->level}}">{{$selectedStudent->level}}</option>
                        <option value="PYP" name="PYP">PYP</option>
                        <option value="MYP" name="MYP">MYP</option>
                    </select>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>13. Entry Date</h5>
                    </div> 

                    <div class="col-6">
                    <input type="date" value="{{$selectedStudent->entry_date}}" name="entry_date" id="entry_date" style="height:40px;width:500px;"></input>
                    </div>
                </div>



<br>

        <br>
        <div class="row">
            <div class="col" style="text-align:right;margin-right:100px;">
            <button class="btn btn-primary" >Save</button>
            </div>
        </div>

        </form>


    
    @endsection 