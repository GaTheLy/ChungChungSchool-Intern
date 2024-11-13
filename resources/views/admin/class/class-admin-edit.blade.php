@extends('base.base-admin')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    var studentsArray = [];

    // Initialize the studentsArray with already assigned students
    @foreach ($selectedClass->students as $student)
        studentsArray.push('{{ $student->nim_pyp }}');
        // Disable the option in the dropdown if the student is already assigned to the class
        $('#students option[id="{{ $student->nim_pyp }}"]').prop('disabled', true);
    @endforeach

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
});

// Function to show the confirmation modal with dynamic student and class information
function showModal(studentId, studentName, classId, className) {
    // Update the modal with student and class information
    $('#modalStudentName').text(studentName);
    $('#modalClassName').text(className);

    // Set the student ID to a data attribute for later use
    $('#confirmDeleteModal').data('student-id', studentId);

    // Show the modal
    $('#confirmDeleteModal').modal('show');
}

// Function to confirm and proceed with the student removal
function confirmDelete() {
    // Get the student ID from the modal's data attribute
    const studentId = $('#confirmDeleteModal').data('student-id');

    // Find the form corresponding to the student ID and submit it
    $('#delete-form-' + studentId).submit();

    // Hide the modal after submission
    $('#confirmDeleteModal').modal('hide');
}
</script>

<style>
    h1 {
        font-family: 'Space Grotesk';
        font-size: 40px;
    }
    h5 {
        padding-left: 10px;
        font-family: 'Lexend Deca';
        font-weight: 400;
        font-size: 25px;
    }
    a {
        color: white;
        text-decoration: none;
    }
</style>

<h1>Class - Edit</h1>
<div class="row">
    <div class="col-6" style="text-align:left;">
        <h5>{{ $teacher->first_name }}</h5>
    </div>
</div>

<br>

<form method="POST" action="{{route('class.edit.submit',['userId' => $teacher->user_id, 'classId' => $selectedClass->class_id])}}">
    @csrf
    <div class="row">
        <div class="col-3">
            <h5>1. Class Name</h5>
        </div> 
        <div class="col-6">
            <input name="class_name" id="class_name" value="{{$selectedClass->class_name}}" style="height:40px;width:500px;">
        </div>
    </div>
    <br>        
    <div class="row">
        <div class="col-3">
            <h5>2. Homeroom</h5>
        </div>
        <div class="col-6">
            <select name="homeroom" id="homeroom" style="height:40px;width:500px;">
                <option value="{{ $assignedHomerooms->get('main') && $assignedHomerooms->get('main')->first()->teacher->nip_pyp }}">
                    {{ $assignedHomerooms->get('main') ? $assignedHomerooms->get('main')->first()->teacher->first_name . ' ' . $assignedHomerooms->get('main')->first()->teacher->last_name : 'N/A' }}
                </option>
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
                <option value="{{ $assignedHomerooms->get('co') && $assignedHomerooms->get('co')->first()->teacher->nip_pyp }}">
                    {{ $assignedHomerooms->get('co') ? $assignedHomerooms->get('co')->first()->teacher->first_name . ' ' . $assignedHomerooms->get('co')->first()->teacher->last_name : '--Select--' }}
                </option>
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
                <option value="{{ $assignedHomerooms->get('subs') && $assignedHomerooms->get('subs')->first()->teacher->nip_pyp }}">
                    {{ $assignedHomerooms->get('subs') ? $assignedHomerooms->get('subs')->first()->teacher->first_name . ' ' . $assignedHomerooms->get('subs')->first()->teacher->last_name : '--Select--' }}
                </option>
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
                <option value="{{$selectedClass->class_level}}"></option>
                <option value="PYP">PYP</option>
                <option value="MYP">MYP</option>
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
        <div class="col">
            <p>total {{ $selectedClass->students->count() }} students</p>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3">
            <h5>Selected New Students</h5>
        </div>
        <div class="col-6">
            <ul id="selected-students"></ul>
        </div>
    </div>
    <input type="hidden" name="students_array" id="students-array">
    
    <br />
    <div class="row">
        <div class="col" style="text-align:right;margin-right:100px;">
            <button class="btn btn-primary">Save</button>
        </div>
    </div>
</form>

<br />
<div class="col-10" style="margin-left:100px;">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>NIM</th>
                <th>Student</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 1; ?>
            @foreach ($selectedClass->students as $student)
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $student->nim_pyp }}</td>
                    <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                    <td>
                        <button onclick="showModal('{{ $student->nim_pyp }}', '{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}', '{{ $selectedClass->class_id }}', '{{ $selectedClass->class_name }}')" style="text-decoration:none;border:0;background:none;color:red;">Remove</button>
                        <form id="delete-form-{{ $student->nim_pyp }}" action="{{ route('class.delete.student', ['userId' => $teacher->user_id, 'classId' => $selectedClass->class_id, 'studentId' => $student->nim_pyp]) }}" method="post" style="display:none;">
                            @csrf
                        </form>
                    </td>
                </tr>
                <?php $index += 1; ?>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Remove Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove <strong id="modalStudentName"></strong> from the class <strong id="modalClassName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Remove</button>
            </div>
        </div>
    </div>
</div>
@endsection
