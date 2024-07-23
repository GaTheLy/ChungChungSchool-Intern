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

        .hidden{
            color: white ;
        }
    </style>
    
        <h1>Year Program</h1>
        <div class="row">
            <div class="col-6" style="text-align:left;">
                <h5>{{ $teacher->first_name }}</h5>
            </div>
        </div>
        {{-- <div class="row" style="text-align:right;margin-right:50px;">
                <h5>Collapse All</h5>
        </div> --}}
        

        <div id="liveAlertPlaceholder"></div>

        <br><br>

        {{-- accordion year prog --}}

        <div class="accordion" id="accordionExample">
            <h2>PYP Year Program</h2>
            <div class="row" style="margin-left: 50px;">
                <div class="col">
                    <button class="btn btn-primary">
                        <b>config ATL</b>
                    </button>
                </div>

                <div class="col">
                    <button class="btn btn-primary">
                        <b>config LOI</b>
                    </button>
                </div>

                <div class="col">
                    <button class="btn btn-primary">
                        <b>config Key Concepts</b>
                    </button>
                </div>
            </div>
            <span class="hidden">{{ $index=0 }}</span>
            @foreach ($yearProgramPYP as $ypPYP)
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$index}}PYP" aria-expanded="false" aria-controls="collapse{{$index}}PYP">
                    <b>{{ $ypPYP->name .' '. $ypPYP->id }}</b>
                </button>
                </h2>
                <div id="collapse{{$index}}PYP" class="accordion-collapse collapse">
                <div class="accordion-body">
                    {{-- fill --}}
                    <table id="units" class="table table-bordered" style="width:90%;">
                            <thead>
                                <tr class="table table-secondary">
                                    <th>Unit</th>
                                    <th>Central Idea</th>
                                    <th>Lines of Inquiry</th>
                                    <th>Key Concepts</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($units as $unit)
                            @if ($unit->year_program_pyp_id == $ypPYP->id)
                                <tr>
                                    <td>{{ $unit->name }}</td>
                                    <td>{{ $unit->central_idea }}</td>
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
                            @endif
                            @endforeach
                            </tbody>
                    </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <button class="btn me-md-2" type="button" id="addUnit" data-bs-toggle="modal" data-bs-target="#staticAddUnit" data-bs-ypId = "{{$ypPYP->id}}" data-bs-ypName = "{{$ypPYP->name}}">
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
                                     @foreach ($ypPYP->atlpyp as $atl)
                                    <tr>
                                            <td>{{ $atl->description }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <button class="btn me-md-2" type="button" id="addATLPYP" data-bs-toggle="modal" data-bs-target="#staticAddATLPYP"  data-bs-ypId = "{{$ypPYP->id}}" data-bs-ypName = "{{$ypPYP->name}}">
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
                                @if ($sub->yp_pyp_id == $ypPYP->id)
                                    <tr>
                                        <td>{{ $sub->subject->subject_name }}</td>
                                        <td>{{ $sub->teacher->first_name }} {{ $sub->teacher->last_name }}</td> <!-- Assuming 'name' is the teacher's name column -->
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <button class="btn me-md-2" type="button" id="addSubjectPYP" data-bs-toggle="modal" data-bs-target="#staticAddSubjectPYP" data-bs-ypId = "{{$ypPYP->id}}" data-bs-ypName = "{{$ypPYP->name}}">
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
                                @if ($classDetail->year_program_pyp_id == $ypPYP->id)

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
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <button class="btn me-md-2" type="button" id="addClassPYP" data-bs-toggle="modal" data-bs-target="#staticAddPYPClass" data-bs-ypId = "{{$ypPYP->id}}" data-bs-ypName = "{{$ypPYP->name}}">
                                add class                                 
                                <i class="lni lni-circle-plus"></i>
                            </button>
                            </div>
                        </div>
                </div>
                </div>
            </div>
            <span class="hidden">{{ $index+=1 }}</span>
            @endforeach

            <div class="d-grid gap-4 d-md-flex justify-content-md-end">
                <button class="btn me-md-2" type="button" id="addProgramPYP" data-bs-toggle="modal" data-bs-target="#staticAddPYP">
                    add PYP program 
                    <i class="lni lni-circle-plus"></i>
                </button>
            </div>
            
            <h2>MYP Year Program</h2>
            <span class="hidden">{{ $indexMYP=0 }}</span>
            @foreach ($yearProgramMYP as $yp)
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $indexMYP }}MYP" aria-expanded="false" aria-controls="collapse{{ $indexMYP }}MYP">
                    <b>{{ $yp->name }}</b>
                </button>
                </h2>
                <div id="collapse{{ $indexMYP }}MYP" class="accordion-collapse collapse">
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
                                @if ($sub->yp_myp_id == $yp->id)
                                    <tr>
                                        <td>{{ $sub->subject->subject_name }}</td>
                                        <td>{{ $sub->teacher->first_name }} {{ $sub->teacher->last_name }}</td> <!-- Assuming 'name' is the teacher's name column -->
                                        <td>
                                            @foreach ($sub->subject->atls as $atl)
                                                {{ $atl->atl_name }}<br>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <button class="btn me-md-2" type="button" id="addSubject" data-bs-toggle="modal" data-bs-target="#staticAddSubjectMYP" data-bs-ypId = "{{$yp->id}}" data-bs-ypName = "{{$yp->name}}">
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
                                @if ($classDetail->year_program_myp_id == $yp->id)

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
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col" style="text-align:right;margin-right:10px;margin-top:10px;">
                            <button class="btn me-md-2" type="button" id="addClass" data-bs-toggle="modal" data-bs-target="#staticAddMYPClass" data-bs-ypId = "{{$yp->id}}" data-bs-ypName = "{{$yp->name}}">
                                add class                                 
                                <i class="lni lni-circle-plus"></i>
                            </button>
                            </div>
                        </div>
                </div>
                </div>
            </div>
            <span class="hidden">{{ $indexMYP=+1 }}</span>
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
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>Central Idea</b></label>
                        </div> 

                        <div class="col-8" >
                            <input type="text" name="central_idea" id="central_idea" style="radius:10px;"></input>
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
                        <h1 class="modal-title fs-5" id="modal-titleATL">Add New ATL</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="addATLForm">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <label for="" class="col-form-label"><b>Approaches to Learning</b></label>
                                <div id="ATLContainerAdd" class="PYPCriteria"></div>
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
                <h1 class="modal-title fs-5" id="modal-title">Add New Unit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="addUnitForm">
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
                        <div class="col-4">
                            <label for="" class="col-form-label"><b>Central Idea</b></label>
                        </div> 

                        <div class="col-8" >
                            <input type="text" name="central_idea" id="central_idea" style="radius:10px;"></input>
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
                <h1 class="modal-title fs-5" id="modal-titleSubPYP">Add New Subject</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="addSubPYPForm">
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
                <h1 class="modal-title fs-5" id="modal-titleClassPYP">Add Class</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="addClassPYPForm">
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
        <div class="modal fade" id="staticAddSubjectMYP" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticAddSubjectLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-titleSubMYP">Add Subject</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="addSubMYPForm">
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
        <div class="modal fade" id="staticAddMYPClass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticAddClassLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-titleClassMYP">Add Class</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="addClassMYPForm">
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
            //modal get prev value
            document.addEventListener('DOMContentLoaded', function() {
                var staticAddUnitModal = document.getElementById('staticAddUnit');
                
                if (staticAddUnitModal){
                     staticAddUnitModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget; // Button that triggered the modal
                    var ypId = button.getAttribute('data-bs-ypId');
                    var ypName = button.getAttribute('data-bs-ypName');
                    
                    // Update the modal title
                    var modalTitle = staticAddUnitModal.querySelector('.modal-title');
                    modalTitle.textContent = 'Add New Unit for ' + ypName + ' ' + ypId;
                    
                    // Update the form action URL
                    var form = staticAddUnitModal.querySelector('#addUnitForm');
                    var baseActionUrl = "{{ route('yearProgram-add.unitPYP', ['userId' => $teacher->user_id, 'ypId' => 'DUMMY_YP_ID']) }}";
                    form.action = baseActionUrl.replace('DUMMY_YP_ID', ypId);
                    });
                }
                    // atl pyp
                    var staticAddATLModal = document.getElementById('staticAddATLPYP');
                    
                    if (staticAddATLModal) {
                        staticAddATLModal.addEventListener('show.bs.modal', function(event) {
                            var button = event.relatedTarget; // Button that triggered the modal
                            var ypId = button.getAttribute('data-bs-ypId');
                            var ypName = button.getAttribute('data-bs-ypName');
                            
                            // Update the modal title
                            var modalTitle = staticAddATLModal.querySelector('#modal-titleATL');
                            modalTitle.textContent = 'Add New ATL for ' + ypName + ' ' + ypId;
                            
                            // Update the form action URL
                            var form = staticAddATLModal.querySelector('#addATLForm');
                            var baseActionUrl = "{{ route('yearProgram-add.atlPYP', ['userId' => $teacher->user_id, 'ypId' => 'DUMMY_YP_ID']) }}";
                            form.action = baseActionUrl.replace('DUMMY_YP_ID', ypId);
                        });
                    }

                    // subject pyp
                    var staticAddSubPYPModal = document.getElementById('staticAddSubjectPYP');
                    
                    if (staticAddSubPYPModal) {
                        staticAddSubPYPModal.addEventListener('show.bs.modal', function(event) {
                            var button = event.relatedTarget; // Button that triggered the modal
                            var ypId = button.getAttribute('data-bs-ypId');
                            var ypName = button.getAttribute('data-bs-ypName');
                            
                            // Update the modal title
                            var modalTitle = staticAddSubPYPModal.querySelector('#modal-titleSubPYP');
                            modalTitle.textContent = 'Add New Subject for ' + ypName + ' ' + ypId;
                            
                            // Update the form action URL
                            var form = staticAddSubPYPModal.querySelector('#addSubPYPForm');
                            var baseActionUrl = "{{ route('yearProgram-add.subjectPYP', ['userId' => $teacher->user_id, 'ypId' => 'DUMMY_YP_ID']) }}";
                            form.action = baseActionUrl.replace('DUMMY_YP_ID', ypId);
                        });
                    }

                    // class pyp
                    var staticAddClassPYPModal = document.getElementById('staticAddPYPClass');
                    
                    if (staticAddClassPYPModal) {
                        staticAddClassPYPModal.addEventListener('show.bs.modal', function(event) {
                            var button = event.relatedTarget; // Button that triggered the modal
                            var ypId = button.getAttribute('data-bs-ypId');
                            var ypName = button.getAttribute('data-bs-ypName');
                            
                            // Update the modal title
                            var modalTitle = staticAddClassPYPModal.querySelector('#modal-titleClassPYP');
                            modalTitle.textContent = 'Add New Class for ' + ypName + ' ' + ypId;
                            
                            // Update the form action URL
                            var form = staticAddClassPYPModal.querySelector('#addClassPYPForm');
                            var baseActionUrl = "{{ route('yearProgram-add.classPYP', ['userId' => $teacher->user_id, 'ypId' => 'DUMMY_YP_ID']) }}";
                            form.action = baseActionUrl.replace('DUMMY_YP_ID', ypId);
                        });
                    }


                    // subject MYP
                    var staticAddSubMYPModal = document.getElementById('staticAddSubjectMYP');
                    
                    if (staticAddSubMYPModal) {
                        staticAddSubMYPModal.addEventListener('show.bs.modal', function(event) {
                            var button = event.relatedTarget; // Button that triggered the modal
                            var ypId = button.getAttribute('data-bs-ypId');
                            var ypName = button.getAttribute('data-bs-ypName');
                            
                            // Update the modal title
                            var modalTitle = staticAddSubMYPModal.querySelector('#modal-titleSubMYP');
                            modalTitle.textContent = 'Add New Subject for ' + ypName + ' ' + ypId;
                            
                            // Update the form action URL
                            var form = staticAddSubMYPModal.querySelector('#addSubMYPForm');
                            var baseActionUrl = "{{ route('yearProgram-add.subject', ['userId' => $teacher->user_id, 'ypId' => 'DUMMY_YP_ID']) }}";
                            form.action = baseActionUrl.replace('DUMMY_YP_ID', ypId);
                        });
                    }

                    // class MYP
                    var staticAddClassMYPModal = document.getElementById('staticAddMYPClass');
                    
                    if (staticAddClassMYPModal) {
                        staticAddClassMYPModal.addEventListener('show.bs.modal', function(event) {
                            var button = event.relatedTarget; // Button that triggered the modal
                            var ypId = button.getAttribute('data-bs-ypId');
                            var ypName = button.getAttribute('data-bs-ypName');
                            
                            // Update the modal title
                            var modalTitle = staticAddClassMYPModal.querySelector('#modal-titleClassMYP');
                            modalTitle.textContent = 'Add New Class for ' + ypName + ' ' + ypId;
                            
                            // Update the form action URL
                            var form = staticAddClassMYPModal.querySelector('#addClassMYPForm');
                            var baseActionUrl = "{{ route('yearProgram-add.class', ['userId' => $teacher->user_id, 'ypId' => 'DUMMY_YP_ID']) }}";
                            form.action = baseActionUrl.replace('DUMMY_YP_ID', ypId);
                        });
                    }




            });
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

                    $('#addInputA').click(function() {
                    var newInputNumber = $('#ATLContainer .form-group').length;
                    console.log(newInputNumber);

                    var newInput = `
                    <div class="form-group">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" name="atl[${newInputNumber}][name]" id="atl[${newInputNumber}][name]" class="form-control" placeholder="Enter ATL name">
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-danger delete-btn"><i class="lni lni-trash-can"></i></button>
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