<div class="container" name="main-myp" style="display:none;" id="main-myp-content">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Joined At</th>
                <th>Report</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->dob }}</td>
                    <td><a href="{{ route('report.myp', [$student->nim_pyp]) }}">Preview Report</a></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Joined At</th>
                <th>Report</th>
            </tr>
        </tfoot>
    </table>


</div>