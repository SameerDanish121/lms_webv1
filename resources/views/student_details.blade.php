<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Dashboard</title>
    @vite('resources/css/app.css')
    <script>
        function toggleMenu() {
            document.getElementById("mobileMenu").classList.toggle("hidden");
        }

    </script>
</head>

@php
$profileImage = asset('images/male.png');
@endphp

<body class="bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100 min-h-screen p-0 m-0">

    @include('components.navbar', [
    'username' => session('username', 'Guest'),
    'profileImage' => session('profileImage', asset('images/male.png')),
    'designation' => session('designation', 'N/A'),
    'type' => session('userType', 'User')
    ])

    <div class="flex justify-center items-center min-h-screen bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl text-center">

            <div class="flex flex-col items-center">
                <img src="{{ !empty($student['image'] ) ? $student['image']  : asset('images/male.png') }}" alt="{{asset('images/male.png')}}" class="w-40 h-40 rounded-full border-4 border-blue-500 shadow-md">
                <h2 class="text-3xl font-bold mt-4">{{ $student['name'] }}</h2>
                <p class="text-gray-600 text-lg">{{ $student['RegNo'] }}</p>
            </div>

            <div class="mt-6 text-left">
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex justify-between w-full">
                        <p class="text-lg font-semibold w-1/2">Father's Name:</p>
                        <p class="text-lg w-1/2">{{ $student['guardian'] }}</p>
                    </div>
                    <div class="flex justify-between w-full">
                        <p class="text-lg font-semibold w-1/2">CGPA:</p>
                        <p class="text-lg w-1/2">{{ $student['cgpa'] }}</p>
                    </div>
                    <div class="flex justify-between w-full">
                        <p class="text-lg font-semibold w-1/2">Gender:</p>
                        <p class="text-lg w-1/2">{{ $student['gender'] }}</p>
                    </div>
                    <div class="flex justify-between w-full">
                        <p class="text-lg font-semibold w-1/2">Date of Birth:</p>
                        <p class="text-lg w-1/2">{{ $student['date_of_birth'] }}</p>
                    </div>
                    <div class="flex justify-between w-full">
                        <p class="text-lg font-semibold w-1/2">Program:</p>
                        <p class="text-lg w-1/2">{{ $student['program']['name'] }}</p>
                    </div>
                    <div class="flex justify-between w-full">
                        <p class="text-lg font-semibold w-1/2">Semester & Section:</p>
                        <p class="text-lg w-1/2">{{ $student['section']['semester'] }}{{ $student['section']['group'] }}</p>
                    </div>
                    <div class="flex justify-between w-full">
                        <p class="text-lg font-semibold w-1/2">Session:</p>
                        <p class="text-lg w-1/2">{{ $student['session']['name'] }} - {{ $student['session']['year'] }}</p>
                    </div>
                    <div class="flex justify-between w-full">
                        <p class="text-lg font-semibold w-1/2">Program Description:</p>
                        <p class="text-lg w-1/2">{{ $student['program']['description'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
