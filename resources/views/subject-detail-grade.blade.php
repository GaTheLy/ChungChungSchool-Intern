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
    
        <h1>[Subject Name]</h1>
        <div class="row">
            <div class="col-3" style="text-align:left;">
                <h5>[class detail]</h5>
            </div>
            <div class="col-3" style="text-align:left;">
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

        {{-- grade form --}}
        <div class="row">
        <div class="col-3">
        <h5 style="padding:20px;">Student Progress</h5>
        </div>
        <div class="col" style="text-align:left;margin-top:15px;margin-left:-95px;">
        <span style="height:40px;width:40px;border:1px solid black;display:inline-block;border-radius:5px;"></span>
        </div>
        </div>

        <div class="row">
            <div class="col-1"></div>
        <div class="col-3">
            <div class="row">
            <h5>A: Analysing</h5>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">1</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">2</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">3</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">4</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">5</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">6</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">7</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">8</span>
            
        </div> 
        </div>
        <div class="col-6" style="text-align:left;margin-left:-55px;">
        <textarea name="" id="" style="height:80px;width:500px;"></textarea>
        </div>
        </div>

        <br>

        <div class="row">
            <div class="col-1"></div>
        <div class="col-3">
            <div class="row">
            <h5>B: Organizing</h5>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">1</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">2</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">3</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">4</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">5</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">6</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">7</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">8</span>
            
        </div> 
        </div>
        <div class="col-6" style="text-align:left;margin-left:-55px;">
        <textarea name="" id="" style="height:80px;width:500px;"></textarea>
        </div>
        </div>

        <br>

        <div class="row">
            <div class="col-1"></div>
        <div class="col-3">
            <div class="row">
            <h5>C: Producing Text</h5>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">1</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">2</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">3</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">4</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">5</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">6</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">7</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">8</span>
            
        </div> 
        </div>
        <div class="col-6" style="text-align:left;margin-left:-55px;">
        <textarea name="" id="" style="height:80px;width:500px;"></textarea>
        </div>
        </div>

        <br>

        <div class="row">
            <div class="col-1"></div>
        <div class="col-3">
            <div class="row">
            <h5>D: Using Language</h5>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">1</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">2</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">3</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">4</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">5</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">6</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">7</span>
            <span style="margin:2px;height:30px;width:30px;border:1px solid black;display:inline-block;border-radius:5px;text-align:center;">8</span>
            
        </div> 
        </div>
        <div class="col-6" style="text-align:left;margin-left:-55px;">
        <textarea name="" id="" style="height:80px;width:500px;"></textarea>
        </div>
        </div>

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
    <tr>
      <th scope="row">Communication</th>
      <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
      <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
      <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
      <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
    </tr>
    <tr>
      <th scope="row">Communication</th>
      <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
      <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
      <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
      <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
    </tr>
    <tr>
      <th scope="row">Communication</th>
      <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
      <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
      <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
      <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
    </tr>
  </tbody>
</table>


<h5 style="padding:20px;">Homeroom Teacher Comments</h5>
<textarea name="" id="" style="height:100px;width:1000px;margin-left:50px;"></textarea>



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

                const alertTrigger = document.getElementById('liveAlertBtn')
                if (alertTrigger) {
                alertTrigger.addEventListener('click', () => {
                    appendAlert('All changes saved!', 'success')
                })
                }
            </script>

    @endsection 