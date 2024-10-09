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

<h1>Class - Edit</h1>
<div class="row">
    <div class="col-6" style="text-align:left;">
        <h5>{{ $teacher->first_name }}</h5>
    </div>
</div>

<br>

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
                <option value="{{ $selectedClass->homeroom ? $selectedClass->homeroom->teacher->nip_pyp : 'N/A' }}">
                {{ $selectedClass->homeroom ? $selectedClass->homeroom->teacher->first_name . ' ' . $selectedClass->homeroom->teacher->last_name : 'N/A' }}
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
            <h5>3. Students</h5>
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
                    <?php
                        $index = 1;
                    ?>
                    @foreach ($selectedClass->students as $student)
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $student->nim_pyp }}</td>
                            <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                            <td>
                                <button onclick="showModal('{{ $student->nim_pyp }}', '{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}', '{{ $selectedClass->class_id }}', '{{ $selectedClass->class_name }}')" style="text-decoration:none;border:0px;background:none;color:red;">Remove</button>
                                <form id="delete-form-{{ $student->nim_pyp }}" action="{{ route('class.delete.student', ['userId' => $teacher->user_id, 'classId' => $selectedClass->class_id, 'studentId' => $student->nim_pyp]) }}" method="post" style="display:none;">
                                    @csrf
                                </form> 
                            </td>
                        </tr>
                        <?php $index += 1; ?>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Student</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- delete confirmation modal --}}
        <div class="modal fade" id="confirmDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="confirmDeleteModalLabel">Confirm Delete</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to remove <span id="modalStudentName"></span> from <span id="modalClassName"></span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
