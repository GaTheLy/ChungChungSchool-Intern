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
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <b>Nursery 1</b>
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    {{-- fill --}}
                </div>
                </div>
            </div>
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
            <button class="btn me-md-2" type="button" id="addProgram">
            <a href="{{ route('yearProgram-add.index', ['userId' => $teacher->user_id]) }}"> add program </a>          <i class="lni lni-circle-plus"></i>
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