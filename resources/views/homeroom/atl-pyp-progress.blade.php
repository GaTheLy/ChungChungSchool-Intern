<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    /* Your existing styles */
    .btn-check:checked + .btn {
        background-color: #0d6efd;
        color: #fff;
    }

    .btn-check + .btn {
        border: 1px solid #0d6efd;
        padding: 0.5rem 1rem;
        border-radius: 0;
    }

    .btn-outline-primary {
        color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-outline-primary:hover, .btn-outline-primary:focus, .btn-outline-primary:active {
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>

<div class="container" name="table-atl-pyp" style="display:none;" id="atl-pyp-content">
    <h1>Approaches To Learning Progress</h1>

    <div style="text-align:right;">
        Select Approaches to Learning :
        <select name="atl" id="atl-select">
            <option value="" selected="selected" hidden="hidden">Choose here</option>
            @foreach($atls as $atl)
                <option value="{{ $atl->atl_id }}"> {{ $atl->description }} id:{{ $atl->atl_id }}</option>
            @endforeach
        </select>
    </div>

    <table id="atl-pyp" class="table table-striped" style="width:100%">
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
                    <div class="btn-group" role="group" aria-label="Progress">
                        <input type="radio" class="btn-check" name="progress_{{ $student->nim_pyp }}" id="exceeding-{{ $student->nim_pyp }}" value="Exceeding" autocomplete="off">
                        <label class="btn btn-outline-primary" for="exceeding-{{ $student->nim_pyp }}">Exceeding</label>

                        <input type="radio" class="btn-check" name="progress_{{ $student->nim_pyp }}" id="achieving-{{ $student->nim_pyp }}" value="Achieving" autocomplete="off">
                        <label class="btn btn-outline-primary" for="achieving-{{ $student->nim_pyp }}">Achieving</label>

                        <input type="radio" class="btn-check" name="progress_{{ $student->nim_pyp }}" id="developing-{{ $student->nim_pyp }}" value="Developing" autocomplete="off">
                        <label class="btn btn-outline-primary" for="developing-{{ $student->nim_pyp }}">Developing</label>

                        <input type="radio" class="btn-check" name="progress_{{ $student->nim_pyp }}" id="beginning-{{ $student->nim_pyp }}" value="Beginning" autocomplete="off">
                        <label class="btn btn-outline-primary" for="beginning-{{ $student->nim_pyp }}">Beginning</label>
                    </div>
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
        <button type="button" class="btn btn-primary" id="save-atl-btn">Save</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const atlSelect = document.getElementById('atl-select');
        const classId = '{{ $class->class_id }}'; // assuming you pass the classId from Blade

        // Function to fetch and display existing ATL progress for selected ATL
        function fetchAtlProgress(atlId, classId) {
            console.log(`Fetching ATL progress for ATL ID: ${atlId}, Class ID: ${classId}`);
            
            fetch(`/atl-progress/${atlId}/${classId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Fetched ATL progress data:', data);
                    updateProgressTable(data);
                })
                .catch(error => {
                    console.error('Error fetching ATL progress:', error);
                });
        }

        // Function to update the table with existing progress data
        function updateProgressTable(data) {
            const tbody = document.querySelector('#atl-pyp-content tbody');

            // Iterate over each row and update the progress if it exists
            document.querySelectorAll('#atl-pyp-content tbody tr').forEach(row => {
                const studentId = row.querySelector('input[type="radio"]').name.split('_')[1];

                // Find the student's progress data
                const studentProgress = data.find(record => record.student_id == studentId);

                if (studentProgress) {
                    // Update the radio button based on the performance
                    row.querySelector(`input[name="progress_${studentId}"][value="${studentProgress.description}"]`).checked = true;
                }
            });
        }

        // Handle ATL dropdown change
        atlSelect.addEventListener('change', function() {
            const selectedAtlId = this.value;
            if (selectedAtlId) {
                fetchAtlProgress(selectedAtlId, classId);
            }
        });

        // Handle save button click
        document.getElementById('save-atl-btn').addEventListener('click', function() {
            const atlProgressData = [];

            // Gather progress data from the table
            document.querySelectorAll('#atl-pyp-content tbody tr').forEach(row => {
                const studentId = row.querySelector('input[type="radio"]').name.split('_')[1];
                const progress = {
                    student_id: studentId,
                    atl_id: atlSelect.value,
                    performance: row.querySelector(`input[name="progress_${studentId}"]:checked`)?.value || ''
                };
                atlProgressData.push(progress);
            });

            console.log('Sending ATL progress data to the server:', atlProgressData);

            // Forward data to the controller
            fetch('/new-atl-progress/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(atlProgressData)
            }).then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message);
                } else {
                    alert('Error saving ATL progress data');
                }
            }).catch(error => {
                console.error('Error sending data:', error);
                alert('An error occurred while saving ATL progress data');
            });
        });
    });

</script>
