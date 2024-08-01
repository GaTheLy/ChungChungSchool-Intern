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
                        <textarea name="comments[{{ $student->nim_pyp}}]" style="width: 90%; height: 150px; overflow: auto; word-wrap: break-word;"></textarea>  
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
    document.getElementById('save-comments-btn').addEventListener('click', function() {
        const form = document.getElementById('comments-form');
        const formData = new FormData(form);

        fetch('/save-homeroom-comments', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert('Comments saved successfully.');
        })
        .catch(error => {
            console.error('Error saving comments:', error);
        });
    });
</script>