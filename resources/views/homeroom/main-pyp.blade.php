<div class="container" name="main-pyp" style="display:block;" id="main-pyp-content">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Joined At</th>
                <th>Progress</th>
                <th>Report</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->dob }}</td>
                    <td style="text-align: center;">
                        ATL prog |

                        Unit prog | 

                        Homeroom Comments
                    </td>
                    <td><a href="{{ route('report.pyp', [$student->nim_pyp]) }}">Preview Report</a></td>
            </tr>
            @endforeach
        </tbody>
        
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Joined At</th>
                <th>Progress</th>
                <th>Report</th>
            </tr>
        </tfoot>
    </table>
</div>
