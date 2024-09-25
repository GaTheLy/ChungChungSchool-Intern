@extends('base.base-admin')
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

        function showModal(subjectId) {
        $('#confirmDeleteModal').data('subject-id', subjectId).modal('show');
        }

        function confirmDelete() {
            var subjectId = $('#confirmDeleteModal').data('subject-id');
            $('#delete-form-' + subjectId).submit();
        }


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
        a{
            color:white;
            text-decoration: none;
        }
    </style>
    
        <h1>Teacher</h1>
        <div class="row">
            <div class="col-6" style="text-align:left;">
                <h5>{{ $teacher->first_name }}</h5>
            </div>
        </div>

        <br>
        <div id="liveAlertPlaceholder"></div>
        <div class="row">
            <div class="col" style="text-align:right;margin-right:100px;">
            <button type="button" class="btn btn-primary" ><a href="{{ route('teacher-add.index', ['userId' => $teacher->user_id]) }}">Add</a></button>
            </div>
        </div>

    <br>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Name</th>
                <th>Teaching</th>
                <th>Position</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $teach)
                <tr>
                    <td style="white-space:nowrap;">{{ $teach->nip_text }}</td>
                    <td>{{ $teach->first_name }} {{ $teach->last_name }}</td>
                    <td>
                    @if($teach->is_myp == 0 && $teach->is_pyp == 1)
                        PYP
                    @elseif($teach->is_myp == 1 && $teach->is_pyp == 0)
                        MYP
                    @elseif($teach->is_myp == 1 && $teach->is_pyp == 1)
                        PYP & MYP
                    @endif
                    </td>
                    <td>{{ $teach->position }}</td>

                    <td>{{ $teach->phone }}</td>


                    <td>
                        
                        <a href="{{ route('teacher.detail', ['userId' => $teacher->user_id, 'teacherId' => $teach->nip_pyp]) }}" style="color:black;">Detail</a>
                        
                        <a href="{{ route('teacher.edit', ['userId' => $teacher->user_id, 'teacherId' => $teach->nip_pyp]) }}" style="color:black;">Edit</a>
                        
                        <button onclick="showModal({{$teach->nip_pyp}})" style="text-decoration:none;border:0px;background:none;">Delete</button>
                        <form id="delete-form-{{ $teach->nip_pyp }}" action="{{ route('teacher.delete', ['userId' => $teacher->user_id, 'teacherId' => $teach->nip_pyp]) }}" method="post">
                            @csrf
                        </form>
                    </td>


                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- delete confirmation modal --}}
    <div class="modal fade" id="confirmDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="confirmDeleteModalLabel">Confirm Delete</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure want to delete this teacher?
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-danger" onclick="confirmDelete()">Yes</button>
        </div>
        </div>
    </div>
    </div>
    @endsection 