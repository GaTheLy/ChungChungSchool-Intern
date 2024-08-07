@extends('base.base-admin')
    <!-- section content -> yield content base.blade -->
    @section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

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
{{-- css report --}}

<h1>MYP Report Custom</h1>
        <div class="row">
            <div class="col-6" style="text-align:left;">
                <h5>{{ $teacher->first_name }}</h5>
            </div>
        </div>
        <br/>
        <br/>
{{-- html report custom form --}}
            <form method="POST" action="{{ route('mypCustom.edit', ['userId' => $teacher->user_id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <h5>Logo</h5>
                    </div> 

                    <div class="col-6">
                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                    </div>
{{-- filename, returned from controller ccs-logo.jpg jadi $filename--}}
                    <div class="col-3" style="align-items: center;">
                        <img style="width:180px;height:100px;" src="{{ asset('assets-image/'. $filename )}}" alt="Icon" class="logo">
                    </div>
                </div>
                <br>
                
                <div class="row">
                    <div class="col-3">
                        <h5>Prinscipal's Greetings</h5>
                    </div> 

                    <div class="col-6" >
                    <textarea name="greetings" id="greetings" style="height:300px;width:600px;" value=" " >
                    {{$greetings}}
                    </textarea>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-3">
                        <h5>Signature</h5>
                    </div> 

                    <div class="col-6">
                    <input type="file" class="form-control" id="sign" name="sign" accept="image/*">
                    </div>
                    <div class="col-3" style="align-items: center;">
                        <img style="width:180px;height:100px;" src="{{ asset('assets-image/'. $filenameSign )}}" alt="Icon" class="logo">
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">
                        <h5>Attendance</h5>
                    </div> 

                    <div class="col-6" >
                        <select name="attendance" id="attendance">
                            <option value="{{$custom->attendance}}">
                            @if ($custom->attendance == 0)
                            off
                            @elseif ($custom->attendance == 1)
                            on
                            @endif
                            </option>
                            <option value="1">on</option>
                            <option value="0">off</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <h5>Homeroom's Comment </h5>
                    </div> 

                    <div class="col-6" >
                        <select name="homeroom_comments" id="homeroom_comments">
                            <option value="{{$custom->homeroom_comments}}">
                            @if ($custom->homeroom_comments == 0)
                            off
                            @elseif ($custom->homeroom_comments == 1)
                            on
                            @endif
                            </option>
                            <option value="1">on</option>
                            <option value="0">off</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <h5>Summary Subjects Progresses</h5>
                    </div> 

                    <div class="col-6" >
                        <select name="summary_progress" id="summary_progress">
                            <option value="{{$custom->summary_progress}}">
                            @if ($custom->summary_progress == 0)
                            off
                            @elseif ($custom->summary_progress == 1)
                            on
                            @endif
                            </option>
                            <option value="1">on</option>
                            <option value="0">off</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <h5>Subjects</h5>
                    </div> 

                    <div class="col-6" >
                        <select name="subjects" id="subjects">
                           <option value="{{$custom->subjects}}">
                            @if ($custom->subjects == 0)
                            off
                            @elseif ($custom->subjects == 1)
                            on
                            @endif
                            </option>
                            <option value="1">on</option>
                            <option value="0">off</option>
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <h5>Approaches to Learning</h5>
                    </div> 

                    <div class="col-6" >
                        <select name="atl" id="atl">
                        <option value="{{$custom->atl}}">
                            @if ($custom->atl == 0)
                            off
                            @elseif ($custom->atl == 1)
                            on
                            @endif
                            </option>                            
                            <option value="1">on</option>
                            <option value="0">off</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <h5>Grade Boundaries</h5>
                    </div> 

                    <div class="col-6" >
                        <select name="boundaries" id="boundaries">
                            <option value="{{$custom->grade_boundaries}}">
                            @if ($custom->grade_boundaries == 0)
                            off
                            @elseif ($custom->grade_boundaries == 1)
                            on
                            @endif
                            </option>
                            <option value="1">on</option>
                            <option value="0">off</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <h5>Achievement Level descriptors</h5>
                    </div> 

                    <div class="col-6" >
                        <select name="achievement_desc" id="achievement_desc">
                            <option value="{{$custom->achievement_descriptors}}">
                            @if ($custom->achievement_descriptors == 0)
                            off
                            @elseif ($custom->achievement_descriptors == 1)
                            on
                            @endif
                            </option>
                            <option value="1">on</option>
                            <option value="0">off</option>
                        </select>
                    </div>
                </div>

                <br/>

                <table class="table table-striped table-bordered" style="width: 80%;">
                    <thead>
                        <tr>
                            <td><b>IB Grades</b></td>
                            <td><b>Local Grades</b></td>
                            <td><b>Mark</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($conversion as $c )

                        <tr>
                            <td>{{$c->ib_grade}}</td>
                            <td>
                            <input type="hidden" name="conversions[{{ $c->id }}][ib_grade]" value="{{ $c->ib_grade }}">
                            <input type="hidden" name="conversions[{{ $c->id }}][mark]" value="{{ $c->mark }}">
                            <input type="text" name="conversions[{{ $c->id }}][local_grade]" value="{{ $c->local_grade }}">
                            </td>
                            <td>{{$c->mark}}</td>
                        </tr>
                        
                        @endforeach

                    </tbody>
                </table>
                


                <br>
            <button  class="btn btn-primary" >Save</button>

        
            </form>

            <script>
            </script>
    @endsection 