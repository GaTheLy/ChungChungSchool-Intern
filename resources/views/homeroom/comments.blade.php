<div class="container" name="table-comments" style="display:none;" id="comments-content">
    <h1>homeroom teacher comment</h1>

    <table id="" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td> 
                        <textarea style="width: 90%; height: 150px; overflow: auto; word-wrap: break-word;"></textarea>  
                    </td>
            </tr>
            @endforeach
        </tbody>
        
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Comments</th>
            </tr>
        </tfoot>
    </table>
    <div class="col" style="text-align:right;">
        <button type="button" class="btn btn-primary" id="liveAlertBtn">Save</button>
    </div>
</div>
