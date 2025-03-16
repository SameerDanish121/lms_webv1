
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporary Enrolments</title>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #000;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #015d05;
        }
        .header h2 {
            margin: 0;
            font-size: 20px;
        }
        .content {
            flex: 1;
            padding: 40px;
        }
        .student-info {
            width: 100%;
            margin-bottom: 20px;
        }
        .student-info td {
            padding: 5px;
            width: 50%; /* Two columns */
        }
        .session-container {
            margin-bottom: 20px;
            border: 1px solid #000;
            padding: 10px;
        }
        .subjects-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .subjects-table th, .subjects-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .subjects-table th {
            background-color: #f2f2f2;
        }
        .session-header {
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 18px;
        }
        .gpa-info {
            margin-top: 10px;
            font-weight: bold;
        }
        /* Watermark Style */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 120px;
            color: rgba(0, 0, 0, 0.1);
            font-weight: bold;
            text-align: center;
            pointer-events: none;
            z-index: -1;
        }
    </style>
    <script>
        let enrollments = [];
        let API_BASE_URL = "http://127.0.0.1:8000/";
        async function getApiBaseUrl() {
            try {
                let response = await fetch('/get-api-url');
                let data = await response.json();
                return data.api_base_url;
            } catch (error) {
                return API_BASE_URL;
            }
        }
    </script>
</head>
<body class="bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100 min-h-screen flex flex-col">
    @include('components.navbar', [
        'username' => session('username', 'Guest'),
        'profileImage' => session('profileImage', asset('images/male.png')),
        'designation' => session('designation', 'N/A'),
        'type' => session('userType', 'User')
    ])
    <div class="content">
        <div class="watermark">UNOFFICIAL</div>

        <table class="student-info">
            <tr>
                <td>Name:<strong> {{ $student['name'] ?? 'N/A' }}</strong></td>
                <td>Father's Name:<strong> {{ $student['guardian'] ?? 'N/A' }}</strong></td>
            </tr>
            <tr>
                <td>Registration No: <strong>{{ $student['RegNo'] ?? 'N/A' }}</strong></td>
                <td>Date of Birth: <strong>{{ $student['date_of_birth'] ?? 'N/A' }}</strong></td>
            </tr>
        </table>

        <p>Program :<strong> {{ $program['description'] ?? 'N/A' }}</strong></p>

        @foreach ($sessionResults as $session)
            <div class="session-container">
                <div class="session-header">Session: {{ $session['session_name'] ?? 'N/A' }}</div>

                <table class="subjects-table">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Course Code</th>
                            <th>Credit Hours</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($session['subjects'] ?? [] as $subject)
                            <tr>
                                <td>{{ $subject['course_name'] ?? 'N/A' }}</td>
                                <td>{{ $subject['course_code'] ?? 'N/A' }}</td>
                                <td>{{ $subject['credit_hours'] ?? 'N/A' }}</td>
                                <td>{{ $subject['grade'] ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="gpa-info">
                    <p><strong>GPA:</strong> {{ $session['GPA'] ?? 'N/A' }}</p>
                    <p><strong>Total Credit Points:</strong> {{ $session['total_credit_points'] ?? 'N/A' }}</p>
                </div>
            </div>
        @endforeach
    </div>
    @include('components.footer')
</body>
</html>