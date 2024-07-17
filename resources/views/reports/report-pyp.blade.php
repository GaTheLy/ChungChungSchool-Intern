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


    </style>
</head>
<body>
    <div class="container">
        <div class="report-header">
            <img src="{{ asset('assets-image/ccs-logo.jpg') }}" alt="School Logo">
            <div>
                <h1>PYP Report</h1>
                <h2>Chung Chung Christian School</h2>
                <p>Second Term (2023 - 2024)</p>
                <p>Prepared: December 12, 2023</p>
            </div>
        </div>

        <div class="report-body">
            <div class="teacher-info">
                <div>
                    <strong>Alicia Natalia Tjandranegara</strong><br>
                    Grade<br>
                    E1
                </div>
                <div>
                    Homeroom Teacher<br>
                    Debry Mudjiono
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
                    <span class="attendance-box" style="background-color: #ff4d4d;">0 Absent</span>
                    <span class="attendance-box" style="background-color: #4caf50;">0 Present</span>
                    <span class="attendance-box" style="background-color: #ffa726;">0 Late</span>
                </div>  
            </div>

            <div class="page-break"></div>

            <div class="subjects-section">
                <div class="subject">
                    <div class="subject-header">
                        <img src="path/to/subject-icon.png" alt="Subject Icon">
                        <h3>English</h3>
                        <h5 style='text-align:right;'>Student Progress</h5>
                    </div>
                    <div class="subject-body">
                        <div class="subject-row">
                            <span class="subject-title">• Oral language - listening and speaking</span>
                            <span class="student-progress">Exceeding</span>
                        </div>
                        <div class="subject-row">
                            <span class="subject-title">• Written language - reading</span>
                            <span class="student-progress">Exceeding</span>
                        </div>
                        <div class="subject-row">
                            <span class="subject-title">• Written language - writing</span>
                            <span class="student-progress">Exceeding</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="subject">
                    <div class="subject-header">
                        <img src="path/to/subject-icon.png" alt="Subject Icon">
                        <h3>Chinese</h3>
                        <h5 style='text-align:right;'>Student Progress</h5>
                    </div>
                    <div class="subject-body">
                        <div class="subject-row">
                            <span class="subject-title">• Oral language - listening and speaking</span>
                            <span class="student-progress">Achieving</span>
                        </div>
                        <div class="subject-row">
                            <span class="subject-title">• Written language - writing</span>
                            <span class="student-progress">Exceeding</span>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="subject">
                    <div class="subject-header">
                        <img src="path/to/subject-icon.png" alt="Subject Icon">
                        <h3>Bahasa Indonesia</h3>
                        <h5 style='text-align:right;'>Student Progress</h5>
                    </div>
                    <div class="subject-body">
                        <div class="subject-row">
                            <span class="subject-title">• Keterampilan berbahasa lisan - mendengarkan dan berbicara</span>
                            <span class="student-progress">Achieving</span>
                        </div>
                        <div class="subject-row">
                            <span class="subject-title">• Bahasa tertulis - membaca</span>
                            <span class="student-progress">Exceeding</span>
                        </div>
                        <div class="subject-row">
                            <span class="subject-title">• Bahasa tertulis - menulis</span>
                            <span class="student-progress">Exceeding</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="teacher-comment">
                <h3>Homeroom Teacher's Comment</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas odio, vitae scelerisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae massa.</p>
            </div>

        </div>
    </div>
</body>
</html>
