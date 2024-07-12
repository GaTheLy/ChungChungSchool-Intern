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
                <div class="row">
                    <div class="col-3">
                        <h5>1. NIS</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{$selectedStudent->nim_pyp}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>        
                <div class="row">
                    <div class="col-3">
                        <h5>2. First Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{$selectedStudent->first_name}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>3. Last Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{$selectedStudent->last_name}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>4. Date of Birth</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{$selectedStudent->dob}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>5. Father's Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{$selectedStudent->fathers_name}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>6. Father's Phone</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{$selectedStudent->fathers_phone}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>7. Mother's Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{$selectedStudent->mothers_name}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>8. Mother's Phone</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{$selectedStudent->mothers_phone}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>9. Parent's Email</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{$selectedStudent->parents_email}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>10. Address</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{$selectedStudent->address}}" style="height:80px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>11. Previous School</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{$selectedStudent->previous_school}}" style="height:80px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>12. Level</h5>
                    </div>
                    <div class="col-3">
                        <input disabled value="{{$selectedStudent->level}}" style="height:40px;width:500px;">
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>13. Entry Date</h5>
                    </div> 

                    <div class="col-6">
                    <input disabled value="{{$selectedStudent->entry_date}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>

    
    @endsection 