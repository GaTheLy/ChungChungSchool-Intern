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

        <div id="liveAlertPlaceholder"></div>

        <br><br>

        {{-- form --}}
        <form method="POST" action="{{route('student-add.submit',['userId' => $teacher->user_id])}}">
            @csrf
            <br>
                <div class="row">
                    <div class="col-3">
                        <h5>1. Program Name</h5>
                    </div> 

                    <div class="col-6" >
                    <input type="text" name="nim_pyp" id="nim_pyp" style="height:40px;width:500px;"></input>
                    </div>
                </div>
        <br>        
                <div class="row">
                    <div class="col-3">
                        <h5>2. Subjects</h5>
                    </div> 

                    <table class="table table-bordered" style="width:80%;margin-left:50px;border-radius:20px;">
                    <thead>
                        <tr class="table-secondary">
                        <th scope="col">#</th>
                        <th scope="col">Subjects</th>
                        <th scope="col">Teachers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Larry the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                    </table>
                    <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <a href="" style="color:black">add subject</a>
                            <i class="lni lni-circle-plus"></i>
                            </div>
                    </div>
                </div>
        <br>
                <div class="row">
                    <div class="col-3">
                        <h5>3. Classes</h5>
                    </div> 

                    <table class="table table-bordered" style="width:80%;margin-left:50px;border-radius:20px;">
                    <thead>
                        <tr class="table-secondary">
                        <th scope="col">#</th>
                        <th scope="col">Class Name</th>
                        <th scope="col">Homeroom Teacher</th>
                        <th scope="col">Active Untill</th>
                        <th scope="col">Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>31 Dec 2024</td>
                        <td>31</td>
                        </tr>

                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>31 Dec 2024</td>
                        <td>20</td>
                        </tr>

                        <tr>
                        <th scope="row">3</th>
                        <td>Larry the Bird</td>
                        <td>@twitter</td>
                        <td>31 Dec 2024</td>
                        <td>24</td>
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
        <br>
        <div class="row">
            <div class="col" style="text-align:right;margin-right:100px;">
            <button class="btn btn-primary" >Save</button>
            </div>
        </div>

        </form>


        {{-- end form --}}


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
                var subjects = []
                var classes = []

            });

        </script>


    
    @endsection 