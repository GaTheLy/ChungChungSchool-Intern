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
        width:255px;
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

<h1>Subject - Detail</h1>
<div class="row">
    <div class="col-6" style="text-align:left;">
        <h5>{{ $teacher->first_name }}</h5>
    </div>
</div>

<br><br>


    <div class="row">
        <div class="col-3">
            <h5>1. Subject's Name</h5>
        </div>
        <div class="col-3">
            <input  style="height:35px;width:100%;" disabled value="{{$subject->subject_name}} ">
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <h5>2. Level</h5>
        </div>
        <div class="col-3">
        <input disabled id="subject_level" name="subject_level" style="height:35px;width:100%;" value="{{$subject->subject_level}}  ">
        </div>
    </div>

    <div class="col-3">
        <h5>3. Grade Input </h5>
    </div> 

    {{-- pyp form --}}
    <div id="PYP" style="display:none;">
        <div id="PYPContainer" class="PYPCriteria">

         {{--      --}}
                <div class="row">
                        <div class="col-3" style="margin-left:80px;">
                            <span>Criteria </span>
                            @foreach ($subject->pypCriteria as $criteria)
                            <div class="row">
                                    <div class="col-6">
                                    <input type="text" disabled value="{{$criteria->crit_name}}" class="criteria-name">
                                    </div>
                                </div>
                            @endforeach
                                
                        </div> 
                </div>
        </div>
    </div>

    {{-- end pyp form --}}

    {{-- myp form --}}

    <div id="MYP" style="display:none;">
        <div id="MYPContainer" class="MYPCriteria">
            {{-- --}}

            <h3>this is myp page</h3>
        
            <div class="row">

                    @foreach ($subject->mypCriteria as $criteria)
                        <div class="col-3" style="margin-left:80px;">
                            <span>Criteria</span>
                            <div class="row">
                                <div class="col-2">
                                    <input type="text" disabled value="{{ $criteria->criteria_title }}" class="criteria-title">
                                </div>
                                <div class="col-4">
                                    <input type="text" name="criteria[{{ $criteria->id }}][name]" id="criteria[{{ $criteria->id }}][name]" value="{{ $criteria->criteria_name }}" class="criteria-name">
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <span>Range</span>
                            @foreach ($criteria->mypCriteriaDetail as $detail)
                                <div class="row">
                                    <input type="text" value="{{ $detail->criteria_range }}" class="crit-progress" name="criteria[{{ $criteria->id }}][ranges][{{ $detail->id }}]" id="criteria[{{ $criteria->id }}][ranges][{{ $detail->id }}]">
                                </div>
                            @endforeach
                        </div>
                        <div class="col-4">
                            <span>Descriptor</span>
                            @foreach ($criteria->mypCriteriaDetail as $detail)
                                <div class="row">
                                    <input type="text" name="criteria[{{ $criteria->id }}][ranges][{{ $detail->id }}][description]" id="criteria[{{ $criteria->id }}][ranges][{{ $detail->id }}][description]" value="{{ $detail->criteria_range_desc }}" placeholder="descriptor {{ $detail->criteria_range }}" class="criteria-desc">
                                </div>
                            @endforeach
                        </div>
                    @endforeach

            </div>
        </div>
    </div>

    {{-- end myp form --}}


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        function resetForms() {
        $('#PYP').hide();
        $('#MYP').hide();
        }

        function checkSubjectLevel() {
            var selectedOption = $('#subject_level').val().trim(); // trim to remove any extra spaces
            if (selectedOption === 'PYP') {
                $('#PYP').show();
            } else if (selectedOption === 'MYP') {
                $('#MYP').show();
            }
        }

        // Initial check on page load
        resetForms();
        checkSubjectLevel();

    });
</script>

@endsection
