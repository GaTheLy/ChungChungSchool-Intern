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
        <form method="POST" action="{{route('student-add.submit',['userId' => $teacher->user_id])}}">
            @csrf
            <br>
                <div class="row">
                    <div class="col-3">
                        <h5>1. NIS</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" name="nim_pyp" id="nim_pyp" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>        
                <div class="row">
                    <div class="col-3">
                        <h5>2. First Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" name="first_name" id="first_name" style="height:40px;width:500px;"></input>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <h5>3. Middle Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input placeholder="nullable" type="text" name="mid_name" id="mid_name" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>4. Last Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" name="last_name" id="last_name" style="height:40px;width:500px;"></input>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <h5>5. Nick Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input placeholder="nullable" type="text" name="nick_name" id="nick_name" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>6. Date of Birth</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="date" name="dob" id="dob" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>7. Father's Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" name="dad_name" id="dad_name" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>8. Father's Phone</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" name="dad_phone" id="dad_phone" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>9. Mother's Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" name="mom_name" id="mom_name" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>10. Mother's Phone</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" name="mom_phone" id="mom_phone" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>11. Parent's Email</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" name="email" id="email" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>12. Address</h5>
                    </div> 

                    <div class="col-6" >
                    <textarea name="address" id="address" style="height:80px;width:500px;"></textarea>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>13. Previous School</h5>
                    </div> 

                    <div class="col-6" >
                    <textarea placeholder="nullable" name="prev_school" id="prev_school" style="height:80px;width:500px;"></textarea>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>14. Level</h5>
                    </div>
                    <div class="col-3">
                    <select name="option" id="option">
                        <option value="">--Select--</option>
                        <option value="PYP" name="PYP">PYP</option>
                        <option value="MYP" name="MYP">MYP</option>
                    </select>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>15. Entry Date</h5>
                    </div> 

                    <div class="col-6">
                    <input type="date" name="entry_date" id="entry_date" style="height:40px;width:500px;"></input>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <h5>16. NISN</h5>
                    </div> 

                    <div class="col-6">
                    <input type="text" name="nisn" id="nisn" style="height:40px;width:500px;" placeholder="nullable"></input>
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