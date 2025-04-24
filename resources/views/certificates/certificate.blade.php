<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate of Completion</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            text-align: center;
            padding: 100px;
        }
        .certificate-box {
            border: 10px solid #ccc;
            padding: 50px;
        }
        .title {
            font-size: 36px;
            margin-bottom: 40px;
        }
        .name {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .course {
            font-size: 22px;
            margin-bottom: 30px;
        }
        .footer {
            margin-top: 60px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="certificate-box">
        <div class="title">Certificate of Completion</div>
        <div class="name">{{ $user->name }}</div>
        <div class="course">has successfully completed the course: <br><strong>{{ $course->title }}</strong></div>
        <div class="course">Instructor: <br><strong>{{ $course->instructor }}</strong></div>
        <div class="footer">Issued on {{ now()->format('F d, Y') }}</div>
    </div>
</body>
</html>
