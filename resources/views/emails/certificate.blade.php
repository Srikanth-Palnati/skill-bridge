<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Completion Certificate</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            line-height: 1.6;
        }
        .email-body h2 {
            color: #007bff;
        }
        .email-footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #6c757d;
        }
        .email-footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Congratulations, {{ $user->name }}!</h1>
        </div>
        <div class="email-body">
            <p>We are thrilled to inform you that you've successfully completed the course: <strong>{{ $course->title }}</strong>.</p>
            <p>Attached is your official certificate of completion. Keep learning and growing with SkillBridge!</p>
        </div>
        <div class="email-footer">
            <p>Thanks,<br>The SkillBridge Team</p>
            <p><a href="https://skillbridge.com">Visit SkillBridge</a></p>
        </div>
    </div>
</body>
</html>
