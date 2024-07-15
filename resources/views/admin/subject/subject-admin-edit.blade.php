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
        border: none;
        background: none;
    }

</style>

<h1>Subject - Edit</h1>
<div class="row">
    <div class="col-6" style="text-align:left;">
        <h5>{{ $teacher->first_name }}</h5>
    </div>
</div>

<br><br>

<form method="POST" action="{{ route('subject-edit.submit', ['userId' => $teacher->user_id, 'subjectId' => $subject->id]) }}">
    @csrf


    <div class="row">
        <div class="col-3">
            <h5>1. Subject's Name</h5>
        </div>
        <div class="col-3">
        <input style="height:35px;width:100%;" name="subject_name" id="subject_name" value="{{ old('subject_name', $subject->subject_name) }}">
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <h5>2. Level</h5>
        </div>
        <div class="col-3">
        <input disabled id="subject_level" name="subject_level" style="height:35px;width:100%;" value="{{ $subject->subject_level }}">
        </div>
    </div>

    <div class="col-3">
        <h5>3. Grade Input </h5>
    </div> 

    {{-- pyp form --}}
    <div id="PYP" style="display:none;">
        <div id="PYPContainer" class="PYPCriteria">

         {{--      --}}
                

        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
            <button class="btn me-md-2" type="button" id="addInputA">
                add more criteria            <i class="lni lni-circle-plus"></i>
            </button>
        </div>


        </div>
    </div>

    {{-- end pyp form --}}

    {{-- myp form --}}

    <div id="MYP" style="display:none;">
        <div id="MYPContainer" class="MYPCriteria">
            {{-- --}}

        
            <div class="d-grid gap-4 d-md-flex justify-content-md-end">
            <button class="btn me-md-2" type="button" id="addInputB">
                add more criteria            <i class="lni lni-circle-plus"></i>
            </button>
            </div>

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
        }

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
                                    <input type="text" name="criteriaNew[${newInputNumber}][name]" id="criteriaNew[${newInputNumber}][name]" class="criteria-name">
                                    </div>
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
                            <input type="text" name="criteriaNew[${newInputNumber}][title]" id="criteriaNew[${newInputNumber}][title]" class="criteria-title">
                            </div>
                            <div class="col-4">
                            <input type="text" name="criteriaNew[${newInputNumber}][name]" id="criteriaNew[${newInputNumber}][name]" class="criteria-name">
                            </div>
                        </div>
                </div> 
                <div class="col-1">
                    <span>Range </span>
                        @for ($i=0;$i<8;$i++)
                            <div class="row">
                            <input type="text" value="{{$i+1}}" class="crit-progress" name="criteriaNew[${newInputNumber}][ranges][{{ $i }}][range]" id="criteriaNew[${newInputNumber}][ranges][{{ $i }}][range]">
                            </div>
                        @endfor
                        
                </div> 
                <div class="col-4">
                    <span>Descriptor</span>
                        @for ($i=0;$i<8;$i++)
                            <div class="row">
                            <input type="text" name="criteriaNew[${newInputNumber}][ranges][{{ $i }}][description]" id="criteriaNew[${newInputNumber}][ranges][{{ $i }}][description]" placeholder="descriptor {{$i+1}}" class="criteria-desc">
                            </div>
                        @endfor
                        

                        <span class="delete-btn">Delete</span>

                </div> 
            </div>
        </div>`;
            $('#MYPContainer').append(newInput);
        });


        function checkSubjectLevel() {
            var selectedOption = $('#subject_level').val().trim();
            if (selectedOption === 'PYP') {
                $('#PYP').show();
                var newInput = `
                <div class="form-group">
                    <div class="row">
                        <div class="col-3" style="margin-left:80px;">
                            <span>Criteria </span>
                            @foreach ($subject->pypCriteria as $criteria)
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" name="criteria[{{ $criteria->sc_pyp_id }}][name]" id="criteria[{{ $criteria->sc_pyp_id}}][name]" value="{{ old('criteria.' . $criteria->sc_pyp_id . '.name', $criteria->crit_name) }}" class="criteria-name">
                                </div>
                            </div>
                            <form method="POST" action="{{ route('subject-edit-criteriaPYP.delete', ['userId' => $teacher->user_id, 'subjectId' => $subject->id, 'criteriaId' => $criteria->sc_pyp_id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                            @endforeach
                        </div> 
                    </div>
                </div>`;
                $('#PYPContainer').append(newInput);
            } else if (selectedOption === 'MYP') {
                $('#MYP').show();
                var newInput = `
                <div class="form-group">
                    <div class="row">
                        @foreach ($subject->mypCriteria as $criteria)
                        <div class="col-3" style="margin-left:80px;">
                            <span>Criteria</span>
                            <div class="row">
                                <div class="col-2">
                                    <input type="text" value="{{ $criteria->criteria_title }}" class="criteria-title">
                                </div>
                                <div class="col-4">
                                    <input type="text" name="criteria[{{ $criteria->id }}][name]" id="criteria[{{ $criteria->id }}][name]" value="{{ old('criteria.' . $criteria->id . '.name', $criteria->criteria_name) }}" class="criteria-name">
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <span>Range</span>
                            @foreach ($criteria->mypCriteriaDetail as $detail)
                                <div class="row">
                                    <input type="text" value="{{ old('criteria.' . $criteria->id . '.ranges.' . $detail->id . '.range', $detail->criteria_range) }}" class="crit-progress" name="criteria[{{ $criteria->id }}][ranges][{{ $detail->id }}][range]" id="criteria[{{ $criteria->id }}][ranges][{{ $detail->id }}][range]">
                                </div>
                            @endforeach
                        </div>
                        <div class="col-4">
                            <span>Descriptor</span>
                            @foreach ($criteria->mypCriteriaDetail as $detail)
                                <div class="row">
                                    <input type="text" name="criteria[{{ $criteria->id }}][ranges][{{ $detail->id }}][description]" id="criteria[{{ $criteria->id }}][ranges][{{ $detail->id }}][description]" value="{{ old('criteria.' . $criteria->id . '.ranges.' . $detail->id . '.description', $detail->criteria_range_desc) }}" placeholder="descriptor {{ $detail->criteria_range }}" class="criteria-desc">
                                </div>
                            @endforeach
                        </div>

                        <form method="POST" action="{{ route('subject-edit-criteriaMYP.delete', ['userId' => $teacher->user_id, 'subjectId' => $subject->id, 'criteriaId' => $criteria->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete</button>
                        </form>
                        @endforeach
                    </div>
                </div>`;
                $('#MYPContainer').append(newInput);
            }
        }

        resetForms();
        checkSubjectLevel();

        $(document).on('click', '.delete-btn', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete this criteria?')) {
            $(this).closest('form').submit();
        }
        });

    });
</script>

@endsection
