<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYP Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    
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
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            text-align: left;
        }
        .header img {
            width: 150px;
            height: auto;
            margin-right: 20px;
        }
        .header div {
            flex-grow: 1;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 16px;
        }
        .content h2, .content p {
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .table td {
            text-align: left;
        }
        .attendance-table, .grades-table {
            margin-top: 20px;
        }
        .attendance-table th, .attendance-table td, .grades-table th, .grades-table td {
            text-align: center;
        }
        .page-break {
            page-break-before: always;
        }
        .student-info h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .info-container {
            display: flex;
            flex-direction: column;
        }

        .info-row {
            display: flex;
            margin-bottom: 10px;
        }

        .info-label, .info-value {
            flex: 1;
        }

        .info-label {
            font-weight: bold;
        }
        .grades-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }
        .grades-table th, .grades-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        .grades-table th {
            background-color: #f2f2f2;
        }
        .grades-table th[colspan="4"], .grades-table td[colspan="7"] {
            text-align: center;
        }
        .grades-table th[rowspan="2"] {
            vertical-align: middle;
        }
        .grades-row-group {
            page-break-inside: avoid;
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

        .grade-mentor-comments p {
            margin: 10px 0;
        }

        .subject-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
            page-break-after: always;
        }

        .subject-table th, .subject-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .subject-table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .subject-table td {
            text-align: left;
        }

        .subject-table th[colspan="2"] img {
            margin-right: 5px;
        }

        .criterion-descriptor {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .criterion-detail {
            padding-left: 20px;
        }

        .overall-comment {
            padding-top: 10px;
            padding-bottom: 10px;
            background-color: #f9f9f9;
        }

        .grade-boundaries {
            padding: 0;
        }

        .boundaries-table {
            width: 100%;
            border-collapse: collapse;
        }

        .boundaries-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .boundaries-table td:first-child {
            text-align: left;
        }

        .project-section {
            display: flex;
            align-items: center;
            padding: 10px;
            color: white;
        }

        .project-icon {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .project-title {
            font-size: 1em;
            margin: 0;
        }

        .project-content {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .project-content h4, .project-content h5 {
            margin: 10px 0 5px;
        }

        .project-content p {
            margin: 0 0 10px;
        }

        .achievement-descriptors {
            /* page-break-before: always; */
            padding: 10px;
        }

        .achievement-descriptors h2 {
            font-size: 1.25em;
            margin-bottom: 10px;
        }

        .achievement-descriptors h3 {
            font-size: 1em;
            margin-bottom: 20px;
        }

        .achievement-descriptors table {
            width: 100%;
            border-collapse: collapse;
        }

        .achievement-descriptors th, .achievement-descriptors td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        .achievement-descriptors th {
            background-color: #f2f2f2;
        }

        .achievement-descriptors td:nth-child(1) {
            width: 10%;
        }

        .achievement-descriptors td:nth-child(2) {
            width: 10%;
        }

        .achievement-descriptors td:nth-child(3) {
            width: 80%;
        }

        hr {
            border: 0;
            height: 1px;
            background: #ddd;
            margin: 20px 0;
        }

        /* Atl Checkmark */
        .checkmark {
        display: inline-block;
        width: 8px;
        height: 20px;
        border: solid green;
        border-width: 0 3px 3px 0;
        transform: rotate(45deg);
        margin: 5px;
        }

        /* .checkmark::after {
        content: '';
        display: block;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        position: absolute;
        top: 2px;
        left: 5px;
        transform: rotate(45deg);
        } */


    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('assets-image/'. $filename) }}" alt="School Logo">
            <div>
                <h1>Middle School Report</h1>
                <p>Chung Chung Christian School</p>
                <p>Prepared on {{ \Carbon\Carbon::today()->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="content">
            <div class="section student-info">
                <h2>{{ $student->first_name }} {{ $student->last_name }}</h2>
                <div class="info-container">
                    <div class="info-row">
                        <div class="info-label">Grade</div>
                        <div class="info-value">{{ $student->class->first()->class_name }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Date of Birth</div>
                        <div class="info-value">{{ $student->dob }} </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Homeroom Teacher</div>
                        <div class="info-value">{{ $student->class->first()->homeroom->teacher->first_name }} {{ $student->class->first()->homeroom->teacher->last_name }}</div>
                    </div>
                </div>
            </div>

            <p>Dear Parents, </p>

            <p>{{$greetings}}</p>
            

            <p>Kind regards,</p>
            <div class="principal-signature">
                <div>
                    <img src="{{ asset('assets-image/'. $filenameSign) }}" alt="Principal Signature" style="max-height: 50px;">
                </div>
                <div>
                    <strong>Laura Carolina</strong><br>
                    MYP Principal
                </div>
            </div>

            <div class="page-break"></div>

            @if ($custom->summary_progress==1)

            <div class="section">
                <h2>Summary of Semester 1 Student Progress</h2>
                <hr>
                <table class="table grades-table">
                    <thead>
                        <tr>
                            <!-- <th rowspan="2">Subject</th>
                            <th rowspan="2">Teacher</th>
                            <th colspan="4">Grades</th>
                            <th rowspan="2">Semester 1 Progress Overview</th> -->
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            
                            <th>A</th>
                            <th>B</th>
                            <th>C</th>
                            <th>D</th>
                            <th>Semester 1 Progress Overview</th>
                        </tr>
                    </thead>
                    <!-- Start of a Subject Entry -->
                     @foreach($subject_teacher_s as $sub_teacher)
                        <tbody class="grades-row-group">
                            <tr>
                                <td>{{ $sub_teacher->subject->subject_name }}</td>
                                <td>{{ $sub_teacher->teacher->first_name }} {{ $sub_teacher->teacher->last_name }}</td>

                                @php
                                    $criteriaCount = $sub_teacher->subject->mypCriteria->count();
                                    $displayedCriteria = 0;
                                @endphp

                                @foreach($sub_teacher->subject->mypCriteria as $criterion)
                                    @php
                                        $grade = $criterion->mypCriteriaGrades->first();
                                    @endphp

                                    @if($grade)
                                        <td>{{ $grade->crit_grade }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @php $displayedCriteria++; @endphp
                                @endforeach

                                @for($i = $displayedCriteria; $i < 4; $i++)
                                    <td></td>
                                @endfor

                                <td>{{ $sub_teacher->subject->progress->grade }}</td>

                            </tr>
                            <tr>
                                <td colspan="7">
                                    {{ $sub_teacher->subject->progress->teacher_comment }}
                                </td>
                            </tr>
                        </tbody>
                        <!-- End of a Subject Entry -->
                     @endforeach
                </table>
            </div>
            @endif

            @if ($custom->attendance==1)
            <div class="section">
                <h3>Attendance</h3>
                <div class="attendance-summary">
                    <span class="attendance-box" style="background-color: #ff4d4d;">{{$attendance->total_absent}} Absent</span>
                    <span class="attendance-box" style="background-color: #4caf50;">{{$attendance->total_present}} Present</span>
                    <span class="attendance-box" style="background-color: #ffa726;">{{$attendance->total_late}} Late</span>
                    <span class="attendance-box" style="background-color: #ffeb3b;">{{$attendance->total_sick}} Sick</span>
                    <span class="attendance-box" style="background-color: #ba68c8;">{{$attendance->total_excused}} Excused</span>
                </div>
                <div class="grade-mentor-comments">
                    <p><strong>{{ $student->class->first()->homeroom->teacher->first_name }} {{ $student->class->first()->homeroom->teacher->last_name }}</strong> &mdash; Grade Mentor Comments</p>
                    <p>{{$comment->description}}</p>
                </div>
            </div>
            @endif

            <div class="page-break"></div>

            <div class="section">

                <h2>Subjects</h2>
                <hr>
                @foreach($subject_teacher_s as $sub_teacher)
                <table class="table subject-table">
                    <thead>
                    @if ($custom->subjects==1)

                        <tr>
                            <th colspan="2">
                                <img src="path-to-icon.png" alt="Subject Icon" style="width:24px; vertical-align:middle;">
                                {{ $sub_teacher->subject->subject_name }}
                                
                                <br>
                                <span style="font-weight: lighter;">{{ $sub_teacher->teacher->first_name }} {{ $sub_teacher->teacher->last_name }}</span>
                            </th>
                            @php
                                $criteriaCount = $sub_teacher->subject->mypCriteria->count();
                                $displayedCriteria = 0;
                            @endphp

                            @foreach($sub_teacher->subject->mypCriteria as $criterion)
                                

                                @if($criterion)
                                    <th>{{ $criterion->criteria_title }}</th>
                                @endif
                                @php $displayedCriteria++; @endphp
                            @endforeach

                            @for($i = $displayedCriteria; $i < 4; $i++)
                                <th></th>
                            @endfor
                            <th>Semester Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"></td>
                                @php
                                    $criteriaCount = $sub_teacher->subject->mypCriteria->count();
                                    $displayedCriteria = 0;
                                @endphp

                                @foreach($sub_teacher->subject->mypCriteria as $criterion)
                                    @php
                                        $grade = $criterion->mypCriteriaGrades->first();
                                    @endphp

                                    @if($grade)
                                        <td>{{ $grade->crit_grade }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @php $displayedCriteria++; @endphp
                                @endforeach

                                @for($i = $displayedCriteria; $i < 4; $i++)
                                    <td></td>
                                @endfor
                            <td>{{ $sub_teacher->subject->progress->grade }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="criterion-descriptor">Criterion Descriptors</td>
                        </tr>
                        @foreach($sub_teacher->subject->mypCriteria as $criterion)
                        <tr>
                            <td colspan="7" class="criterion-detail">
                                <strong>{{$criterion->criteria_title}}: {{$criterion->criteria_name}}</strong><br>
                                    @php
                                        $grade = $criterion->mypCriteriaGrades->first();
                                        $details = $criterion->mypCriteriaDetail;
                                        $filteredDetails = $details->filter(function ($detail) use ($grade) {
                                            return $detail->criteria_range == $grade->crit_grade;
                                        });
                                    @endphp

                                    @foreach($filteredDetails as $detail)
                                         {{ $detail->criteria_range_desc }}
                                    @endforeach

                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="7" class="overall-comment">
                            {{ $sub_teacher->subject->progress->teacher_comment }}
                            </td>
                        </tr>
                        <tr>

                        @endif


                            <td colspan="7" class="grade-boundaries">
                                
                        @if ($custom->grade_boundaries==1)
                                <table class="boundaries-table">
                                    <tr>
                                        <td>Grade</td>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                        <td>6</td>
                                        <td>7</td>
                                    </tr>
                                    <tr>
                                        <td>Boundaries</td>
                                        <td>0 – 5</td>
                                        <td>6 – 9</td>
                                        <td>10 – 14</td>
                                        <td>15 – 18</td>
                                        <td>19 – 23</td>
                                        <td>24 – 27</td>
                                        <td>28 – 32</td>
                                    </tr>
                                </table>
                                
                            @endif
                            </td>
                        </tr>

                        <tr>
    <td colspan="7">
        <h3>Approaches to Learning</h3>
        @if ($custom->atl==1)

        <table class="table table-bordered atl-table">
            <thead>
                <tr>
                    <th>ATL</th>
                    <th>EE</th>
                    <th>ME</th>
                    <th>AE</th>
                    <th>BE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sub_teacher->subject->atls as $atl)
                <tr>
                    <td>{{ $atl->atl_name }}</td>
                    <td>@if($atl->progress->atl_progress == 'EE')  
                        <span class="checkmark"></span>  
                        @endif
                    </td>
                    <td>@if($atl->progress->atl_progress == 'ME')  
                        <span class="checkmark"></span>  
                        @endif
                    </td>
                    <td>@if($atl->progress->atl_progress == 'AE')  
                        <span class="checkmark"></span>  
                        @endif
                    </td>
                    <td>@if($atl->progress->atl_progress == 'BE')  
                        <span class="checkmark"></span>  
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </td>
</tr>

                    </tbody>


                </table>
                @endforeach
            </div>

        
            @if ($custom->achievement_descriptors==1)
            <div class="achievement-descriptors">
                <h2>Achievement Level Descriptors</h2>
                <hr>
                <h3>Final Grade</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Final Grade</th>
                            <th>Local Grade</th>
                            <th>Descriptor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>7:</td>
                            <td>A+</td>
                            <td>Produces high-quality, frequently innovative work. Communicates comprehensive, nuanced understanding of concepts and contexts. Consistently demonstrates sophisticated critical and creative thinking. Frequently transfers knowledge and skills with independence and expertise in a variety of complex classroom and real-world situations.</td>
                        </tr>
                        <tr>
                            <td>6:</td>
                            <td>A</td>
                            <td>Produces high-quality, occasionally innovative work. Communicates extensive understanding of concepts and contexts. Demonstrates critical and creative thinking, frequently with sophistication. Uses knowledge and skills in familiar and unfamiliar classroom and real-world situations, often with independence.</td>
                        </tr>
                        <tr>
                            <td>5:</td>
                            <td>B+</td>
                            <td>Produces generally high-quality work. Communicates secure understanding of concepts and contexts. Demonstrates critical and creative thinking, sometimes with sophistication. Uses knowledge and skills in familiar classroom and real-world situations and, with support, some unfamiliar real-world situations.</td>
                        </tr>
                        <tr>
                            <td>4:</td>
                            <td>B</td>
                            <td>Produces good-quality work. Communicates basic understanding of most concepts and contexts with few misunderstandings and minor gaps. Often demonstrates basic critical and creative thinking. Uses knowledge and skills with some flexibility in familiar classroom situations, but requires support in unfamiliar situations.</td>
                        </tr>
                        <tr>
                            <td>3:</td>
                            <td>C+</td>
                            <td>Produces work of an acceptable quality. Communicates basic understanding of many concepts and contexts, with occasionally significant misunderstandings or gaps. Begins to demonstrate some basic critical and creative thinking. Is often inflexible in the use of knowledge and skills, requiring support even in familiar classroom situations.</td>
                        </tr>
                        <tr>
                            <td>2:</td>
                            <td>C</td>
                            <td>Produces work of limited quality. Expresses misunderstandings or significant gaps in understanding for many concepts and contexts. Infrequently demonstrates critical or creative thinking. Generally inflexible in the use of knowledge and skills, infrequently applying knowledge and skills.</td>
                        </tr>
                        <tr>
                            <td>1:</td>
                            <td>D</td>
                            <td>Produces work of very limited quality. Conveys many significant misunderstandings or lacks understanding of most concepts and contexts. Very rarely demonstrates critical or creative thinking. Very inflexible, rarely using knowledge or skills.</td>
                        </tr>
                        <tr>
                            <td>N/A</td>
                            <td>F</td>
                            <td>Not Yet Assessed.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            @endif
            
            <!--  -->
        </div>
    </div>
</body>
</html>
