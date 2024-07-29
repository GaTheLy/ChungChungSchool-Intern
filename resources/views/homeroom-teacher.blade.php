@extends('base.base')
    <!-- section content -> yield content base.blade -->
    @section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    
    <style>
        h1{
            font-family:'Space Grotesk';
            /* font-weight: bold; */
            font-size: 40px;
        }
        h5{
            padding-left: 10px;
            padding-top: -20px;
            font-family:'Lexend Deca';
            font-weight: 400;
            font-size: 25px;
        }
    </style>
    
        <h1>Homeroom</h1>
        <div class="row">
            <div class="col-6" style="text-align:left;">
                <h5>{{ $class->class_name }}</h5>
                {{-- <!-- @foreach($homerooms as $homeroom) -->
                <!-- <h5>{{ $homeroom->class->class_name }}</h5> -->
            <!-- @endforeach --> --}}
            </div>
            <div class="col-6" style="text-align:right;">
                <h5>{{ $teacher->first_name }}</h5>
            </div>
        </div>

        <br>
        <div id="liveAlertPlaceholder"></div>
        {{-- 
        <div class="row">
            <div class="col-3" style="text-align:center;">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticExport">Export All</button>
            </div>
            <div class="col-3" style="text-align:center;">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticConvert">Convert All</button>
            </div>
            <div class="col-3" style="text-align:center;">
            </div>
            <div class="col-3" style="text-align:center;">
            <button type="button" class="btn btn-primary" id="liveAlertBtn">Save</button>
            </div>
        </div>
         --}}

        <div class="row" style="text-align:center;">
            <div class="col">
                <button type="button" class="btn btn-info" id="show-main-button">Main</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-info" id="show-attendance-button">Fill Attendance</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-info" id="show-atl-pyp-button">ATL Progress</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-info" id="show-hc-button">Homeroom's Comment</button>
            </div>
        </div>

    <br>

    @include('homeroom.attendance')

    @include('homeroom.atl-myp-progress')

    @include('homeroom.comments')

    @include('homeroom.main-myp')
    <br>

    {{-- 

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Joined At</th>
                <th>Action</th>
                <th>Report</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->dob }}</td>
                    <td data-bs-toggle="modal"
                        data-bs-target="#fillAttendance"
                        data-bs-whatever="{{ $student->first_name }} {{ $student->last_name }}"
                        data-student-id="{{ $student->nim_pyp }}"
                        data-absent="{{ optional($student->attendance)->absent }}"
                        data-present="{{ optional($student->attendance)->present }}"
                        data-late="{{ optional($student->attendance)->late }}"
                        data-sick="{{ optional($student->attendance)->sick }}"
                        data-excused="{{ optional($student->attendance)->excused }}">
                        Fill Attendance
                    </td>
                    <td><a href="{{ route('report.myp', [$student->nim_pyp]) }}">Preview Report</a></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Joined At</th>
                <th>Action</th>
                <th>Report</th>
            </tr>
        </tfoot>
    </table>
 --}}


