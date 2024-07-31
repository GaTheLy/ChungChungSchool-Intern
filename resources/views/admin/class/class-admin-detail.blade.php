@extends('base.base-admin')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
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

<br>

    <div class="row">
        <div class="col-3">
            <h5>1. Class Name</h5>
        </div> 
        <div class="col-6">
            <input disabled value="{{$selectedClass->class_name}}" style="height:40px;width:500px;">
        </div>
    </div>
    <br>        
    <div class="row">
        <div class="col-3">
            <h5>2. Homeroom</h5>
        </div> 
        <div class="col-6">
            <input disabled value="{{ $selectedClass->homeroom ? $selectedClass->homeroom->teacher->first_name . ' ' . $selectedClass->homeroom->teacher->last_name : 'N/A' }}" style="height:40px;width:500px;">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3">
            <h5>3. Students</h5>
        </div>
        <div class="col">
            <p>total {{ $selectedClass->students->count() }} students</p>
        </div>
    </div>
    <br />
    <div class="col-10" style="margin-left:100px;">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Student</th>

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
                        </tr>
                        <?php $index += 1; ?>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Student</th>
                    </tr>
                </tfoot>
            </table>
        </div>

@endsection
