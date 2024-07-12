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

<h1>Subject</h1>
<div class="row">
    <div class="col-6" style="text-align:left;">
        <h5>{{ $teacher->first_name }}</h5>
    </div>
</div>

<br><br>

{{-- form --}}

{{-- form --}}
<form method="POST" action="{{route('subject-add.submit',['userId' => $teacher->user_id])}}">
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
        <select name="option" id="option">
            <option value="">--Select--</option>
            <option value="PYP" name="PYP">PYP</option>
            <option value="MYP" name="MYP">MYP</option>
        </select>
        </div>
    </div>

    <div class="col-3">
        <h5>3. Grade Input </h5>
    </div> 

    {{-- pyp form --}}
    <div id="PYP" style="display:none;">
        <div id="PYPContainer" class="PYPCriteria">
{{--  
            <div class="form-group">
                <div class="row">
                        <div class="col-3" style="margin-left:80px;">
                            <span>Criteria </span>
                                <div class="row">
                                    <div class="col-4">
                                    <input type="text" name="criteria[0][name]" id="criteria[0][name]" class="criteria-name">
                                    </div>
                                </div>
                        </div> 
                        <div class="col-4">
                            <span>Descriptor</span>
                                <div class="row">
                                <input type="text" name="criteria[0][description]" id="criteria[0][description]" class="criteria-desc">
                                </div>
                        </div>

                        <span class="delete-btn">Delete</span>

                    </div>
            </div>

             --}}
        </div>
        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
            <button class="btn me-md-2" type="button" id="addInputA">
                add more criteria            <i class="lni lni-circle-plus"></i>
            </button>
        </div>
    </div>

    {{-- end pyp form --}}

    {{-- myp form --}}

    <div id="MYP" style="display:none;">

    <div id="MYPContainer" class="MYPCriteria">
            {{-- 
    <div class="form-group">
            <div class="row">
                <div class="col-3" style="margin-left:80px;">
                    <span>Criteria </span>
                        <div class="row">
                            <div class="col-2">
                            <input type="text" name="criteria[0][title]" id="criteria[0][title]" class="criteria-title">
                            </div>
                            <div class="col-4">
                            <input type="text" name="criteria[0][name]" id="criteria[0][name]" class="criteria-name">
                            </div>
                        </div>
                </div> 
                <div class="col-1">
                    <span>Range </span>
                        @for ($i=0;$i<8;$i++)
                            <div class="row">
                            <input type="text" value="{{$i+1}}" class="crit-progress" name="criteria[0][ranges][{{ $i }}]" id="criteria[0][ranges][{{ $i }}]">
                            </div>
                        @endfor
                        
                </div> 
                <div class="col-4">
                    <span>Descriptor</span>
                        @for ($i=0;$i<8;$i++)
                            <div class="row">
                            <input type="text" name="criteria[0][ranges][{{ $i }}][description]" id="criteria[0][ranges][{{ $i }}][description]" placeholder="descriptor {{$i+1}}" class="criteria-desc">
                            </div>
                        @endfor
                        

                        <span class="delete-btn">Delete</span>

                </div> 
            </div>
        </div>
                --}}

        </div>
        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
            <button class="btn me-md-2" type="button" id="addInputB">
                add more criteria            <i class="lni lni-circle-plus"></i>
            </button>
        </div>
        
    </div>

    {{-- end myp form --}}



    <button class="btn btn-primary">Save</button>
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

        $('#option').change(function() {
            resetForms();
            var selectedOption = $(this).val();
            if (selectedOption === 'PYP') {
                $('#PYP').show();
                // $('#btnA').addClass('active');
            } else if (selectedOption === 'MYP') {
                $('#MYP').show();
                // $('#btnB').addClass('active');
            }
        });


        $('#addInputA').click(function() {
            var newInputNumber = $('#PYPContainer .form-group').length;
            console.log(newInputNumber);


            var newInput = `
            <div class="form-group">
                <div class="row">
                        <div class="col-3" style="margin-left:80px;">
                            <span>Criteria ${newInputNumber}</span>
                                <div class="row">
                                    <div class="col-4">
                                    <input type="text" name="criteria[${newInputNumber}][name]" id="criteria[${newInputNumber}][name]" class="criteria-name">
                                    </div>
                                </div>
                        </div> 
                        <div class="col-4">
                            <span>Descriptor</span>
                                <div class="row">
                                <input type="text" name="criteria[${newInputNumber}][description]" id="criteria[${newInputNumber}][description]" class="criteria-desc">
                                </div>
                        </div>
                                            <span class="delete-btn">Delete</span>

                    </div>
            </div>
                            
                            `;
            $('#PYPContainer').append(newInput);
        });


        $('#addInputB').click(function() {
            var newInputNumber = $('#MYPContainer .form-group').length;
console.log(newInputNumber);
            var newInput = `
            
            <div class="form-group">
       <div class="row">
                <div class="col-3" style="margin-left:80px;">
                    <span>Criteria ${newInputNumber}  </span>
                        <div class="row">
                            <div class="col-2">
                            <input type="text" name="criteria[${newInputNumber}][title]" id="criteria[${newInputNumber}][title]" class="criteria-title">
                            </div>
                            <div class="col-4">
                            <input type="text" name="criteria[${newInputNumber}][name]" id="criteria[${newInputNumber}][name]" class="criteria-name">
                            </div>
                        </div>
                </div> 
                <div class="col-1">
                    <span>Range </span>
                        @for ($i=0;$i<8;$i++)
                            <div class="row">
                            <input type="text" value="{{$i+1}}" class="crit-progress" name="criteria[${newInputNumber}][ranges][{{ $i }}][range]" id="criteria[${newInputNumber}][ranges][{{ $i }}][range]">
                            </div>
                        @endfor
                        
                </div> 
                <div class="col-4">
                    <span>Descriptor</span>
                        @for ($i=0;$i<8;$i++)
                            <div class="row">
                            <input type="text" name="criteria[${newInputNumber}][ranges][{{ $i }}][description]" id="criteria[${newInputNumber}][ranges][{{ $i }}][description]" placeholder="descriptor {{$i+1}}" class="criteria-desc">
                            </div>
                        @endfor
                        

                        <span class="delete-btn">Delete</span>

                </div> 
            </div>
        </div>`;
            $('#MYPContainer').append(newInput);
        });

// Delegate click event for delete buttons
        $(document).on('click', '.delete-btn', function() {
            $(this).closest('.form-group').remove();
        });
    });
</script>

@endsection
