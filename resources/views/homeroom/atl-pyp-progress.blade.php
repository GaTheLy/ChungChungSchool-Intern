<div class="container" name="table-atl-pyp" style="display:none;" id="atl-pyp-content">
    <h1>atl progress pyp</h1>

    <table id="" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Progress</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>                        
                        <button>EXCEEDING</button>
                        <button>ACHIEVING</button>
                        <button>DEVELOPING</button>
                        <button>BEGINNING</button>
                    </td>
            </tr>
            @endforeach
        </tbody>
        
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Progress</th>
            </tr>
        </tfoot>
    </table>
    <div class="col" style="text-align:right;">
        <button type="button" class="btn btn-primary" id="liveAlertBtn">Save</button>
    </div>
</div>
