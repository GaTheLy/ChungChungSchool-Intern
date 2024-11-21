{{-- modal Edit Subject for PYP --}}
<div class="modal fade" id="editSubjectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editSubjectModalLabel">Edit Subject</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="editSubjectForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-subject-name" class="form-label"><b>Subject Name</b></label>
                        <input type="text" class="form-control" id="edit-subject-name" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="edit-criteria-list" class="form-label"><b>Criteria</b></label>
                        <div id="edit-criteria-list">
                            <!-- Criteria checkboxes will be dynamically injected here -->
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit-class" class="form-label"><b>Assigned Class</b></label>
                        <select name="class" id="edit-class" class="form-select">
                            <option value="">-- Select --</option>
                            <option value="ALL">All</option>
                            <!-- Class options dynamically added -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var editSubjectModal = document.getElementById('editSubjectModal');

    editSubjectModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var subjectId = button.getAttribute('data-subject-id');
        var classInfo = JSON.parse(button.getAttribute('data-class-info'));

        // Populate Subject Name
        var subjectNameInput = editSubjectModal.querySelector('#edit-subject-name');
        subjectNameInput.value = button.closest('tr').querySelector('td:first-child').textContent.trim();

        // Populate Criteria List
        var criteriaContainer = editSubjectModal.querySelector('#edit-criteria-list');
        criteriaContainer.innerHTML = '';

        fetch(`/criteria/${subjectId}`)
            .then(response => response.json())
            .then(criteria => {
                criteria.forEach(criterion => {
                    let checkbox = document.createElement('div');
                    checkbox.classList.add('form-check');
                    checkbox.innerHTML = `
                        <input class="form-check-input" type="checkbox" name="criteria_${criterion.sc_pyp_id}" value="1" ${criterion.is_checked ? 'checked' : ''}>
                        <label class="form-check-label">${criterion.crit_name}</label>`;
                    criteriaContainer.appendChild(checkbox);
                });
            });

        // Populate Classes
        var classSelect = editSubjectModal.querySelector('#edit-class');
        classSelect.innerHTML = '<option value="">-- Select --</option>';
        let isMultipleClasses = Object.keys(classInfo).length > 1;

        if (isMultipleClasses) {
            classSelect.innerHTML += '<option value="ALL" selected>All</option>';
        }

        for (let classId in classInfo) {
            classSelect.innerHTML += `
                <option value="${classId}" ${!isMultipleClasses && 'selected'}>${classInfo[classId]}</option>`;
        }

        // Update form action
        var form = editSubjectModal.querySelector('#editSubjectForm');
        // Set the action URL for the form dynamically
        form.action = `/year-program-edit-subjectPYP/${subjectId}`;
    });
});

</script>
