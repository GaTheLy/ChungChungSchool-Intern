@extends('base.base-admin')
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
        a{
            color:black;
            text-decoration: none;
        }
    </style>
    
        <h1>Year Program</h1>
        <div class="row">
            <div class="col-6" style="text-align:left;">
                <h5>{{ $teacher->first_name }}</h5>
            </div>
        </div>
        <div class="row" style="text-align:right;margin-right:50px;">
                <h5>Collapse All</h5>
        </div>

        <div id="liveAlertPlaceholder"></div>

        <br><br>

        {{-- accordion year prog --}}

        <div class="accordion" id="accordionExample">

            @foreach ($yearProgramMYP as $yp)
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <b>{{ $yp->name }}</b>
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    {{-- fill --}}
                    <table id="example" class="table table-bordered" style="width:80%;">
                            <thead>
                                <tr class="table table-secondary">
                                    <th>Subjects</th>
                                    <th>Teacher</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mathematic</td>
                                    <td>Alexander Doe</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <button class="btn me-md-2" type="button" id="addSubject" data-bs-toggle="modal" data-bs-target="#staticAddSubject">
                                add subject                                 
                                <i class="lni lni-circle-plus"></i>
                            </button>
                            </div>
                        </div>

                        <h5>Active Class</h5>

                        <table id="example" class="table table-bordered" style="width:80%;">
                            <thead>
                                <tr class="table table-secondary">
                                    <th>Class</th>
                                    <th>Homeroom Teacher</th>
                                    <th>Active Until</th>
                                    <th>Students</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Middle School 7</td>
                                    <td>Alexander Doe</td>
                                    <th>31 Dec 2024</th>
                                    <th>20</th>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <a href="" style="color:black">add class</a>
                            <i class="lni lni-circle-plus"></i>
                            </div>
                        </div>
                </div>
                </div>
            </div>
            @endforeach
            


            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <b>Elementary 1</b>
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    {{-- fill --}}
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <b>Middle Year 7</b>
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                        {{-- fill --}}
                        <table id="example" class="table table-bordered" style="width:80%;">
                            <thead>
                                <tr>
                                    <th>Subjects</th>
                                    <th>Teacher</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mathematic</td>
                                    <td>Alexander Doe</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <a href="" style="color:black">add subject</a>
                            <i class="lni lni-circle-plus"></i>
                            </div>
                        </div>

                        <h5>Active Class</h5>

                        <table id="example" class="table table-bordered" style="width:80%;">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Homeroom Teacher</th>
                                    <th>Active Until</th>
                                    <th>Students</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Middle School 7</td>
                                    <td>Alexander Doe</td>
                                    <th>31 Dec 2024</th>
                                    <th>20</th>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <a href="" style="color:black">add class</a>
                            <i class="lni lni-circle-plus"></i>
                            </div>
                        </div>

                </div>
                </div>
            </div>
            
        </div>

        

        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
            <button class="btn me-md-2" type="button" id="addProgram" data-bs-toggle="modal" data-bs-target="#staticAddYP">
           {{--  <a href=""> </a> --}}
                 add program 
                
                <i class="lni lni-circle-plus"></i>
            </button>
        </div>

        <br>
        {{-- 
        <div class="row">
            <div class="col" style="text-align:right;margin-right:100px;">
            <button type="button" class="btn btn-primary" id="liveAlertBtn">Save</button>
            </div>
        </div>

         --}}


         {{-- modal AddYP --}}
        <div class="modal fade" id="staticAddYP" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticAddYPLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticAddYPLabel">Add New Year Program</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('yearProgram-add.index', ['userId' => $teacher->user_id]) }} ">
                @csrf
            <div class="modal-body">
                <br>
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>Program's Name</b></label>
                        </div> 

                        <div class="col-8" >
                            <input type="text" name="program_name" id="program_name" style="radius:10px;"></input>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
            </div>
        </div>
        </div>


        {{-- modal Add Subject --}}
        <div class="modal fade" id="staticAddSubject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticAddSubjectLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticAddSubjectLabel">Add Subject to Year Program {{$yp->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('yearProgram-add.subject', ['userId' => $teacher->user_id, 'ypId' => $yp->id]) }} ">
                @csrf
            <div class="modal-body">
                <br>
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>Subject</b></label>
                        </div> 

                        <div class="col-8" >
                        <select name="subject" id="subject">
                            <option value="">--Select--</option>
                            @foreach ($subjectMYP as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->subject_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>Teacher</b></label>
                        </div> 

                        <div class="col-8" >
                        <select name="teacher" id="teacher">
                            <option value="">--Select--</option>
                            @foreach ($teacherMYP as $teach)
                                <option value="{{ $teach->nip_pyp }}">{{ $teach->first_name . ' ' . $teach->last_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="col-form-label"><b>Approaches to Learning</b></label>
                        <div id="ATLContainer" class="PYPCriteria">

        
                        </div>
                        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
                            <button class="btn me-md-2" type="button" id="addInputA">
                                <i class="lni lni-circle-plus"></i>
                            </button>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
            </div>
        </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

                $(document).ready(function() {

                   $('#addInputA').click(function(){
                    var newInputNumber = $('#ATLContainer .form-group').length;
                    console.log(newInputNumber);


                    var newInput = `
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="atl[${newInputNumber}][name]" id="atl[${newInputNumber}][name]">
                                <span class="delete-btn"><i class="lni lni-trash-can"></i></span>
                            </div>
                        </div>
                    </div>
                                    <br>
                                    `;
                    $('#ATLContainer').append(newInput);

                   });

                   $(document).on('click', '.delete-btn', function() {
                        $(this).closest('.form-group').remove();
                    });


                });
        </script>


    
    @endsection 