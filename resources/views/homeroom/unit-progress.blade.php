<style>
    /* Hide the default radio buttons */
    input[type="radio"] {
        display: none;
    }

    /* Custom square button */
    input[type="radio"] + label {
        display: inline-block;
        position: relative;
        padding: 10px 20px;
        margin-right: 10px;
        cursor: pointer;
        font-size: 14px;
        user-select: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        transition: background-color 0.3s, border-color 0.3s;
    }

    /* Selected state */
    input[type="radio"]:checked + label {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    /* Hover state */
    input[type="radio"] + label:hover {
        border-color: #007bff;
    }

    /* Add some spacing between the rows */
    tr {
        height: 50px;
    }
</style>
<div class="container" name="table-atl-pyp" style="display:none;" id="unit-content">
    <h1>Unit Progress PYP Only</h1>

    <div style="text-align:right;">
        Select Unit :
        <select name="unit" id="unit-select">
        <option value="" selected="selected" hidden="hidden">Choose here</option>
            @foreach($units as $unit)
                <option value="{{ $unit->unit_id }}">{{ $unit->name }}</option>
            @endforeach
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
                    <input type="radio" id="exceeding_{{ $student->nim_pyp }}" name="performance_{{ $student->nim_pyp }}" value="EXCEEDING">
                    <label for="exceeding_{{ $student->nim_pyp }}">EXCEEDING</label>
                    
                    <input type="radio" id="achieving_{{ $student->nim_pyp }}" name="performance_{{ $student->nim_pyp }}" value="ACHIEVING">
                    <label for="achieving_{{ $student->nim_pyp }}">ACHIEVING</label>
                    
                    <input type="radio" id="developing_{{ $student->nim_pyp }}" name="performance_{{ $student->nim_pyp }}" value="DEVELOPING">
                    <label for="developing_{{ $student->nim_pyp }}">DEVELOPING</label>
                    
                    <input type="radio" id="beginning_{{ $student->nim_pyp }}" name="performance_{{ $student->nim_pyp }}" value="BEGINNING">
                    <label for="beginning_{{ $student->nim_pyp }}">BEGINNING</label>
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
        <button type="button" class="btn btn-primary" id="save-unit-progress-btn">Save</button>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle save button click
        document.getElementById('save-unit-progress-btn').addEventListener('click', function() {
            const unitId = document.getElementById('unit-select').value;
            const unitProgressData = [];

            // Gather unit progress data from the table
            document.querySelectorAll('#unit-content tbody tr').forEach(row => {
                const studentNim = row.querySelector('input[type="radio"]').name.split('_')[1];
                const progress = row.querySelector(`input[name="performance_${studentNim}"]:checked`);
                if (progress) {
                    unitProgressData.push({
                        student_id: studentNim,
                        unit_id: unitId,
                        performance: progress.value
                    });
                }
            });

            console.log('Sending unit progress data to the server:', unitProgressData);

            // Forward data to the controller
            fetch('{{ route("homeroom.saveUnitProg") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(unitProgressData)
            }).then(response => {
                if (response.ok) {
                    alert('Unit progress saved successfully.');
                } else {
                    alert('Failed to save unit progress.');
                }
            }).catch(error => {
                console.error('Error sending data:', error);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const classId = '{{ $class->class_id }}';

        // Handle unit selection change
        document.getElementById('unit-select').addEventListener('change', function() {
            const unitId = this.value;
            
            // Fetch progress data for the selected unit
            fetch(`/unit-progress/${unitId}/${classId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Fetched unit progress data:', data);
                    updateTable(data);
                })
                .catch(error => console.error('Error fetching data:', error));
        });

        function updateTable(data) {
            const tbody = document.querySelector('#unit-content tbody');
            tbody.innerHTML = ''; // Clear the existing table rows

            data.forEach(progress => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${progress.first_name} ${progress.last_name} </td>
                    <td>
                        <input type="radio" id="exceeding_${progress.student_id}" name="performance_${progress.student_id}" value="EXCEEDING" ${progress.description === 'EXCEEDING' ? 'checked' : ''}>
                        <label for="exceeding_${progress.student_id}">EXCEEDING</label>
                        
                        <input type="radio" id="achieving_${progress.student_id}" name="performance_${progress.student_id}" value="ACHIEVING" ${progress.description === 'ACHIEVING' ? 'checked' : ''}>
                        <label for="achieving_${progress.student_id}">ACHIEVING</label>
                        
                        <input type="radio" id="developing_${progress.student_id}" name="performance_${progress.student_id}" value="DEVELOPING" ${progress.description === 'DEVELOPING' ? 'checked' : ''}>
                        <label for="developing_${progress.student_id}">DEVELOPING</label>
                        
                        <input type="radio" id="beginning_${progress.student_id}" name="performance_${progress.student_id}" value="BEGINNING" ${progress.description === 'BEGINNING' ? 'checked' : ''}>
                        <label for="beginning_${progress.student_id}">BEGINNING</label>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

    });

</script>