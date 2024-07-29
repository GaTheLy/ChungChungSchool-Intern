<div class="container" name="table-atl-pyp" style="display:none;" id="unit-content">
    <h1>unit progress pyp only</h1>

    <div style="text-align:right;">    
        Select Unit : 
        <select name="" id="">
            {{-- ini di for loop ya mksi --}}
            <option value="">Unit 1</option>
            <option value="">Unit 2</option>
        </select>
    </div>

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
