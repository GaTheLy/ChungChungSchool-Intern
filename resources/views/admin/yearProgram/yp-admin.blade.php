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
            <h2>PYP Year Program</h2>
            {{ @$index=0 }}
            @foreach ($yearProgramPYP as $ypPYP)
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$index}}PYP" aria-expanded="false" aria-controls="collapse{{$index}}PYP">
                    <b>{{ $ypPYP->name }}</b>
                </button>
                </h2>
                <div id="collapse{{$index}}PYP" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    {{-- fill --}}
                    <table id="units" class="table table-bordered" style="width:80%;">
                            <thead>
                                <tr class="table table-secondary">
                                    <th>Unit</th>
                                    <th>Lines of Inquiry</th>
                                    <th>Key Concepts</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($units as $unit)
                                <tr>
                                    <td>{{ $unit->name }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($unit->linesOfInquiry as $loi)
                                                <li>{{ $loi->description }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($unit->keyConcepts as $kc)
                                                <li>
                                                    <strong>Topic:</strong> {{ $kc->topic }}<br>
                                                    {{-- 
                                                    <strong>Question:</strong> {{ $kc->question }}<br>
                                                    <strong>Definition:</strong> {{ $kc->definition }}<br>
                                                    <strong>Icon:</strong> {{ $kc->icon }}
                                                     --}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <button class="btn me-md-2" type="button" id="addUnit" data-bs-toggle="modal" data-bs-target="#staticAddUnit">
                                add unit                                 
                                <i class="lni lni-circle-plus"></i>
                            </button>
                            </div>
                        </div>

                        <table id="atls" class="table table-bordered" style="width:80%;">
                            <thead>
                                <tr class="table table-secondary">
                                    <th>Approaches to Learning</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        @foreach ($ypPYP->atlpyp as $atl)
                                            <td>{{ $atl->description }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>list of approaches to learning</td>
                                    </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <button class="btn me-md-2" type="button" id="addATLPYP" data-bs-toggle="modal" data-bs-target="#staticAddATLPYP">
                                add atl                                 
                                <i class="lni lni-circle-plus"></i>
                            </button>
                            </div>
                        </div>
                        <table id="example" class="table table-bordered" style="width:80%;">
                            <thead>
                                <tr class="table table-secondary">
                                    <th>Subjects</th>
                                    <th>Teacher</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailSubPYP as $sub)
                                    <tr>
                                        <td>{{ $sub->subject->subject_name }}</td>
                                        <td>{{ $sub->teacher->first_name }} {{ $sub->teacher->last_name }}</td> <!-- Assuming 'name' is the teacher's name column -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <button class="btn me-md-2" type="button" id="addSubjectPYP" data-bs-toggle="modal" data-bs-target="#staticAddSubjectPYP">
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
                                @foreach ($detailClassPYP as $classDetail)
                                        <tr>
                                            <td>{{ $classDetail->class->class_name }}</td>
                                            <td>
                                                @if ($classDetail->homeroom && $classDetail->homeroom->teacher)
                                                    {{ $classDetail->homeroom->teacher->first_name }} {{ $classDetail->homeroom->teacher->last_name }}
                                                @else
                                                    No Homeroom Teacher
                                                @endif
                                            </td>
                                            <td>{{ $classDetail->end_date }}</td>
                                            <td>{{ $classDetail->class->students()->count() }}</td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <button class="btn me-md-2" type="button" id="addClassPYP" data-bs-toggle="modal" data-bs-target="#staticAddPYPClass">
                                add class                                 
                                <i class="lni lni-circle-plus"></i>
                            </button>
                            </div>
                        </div>
                </div>
                </div>
            </div>
            {{ $index+=1 }}
            @endforeach

            <div class="d-grid gap-4 d-md-flex justify-content-md-end">
                <button class="btn me-md-2" type="button" id="addProgramPYP" data-bs-toggle="modal" data-bs-target="#staticAddPYP">
                    add PYP program 
                    <i class="lni lni-circle-plus"></i>
                </button>
            </div>
            
            <h2>MYP Year Program</h2>
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
                                    <th>ATLs</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailSubMYP as $sub)
                                    <tr>
                                        <td>{{ $sub->subject->subject_name }}</td>
                                        <td>{{ $sub->teacher->first_name }} {{ $sub->teacher->last_name }}</td> <!-- Assuming 'name' is the teacher's name column -->
                                        <td>
                                            @foreach ($sub->subject->atls as $atl)
                                                {{ $atl->atl_name }}<br>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
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
                                @foreach ($detailClassMYP as $classDetail)
                                    <tr>
                                        <td>{{ $classDetail->class->class_name }}</td>
                                        <td>
                                            @if ($classDetail->homeroom && $classDetail->homeroom->teacher)
                                                {{ $classDetail->homeroom->teacher->first_name }} {{ $classDetail->homeroom->teacher->last_name }}
                                            @else
                                                No Homeroom Teacher
                                            @endif
                                        </td>
                                        <td>{{ $classDetail->end_date }}</td>
                                        <td>{{ $classDetail->class->students()->count() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <button class="btn me-md-2" type="button" id="addClass" data-bs-toggle="modal" data-bs-target="#staticAddClass">
                                add class                                 
                                <i class="lni lni-circle-plus"></i>
                            </button>
                            </div>
                        </div>
                </div>
                </div>
            </div>
            @endforeach


           
        

        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
            <button class="btn me-md-2" type="button" id="addProgram" data-bs-toggle="modal" data-bs-target="#staticAddYP">
                 add MYP program 
                <i class="lni lni-circle-plus"></i>
            </button>
        </div>

        <br>



        {{-- modal AddYP for PYP --}}
        <div class="modal fade" id="staticAddPYP" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticAddPYPLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticAddPYPLabel">Add New Year Program for PYP</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('yearProgram-add.indexPYP', ['userId' => $teacher->user_id]) }} ">
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

                    <div class="row">
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>Unit's Name</b></label>
                        </div> 

                        <div class="col-8" >
                            <input type="text" name="unit_name" id="unit_name" style="radius:10px;"></input>
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="col-form-label"><b>Lines of Inquiry</b></label>
                        <div id="LOIContainer" class="PYPCriteria">

        
                        </div>
                        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
                            <button class="btn me-md-2" type="button" id="addInputLOI">
                                <i class="lni lni-circle-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="col-form-label"><b>Key Concepts</b></label>
                        <div id="KeyContainer" class="PYPCriteria">

        
                        </div>
                        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
                            <button class="btn me-md-2" type="button" id="addInputKey">
                                <i class="lni lni-circle-plus"></i>
                            </button>
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

         {{-- modal Add ATL for PYP --}}
         <div class="modal fade" id="staticAddATLPYP" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticAddATLPYPLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticAddATLPYPLabel">Add New ATL for {{ $ypPYP->name }} </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('yearProgram-add.atlPYP', ['userId' => $teacher->user_id, 'ypId'=>$ypPYP->id]) }} ">
                @csrf
            <div class="modal-body">
                <br>

                    <div class="row">
                        <label for="" class="col-form-label"><b>Approaches to Learning</b></label>
                        <div id="ATLContainerAdd" class="PYPCriteria">

        
                        </div>
                        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
                            <button class="btn me-md-2" type="button" id="addInputATLAdd">
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

        {{-- modal AddUnit for PYP --}}
        <div class="modal fade" id="staticAddUnit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticAddUnitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticAddUnitLabel">Add New Year Program for PYP</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('yearProgram-add.unitPYP', ['userId' => $teacher->user_id, 'ypId'=>$ypPYP->id]) }} ">
                @csrf
            <div class="modal-body">
                <br>
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>Unit's Name</b></label>
                        </div> 

                        <div class="col-8" >
                            <input type="text" name="unit_name" id="unit_name" style="radius:10px;"></input>
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="col-form-label"><b>Lines of Inquiry</b></label>
                        <div id="LOIContainerUnit" class="PYPCriteria">

        
                        </div>
                        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
                            <button class="btn me-md-2" type="button" id="addInputLOIUnit">
                                <i class="lni lni-circle-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="col-form-label"><b>Key Concepts</b></label>
                        <div id="KeyContainerUnit" class="PYPCriteria">

        
                        </div>
                        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
                            <button class="btn me-md-2" type="button" id="addInputKeyUnit">
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

        {{-- modal Add Subject for PYP --}}
        <div class="modal fade" id="staticAddSubjectPYP" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticAddSubjectPYPLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticAddSubjectPYPLabel">Add Subject to Year Program {{$ypPYP->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('yearProgram-add.subjectPYP', ['userId' => $teacher->user_id, 'ypId' => $ypPYP->id]) }} ">
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
                            @foreach ($subjectPYP as $sub)
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
                            @foreach ($teacherPYP as $teach)
                                <option value="{{ $teach->nip_pyp }}">{{ $teach->first_name . ' ' . $teach->last_name }}</option>
                            @endforeach
                        </select>
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

        {{-- modal Add Class for PYP --}}
        <div class="modal fade" id="staticAddPYPClass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticAddPYPClassLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticAddPYPClassLabel">Add Class to Year Program {{$ypPYP->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('yearProgram-add.classPYP', ['userId' => $teacher->user_id, 'ypId' => $ypPYP->id]) }} ">
                @csrf
            <div class="modal-body">
                <br>
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>Class</b></label>
                        </div> 

                        <div class="col-8" >
                        <select name="class" id="class">
                            <option value="">--Select--</option>
                            @foreach ($class as $c)
                                <option value="{{ $c->class_id }}">{{ $c->class_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <br>
                    <label for="" class="col-form-label"><b>Active Period</b></label>
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>Start</b></label>
                        </div> 

                        <div class="col-8" >
                        <input type="date" name="start_date" id="start_date">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>End</b></label>
                        </div> 

                        <div class="col-8" >
                        <input type="date" name="end_date" id="end_date">
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



         {{-- modal AddYP for MYP--}}
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
                        <div id="ATLContainer" class="MYPCriteria">

        
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



        {{-- modal Add Class --}}
        <div class="modal fade" id="staticAddClass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticAddClassLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticAddClassLabel">Add Class to Year Program {{$yp->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('yearProgram-add.class', ['userId' => $teacher->user_id, 'ypId' => $yp->id]) }} ">
                @csrf
            <div class="modal-body">
                <br>
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>Class</b></label>
                        </div> 

                        <div class="col-8" >
                        <select name="class" id="class">
                            <option value="">--Select--</option>
                            @foreach ($class as $c)
                                <option value="{{ $c->class_id }}">{{ $c->class_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <br>
                    <label for="" class="col-form-label"><b>Active Period</b></label>
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>Start</b></label>
                        </div> 

                        <div class="col-8" >
                        <input type="date" name="start_date" id="start_date">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>End</b></label>
                        </div> 

                        <div class="col-8" >
                        <input type="date" name="end_date" id="end_date">
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

                    $('#addInputATLAdd').click(function(){
                    var newInputNumber = $('#ATLContainerAdd .form-group').length;
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
                    $('#ATLContainerAdd').append(newInput);

                    });

                   $('#addInputLOI').click(function(){
                    var newInputNumber = $('#LOIContainer .form-group').length;
                    console.log(newInputNumber);


                    var newInput = `
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="loi[${newInputNumber}][name]" id="loi[${newInputNumber}][name]">
                                <span class="delete-btn"><i class="lni lni-trash-can"></i></span>
                            </div>
                        </div>
                    </div>
                                    <br>
                                    `;
                    $('#LOIContainer').append(newInput);

                   });

                   $('#addInputLOIUnit').click(function(){
                    var newInputNumber = $('#LOIContainerUnit .form-group').length;
                    console.log(newInputNumber);


                    var newInput = `
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="loi[${newInputNumber}][name]" id="loi[${newInputNumber}][name]">
                                <span class="delete-btn"><i class="lni lni-trash-can"></i></span>
                            </div>
                        </div>
                    </div>
                                    <br>
                                    `;
                    $('#LOIContainerUnit').append(newInput);

                   });

                   $('#addInputKey').click(function(){
                    var newInputNumber = $('#KeyContainer .form-group').length;
                    console.log(newInputNumber);


                    var newInput = `
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="key[${newInputNumber}][name]" id="key[${newInputNumber}][name]">
                                <span class="delete-btn"><i class="lni lni-trash-can"></i></span>
                            </div>
                        </div>
                    </div>
                                    <br>
                                    `;
                    $('#KeyContainer').append(newInput);

                   });

                   $('#addInputKeyUnit').click(function(){
                    var newInputNumber = $('#KeyContainerUnit .form-group').length;
                    console.log(newInputNumber);


                    var newInput = `
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="key[${newInputNumber}][name]" id="key[${newInputNumber}][name]">
                                <span class="delete-btn"><i class="lni lni-trash-can"></i></span>
                            </div>
                        </div>
                    </div>
                                    <br>
                                    `;
                    $('#KeyContainerUnit').append(newInput);

                   });
                   

                   $(document).on('click', '.delete-btn', function() {
                        $(this).closest('.form-group').remove();
                    });


                });
        </script>


    
    @endsection 