{{-- modal export --}}
    <div class="modal fade" id="staticExport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticExportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticExportLabel">Export All Report</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure want to export all report?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary">Yes</button>
        </div>
        </div>
    </div>
    </div>

    {{-- modal convert --}}
    <div class="modal fade" id="staticConvert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticConvertLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticConvertLabel">Convert All Report</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure want to convert all report?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary">Yes</button>
        </div>
        </div>
    </div>
    </div>

    {{-- modal fill Attendance 
    <div class="modal fade" id="fillAttendance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="fillAttendanceLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="fillAttendanceLabel">Fill Attendance for {{ $student->first_name }} {{ $student->last_name }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="attendanceForm" action="{{ route('attendance.save.myp') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="data-student-name" class="col-form-label"><b>Student's Name</b></label>
                <input type="text" name='student_name' class="form-control" id="data-student-name" disabled>
            </div>
            <input type="hidden" id="studentId" name="student_id">
            <label for="message-text" class="col-form-label"><b>Attendance</b></label>

            <div class="row" style="text-align: center;">
                <div class="col-md-2">
                    <label for="data-absent" class="col-form-label center-align">Absent</label>
                    <input type="text" class="form-control" id="data-absent" name='absent' value="{{ old('absent') ?? $student->attendance->absent ?? '' }}">
                </div>

                <div class="col-md-2">
                    <label for="data-present" class="col-form-label center-align">Present</label>
                    <input type="text" class="form-control" id="data-present" name='present' value="{{ old('present') ?? $student->attendance->present ?? '' }}">
                </div>

                <div class="col-md-2">
                    <label for="data-sick" class="col-form-label center-align">Sick</label>
                    <input type="text" class="form-control" id="data-sick" name='sick' value="{{ old('sick') ?? $student->attendance->sick ?? '' }}">
                </div>

                <div class="col-md-2">
                    <label for="data-late" class="col-form-label center-align">Late</label>
                    <input type="text" class="form-control" id="data-late" name='late' value="{{ old('late') ?? $student->attendance->late ?? '' }}">
                </div>

                <div class="col-md-2">
                    <label for="data-excused" class="col-form-label center-align">Excused</label>
                    <input type="text" class="form-control" id="data-excused" name='excused' value="{{ old('excused') ?? $student->attendance->excused ?? '' }}">
                </div>
            </div>
            
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary">Yes</button>
        </div>
        </form>
        </div>
    </div>
    </div>
--}}

    <script>
        var mainContent = document.getElementById('main-myp-content');
        var attendanceContent = document.getElementById('attendance-content');
        var atlPypContent = document.getElementById('atl-myp-content');
        var hcContent = document.getElementById('comments-content');

            document.getElementById('show-main-button').addEventListener('click', function() {
                if (mainContent.style.display === 'none') {
                    mainContent.style.display = 'block';
                    attendanceContent.style.display = 'none';
                    atlPypContent.style.display = 'none';
                    hcContent.style.display = 'none';
                } else {
                    mainContent.style.display = 'none';
                }
            });

            document.getElementById('show-attendance-button').addEventListener('click', function() {
                if (attendanceContent.style.display === 'none') {
                    attendanceContent.style.display = 'block';
                    atlPypContent.style.display = 'none';
                    hcContent.style.display = 'none';
                    mainContent.style.display = 'none';
                } else {
                    attendanceContent.style.display = 'none';
                }
            });

            document.getElementById('show-atl-pyp-button').addEventListener('click', function() {
                if (atlPypContent.style.display === 'none') {
                    atlPypContent.style.display = 'block';
                    attendanceContent.style.display = 'none';
                    hcContent.style.display = 'none';
                    mainContent.style.display = 'none';
                } else {
                    atlPypContent.style.display = 'none';
                }
            });

            document.getElementById('show-hc-button').addEventListener('click', function() {
                if (hcContent.style.display === 'none') {
                    hcContent.style.display = 'block';
                    atlPypContent.style.display = 'none';
                    attendanceContent.style.display = 'none';
                    mainContent.style.display = 'none';
                } else {
                    hcContent.style.display = 'none';
                }
            });




        const exampleModal = document.getElementById('fillAttendance');

if (exampleModal) {
    exampleModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget;

        // Extract necessary data from data-bs-* attributes
        const studentName = button.getAttribute('data-bs-whatever');
        const studentId = button.getAttribute('data-student-id');
        const absent = button.getAttribute('data-absent') || '';
        const present = button.getAttribute('data-present') || '';
        const late = button.getAttribute('data-late') || '';
        const sick = button.getAttribute('data-sick') || '';
        const excused = button.getAttribute('data-excused') || '';

        // Update the modal's content
        const modalTitle = exampleModal.querySelector('.modal-title');
        modalTitle.textContent = `Fill Attendance for ${studentName}`;

        // Update the student name input
        const studentNameInput = exampleModal.querySelector('#data-student-name');
        studentNameInput.value = studentName;

        const studentIdInput = exampleModal.querySelector('#studentId');
        studentIdInput.value = studentId;

        // Update the attendance inputs
        const inputAbsent = exampleModal.querySelector('#data-absent');
        inputAbsent.value = absent;

        const inputPresent = exampleModal.querySelector('#data-present');
        inputPresent.value = present;

        const inputLate = exampleModal.querySelector('#data-late');
        inputLate.value = late;

        const inputSick = exampleModal.querySelector('#data-sick');
        inputSick.value = sick;

        const inputExcused = exampleModal.querySelector('#data-excused');
        inputExcused.value = excused;

        axios.get('/attendance-myp/' + studentId)
        .then(function (response) {
            var attendanceData = response.data;
            document.getElementById('data-absent').value = attendanceData.absent;
            document.getElementById('data-present').value = attendanceData.present;
            document.getElementById('data-late').value = attendanceData.late;
            document.getElementById('data-sick').value = attendanceData.sick;
            document.getElementById('data-excused').value = attendanceData.excused;
        })
        .catch(function (error) {
            console.error('Error fetching attendance data:', error);
        });
    });
}

            //alert
            const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
            const appendAlert = (message, type) => {
            const wrapper = document.createElement('div')
            wrapper.innerHTML = [
                `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                `   <div>${message}</div>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                '</div>'
            ].join('')

            alertPlaceholder.append(wrapper)
            }

            const alertTrigger = document.getElementById('liveAlertBtn')
            if (alertTrigger) {
            alertTrigger.addEventListener('click', () => {
                appendAlert('All changes saved!', 'success')
            })
            }
    </script>

    
    @endsection 