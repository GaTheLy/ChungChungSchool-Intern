<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PYP Report</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }
        .page-break {
            page-break-before: always;
        }
        .report-header, .report-footer {
            text-align: left;
            padding: 10px 0;
        }
        .report-header img {
            float: left;
            margin-right: 20px;
            max-height: 100px;
        }
        .report-header h1 {
            font-size: 24px;
            margin: 0;
        }
        .report-header h2 {
            font-size: 20px;
            margin: 0;
        }
        .report-header p {
            font-size: 12px;
            margin: 5px 0 0 0;
        }
        .report-body {
            padding: 20px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .teacher-info, .principal-signature {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .teacher-info div, .principal-signature div {
            flex: 1;
        }
        .teacher-info div:last-child {
            text-align: right;
        }
        .attendance-summary {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .attendance-box {
            padding: 6px 9px;
            border-radius: 2px;
            color: #fff;
            font-weight: bold;
            text-align: center;
        }

        .attendance-box.absent {
            background-color: #ff4d4d;
        }

        .attendance-box.present {
            background-color: #4caf50;
        }

        .attendance-box.late {
            background-color: #ffa726;
        }

        .attendance-box.excused {
            background-color: #ba68c8;
        }

        /* Subject onwards */
        .subjects-section {
            width: 100%;
            margin: 20px 0;
        }

        .subject {
            margin-bottom: 20px;
        }

        .subject-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .subject-header img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .subject-header h3 {
            font-size: 16px;
            margin: 0;
        }

        .subject-body {
            width: 100%;
        }

        .subject-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

        .subject-title {
            flex: 1;
            text-align: left;
        }

        .student-progress {
            width: 120px;
            text-align: right;
            float:right;
        }

        .subject-row:last-child {
            border-bottom: none;
        }

        /* ATL onwards */
        .atl-section {
            width: 100%;
            margin: 10px 0;
        }

        .atl-section h3 {
            font-size: 20px;
            margin: 5px 0;
            color: black;
        }

        .atl {
            margin-bottom: 10px;
        }

        .atl-header {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .atl-row img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .atl-header h3 {
            font-size: 16px;
            margin: 0;
        }

        .atl-body {
            width: 100%;
        }

        .atl-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

        .atl-title {
            flex: 1;
            text-align: left;
        }

        .atl-progress {
            width: 120px;
            text-align: right;
            float: right;
        }

        .atl-row:last-child {
            border-bottom: none;
        }


        /* Unit */
        .programme-inquiry {
            width: 100%;
            margin: 10px 0;
            padding: 5px;
            border: 1px solid #ddd;
        }

        .programme-inquiry h2 {
            font-size: 20px;
            margin: 0 0 10px;
        }

        .unit {
            margin-bottom: 15px;
        }

        .unit-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f9fa;
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        .unit-header h3 {
            font-size: 20px;
            margin: 0;
        }

        .student-progress-unit {
            font-size: 16px;
            color: black;
            text-align: right;
        }

        .central-idea, .lines-of-inquiry, .key-concepts {
            margin: 10px 0;
        }

        .central-idea h4, .lines-of-inquiry h4, .key-concepts h4 {
            font-size: 18px;
            color: black;
            margin: 0 0 5px;
        }

        .lines-of-inquiry ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .lines-of-inquiry li {
            margin: 3px 0;
        }

        .key-concepts table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .key-concepts th, .key-concepts td {
            padding: 5px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .key-concepts th {
            background-color: #f8f9fa;
            font-size: 14px;
        }

        .key-concepts td {
            font-size: 14px;
        }

        .student-progress-descriptor {
            width: 100%;
            margin: 10px 0;
            padding: 5px;
            border: 1px solid #ddd;
        }


    </style>
</head>
<body>
    <div class="container">
        <div class="report-header">
            <img src="{{ asset('assets-image/'. $filename) }}" alt="School Logo" name="logo">
            <div>
                <h1>PYP Report</h1>
                <h2>Chung Chung Christian School</h2>
                <p>First Term (2024 - 2025)</p>
                <p>Prepared: {{ \Carbon\Carbon::today()->format('d/m/Y') }}</p>
            </div>
        </div>
<br/>
        <div class="report-body">

            <div class="teacher-info">
                <table>
                    <tbody>
                        <tr style="line-height:0;">
                            <td colspan="2">
                            <strong>{{ $student->first_name }} {{ $student->last_name }}</strong>

                            </td>
                        </tr>
                        <tr style="line-height:0;">
                            <td>
                            <h5> Grade</h5>
                            </td>
                            <td margin-right="5px"></td>
                            <td>
                            <h5>Homeroom Teachers</h5>
                            </td>
                        </tr>
                        <tr style="line-height:0;">
                            <td style="vertical-align: top;">
                            {{ $student->class->first()->class_name }}
                            </td>
                            <td margin-right="15px"></td>
                            <td>
                            @if ($student->class->first()->homerooms->where('role', 'main')->isNotEmpty())
                                <div style="margin-bottom:24px;text-align: left;">
                                    {{ $student->class->first()->homerooms->where('role', 'main')->first()->teacher->first_name }}
                                    {{ $student->class->first()->homerooms->where('role', 'main')->first()->teacher->last_name }}
                                </div>
                            @endif

                            @if ($student->class->first()->homerooms->where('role', 'co')->isNotEmpty())
                                <div style="text-align:left;">
                                    {{ $student->class->first()->homerooms->where('role', 'co')->first()->teacher->first_name }}
                                    {{ $student->class->first()->homerooms->where('role', 'co')->first()->teacher->last_name }} 
                                </div>
                            @endif
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
 
            <div class="message mt-4">
                <p>Dear Parents,</p>
                {{ $greetings }}
                <br />
                <p>Kind regards,</p>
            </div>
            <br>

            <div class="principal-signature" style="display:block;">
                <div>
                    <img src="{{ asset('assets-image/'. $filenameSign) }}" alt="Principal Signature" style="max-height: 50px;">
                </div>
                <div>
                    <strong>Laura Carolina</strong><br>
                    PYP Principal
                </div>
            </div>
{{--  
            @if ($custom->attendance==1)
            <div class="section">
                <h3>Attendance</h3>
                <div class="attendance-summary">
                    <span class="attendance-box" style="background-color: #ff4d4d;">{{$attendance->total_absent}} Absent</span>
                    <span class="attendance-box" style="background-color: #4caf50;">{{$attendance->total_present}} Present</span>
                    <span class="attendance-box" style="background-color: #ffa726;">{{$attendance->total_late}} Late</span>
                    <span class="attendance-box" style="background-color: #ba68c8;">{{$attendance->total_excused}} Excused</span>
                </div>
            </div>
            @endif
--}}
            @if ($custom->attendance==1)
            <div class="section">
                <h3>Attendance</h3>
                @if($attendance)
                <div class="attendance-summary">
                    <span class="attendance-box absent">{{$attendance->absent}} Absent</span>
                    <span class="attendance-box present">{{$attendance->present}} Present</span>
                    <span class="attendance-box late">{{$attendance->late}} Late</span>
                    <span class="attendance-box excused">{{$attendance->excused}} Excused</span>
                </div>

                @else
                <span>Overall attendance has not been filled.</span>
                @endif
            </div>
            @endif

            <div class="page-break"></div>
  
            <div class="student-progress-descriptor">
            <img src="{{ asset('assets-image/'. $progressDesc) }}" alt="progress-descriptor" style="max-height:100vh;width:100%;">
            </div>

            <div class="page-break"></div>


            <div class="ib-learner-profile">
            <img src="{{ asset('assets-image/'. $ibProfile) }}" alt="learner-profile" style="max-height:100vh;width:100%;">
            </div>

            <div class="page-break"></div>
{{----}}

            <div class="programme-inquiry">
                <table>
                <tr>
                    <td>
                    <img src="{{ asset('assets-image/'. 'poi_logo.jpg') }}" alt="logo" width="32px;" > 
                    </td>
                    <td>
                    <h2 style="margin-top:8px;">Programme of Inquiry</h2>
                    </td>
                </tr>
                </table>

                @php
                $index = 1;
                @endphp                

                @foreach($units as $unit)
                <div class="unit">
                    <div class="unit-header">
                        <h3>Unit {{ $index }} - {{ $unit->name}}</h3>
                        <div class="student-progress-unit"><strong>{{$unit->description}}</strong> <br>Student Progress</div>
                    </div>
                    @if ($custom->central_idea==1)
        
                    <div class="central-idea">
                    <table>
                    <tr>
                        <td>
                        <img src="{{ asset('assets-image/'. 'ci_logo.jpg') }}" alt="logo" width="20px;"  > 
                        </td>
                        <td>
                        <h4 style="margin-top:8px;">The Central Idea</h4>
                        </td>
                    </tr>
                    </table>
                    <p>{{$unit->central_idea}}</p>
                    </div>
                     @endif

                    @if ($custom->lines_of_inquiry==1)
                    <div class="lines-of-inquiry">
                    <table>
                    <tr>
                        <td>
                        <img src="{{ asset('assets-image/'. 'loi_logo.jpg') }}" alt="logo" width="20px;"  > 
                        </td>
                        <td>
                        <h4 style="margin-top:4px;">Lines Of Inquiry</h4>
                        </td>
                    </tr>
                    </table>                        
                        <ul>
                            @foreach($unit->line_of_inquiries as $loa)
                                <li>• {{$loa->description}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if ($custom->key_concepts==1)
                    <div class="key-concepts">
                            <img src="{{ asset('assets-image/'. 'kc_logo.jpg') }}" alt="logo" width="20px;"  > 
                            
                            <h4 style="margin-top:4px;">Key Concepts</h4>

                        <table>
                            <thead>
                                <tr>
                                    <th>Key Concepts</th>
                                    <th>Key questions and definition</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($unit->key_concepts as $key_concept)
                                <tr>
                                    <td style="text-align:center;">
                                    <img src="{{ asset('key-concepts/'. $key_concept->icon)}}" alt="logo" width="48px;"  > 
                                    <br/>
                                    {{$key_concept->topic}}
                                    </td>
                                    <td><strong>{{$key_concept->question}}</strong>  <br>
                                    {{$key_concept->definition}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif  
                </div>
                @php
                $index+=1;
                @endphp
                @endforeach
            </div>


            @if ($custom->atl==1)
            <div class="atl-section">
                <table>
                    <tr>
                        <td>
                        <img src="{{ asset('atls/'. 'atl_icon.jpg') }}" alt="logo" width="32px;"  > 
                        </td>
                        <td>
                        <h3 style="margin-top:4px;">Approaches to Learning</h3>
                        </td>
                    </tr>
                </table>   
                    <div class="atl">
                        <div class="atl-header">
                            <h5 style='text-align:right;'>Student Progress</h5>
                        </div>
                        <div class="atl-body">
                               @foreach($atls as $atl)
                                    <div class="atl-row">
                                        <img src="{{ asset('atls/'. $atl->icon) }}" alt="atl icon" width="32px;" style="margin-bottom:4px;">
                                        <span class="atl-title" style="margin-top:4px;">{{ $atl->description }}</span>
                                        <span class="atl-progress" style="margin-bottom:4px;">{{ $atl->atl_progress_description }}</span>
                                    </div>
                                @endforeach 
                        </div>
                    </div>
            </div>
            @endif


            @if ($custom->subjects==1)
            <div class="subjects-section">
                <table>
                    <tr>
                        <td>
                        <img src="{{ asset('subjects/'. 'subjects_icon.jpg') }}" alt="logo" width="32px;"  > 
                        </td>
                        <td>
                        <h3 style='font-size: 20px;margin: 5px 0;'>Subjects</h3>
                        </td>
                    </tr>
                </table>   
    @foreach($subject_teacher_s as $sub_teacher)
        @php
            // Retrieve homerooms
            $mainHomeroom = $student->class->first()->homerooms->where('role', 'main')->first();
            $coHomeroom = $student->class->first()->homerooms->where('role', 'co')->first();

            // Check if the subject is taught by main or co homerooms
            $isMainHomeroomSubject = $mainHomeroom && $sub_teacher->teacher_id == $mainHomeroom->teacher->nip_pyp;
            $isCoHomeroomSubject = $coHomeroom && $sub_teacher->teacher_id == $coHomeroom->teacher->nip_pyp;
        @endphp

        @if($isMainHomeroomSubject)
            {{-- Show the subject taught by the main homeroom --}}
            <div class="subject">
                <div class="subject-header">
                    <table width="100%">
                        <tr>
                            <td width="5%">
                            <img src="{{ asset('subjects/'. 'unknown_subject.jpg') }}" alt="logo" width="20px;" >
                            </td>
                            <td style="text-align: left;">
                            <h3>{{ $sub_teacher->subject->subject_name }}</h3>
                            </td>
                            <td style="text-align: right;">
                            <h5>Student Progress</h5>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="subject-body" style="margin-top:-24px;">
                    @foreach($sub_teacher->subject->pypCriteria as $criterion)
                        @php
                            $grade = $criterion->pypCriteriaProgress->first();
                        @endphp

                        @if($grade && $grade->description != 'Criteria Not Used')
                            <div class="subject-row" style="margin-left:16px;">
                                <span class="subject-title">• {{$criterion->crit_name}}</span>
                                <span class="student-progress">{{$grade->description}}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @elseif($isCoHomeroomSubject)
            {{-- Show the subject taught by the main homeroom --}}
            @if($sub_teacher->yp_pyp_id == 20)
                 @if( $sub_teacher->subject->id == 28)

            <div class="subject">
                <div class="subject-header">
                    <table width="100%">
                        <tr>
                            <td width="5%">
                            <img src="{{ asset('subjects/'. 'unknown_subject.jpg') }}" alt="logo" width="20px;" >
                            </td>
                            <td style="text-align: left;">
                            <h3>{{ $sub_teacher->subject->subject_name }}</h3>
                            </td>
                            <td style="text-align: right;">
                            <h5>Student Progress</h5>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="subject-body" style="margin-top:-24px;">
                    @foreach($sub_teacher->subject->pypCriteria as $criterion)
                        @php
                            $grade = $criterion->pypCriteriaProgress->first();
                        @endphp

                        @if($grade && $grade->description != 'Criteria Not Used')
                            <div class="subject-row" style="margin-left:16px;">
                                <span class="subject-title">• {{$criterion->crit_name}}</span>
                                <span class="student-progress">{{$grade->description}}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
            @endif
        @elseif(!$isMainHomeroomSubject && !$isCoHomeroomSubject)
            {{-- Show other subjects not taught by both main and co homerooms --}}
            @if($sub_teacher->subject->id == 28 && $sub_teacher->teacher_id == 22005)
                @if( $sub_teacher->yp_pyp_id == 14)
                    {{-- Show Chinese subject --}}
                    <div class="subject">
                        <div class="subject-header">
                            <table width="100%">
                                <tr>
                                    <td width="5%">
                                        <img src="{{ asset('subjects/'. 'unknown_subject.jpg') }}" alt="logo" width="20px;">
                                    </td>
                                    <td>
                                        <h3>{{ $sub_teacher->subject->subject_name }}</h3>
                                    </td>
                                    <td style="text-align: right;">
                                    <h5>Student Progress</h5>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="subject-body">
                            @foreach($sub_teacher->subject->pypCriteria as $criterion)
                                @php
                                    $grade = $criterion->pypCriteriaProgress->first();
                                @endphp

                                @if($grade && $grade->description != 'Criteria Not Used')
                                    <div class="subject-row">
                                        <span class="subject-title">• {{ $criterion->crit_name }}</span>
                                        <span class="student-progress">{{ $grade->description }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @elseif($sub_teacher->subject->id == 27 && $sub_teacher->teacher_id == 23004)
                @if( $sub_teacher->yp_pyp_id == 15 || $sub_teacher->yp_pyp_id == 16 )
                @endif
            @else
            <div class="subject">
                <div class="subject-header">
                    <table width="100%">
                        <tr>
                            <td width="5%">
                            <img src="{{ asset('subjects/'. 'unknown_subject.jpg') }}" alt="logo" width="20px;" >
                            </td>
                            <td>
                            <h3>{{ $sub_teacher->subject->subject_name }}</h3>
                            </td>
                            <td style="text-align: right;">
                            <h5>Student Progress</h5>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="subject-body">
                    @foreach($sub_teacher->subject->pypCriteria as $criterion)
                        @php
                            $grade = $criterion->pypCriteriaProgress->first();
                        @endphp

                        @if($grade && $grade->description != 'Criteria Not Used')
                            <div class="subject-row">
                                <span class="subject-title">• {{$criterion->crit_name}}</span>
                                <span class="student-progress">{{$grade->description}}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
            
        @endif
    @endforeach
</div>

            @endif

            <hr>

            @if ($custom->homeroom_comments==1)
            <div class="teacher-comment">
                <h3>Homeroom Teacher's Comment</h3>
                @if ($comment)
                <p>{{ $comment->description }}</p>
                @else
                <p>No Comment Yet.</p>
                @endif
            </div>
            @endif
        </div>  
    </div>
</body>
</html>
