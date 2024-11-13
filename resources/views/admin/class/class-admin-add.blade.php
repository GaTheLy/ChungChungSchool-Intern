@extends('base.base-admin')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
    var studentsArray = [];

    $('#add-student-btn').click(function() {
        var selectedStudent = $('#students').find(':selected');
        var studentId = selectedStudent.attr('id');
        var studentName = selectedStudent.val();
        
        if (studentId) {
            // Check if the student is already in the selected list
            if (!studentsArray.includes(studentId)) {
                // Add the student to the selected students list
                $('#selected-students').append('<li>' + studentName + ' <button type="button" class="btn btn-danger btn-sm remove-student" data-id="' + studentId + '">Remove</button></li>');

                // Disable the selected option in the dropdown
                selectedStudent.prop('disabled', true);
                
                // Add the student ID to the hidden input array
                studentsArray.push(studentId);
                $('#students-array').val(JSON.stringify(studentsArray));
            }
        }
        console.log(studentsArray);
    });

    // Remove student from the selected list and return them to the dropdown list
    $(document).on('click', '.remove-student', function() {
        var studentId = $(this).data('id');
        
        // Re-enable the option in the dropdown
        $('#students option[id="' + studentId + '"]').prop('disabled', false);
        
        // Remove the student from the selected list
        $(this).parent().remove();
        
        // Remove the student ID from the hidden input array
        studentsArray = studentsArray.filter(id => id != studentId);
        $('#students-array').val(JSON.stringify(studentsArray));
        console.log(studentsArray);
    });

    // Update the dropdown list when the student is added or removed
    $('#students').on('change', function() {
        $(this).find('option').each(function() {
            // If the student is in the selected array, disable the option
            if (studentsArray.includes($(this).attr('id'))) {
                $(this).prop('disabled', true);
            } else {
                $(this).prop('disabled', false);
            }
        });
    });
});

</script>

<style>
    h1 {
        font-family: 'Space Grotesk';
        font-size: 40px;
    }
    h5 {
        padding-left: 10px;
        padding-top: -20px;
        font-family: 'Lexend Deca';
        font-weight: 400;
        font-size: 25px;
    }
    a {
        color: white;
        text-decoration: none;
    }
</style>

<h1>Class</h1>
<div class="row">
    <div class="col-6" style="text-align:left;">
        <h5>{{ $teacher->first_name }}</h5>
    </div>
</div>

<br>
<div id="liveAlertPlaceholder"></div>

<br>

<form method="POST" action="{{route('class-add.submit',['userId' => $teacher->user_id])}}">
    @csrf
    <br>
    <div class="row">
        <div class="col-3">
            <h5>1. Class Name</h5>
        </div> 
        <div class="col-6">
            <input type="text" name="class_name" id="class_name" style="height:40px;width:500px;">
        </div>
    </div>
    <br>        
    <div class="row">
        <div class="col-3">
            <h5>2. Homeroom</h5>
        </div> 
        <div class="col-6">
            <select name="homeroom" id="homeroom" style="height:40px;width:500px;">
                <option value="">--Select--</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->nip_pyp }}">{{ $teacher->first_name . ' ' . $teacher->last_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>        
    <div class="row">
        <div class="col-3">
            <h5>3. Co-Homeroom</h5>
        </div> 
        <div class="col-6">
            <select name="co-homeroom" id="co-homeroom" style="height:40px;width:500px;">
                <option value="0">Not Assigned</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->nip_pyp }}">{{ $teacher->first_name . ' ' . $teacher->last_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>        
    <div class="row">
        <div class="col-3">
            <h5>4. Substitute Homeroom</h5>
        </div> 
        <div class="col-6">
            <select name="subs-homeroom" id="subs-homeroom" style="height:40px;width:500px;">
                <option value="0">Not Assigned</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->nip_pyp }}">{{ $teacher->first_name . ' ' . $teacher->last_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3">
            <h5>5. Level</h5>
        </div> 
        <div class="col-6">
            <select name="class_level" id="class_level" style="height:40px;width:500px;">
                    <option value="">--Select--</option>
                    <option value="PYP" name="PYP">PYP</option>
                    <option value="MYP" name="MYP">MYP</option>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3">
            <h5>6. Students</h5>
        </div>
        <div class="col-3">
            <select name="student" id="students" style="height:40px;width:500px;">
                <option value="">--Select--</option>
                @foreach ($students as $student)
                    <option value="{{ $student->first_name . ' ' . $student->last_name }}" id="{{ $student->nim_pyp }}">{{ $student->first_name . ' ' . $student->last_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            <button type="button" id="add-student-btn" class="btn btn-primary">Add Student</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3">
            <h5>Selected Students</h5>
        </div>
        <div class="col-6">
            <ul id="selected-students"></ul>
        </div>
    </div>
    <input type="hidden" name="students_array" id="students-array">
    <br>
    <div class="row">
        <div class="col" style="text-align:right;margin-right:100px;">
            <button class="btn btn-primary">Save</button>
        </div>
    </div>
</form>

@endsection
