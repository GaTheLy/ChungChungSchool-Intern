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

<h1>PYP Report Custom</h1>
        <div class="row">
            <div class="col-6" style="text-align:left;">
                <h5>{{ $teacher->first_name }}</h5>
            </div>
        </div>
        <br/>
        <br/>
{{-- html report custom form --}}
            <form method="POST" action="{{ route('pypCustom.edit', ['userId' => $teacher->user_id]) }}" enctype="multipart/form-data">
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
                    <div class="col-3">
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
                    <div class="col-3">
                        <h5>Central Idea</h5>
                    </div> 

                    <div class="col-6" >
                        <select name="central-idea" id="central-idea">
                            
                        <option value="{{$custom->central_idea}}">
                            @if ($custom->central_idea == 0)
                            off
                            @elseif ($custom->central_idea == 1)
                            on
                            @endif
                            </option> 
                        
                        <option value="1">on</option>
                            <option value="0">off</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <h5>Lines of Inquiry</h5>
                    </div> 

                    <div class="col-6" >
                        <select name="loi" id="loi">
                        <option value="{{$custom->lines_of_inquiry}}">
                            @if ($custom->lines_of_inquiry == 0)
                            off
                            @elseif ($custom->lines_of_inquiry == 1)
                            on
                            @endif
                            </option> 
                            
                            <option value="1">on</option>
                            <option value="0">off</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <h5>Key Concepts</h5>
                    </div> 

                    <div class="col-6" >
                        <select name="key-concepts" id="key-concepts">
                            
                        <option value="{{$custom->key_concepts}}">
                            @if ($custom->key_concepts == 0)
                            off
                            @elseif ($custom->key_concepts == 1)
                            on
                            @endif
                            </option> 
                        
                        <option value="1">on</option>
                            <option value="0">off</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
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
                    <div class="col-3">
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

                    <div class="row">
                    <div class="col-3">
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

                </div>

                <br>
            <button  class="btn btn-primary" >Save</button>

        
            </form>

            <script>
            </script>
    @endsection 