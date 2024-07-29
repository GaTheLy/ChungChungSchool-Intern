<div class="container" name="table-attendance" style="display:none;" id="attendance-content">
    <h1>attendance</h1>

    <div style="text-align:right;">    Select Date : <input type="date" />     </div>
    <table id="" class="table table-striped" style="width:100%">
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
                        <button>PRESENT</button>
                        <button>LATE</button>
                        <button>SICK</button>
                        <button>ABSENT</button>
                        <button>EXCUSED</button>
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
    <div class="col" style="text-align:right;">
        <button type="button" class="btn btn-primary" id="liveAlertBtn">Save</button>
    </div>
</div>