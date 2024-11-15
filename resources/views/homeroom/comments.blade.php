<div class="container" name="table-comments" style="display:none;" id="comments-content">
    <h1>Homeroom Teacher Comment</h1>

    <form id="comments-form">
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
                        <textarea name="comments[{{ $student->nim_pyp }}]" id="comment-{{ $student->nim_pyp }}" style="width: 90%; height: 150px; overflow: auto; word-wrap: break-word;"></textarea>  
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
            <button type="button" class="btn btn-primary" id="save-comments-btn">Save</button>
        </div>
    </form>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const classId = '{{ $class->class_id }}'; // Ensure this is passed to the Blade template
    const getCommentsUrl = '{{ route('getComment', ['classId' => $class->class_id]) }}';

    console.log('getCommentsUrl:', getCommentsUrl); // Check the URL in the console

    // Fetch existing comments when the page loads
    fetch(getCommentsUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log('Comments data:', data); // Debugging log
            for (const [key, val] of Object.entries(data)) {
                const textarea = document.querySelector(`textarea[name="comments[${val.nim_pyp}]"]`);
                if (textarea) {
                    textarea.value = val.description || 'asu';
                }
            }
        })
        .catch(error => {
            console.error('Error fetching comments:', error);
            alert('There was an error fetching comments. Please try again later.');
        });

    // Handle form submission for saving comments
    document.getElementById('save-comments-btn').addEventListener('click', function() {
        const form = document.getElementById('comments-form');
        const formData = new FormData(form);

        fetch(`/save-homeroom-comments`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            alert('Comments saved successfully.');
        })
        .catch(error => {
            console.error('Error saving comments:', error);
            alert('There was an error saving comments. Please try again later.');
        });
    });
});

</script>


