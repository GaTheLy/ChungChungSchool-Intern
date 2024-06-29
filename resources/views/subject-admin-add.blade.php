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
</style>

<h1>Subject</h1>
<div class="row">
    <div class="col-6" style="text-align:left;">
        <h5>{{ $teacher->first_name }}</h5>
    </div>
</div>

<br><br>

{{-- form --}}
<form method="POST" action="">
    @csrf

    <div class="row">
        <div class="col-3">
            <h5>1. Subject's Name</h5>
        </div>
        <div class="col-3">
            <input type="text" name="subject_name" id="subject_name" style="height:35px;width:100%;">
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <h5>2. Level</h5>
        </div>
        <div class="col-3">
            <div class="btn-option" id="btnA">PYP</div>
            <div class="btn-option" id="btnB">MYP</div>
            <input type="hidden" name="level" id="level" value="">
        </div>
    </div>

    {{-- pyp form --}}

    <div id="PYP" style="display:none;">
        <div id="PYPContainer">
            <div class="form-group">
                <label for="inputA1">Input A1</label>
                <input type="text" name="inputA[]" id="inputA1">
            </div>
            <div class="form-group">
                <label for="inputA2">Input A2</label>
                <input type="text" name="inputA[]" id="inputA2">
            </div>
            <div class="form-group">
                <label for="inputA3">Input A3</label>
                <input type="text" name="inputA[]" id="inputA3">
            </div>
        </div>
        <div class="row">
        <div class="col" style="text-align:right;margin-right:100px;">
            <a href="#" style="color:black">add more criteria</a>
            <i class="lni lni-circle-plus"></i>
        </div>
    </div>
        <button type="button" id="addInputA">Add Input</button>
    </div>

    {{-- end pyp form --}}


    {{-- myp form --}}

    <div id="MYP" style="display:none;">

    <div id="MYPContainer">
    <div class="form-group">
        <div class="row">
            <div class="col-3">
                <h5>3. Grade Input </h5>
            </div> 
            
            <div class="row">
                <div class="col-3" style="margin-left:80px;">
                    <span>Criteria </span>
                        <div class="row">
                        <div class="col-2">
                        <input type="text" name="crit-title[0]" id="crit-title[0]" class="criteria-title">
                        </div>
                        <div class="col-4">
                        <input type="text" name="crit-name[0]" id="crit-name[0]" class="criteria-name">
                        </div>
                </div>
                    
                    

                </div> 
                <div class="col-1">
                    <span>Range </span>
                        <div class="row">
                        <input type="text" value="1" class="crit-progress" name="range-1[0]" id="range-1[0]">
                        </div>
                        <div class="row">
                        <input type="text" value="2" class="crit-progress" name="range-2[0]" id="range-2[0]">
                        </div>
                        <div class="row">
                        <input type="text" value="3" class="crit-progress" name="range-3[0]" id="range-3[0]">
                        </div>
                        <div class="row">
                        <input type="text" value="4" class="crit-progress" name="range-4[0]" id="range-4[0]">
                        </div>
                        <div class="row">
                        <input type="text" value="5" class="crit-progress" name="range-5[0]" id="range-5[0]">
                        </div>
                        <div class="row">
                        <input type="text" value="6" class="crit-progress" name="range-6[0]" id="range-6[0]">
                        </div>
                        <div class="row">
                        <input type="text" value="7" class="crit-progress" name="range-7[0]" id="range-7[0]">
                        </div>
                        <div class="row">
                        <input type="text" value="8" class="crit-progress" name="range-8[0]" id="range-8[0]">
                        </div>
                </div> 
                <div class="col-4">
                    <span>Descriptor</span>
                        <div class="row">
                        <input type="text" name="range-1-desc[0]" id="range-1-desc[0]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-2-desc[0]" id="range-2-desc[0]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-3-desc[0]" id="range-3-desc[0]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-4-desc[0]" id="range-4-desc[0]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-5-desc[0]" id="range-5-desc[0]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-6-desc[0]" id="range-6-desc[0]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-7-desc[0]" id="range-7-desc[0]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-8-desc[0]" id="range-8-desc[0]" class="criteria-desc">
                        </div>
                </div> 
            </div>
        </div>
    </div>
        
        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
            <button class="btn me-md-2" type="button" id="addInputB">
                add more criteria            <i class="lni lni-circle-plus"></i>
            </button>
        </div>

        </div>
    </div>

    {{-- end myp form --}}

    <br>
    <div class="row">
        <div class="col" style="text-align:right;margin-right:100px;">
            <a href="#" style="color:black">add more criteria</a>
            <i class="lni lni-circle-plus"></i>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col" style="text-align:right;margin-right:100px;">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function resetForms() {
            $('#PYP').hide();
            $('#MYP').hide();
            $('#btnA').removeClass('active');
            $('#btnB').removeClass('active');
            $('#level').val('');
        }

        $('#btnA').click(function() {
            resetForms();
            $('#PYP').show();
            $(this).addClass('active');
            $('#level').val('A');
        });

        $('#btnB').click(function() {
            resetForms();
            $('#MYP').show();
            $(this).addClass('active');
            $('#level').val('B');
        });

        $('#addInputA').click(function() {
            var newInputNumber = $('#PYPContainer .form-group').length + 1;
            var newInput = `<div class="form-group">
                                <label for="inputA${newInputNumber}">Input A${newInputNumber}</label>
                                <input type="text" name="inputA[]" id="inputA${newInputNumber}">
                            </div>`;
            $('#PYPContainer').append(newInput);
        });


        $('#addInputB').click(function() {
            var newInputNumber = $('#MYPContainer .form-group').length + 1;
            var newInput = `
            
            <div class="form-group">
        <div class="row">
            <div class="row">
                <div class="col-3" style="margin-left:80px;">
                    <span>Criteria </span>
                        <div class="row">
                        <div class="col-2">
                        <input type="text" name="crit-title[${newInputNumber}]" id="crit-title[${newInputNumber}]" class="criteria-title">
                        </div>
                        <div class="col-4">
                        <input type="text" name="crit-name[${newInputNumber}]" id="crit-name[${newInputNumber}]" class="criteria-name">
                        </div>
                </div>
                    
                    

                </div> 
                <div class="col-1">
                    <span>Range </span>
                        <div class="row">
                        <input type="text" value="1" class="crit-progress" name="range-1[${newInputNumber}]" id="range-1[${newInputNumber}]">
                        </div>
                        <div class="row">
                        <input type="text" value="2" class="crit-progress" name="range-2[${newInputNumber}]" id="range-2[${newInputNumber}]">
                        </div>
                        <div class="row">
                        <input type="text" value="3" class="crit-progress" name="range-3[${newInputNumber}]" id="range-3[${newInputNumber}]">
                        </div>
                        <div class="row">
                        <input type="text" value="4" class="crit-progress" name="range-4[${newInputNumber}]" id="range-4[0]">
                        </div>
                        <div class="row">
                        <input type="text" value="5" class="crit-progress" name="range-5[${newInputNumber}]" id="range-5[${newInputNumber}]">
                        </div>
                        <div class="row">
                        <input type="text" value="6" class="crit-progress" name="range-6[${newInputNumber}]" id="range-6[${newInputNumber}]">
                        </div>
                        <div class="row">
                        <input type="text" value="7" class="crit-progress" name="range-7[${newInputNumber}]" id="range-7[${newInputNumber}]">
                        </div>
                        <div class="row">
                        <input type="text" value="8" class="crit-progress" name="range-8[${newInputNumber}]" id="range-8[${newInputNumber}]">
                        </div>
                </div> 
                <div class="col-4">
                    <span>Descriptor</span>
                        <div class="row">
                        <input type="text" name="range-1-desc[${newInputNumber}]" id="range-1-desc[${newInputNumber}]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-2-desc[${newInputNumber}]" id="range-2-desc[${newInputNumber}]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-3-desc[${newInputNumber}]" id="range-3-desc[${newInputNumber}]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-4-desc[${newInputNumber}]" id="range-4-desc[${newInputNumber}]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-5-desc[${newInputNumber}]" id="range-5-desc[${newInputNumber}]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-6-desc[${newInputNumber}]" id="range-6-desc[${newInputNumber}]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-7-desc[${newInputNumber}]" id="range-7-desc[${newInputNumber}]" class="criteria-desc">
                        </div>
                        <div class="row">
                        <input type="text" name="range-8-desc[${newInputNumber}]" id="range-8-desc[${newInputNumber}]" class="criteria-desc">
                        </div>
                </div> 
            </div>
        </div>`;
            $('#MYPContainer').append(newInput);
        });


    });
</script>

@endsection
