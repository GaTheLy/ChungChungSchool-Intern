@extends('base.base')
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
    .delete-btn {
        cursor: pointer;
        color: red;
        margin-top: 10px;
        margin-left: 10px;
    }

</style>

<h1>Profile</h1>
<div class="row">
    <div class="col-6" style="text-align:left;">
        <h5>{{ $teacher->first_name }}</h5>
    </div>
</div>

<br><br>

<form method="POST" action="{{ route('profile-admin.edit', ['userId' => $teacher->user_id, 'teacherId' => $teacher->nip_pyp]) }}">
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
                    <input type="text" name="email" id="email" value="{{$infoEmail}}"style="height:40px;width:500px;"></input>
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
                    <input name="address" id="address" value="{{$selectedTeacher->address}}" style="height:40px;width:500px;"></input>
                    </div>
                </div>
                

                <br/>
                <div class="row">
                    <div class="col-3">
                        <h5>7. Change Password</h5>
                    </div> 

                    <div class="col-6">
                        <div class="row">
                            <input style="height:40px;width:500px;margin-left:11px;" type="password" name="change_pass" id="change_pass" placeholder="new password"></input>
                        </div>
                        <br />
                        <div class="row">
                            <input style="height:40px;width:500px;margin-left:11px;" type="password" name="confirm_pass" id="confirm_pass" placeholder="confirm new password"></input>
                        </div>
                        <div class="row">
                            <p id="alert-message" style="margin-left:11px;"></p>
                        </div>
                    </div>
                </div>


        <div class="" style="text-align:right;margin-right:480px;margin-top:20px;">
            <button class="btn btn-primary" id="save">Save</button>
        </div>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    //confirm password
    document.addEventListener('DOMContentLoaded', (event) => {
        const changePassInput = document.getElementById('change_pass');
        const confirmPassInput = document.getElementById('confirm_pass');
        const alertMessage = document.getElementById('alert-message');
        const button = document.getElementById('save');

        function checkPasswordMatch() {
            if (changePassInput.value !== confirmPassInput.value) {
                alertMessage.textContent = "Passwords do not match!";
                alertMessage.style.color = "red";
                button.disabled = true;
            } else {
                alertMessage.textContent = "Password matched!";
                alertMessage.style.color = "green";
                button.disabled = false;

            }
        }

        changePassInput.addEventListener('input', checkPasswordMatch);
        confirmPassInput.addEventListener('input', checkPasswordMatch);
    });
</script>

@endsection
