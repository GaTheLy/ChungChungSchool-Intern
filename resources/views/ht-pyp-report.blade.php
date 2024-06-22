@extends('base.base')
    <!-- section content -> yield content base.blade -->
    @section('content')

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
    
        <h1>Homeroom</h1>
        <div class="row">
            <div class="col-6" style="text-align:left;">
                <h5>[class detail]</h5>
            </div>
            <div class="col-6" style="text-align:right;">
                <h5>[full name]</h5>
            </div>
        </div>

        <br>
        <div id="liveAlertPlaceholder"></div>
        <div class="row">
            <div class="col-3" style="text-align:center;">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticExport">Export</button>
            </div>
            <div class="col-3" style="text-align:center;">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticConvert">Convert</button>
            </div>
            <div class="col-3" style="text-align:center;">
            </div>
            <div class="col-3" style="text-align:center;">
            <button type="button" class="btn btn-primary" id="liveAlertBtn">Save</button>
            </div>
        </div>

        

        
        <div class="row">
            <h6><b>Name</b></h6>
            <span>[full name]</span>
        </div>
        <br>
        <div class="row">
            <div class="col-1">
            <h6><b>Grade</b></h6>
            <span>[grade level]</span>
            </div>
            <div class="col-2">
            <h6><b>Date of Birth</b></h6>
            <span>[birth date]</span>
            </div>
            <div class="col-2">
            <h6><b>Homeroom</b></h6>
            <span>[teacher's name]</span>
            </div>
        </div>
<br>
        <div class="row">
            <h6><b>Attendance</b></h6>
            <div class="col-md-1">
                    <label for="inputAbsent" class="col-form-label center-align">Absent</label>
                    <input type="text" class="form-control" id="inputAbsent">
                </div>

                <div class="col-md-1">
                    <label for="inputPresent" class="col-form-label center-align">Present</label>
                    <input type="text" class="form-control" id="inputPresent">
                </div>

                <div class="col-md-1">
                    <label for="inputLate" class="col-form-label center-align">Late</label>
                    <input type="text" class="form-control" id="inputLate">
                </div>

        </div>
        <br>    
        <div class="row">
            <h6><b>Report</b></h6>
            <span>[data]</span>
        </div>



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
{{-- javascript --}}
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