@extends('base.base-pyp')
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
<div id="liveAlertPlaceholder"></div>
<form action="{{ route('subject.grade.save') }}" method="POST">
    @csrf
    {{-- <input type="hidden" name="subject_id" value="{{ $subject->subject_pyp_id }}"> 
    <input type="hidden" name="class_id" value="{{ $class->class_id }}"> --}}

    <input type="hidden" name="student_id" value="{{ $student->nim_pyp }}"> 

    <div class="row">
        <div class="col" style="text-align:right;margin-right:100px;">
            <button type="submit" class="btn btn-primary" id="liveAlertBtn">Save</button>
        </div>
    </div>

    {{-- grade form --}}
    <div class="row">
        <div class="col-3">
            <h5 style="padding:20px;">Criteria</h5>
        </div>

        @foreach($criteria as $criterion)
        <input type="hidden" name="criteria[{{ $criterion->crit_id }}][sc_pyp_id]" value="{{ $criterion->sc_pyp_id }}">
            <div class="row" style="padding-left:50px;">
                <div class="col-4">
                    <p style="font-size: 25px;">{{ $criterion->crit_name }}</p>
                </div> 
                <div class="col-2" style="text-align:left;">
                    <select name="criteria[{{ $criterion->crit_id }}][description]" class="form-select">
                        <option selected><b>Select Criteria</b></option>
                        <option value="Beginning">Beginning</option>
                        <option value="Developing">Developing</option>
                        <option value="Achieving">Achieving</option>
                        <option value="Exceeding">Exceeding</option>
                    </select>
                </div>      
            </div>
        @endforeach
    </div>
</form>

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

    const alertTrigger = document.getElementById('liveAlertBtn')
    if (alertTrigger) {
        alertTrigger.addEventListener('click', () => {
            appendAlert('All changes saved!', 'success')
        })
    }
</script>

@endsection
