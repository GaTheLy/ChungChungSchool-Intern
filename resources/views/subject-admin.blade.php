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
    
        <h1>Subject</h1>
        <div class="row">
            <div class="col-6" style="text-align:left;">
                <h5>{{ $teacher->first_name }}</h5>
            </div>
        </div>

        <br>
        <div id="liveAlertPlaceholder"></div>
        <div class="row">
            <div class="col" style="text-align:right;margin-right:100px;">
            <button type="button" class="btn btn-primary" ><a href="{{ route('subject-add', ['userId' => $teacher->user_id]) }}">Add</a></button>
            </div>
        </div>

    <br>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Created At</th>
                <th>Level</th>
                <th>Criteria</th>
                <th>Action</th>
                <th>Updated At</th>

            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->subject_name }}</td>
                    <td>dummy</td>
                    <td>{{ $subject->subject_level }}</td>

                    <td>A</td>

                    <td>Detail</td>

                    <td>dummy</td>

                </tr>
            @endforeach
            <tr>
                <td>Mathematic</td>
                <td>January 1, 2024 09:00 WIB</td>
                <td>MYP</td>
                
                <td>A</td>
                    
                <td>Detail</td>

                <td>dummy</td>
            </tr>
            
        </tbody>
        <tfoot>
            <tr>
                <th>Subject</th>
                <th>Created At</th>
                <th>Level</th>
                <th>Criteria</th>
                <th>Action</th>
                <th>Updated At</th>

            </tr>
        </tfoot>
    </table>

    
    @endsection 