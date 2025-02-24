<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    @vite('resources/css/app.css')
    <style>
        @media (min-width: 1024px) {
            table {
                font-size: 18px;
                width: 98%;
            }

            th,
            td {
                padding: 12px;
            }
        }

        @media (max-width: 768px) {
            .table-container {
                width: 100%;
                overflow-x: auto;
            }

            table {
                width: 100%;
                font-size: 14px;
                min-width: 800px;
            }

            th,
            td {
                padding: 8px;
            }
        }

    </style>
</head>
@php
$profileImage= asset('images/male.png');
@endphp
<body class="bg-gray-100">
    @include('components.navbar', [
    'username' => session('username', 'Guest'),
    'profileImage' => session('profileImage', asset('images/male.png')),
    'designation' => session('designation', 'N/A'),
    'type' => session('type', 'User')
    ])
        <div class="container mx-auto p-4">
            <h2 class="text-xl font-bold text-center mb-4">Time Table: BCS-8B</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-400 text-center">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-400 p-2"></th>
                            <th class="border border-gray-400 p-2">Monday</th>
                            <th class="border border-gray-400 p-2">Tuesday</th>
                            <th class="border border-gray-400 p-2">Wednesday</th>
                            <th class="border border-gray-400 p-2">Thursday</th>
                            <th class="border border-gray-400 p-2">Friday</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $schedule = [
                                '8:30 - 9:30' => ['', '', '', '', ''],
                                '9:30 - 10:30' => ['', '', '', '', ''],
                                '10:30 - 11:30' => ['', '', '', '', ''],
                                '11:30 - 12:30' => ['', '', '', '', ''],
                                '12:30 - 1:30' => ['', '', '', '', ''],
                                '2:00 - 3:00' => ['', '', 'TOQ-202_TOQ-4_50 (Abdul Hameed)_Lt10', '', ''],
                                '3:00 - 4:00' => ['', '', 'CS497_IS_50 (Attia)_Lt11', '', ''],
                                '4:00 - 5:00' => ['', 'CS497_IS_50 (Attia)_Lt7', '', '', 'CS497_IS_50 (Attia)_Lt14'],
                                '5:00 - 6:00' => ['', '', '', '', '']
                            ];
                        @endphp
                        
                        @foreach($schedule as $time => $days)
                            <tr>
                                <td class="border border-gray-400 p-2 font-bold whitespace-nowrap">{{ $time }}</td>
                                @foreach($days as $event)
                                    <td class="border border-gray-400 p-2 whitespace-normal break-words max-w-xs">{{ $event }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>       
</body>
</html>
