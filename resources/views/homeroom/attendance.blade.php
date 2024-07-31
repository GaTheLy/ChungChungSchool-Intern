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

    <table class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Attendance</th>
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

                        <input type="radio" class="btn-check" name="attendance_{{ $student->nim_pyp }}" id="sick-{{ $student->nim_pyp }}" autocomplete="off">
                        <label class="btn btn-outline-primary" for="sick-{{ $student->nim_pyp }}">SICK</label>

                        <input type="radio" class="btn-check" name="attendance_{{ $student->nim_pyp }}" id="absent-{{ $student->nim_pyp }}" autocomplete="off">
                        <label class="btn btn-outline-primary" for="absent-{{ $student->nim_pyp }}">ABSENT</label>

                        <input type="radio" class="btn-check" name="attendance_{{ $student->nim_pyp }}" id="excused-{{ $student->nim_pyp }}" autocomplete="off">
                        <label class="btn btn-outline-primary" for="excused-{{ $student->nim_pyp }}">EXCUSED</label>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Attendance</th>
            </tr>
        </tfoot>
    </table>

    <div class="text-end mt-3">
        <button type="button" class="btn btn-primary" id="save-attendance-btn">Save</button>
    </div>
</div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
        // Set today's date automatically
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('attendance-date').value = today;

        // Handle save button click
        document.getElementById('save-attendance-btn').addEventListener('click', function() {
            const selectedDate = document.getElementById('attendance-date').value;
            const attendanceData = [];

            // Gather attendance data from the table
            document.querySelectorAll('#attendance-content tbody tr').forEach(row => {
                const studentNim = row.querySelector('input[type="radio"]').name.split('_')[1];
                const attendance = {
                    student_id: studentNim,
                    date: selectedDate,
                    present: row.querySelector(`#present-${studentNim}`)?.checked ? 1 : 0,
                    late: row.querySelector(`#late-${studentNim}`)?.checked ? 1 : 0,
                    sick: row.querySelector(`#sick-${studentNim}`)?.checked ? 1 : 0,
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
                alert('Attendance data sent to the server.');
            }).catch(error => {
                console.error('Error sending data:', error);
            });
        });
    });


</script>
