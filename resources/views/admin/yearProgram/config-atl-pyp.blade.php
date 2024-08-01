     {{-- config approaches to learning --}}   
        <div class="modal fade" id="staticConfigATLPYP" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticConfigATLPYPLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-titleATLConfig">Config New ATL</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="ConfigATLForm">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <label for="" class="col-form-label"><b>Approaches to Learning</b></label>
                                <button class="btn me-md-2" type="button" id="addInputA">
                                    add more criteria            <i class="lni lni-circle-plus"></i>
                                </button>
                                <table>
                                    <thead>
                                        <th>
                                            <td>#</td>
                                            <td>Name</td>
                                            <td>Action</td>
                                        </th>

                                    </thead>

                                </table>
                                <input type="text" id="atl_name" name="atl_name" atyle="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Config</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                var staticConfigATLModal = document.getElementById('staticConfigATLPYP');
                    
                    if (staticConfigATLModal) {
                        staticConfigATLModal.addEventListener('show.bs.modal', function(event) {
                            var button = event.relatedTarget; // Button that triggered the modal
                            
                            // Update the modal title
                            var modalTitle = staticAddATLModal.querySelector('#modal-titleATLConfig');
                            modalTitle.textContent = 'Config New ATL';
                            
                            // Update the form action URL
                            var form = staticAddATLModal.querySelector('#ConfigATLForm');
                        });
                    }

                    $('#addInputA').click(function() {
                        var newInputNumber = $('#PYPContainer .form-group').length;
                        console.log(newInputNumber);


                        var newInput = `
                        <div class="form-group">
                            <div class="row">
                                    <div class="col-3" style="margin-left:80px;">
                                        <span>Criteria ${newInputNumber}</span>
                                            <div class="row">
                                                <div class="col-4">
                                                <input type="text" name="criteriaNew[${newInputNumber}][name]" id="criteriaNew[${newInputNumber}][name]" class="criteria-name">
                                                </div>
                                            </div>
                                    </div> 
                                                        <span class="delete-btn">Delete</span>

                                </div>
                        </div>
                                        
                                        `;
                        $('#PYPContainer').append(newInput);
                    });

                    var selectedOption = $('#subject_level').val().trim();
                    if (selectedOption === 'PYP') {
                        $('#PYP').show();
                        var newInput = `
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3" style="margin-left:80px;">
                                    <span>Criteria </span>
                                    @foreach ($subject->pypCriteria as $criteria)
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="text" name="criteria[{{ $criteria->sc_pyp_id }}][name]" id="criteria[{{ $criteria->sc_pyp_id}}][name]" value="{{ old('criteria.' . $criteria->sc_pyp_id . '.name', $criteria->crit_name) }}" class="criteria-name">
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('subject-edit-criteriaPYP.delete', ['userId' => $teacher->user_id, 'subjectId' => $subject->id, 'criteriaId' => $criteria->sc_pyp_id]) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                    @endforeach
                                </div> 
                            </div>
                        </div>`;
                        $('#PYPContainer').append(newInput);
                    }

                });
        </script>