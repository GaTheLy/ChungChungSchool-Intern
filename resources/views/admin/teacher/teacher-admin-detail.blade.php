@extends('base.base-admin')
<!-- section content -> yield content base.blade -->
@section('content')

<style>
    h1{
        font-family:'Space Grotesk';
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

<h1>Teacher - Detail</h1>
<div class="row">
    <div class="col-6" style="text-align:left;">
        <h5>{{ $teacher->first_name }}</h5>
    </div>
</div>

<br><br>
    
                <div class="row">
                    <div class="col-3">
                        <h5>1. First Name</h5>
                    </div> 

                    <div class="col-6">
                    <input disabled value="{{$selectedTeacher->first_name}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <h5>2. Last Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{$selectedTeacher->last_name}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <h5>3. Email</h5>
                    </div> 

                    <div class="col-6" >
                    <input disabled value="{{ $infoEmail }}" style="height:40px;width:500px;"></input>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-3">
                        <h5>4. Teacher's ID</h5>
                    </div> 

                    <div class="col-6">
                    <input disabled value="{{$selectedTeacher->nip_pyp}}"  style="height:40px;width:500px;"></input>
                    </div>
                </div>
                <br>
               <div class="row">
                    <div class="col-3">
                        <h5>5. Phone</h5>
                    </div> 

                    <div class="col-6">
                    <input disabled value="{{$selectedTeacher->phone}}"  style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>6. Address</h5>
                    </div> 

                    <div class="col-6">
                    <input disabled value="{{$selectedTeacher->address}}"  style="height:40px;width:500px;"></input>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <h5>7. Joined At</h5>
                    </div> 

                    <div class="col-6">
                    <input disabled value="{{$selectedTeacher->joined_at}}" style="height:40px;width:500px;" ></input>
                    </div>
                </div>
                <br>
                <div class="row">
                <div class="col-3">
                    <h5>8. Level </h5>
                </div> 
                
                <div class="col-2">
                @php
                    $level = '';
                    if ($selectedTeacher->is_myp == 0 && $selectedTeacher->is_pyp == 1) {
                        $level = 'PYP';
                    } elseif ($selectedTeacher->is_myp == 1 && $selectedTeacher->is_pyp == 0) {
                        $level = 'MYP';
                    } elseif ($selectedTeacher->is_myp == 1 && $selectedTeacher->is_pyp == 1) {
                        $level = 'PYP & MYP';
                    }
                @endphp

                    <input style="height:40px;width:500px;" disabled value="{{ $selectedTeacher->level }}">
                </div>  
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <h5>9. Position</h5>
                    </div> 

                    <div class="col-6">
                    <input style="height:40px;width:500px;" disabled value="{{ $selectedTeacher->position }}" ></input>
                    </div>
                </div>
                <br>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
