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
            color: #0056b3;
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
            font-size: 24px;
            color: #0056b3;
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
            color: #007bff;
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


    </style>
</head>
<body>
    <div class="container">
        <div class="report-header">
            <img src="{{ asset('assets-image/ccs-logo.jpg') }}" alt="School Logo">
            <div>
                <h1>PYP Report</h1>
                <h2>Chung Chung Christian School</h2>
                <p>First Term (2024 - 2025)</p>
                <p>Prepared: {{ \Carbon\Carbon::today()->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="report-body">
            <div class="teacher-info">
                <div>
                    <strong>{{ $student->first_name }} {{ $student->last_name }}</strong><br>
                    Grade<br>
                    {{ $student->class->first()->class_name }}
                </div>
                <div>
                    Homeroom Teacher<br>
                    {{ $student->class->first()->homeroom->teacher->first_name }} {{ $student->class->first()->homeroom->teacher->last_name }}
                </div>
            </div>

            <div class="message mt-4">
                <p>Dear Parents,</p>
                <p>At Chung Chung Christian School, we believe in an education that actively combines challenging and enriching experiences with academic rigor and creative opportunities. Our goal is to empower students to courageously push the boundaries of their experiences and explore the vast possibilities available to them. While we take pride in their academic achievements, our commitment goes beyond test scores. We aim for our students to discover the excitement of realizing their capabilities far exceed what they might have thought possible. We hold high expectations for our students, and they, in turn, have high expectations for themselves. It is crucial that parents wholeheartedly embrace and support the school's ethos.</p>
                <p>With this, I am pleased to present the first report card of the academic year. Let's collaborate to create an environment that fosters growth and development.</p>
                <p>Kind regards,</p>
            </div>
            <br>

            <div class="principal-signature">
                <div>
                    <img src="path/to/signature.png" alt="Principal Signature" style="max-height: 50px;">
                </div>
                <div>
                    <strong>Laura Carolina</strong><br>
                    PYP Principal
                </div>
            </div>

            <div class="section">
                <h3>Attendance</h3>
                <div class="attendance-summary">
                    <span class="attendance-box" style="background-color: #ff4d4d;">{{$attendance->total_absent}} Absent</span>
                    <span class="attendance-box" style="background-color: #4caf50;">{{$attendance->total_present}} Present</span>
                    <span class="attendance-box" style="background-color: #ffa726;">{{$attendance->total_late}} Late</span>
                    <span class="attendance-box" style="background-color: #ffeb3b;">{{$attendance->total_sick}} Sick</span>
                    <span class="attendance-box" style="background-color: #ba68c8;">{{$attendance->total_excused}} Excused</span>
                </div>
            </div>

            <div class="page-break"></div>

            <div class="programme-inquiry">
                <h2>Programme of Inquiry</h2>
                @foreach($units as $unit)
                <div class="unit">
                    <div class="unit-header">
                        <h3>{{$unit->name}}</h3>
                        <div class="student-progress-unit"><strong>{{$unit->description}}</strong> <br>Student Progress</div>
                    </div>
                    <div class="central-idea">
                        <h4>The Central Idea</h4>
                        <p>{{$unit->central_idea}}</p>
                    </div>
                    <div class="lines-of-inquiry">
                        <h4>Lines of Inquiry</h4>
                        <ul>
                            @foreach($unit->line_of_inquiries as $loa)
                                <li>{{$loa->description}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="key-concepts">
                        <h4>Key Concepts</h4>
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
                                    <td>{{$key_concept->topic}}</td>
                                    <td><strong>{{$key_concept->question}}</strong>  <br>
                                    {{$key_concept->definition}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>


            <div class="page-break"></div>

            <div class="atl-section">
                <h3>Approaches to Learning</h3>
                    <div class="atl">
                        <div class="atl-header">
                            <h5 style='text-align:right;'>Student Progress</h5>
                        </div>
                        <div class="atl-body">
                               {{-- @foreach($sub_teacher->subject->pypCriteria as $criterion)
                                    @php
                                        $grade = $criterion->pypCriteriaProgress->first();
                                    @endphp --}}
                                    <div class="atl-row">
                                        <img src="path/to/subject-icon.png" alt="Subject Icon">
                                        <span class="atl-title">[ATL Name]</span>
                                        <span class="atl-progress">Exceeding</span>
                                    </div>
                                {{--@endforeach --}}
                        </div>
                    </div>
            </div>


            <div class="subjects-section">
                <h3 style='font-size: 20px;margin: 5px 0;color: #0056b3;'>Subjects</h3>
                @foreach($subject_teacher_s as $sub_teacher)
                    <div class="subject">
                        <div class="subject-header">
                            <img src="path/to/subject-icon.png" alt="Subject Icon">
                            <h3>{{ $sub_teacher->subject->subject_name }}</h3>
                            <h5 style='text-align:right;'>Student Progress</h5>
                        </div>
                        <div class="subject-body">
                                @foreach($sub_teacher->subject->pypCriteria as $criterion)
                                    @php
                                        $grade = $criterion->pypCriteriaProgress->first();
                                    @endphp
                                    <div class="subject-row">
                                        <span class="subject-title">• {{$criterion->crit_name}}</span>
                                        <span class="student-progress">{{$criterion->pypCriteriaProgress->first()->description}}</span>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                @endforeach
            </div>   

            <hr>

            <div class="teacher-comment">
                <h3>Homeroom Teacher's Comment</h3>
                <p>{{ $comment->description }}</p>
            </div>

        </div>
    </div>
</body>
</html>
