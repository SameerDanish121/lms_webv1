@php
// Sample data - replace this with your API data later
$studentInfo = [
    'name' => 'M Sharjeel Ijaz',
    'currentSemester' => 4,
    'cgpa' => 3.48
];

$semesters = [
    [
        'number' => '01',
        'totalCredit' => 12,
        'gpa' => 3.50,
        'courses' => [
            ['code' => 'CS-301', 'title' => 'Programming Fundamental', 'credit' => 4, 'grade' => 'B', 'points' => 12],
            ['code' => 'MTH-302', 'title' => 'Calculus', 'credit' => 3, 'grade' => 'A', 'points' => 16],
            ['code' => 'SC-101', 'title' => 'Information Security', 'credit' => 3, 'grade' => 'B', 'points' => 10],
            ['code' => 'SC-112', 'title' => 'Pakistan Studies', 'credit' => 2, 'grade' => 'A', 'points' => 8]
        ]
    ],
    [
        'number' => '02',
        'totalCredit' => 16,
        'gpa' => 3.22,
        'courses' => [
            ['code' => 'CS-301', 'title' => 'Programming Fundamental', 'credit' => 4, 'grade' => 'B', 'points' => 12],
            ['code' => 'MTH-302', 'title' => 'Calculus', 'credit' => 3, 'grade' => 'A', 'points' => 16],
            ['code' => 'MTH-398', 'title' => 'Stp', 'credit' => 3, 'grade' => 'B', 'points' => 9],
            ['code' => 'MTH-302', 'title' => 'Calculus', 'credit' => 3, 'grade' => 'C', 'points' => 9],
            ['code' => 'MTH-302', 'title' => 'Calculus', 'credit' => 3, 'grade' => 'D', 'points' => 16]
        ]
    ],
    [
        'number' => '03',
        'totalCredit' => 16,
        'gpa' => 3.45,
        'courses' => [
            ['code' => 'CS-301', 'title' => 'Programming Fundamental', 'credit' => 4, 'grade' => 'C', 'points' => 12],
            ['code' => 'MTH-302', 'title' => 'Calculus', 'credit' => 3, 'grade' => 'A', 'points' => 16],
            ['code' => 'MTH-401', 'title' => 'Linear Algebra', 'credit' => 3, 'grade' => 'A', 'points' => 16],
            ['code' => 'CS-401', 'title' => 'Web Development', 'credit' => 3, 'grade' => 'B', 'points' => 12],
            ['code' => 'CS-310', 'title' => 'Data Structures', 'credit' => 3, 'grade' => 'A', 'points' => 16]
        ]
    ]
];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Report Card - LMS</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-200">
    @include('components.navbar', [
        'username' => session('username', 'Guest'),
        'profileImage' => session('profileImage', asset('images/male.png')),
        'designation' => session('designation', 'N/A'),
        'type' => session('type', 'User')
    ])

    <div class="container mx-auto px-2">

        <div class="bg-blue-600 text-white py-4 text-center text-2xl font-semibold mb-4 mt-3 rounded-md shadow-md">
            Student Report Card
        </div>



        <div class="flex flex-wrap justify-between items-center mb-6 px-4 bg-white p-4 rounded-lg shadow-sm">
            <div class="mb-2">
                <span class="font-semibold text-lg text-gray-700">Student name : </span>
                <span class="text-blue-800 font-bold text-xl">{{ $studentInfo['name'] }}</span>
            </div>
            <div class="flex flex-wrap gap-8">
                <div>
                    <span class="font-semibold text-lg text-gray-700">Current Semester : </span>
                    <span class="text-blue-800 font-bold text-xl">{{ $studentInfo['currentSemester'] }}</span>
                </div>
                <div>
                    <span class="font-semibold text-lg text-gray-700">CGPA : </span>
                    <span class="text-blue-800 font-bold text-xl font-semibold">{{ $studentInfo['cgpa'] }}</span>
                </div>
            </div>
        </div>


        @foreach($semesters as $index => $semester)
        <div class="mb-8 px-4">
            <div class="flex justify-between mb-2">
                <div class="font-semibold text-xl text-blue-700">Semester: {{ $semester['number'] }}</div>
                <div>
                    <span class="font-semibold text-gray-700">Total Credit: </span>
                    <span>{{ $semester['totalCredit'] }}</span>
                </div>
            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow-sm">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-blue-500 text-white">
                            <th class="border border-gray-300 p-2 text-left">Code</th>
                            <th class="border border-gray-300 p-2 text-left">Course Title</th>
                            <th class="border border-gray-300 p-2 text-center">Credit</th>
                            <th class="border border-gray-300 p-2 text-center">Grade</th>
                            <th class="border border-gray-300 p-2 text-center">Quality Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($semester['courses'] as $course)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 p-2 font-medium text-blue-600">{{ $course['code'] }}</td>
                            <td class="border border-gray-300 p-2 text-gray-700">{{ $course['title'] }}</td>
                            <td class="border border-gray-300 p-2 text-center text-gray-700">{{ $course['credit'] }}</td>
                            <td class="border border-gray-300 p-2 text-center font-semibold
                                {{ $course['grade'] === 'A' ? 'text-green-600' :
                                   ($course['grade'] === 'B'  ? 'text-blue-600' :
                                   ($course['grade'] === 'C' ? 'text-amber-600' :
                                   ($course['grade'] === 'D' ? 'text-orange-600' : 'text-red-600'))) }}">
                                {{ $course['grade'] }}
                            </td>
                            <td class="border border-gray-300 p-2 text-center text-gray-700">{{ $course['points'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class=" text-center my-4 font-bold text-2xl text-black-700">GPA : {{ $semester['gpa'] }}</div>

            @if($index < count($semesters) - 1)
            <div class="h-1 w-7/5 mx-auto my-6 bg-gradient-to-r from-transparent via-gray-600 to-transparent"></div>
    @endif
        </div>
        @endforeach
    </div>

    <footer class="bg-blue-600 p-2 mt-20 shadow-md text-center">
        <h4 class="font-bold text-2xl mb-4 mt-4 text-white">Learning Management System</h4>
        <p class="text-white text-xl">&copy; 2025 LMS. All Rights Reserved.</p>
        <p class="text-white text-xl">Sameer | Ali | Sharjeel</p>
    </footer>
</body>
</html>