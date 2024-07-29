
<div class="container" name="table-atl-myp" style="display:none;" id="atl-myp-content">
    <h1>atl progress myp</h1>

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
                        <button>1</button>
                        <button>2</button>
                        <button>3</button>
                        <button>4</button>
                        <button>5</button>
                        <button>6</button>
                        <button>7</button>
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