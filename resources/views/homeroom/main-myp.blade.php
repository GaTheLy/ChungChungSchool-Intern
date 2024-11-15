<div class="container" name="main-myp" style="display:block;" id="main-myp-content">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Report</th>
                <th>Report Conversion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->dob }}</td>
                    <td><a href="{{ route('report.myp', [$student->nim_pyp]) }}">Preview Report</a></td>
                    <td><a href="{{ route('report-convert.myp', [$student->nim_pyp]) }}">Preview Report Conversion</a></td>

            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Report</th>
                <th>Report Conversion</th>
            </tr>
        </tfoot>
    </table>


</div>