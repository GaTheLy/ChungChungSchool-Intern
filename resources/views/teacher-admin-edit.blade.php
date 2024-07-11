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
    .btn-option {
        margin-right: 10px;
        padding: 10px 20px;
        border: 1px solid #007bff;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn-option.active {
        background-color: #007bff;
        color: white;
    }

    .criteria-title{
        height:35px;
        width:35px;
        border:1px solid black;
        display:inline-block;
        border-radius:5px;
        margin-top:10px;
        margin-left:10px;
    }
    .criteria-name{
        height:35px;
        width:155px;
        border:1px solid black;
        display:inline-block;
        border-radius:5px;
        margin-top:10px;
        margin-left:10px;
    }
    .criteria-desc{
        height:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;
    }

    .crit-progress{
        height:35px;width:35px;border:1px solid black;display:inline-block;border-radius:5px;margin-top:10px;margin-left:20px;
    }

    .delete-btn {
        cursor: pointer;
        color: red;
        margin-top: 10px;
        margin-left: 10px;
    }

</style>

<h1>Subject - Edit</h1>
<div class="row">
    <div class="col-6" style="text-align:left;">
        <h5>{{ $teacher->first_name }}</h5>
    </div>
</div>

<br><br>

<form method="POST" action="{{ route('teacher-edit.submit', ['userId' => $teacher->user_id, 'teacherId' => $selectedTeacher->nip_pyp]) }}">
    @csrf
                <div class="row">
                    <div class="col-3">
                        <h5>1. First Name</h5>
                    </div> 

                    <div class="col-6">
                    <input type="text" name="first_name" id="first_name" value="{{$selectedTeacher->first_name}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <h5>2. Last Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" name="last_name" id="last_name" value="{{$selectedTeacher->last_name}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <h5>3. Email</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" name="email" id="email" value="{{$selectedTeacher->email}}"style="height:40px;width:500px;"></input>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-3">
                        <h5>4. Teacher's ID</h5>
                    </div> 

                    <div class="col-6">
                    <input type="text" name="nip" id="nip" value="{{$selectedTeacher->nip_pyp}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
                <br>
               <div class="row">
                    <div class="col-3">
                        <h5>5. Phone</h5>
                    </div> 

                    <div class="col-6">
                    <input type="text" name="phone" id="phone" value="{{$selectedTeacher->phone}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>6. Address</h5>
                    </div> 

                    <div class="col-6">
                    <textarea name="address" id="address" value="{{$selectedTeacher->address}}" style="height:80px;width:500px;"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <h5>7. Joined At</h5>
                    </div> 

                    <div class="col-6">
                    <input type="date" name="joined_at" id="joined_at" value="{{$selectedTeacher->joined_at}}"></input>
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
                    <select name="option" id="option">
                    <option value="{{ $level }}">--Select--</option>
                    <option value="PYP" name="PYP">PYP</option>
                    <option value="MYP" name="MYP">MYP</option>
                    <option value="ALL" name="ALL">PYP & MYP</option>
                    </select>
                </div>
                </div>

    <button class="btn btn-primary">Save</button>

</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
