@extends('base.base-pyp')
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
            </div>
            <div class="col-6" style="text-align:right;">
                <h5> {{ $class->homeroom->teacher->first_name }} {{ $class->homeroom->teacher->last_name }}</h5>
            </div>
        </div>

        <br>
        <div id="liveAlertPlaceholder"></div>
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

    <br>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Joined At</th>
                <th>Action</th>
                <th>Progress</th>
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
                        data-late="{{ optional($student->attendance)->late }}">
                        Fill Attendance
                    </td>
                    <td style="text-align: center;"><span data-bs-toggle="modal" data-bs-target="#unitProgress" data-bs-whatever="{{ $student->first_name }} {{ $student->last_name }}">Unit</span> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <span>ATL</span></td>
                    <td><a href="/homeroom-teacher-report-preview-myp">Preview Report</a></td>
            </tr>
            @endforeach
        </tbody>
        
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Joined At</th>
                <th>Action</th>
                <th>Progress</th>
                <th>Report</th>
            </tr>
        </tfoot>
    </table>


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

    {{-- modal fill Attendance --}}
    <div class="modal fade" id="fillAttendance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="fillAttendanceLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="fillAttendanceLabel">Fill Attendance for {{ $student->first_name }} {{ $student->last_name }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="attendanceForm" action="{{ route('attendance.save.pyp') }}" method="POST">
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
                    <label for="data-late" class="col-form-label center-align">Late</label>
                    <input type="text" class="form-control" id="data-late" name='late' value="{{ old('late') ?? $student->attendance->late ?? '' }}">
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


     {{-- modal unit progress --}}
     <div class="modal fade" id="unitProgress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="unitProgressLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="unitProgressLabel">Unit Progress</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label"><b>Student's Name</b></label>
                <input type="text" class="form-control" id="recipient-name">
            </div>
            <label for="message-text" class="col-form-label"><b>Unit Progress</b></label>

            <div class="row" style="text-align:left;">
                <select id="inputState" class="form-select">
                <option selected><b>Select Criteria</b></option>
                <option>Beginning</option>
                <option>Developing</option>
                <option>Achieving</option>
                <option>Exceeding</option>
                </select>
            </div>      
            
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary">Yes</button>
        </div>
        </div>
    </div>
    </div>


    <script>
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

                axios.get('/attendance/' + studentId)
                .then(function (response) {
                    var attendanceData = response.data;
                    document.getElementById('data-absent').value = attendanceData.absent;
                    document.getElementById('data-present').value = attendanceData.present;
                    document.getElementById('data-late').value = attendanceData.late;
                })
                .catch(function (error) {
                    console.error('Error fetching attendance data:', error);
                });
            });
        }



        const exampleModalunit = document.getElementById('unitProgress')
            if (exampleModalunit) {
                exampleModalunit.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const recipient = button.getAttribute('data-bs-whatever')
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                // Update the modal's content.
                const modalTitle = exampleModalunit.querySelector('.modal-title')
                const modalBodyInput = exampleModalunit.querySelector('.modal-body input')

                modalTitle.textContent = `Unit Progress for ${recipient}`
                modalBodyInput.value = recipient
            })
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

    