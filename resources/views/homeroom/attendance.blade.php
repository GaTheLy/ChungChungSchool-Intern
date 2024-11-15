<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .btn-check:checked + .btn {
        background-color: #0d6efd;
        color: #fff;
    }

    .btn-check + .btn {
        border: 1px solid #0d6efd;
        padding: 0.5rem 1rem;
        border-radius: 0;
    }

    .btn-outline-primary {
        color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-outline-primary:hover, .btn-outline-primary:focus, .btn-outline-primary:active {
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>

<div class="container mt-4" id="attendance-content" style="display: none;">
    <h1>Attendance</h1>

    <div class="mb-3 text-end">
        <label for="attendance-date" class="form-label">Select Date:</label>
        <input type="date" id="attendance-date" class="form-control d-inline-block w-auto">
    </div>

    <table class="table table-striped" style="width:100%" id="attendance">
        <thead>
            <tr>
                <th>Name</th>
                <th>Attendance</th>
                <th>Total Attendance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Attendance">
                        <input type="radio" class="btn-check" name="attendance_{{ $student->nim_pyp }}" id="present-{{ $student->nim_pyp }}" autocomplete="off">
                        <label class="btn btn-outline-primary" for="present-{{ $student->nim_pyp }}">PRESENT</label>

                        <input type="radio" class="btn-check" name="attendance_{{ $student->nim_pyp }}" id="late-{{ $student->nim_pyp }}" autocomplete="off">
                        <label class="btn btn-outline-primary" for="late-{{ $student->nim_pyp }}">LATE</label>

                        <input type="radio" class="btn-check" name="attendance_{{ $student->nim_pyp }}" id="absent-{{ $student->nim_pyp }}" autocomplete="off">
                        <label class="btn btn-outline-primary" for="absent-{{ $student->nim_pyp }}">ABSENT</label>

                        <input type="radio" class="btn-check" name="attendance_{{ $student->nim_pyp }}" id="excused-{{ $student->nim_pyp }}" autocomplete="off">
                        <label class="btn btn-outline-primary" for="excused-{{ $student->nim_pyp }}">EXCUSED</label>
                    </div>
                </td>
                <td>total attendance</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Attendance</th>
                <td>total attendance</td>
            </tr>
        </tfoot>
    </table>

    <div class="text-end mt-3">
        <button type="button" class="btn btn-primary" id="save-attendance-btn">Save</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('attendance-date');
        const classId = '{{ $class->class_id }}';

        // Set today's date automatically
        const today = new Date().toISOString().split('T')[0];
        dateInput.value = today;

        // Function to fetch all students for the class
        // function fetchStudents() {
        //     return fetch(`/students-by-class/${classId}`)
        //         .then(response => response.json())
        //         console.log("fetch students by class: ", response)
        //         .catch(error => {
        //             console.error('Error fetching students data:', error);
        //             return [];
        //         });
        // }

        function fetchStudents() {
            return fetch(`/students-by-class/${classId}`)
                .then(response => response.json()) // This needs to be awaited or chained correctly
                .then(data => {
                    console.log("fetch students by class: ", data); // Fix: Log `data`, not `response`
                    return data; // Return parsed JSON data
                })
                .catch(error => {
                    console.error('Error fetching students data:', error);
                    return [];
                });
        }


        // Function to fetch attendance data and update the table
        function fetchAttendanceData(date) {
            console.log(date);
            if (!date) {
                // If no date, clear the table or show a message if needed
                updateAttendanceTable([]);
                return;
            }

            
            fetch(`/attendance-by-date/${classId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ date })
                
            })
            .then(response => response.json())
            .then(data => {
                if (data.length != 0) {
                    console.log('attendance data =', data);
                    updateAttendanceTable(data);
                } else {
                    // fetchStudents().then(students => {
                    //     console.log("students: ", data); 
                    //     updateAttendanceTableForAllStudents(students);
                    // });
                    fetchStudents().then(students => {
                        console.log("students: ", students); 
                        updateAttendanceTableForAllStudents(students);
                    });

                }
            })
            .catch(error => {
                console.error('Error fetching attendance data:', error);
            });
        }

// Update the attendance table dynamically
function updateAttendanceTable(data) {
    const tbody = document.querySelector('#attendance-content tbody');
    tbody.innerHTML = ''; // Clear the existing table rows

    data.forEach(record => {
        const studentId = record.student_id;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${record.first_name} ${record.last_name}</td>
            <td>
                <div class="btn-group" role="group" aria-label="Attendance">
                    <input type="radio" class="btn-check" name="attendance_${studentId}" id="present-${studentId}" value="PRESENT" ${record.present ? 'checked' : ''} autocomplete="off">
                    <label class="btn btn-outline-primary" for="present-${studentId}">PRESENT</label>

                    <input type="radio" class="btn-check" name="attendance_${studentId}" id="late-${studentId}" value="LATE" ${record.late ? 'checked' : ''} autocomplete="off">
                    <label class="btn btn-outline-primary" for="late-${studentId}">LATE</label>

                    <input type="radio" class="btn-check" name="attendance_${studentId}" id="absent-${studentId}" value="ABSENT" ${record.absent ? 'checked' : ''} autocomplete="off">
                    <label class="btn btn-outline-primary" for="absent-${studentId}">ABSENT</label>

                    <input type="radio" class="btn-check" name="attendance_${studentId}" id="excused-${studentId}" value="EXCUSED" ${record.excused ? 'checked' : ''} autocomplete="off">
                    <label class="btn btn-outline-primary" for="excused-${studentId}">EXCUSED</label>
                </div>
            </td>
            <td></td>
        `;
        tbody.appendChild(row);
    });
}

// When updating the table with all students
function updateAttendanceTableForAllStudents(students) {
    const tbody = document.querySelector('#attendance-content tbody');
    tbody.innerHTML = ''; // Clear the existing table rows

    students.forEach(student => {
        const studentId = student.nim_pyp;
        console.log(studentId);
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${student.first_name} ${student.last_name}</td>
            <td>
                <div class="btn-group" role="group" aria-label="Attendance">
                    <input type="radio" class="btn-check" name="attendance_${studentId}" id="present-${studentId}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="present-${studentId}">PRESENT</label>

                    <input type="radio" class="btn-check" name="attendance_${studentId}" id="late-${studentId}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="late-${studentId}">LATE</label>

                    <input type="radio" class="btn-check" name="attendance_${studentId}" id="absent-${studentId}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="absent-${studentId}">ABSENT</label>

                    <input type="radio" class="btn-check" name="attendance_${studentId}" id="excused-${studentId}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="excused-${studentId}">EXCUSED</label>
                </div>
            </td>
            <td></td>
        `;
        tbody.appendChild(row);
    });
}


        // Fetch attendance data for today's date on page load
        fetchAttendanceData(today);

        // Handle date change
        dateInput.addEventListener('change', function() {
            const selectedDate = this.value;
            fetchAttendanceData(selectedDate);
        });

        // Handle save button click
        document.getElementById('save-attendance-btn').addEventListener('click', function() {
            const selectedDate = dateInput.value;
            const attendanceData = [];

            // Gather attendance data from the table
            document.querySelectorAll('#attendance-content tbody tr').forEach(row => {
                const studentNim = row.querySelector('input[type="radio"]').name.split('_')[1];
                const attendance = {
                    student_id: studentNim,
                    date: selectedDate,
                    present: row.querySelector(`#present-${studentNim}`)?.checked ? 1 : 0,
                    late: row.querySelector(`#late-${studentNim}`)?.checked ? 1 : 0,
                    absent: row.querySelector(`#absent-${studentNim}`)?.checked ? 1 : 0,
                    excused: row.querySelector(`#excused-${studentNim}`)?.checked ? 1 : 0,
                };
                attendanceData.push(attendance);
            });

            console.log('Sending attendance data to the server:', attendanceData);

            // Forward data to the controller
            fetch('/new-attendance/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(attendanceData)
            }).then(() => {
                alert('Attendance data sent.');
            }).catch(error => {
                console.error('Error sending data:', error);
            });
        });
    });
</script>


