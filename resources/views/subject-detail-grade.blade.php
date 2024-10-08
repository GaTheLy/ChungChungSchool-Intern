@extends('base.base')
    <!-- section content -> yield content base.blade -->
    @section('content')
{{-- datatables attributes --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    {{-- datatables attributes --}}

    <style>
        h1{
            font-family:'Space Grotesk';
            /* font-weight: bold; */
            font-size: 40px;
        }
        h5{
            padding-left: 10px;
            padding-top: -20px;
            font-family:'Lexend Deca';
            font-weight: 400;
            font-size: 25px;
        }
    </style>
    
        <h1>{{ $subject->subject_name }}</h1>
        <div class="row">
            <div class="col-3" style="text-align:left;">
                <h5>{{ $class->class_name }}</h5>
            </div>
            <div class="col-3" style="text-align:left;">
                <h5>{{ $student->first_name }} {{ $student->last_name }}</h5>
            </div>
        </div>
        <br>

        <form action="{{ route('subject.grade.myp.save') }}" method="POST">
    @csrf

    <input type="hidden" name="overall_grade" id="overall-grade-input">

    <input type="hidden" name="student_id" value="{{ $student->nim_pyp }}">

    <input type="hidden" name="subject_id" value="{{ $subject->id }}">

    <div id="liveAlertPlaceholder"></div>
    <div class="row">
        <div class="row">
            <div class="col" style="text-align:right;margin-right:100px;">
                <button type="submit" class="btn btn-primary" id="liveAlertBtn">Save</button>
            </div>
        </div>
    </div>

    {{-- grade form --}}
    <div class="row">
        <div class="col-3">
            <h5 style="padding:20px;">Student Progress</h5>
        </div>
        <div class="col" style="text-align:left;margin-top:15px;margin-left:-95px;">
            <span id='overall-grade' style="
                height:40px;
                width:40px;
                border:1px solid black;
                display:inline-flex;
                align-items:center;
                justify-content:center;
                border-radius:5px;
                font-weight: bold;
                text-align: center;
                line-height: 40px;
                font-size: 16px; /* Adjust font size as needed */
            "></span>
        </div>
    </div>

    @foreach($criteria as $criterion)
        <div class="row">
            <div class="col-1"></div>
            <div class="col-3">
                <h5>{{ $criterion->criteria_title }}: {{ $criterion->criteria_name }}</h5>
                <div class="btn-group" role="group" aria-label="Grade Range">
                    @for ($i = 1; $i <= 8; $i++)
                        <input type="radio" class="btn-check" name="criteria[{{ $criterion->id }}][grade]" id="grade-{{ $criterion->id }}-{{ $i }}" autocomplete="off" value="{{ $i }}"
                            @if($studentGrade->has($criterion->id) && $studentGrade[$criterion->id]->crit_grade == $i) checked @endif>
                        <label class="btn btn-outline-secondary" for="grade-{{ $criterion->id }}-{{ $i }}" onclick="updateDescriptor({{ $criterion->id }}, {{ $i }})">{{ $i }}</label>
                    @endfor
                </div>
            </div>
            <div class="col-6" style="text-align:left;margin-left:-55px;">
                <p id="descriptor-{{ $criterion->id }}" style="height:80px;width:500px; border-style:ridge;">
                    @if($studentGrade->has($criterion->id))
                        {{ $criterion->mypCriteriaDetail->firstWhere('criteria_range', $studentGrade[$criterion->id]->crit_grade)->criteria_range_desc ?? '' }}
                    @endif
                </p>
            </div>
        </div>
        <br>
    @endforeach

    <br>

    <h5 style="padding:20px;">Approaches to Learning</h5>

    <table class="table" style="margin-left:50px;width:50%;">
    <thead>
        <tr>
        <th scope="col"></th>
        <th scope="col">EE</th>
        <th scope="col">AE</th>
        <th scope="col">ME</th>
        <th scope="col">BE</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
    @foreach($atls as $index => $atl)
        <tr>
            <th scope="row">{{ $atl->atl_name }}</th>
            <td>
                <input class="form-check-input" type="radio" name="atl_[{{ $atl->id }}][prog]" value="EE" id="prog_{{ $index }}_ee"
                @if($studentAtl->has($atl->id) && $studentAtl[$atl->id]->atl_progress == 'EE') checked @endif>
            </td>
            <td>
                <input class="form-check-input" type="radio" name="atl_[{{ $atl->id }}][prog]" value="AE" id="prog_{{ $index }}_ae"
                @if($studentAtl->has($atl->id) && $studentAtl[$atl->id]->atl_progress == 'AE') checked @endif>
            </td>
            <td>
                <input class="form-check-input" type="radio" name="atl_[{{ $atl->id }}][prog]" value="ME" id="prog_{{ $index }}_me"
                @if($studentAtl->has($atl->id) && $studentAtl[$atl->id]->atl_progress == 'ME') checked @endif>
            </td>
            <td>
                <input class="form-check-input" type="radio" name="atl_[{{ $atl->id }}][prog]" value="BE" id="prog_{{ $index }}_be"
                @if($studentAtl->has($atl->id) && $studentAtl[$atl->id]->atl_progress == 'BE') checked @endif>
            </td>
        </tr>
    @endforeach

    </tbody>
    </table>

    <h5 style="padding:20px;">Homeroom Teacher Comments</h5>
    <textarea name="teacher_com" id="teacher_com" style="height:100px;width:1000px;margin-left:50px;">@if(isset($subject->progress->teacher_comment)){{ $subject->progress->teacher_comment }}@endif</textarea>
    </form>



         {{-- modal export --}}
    <div class="modal fade" id="staticExport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticExportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticExportLabel">Export All Report</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure want to export all report?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary">Yes</button>
        </div>
        </div>
    </div>
    </div>

    {{-- modal convert --}}
    <div class="modal fade" id="staticConvert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticConvertLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticConvertLabel">Convert All Report</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure want to convert all report?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary">Yes</button>
        </div>
        </div>
    </div>
    </div>

        <script>
            //alert
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
            const appendAlert = (message, type) => {
            const wrapper = document.createElement('div')
            wrapper.innerHTML = [
                `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                `   <div>${message}</div>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                '</div>'
            ].join('')

            alertPlaceholder.append(wrapper)
            }

            // Overall grade
            function calculateOverallGrade() {
                let totalScore = 0;
                let criteriaCount = 0;

                // Iterate through each criterion and update totalScore and criteriaCount
                @foreach($criteria as $criterion)
                    // Instead of const, use let to avoid redeclaration issues
                    var selectedGrade = $('input[name="criteria[{{ $criterion->id }}][grade]"]:checked').val();
                    if (selectedGrade) {
                        totalScore += parseInt(selectedGrade, 10);
                        criteriaCount++;
                    }
                @endforeach

                const overallGrade = criteriaCount > 0 ? Math.round(totalScore / criteriaCount) : 'N/A';
                document.getElementById('overall-grade').innerText = overallGrade;
                document.getElementById('overall-grade-input').value = overallGrade; 
            }

            const alertTrigger = document.getElementById('liveAlertBtn')
            if (alertTrigger) {
            alertTrigger.addEventListener('click', () => {
                appendAlert('All changes saved!', 'success')
            })
            }
        
            const descriptors = @json($criteria->mapWithKeys(function ($criterion) {
                return [$criterion->id => $criterion->mypCriteriaDetail->pluck('criteria_range_desc', 'criteria_range')];
            }));

            // Update descriptor
            function updateDescriptor(criteriaId, grade) {
                const descriptor = descriptors[criteriaId][grade] || '';
                document.getElementById(`descriptor-${criteriaId}`).innerText = descriptor;
            }

            $(document).ready(function() {
                // Initial calculation of the overall grade
                calculateOverallGrade();

                // Recalculate overall grade on any radio button change
                $('input[type="radio"]').on('change', function() {
                    calculateOverallGrade();
                });
            });
            
            
        </script>

    @endsection 