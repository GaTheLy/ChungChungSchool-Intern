@extends('base.base')
    <!-- section content -> yield content base.blade -->
    @section('content')
{{-- datatables attributes --}}
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

    {{-- datatables attributes --}}

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
    
        <h1>{{ $subject->subject_name }} ({{ $class->class_name }})</h1>
        <h5>{{ $teacher->first_name }} {{ $teacher->last_name }}</h5>
        <br>


        <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($students as $student)
            <tr>
                <td>{{ $student->first_name}} {{ $student->last_name}}</td>
                <td>
                    @if ($subject->subject_level == 'PYP')
                        <a style="text-decoration:none;" href="{{ route('subject.grade', ['teacherId' => $teacher->nip_pyp, 'subjectId' => $subject->id, 'classId' => $class->class_id, 'studentId' => $student->nim_pyp]) }}">Grade</a>
                    @elseif ($subject->subject_level == 'MYP')
                        <a style="text-decoration:none;" href="{{ route('subject.grade.myp', ['teacherId' => $teacher->nip_pyp, 'subjectId' => $subject->id, 'classId' => $class->class_id, 'studentId' => $student->nim_pyp]) }}">Grade</a>
                    @endif
                </td>

            </tr>
            @endforeach
            
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>

    
    



            <script>
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