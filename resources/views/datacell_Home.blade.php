{{--
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
    <style>
        @keyframes marquee {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-100%);
            }
        }

        .marquee-container {
            display: flex;
            min-width: 200%;
            animation: marquee 50s linear infinite;
        }

        .relative:hover .marquee-container {
            animation-play-state: paused;
        }

        .btn-hover:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .nav-item {
            position: relative;
            color: #4b5563;
            font-weight: 600;
            transition: color 0.3s ease-in-out;
        }

        .nav-item:hover {
            color: #1d4ed8;
        }

        .nav-item::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -2px;
            width: 0;
            height: 2px;
            background-color: #1d4ed8;
            transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
        }

        .nav-item:hover::after {
            width: 100%;
            left: 0;
        }
    </style>
</head>
@php
$profileImage = session('profileImage', asset('images/male.png'));
$userName = session('username', 'Guest');
$designation = session('designation', 'N/A');
$type=session('userType', 'User');
$imagePath = asset('images/male.png');
@endphp

<body class="bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100 min-h-screen p-0 m-0">
    @include('components.navbar', [
    'username' => session('username', 'Guest'),
    'profileImage' => session('profileImage', asset('images/male.png')),
    'designation' => session('designation', 'N/A'),
    'type' => session('userType', 'User')
    ])
    <div class="max-w-6xl mx-auto mb-1 mt-6 p-6 rounded-2xl shadow-lg text-center fade-in backdrop-blur-lg border border-white/10"
        style="background: linear-gradient(to bottom right, rgba(0, 198, 255, 0.8), rgba(0, 114, 255, 0.8), rgba(30, 61, 143, 0.8));">
        <img src="{{$profileImage}}" alt="{{$imagePath}}"
class="mx-auto rounded-full border-4 border-white shadow-lg w-24 h-24 object-cover">
<h2 class="text-white text-2xl font-bold mt-3">{{ $userName }}</h2>
<p class="text-white opacity-80">{{ $type}}</p>
<form action="{{ route('profile') }}" method="GET">
    <button type="submit" class="account-btn text-white px-6 py-3 mt-4 rounded-full bg-white/20 hover:bg-white/30 transition-all duration-300 shadow-lg">
        Go to Profile
    </button>
</form>
</div>
<div class="relative w-full max-w-8xl overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-800 text-white shadow-lg rounded-lg border border-white/10 mx-auto py-4">
    <div class="marquee-container flex space-x-16 whitespace-nowrap text-lg font-semibold tracking-wide">
        <div class="marquee flex space-x-20">
            <span>🚀 Semester Registrations Open</span>
            <span>🏛️ Fee Deadline: 15 Feb 2025</span>
            <span>🎓 Convocation: 20 March 2025</span>
            <span>📢 Students Week Soon</span>
            <span>📝 Mids : 25 March 2025</span>
        </div>
        <div class="marquee flex space-x-16">
            <span>🚀 Semester Registrations Open</span>
            <span>🏛️ Fee Deadline: 15 Feb 2025</span>
            <span>🎓 Convocation: 20 March 2025</span>
            <span>📢 New Student Portal Launched!</span>
            <span>📝 Exam Forms Submission Ends Soon</span>
        </div>
    </div>
</div>
</div>

<!-- Original buttons section -->
<div class="max-w-5xl mx-auto mt-6 flex items-center">
    <button id="prevBtn" class="bg-white p-3 md:p-4 rounded-lg shadow-md text-center btn-hover mr-2 md:mr-5">⬅️</button>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 flex-1" id="cardContainer">
        <!-- Button 1 -->
        <a href="{{route('show.timetable')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">📑</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Upload Timetable</p>
        </a>

        <!-- Button 2 -->
        <a href="{{route('show.student_upload')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👨‍🎓</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Add Students</p>
        </a>
        <a href="{{route ('show.excel_teacher')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👨‍🏫</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Add Teachers</p>
        </a>
        <a href="{{route ('show.excel_junior')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👨‍🏫</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Add Junior Lecturer</p>
        </a>
        <a href="{{route ('show.excel_venue')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👨‍🏫</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Add Venue</p>
        </a>
        <a href="{{route ('show.excel_course')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👨‍🏫</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Add Course</p>
        </a>
        <a href="{{route ('show.excel_session')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👨‍🏫</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Add Session</p>
        </a>
        <a href="{{route ('show.excel_excludedDays')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👨‍🏫</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Add Excluded Days</p>
        </a>
        <a href="{{route ('show.excel_sections')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👨‍🏫</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Add Section Data</p>
        </a>


        <!-- Button 3 -->
        <a href="{{ route('allcourses') }}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">📚</span>
            <p class="mt-2 font-bold text-xs md:text-sm">All Courses</p>
        </a>
        <a href="{{ route('full.timetable') }}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">📚</span>
            <p class="mt-2 font-bold text-xs md:text-sm">All Courses</p>
        </a>
        <!-- Button 4 -->
        <a href="" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">🎓</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Assign Courses</p>
        </a>

        <!-- Button 5 -->
        <a href="" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👨‍🏫</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Teachers</p>
        </a>
        <!-- Button 6 -->
        <a href="{{route('allstudents')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👨‍🎓</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Students</p>
        </a>
    </div>
    <!-- Next Button: Positioned to the right outside the card with margin -->
    <button id="nextBtn" class="bg-white p-3 md:p-4 rounded-lg shadow-md text-center btn-hover ml-2 md:ml-5">
        <span>➡️</span>
    </button>
</div>

<!-- NEW SECTION: View Functionality Buttons -->
<div class="max-w-5xl mx-auto mt-10 flex items-center">
    <button id="prevBtnView" class="bg-white p-3 md:p-4 rounded-lg shadow-md text-center btn-hover mr-2 md:mr-5">⬅️</button>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 flex-1" id="viewCardContainer">
        <!-- View Button 1 -->
        <a href="{{ route('full.timetable') }}" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">📅</span>
            <p class="mt-2 font-bold text-xs md:text-sm">View Timetable</p>
        </a>
        <a href="" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">🔍</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Search Students</p>
        </a>




        <a href="{{ route('allcourses') }}" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">📚</span>
            <p class="mt-2 font-bold text-xs md:text-sm">View Courses</p>
        </a>

        <!-- View Button 4 -->
        <a href="" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👨‍🏫</span>
            <p class="mt-2 font-bold text-xs md:text-sm">View Teachers</p>
        </a>

        <!-- View Button 5 -->
        <a href="" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">🏢</span>
            <p class="mt-2 font-bold text-xs md:text-sm">View Venues</p>
        </a>

        <!-- View Button 6 -->
        <a href="" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👥</span>
            <p class="mt-2 font-bold text-xs md:text-sm">View Sections</p>
        </a>
        <a href="{{ route('allstudents') }}" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">👨‍🎓</span>
            <p class="mt-2 font-bold text-xs md:text-sm">View Students</p>
        </a>


        <a href="" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
            <span class="text-4xl">📊</span>
            <p class="mt-2 font-bold text-xs md:text-sm">Reports</p>
        </a>
    </div>
    <!-- Next Button for View section -->
    <button id="nextBtnView" class="bg-white p-3 md:p-4 rounded-lg shadow-md text-center btn-hover ml-2 md:ml-5">
        <span>➡️</span>
    </button>
</div>
<br />
<br />
<div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Card 1 -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Full Timetable</h2>
        <p class="text-gray-600 mt-2">Click below to View Full Timetable.</p>
        <a href="{{ route('full.timetable') }}" class="mt-4 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition">
            Click Me ➡️
        </a>
    </div>

    <!-- Card 2 -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Teacher</h2>
        <p class="text-gray-600 mt-2">Click below to Add New Teacher</p>
        <a href="{{route('add.teacher')}}" class="mt-4 inline-block bg-green-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-600 transition">
            Click Me ➡️
        </a>
    </div>

    <!-- Card 3 -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Junior Lecturer</h2>
        <p class="text-gray-600 mt-2">Click below to Add New Junior Lecturer</p>
        <a href="{{route('add.junior')}}" class="mt-4 inline-block bg-red-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-red-600 transition">
            Click Me ➡️
        </a>
    </div>

    <!-- Card 4 -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Datacell</h2>
        <p class="text-gray-600 mt-2">Click below to Add New Datacell</p>
        <a href="{{route('add.datacell')}}" class="mt-4 inline-block bg-yellow-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-yellow-600 transition">
            Click Me ➡️
        </a>
    </div>

    <!-- Card 5 -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Admin</h2>
        <p class="text-gray-600 mt-2">Click below to Add New Admin</p>
        <a href="{{route('add.admin')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Student</h2>
        <p class="text-gray-600 mt-2">Click below to Add New Student</p>
        <a href="{{route('add.student')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Teacher Offered Course</h2>
        <p class="text-gray-600 mt-2">Click below to Upload Course for Session with Teacher Allocation</p>
        <a href="{{route('show.offered_Course')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Enrollments</h2>
        <p class="text-gray-600 mt-2">Click below to Upload Student Enrollments is a Session</p>
        <a href="{{route('show.enrollments')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Grader and Assign to Teacher</h2>
        <p class="text-gray-600 mt-2">Click below to Upload Student Grader Assign </p>
        <a href="{{route('show.grader')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Junior Course Allocaion List </h2>
        <p class="text-gray-600 mt-2">Click below to Junior Course Allocation List </p>
        <a href="{{route('show.junior_courseAllocation')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Topic For A Course Per Week </h2>
        <p class="text-gray-600 mt-2">Click below to Add Topics</p>
        <a href="{{route('show.topic_coursePerWeek')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Full Subject Result List </h2>
        <p class="text-gray-600 mt-2">Click below to Add Full Award List of A Section and Subject
            (MID/FINAL/LAB/INTERNAL/GRADE)</p>
        <a href="{{route('show.subject_result')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Full Subject Exam List </h2>
        <p class="text-gray-600 mt-2">Click below to Add Obtained Marks of a Section Question Wise</p>
        <a href="{{route('show.exam_marks')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Exam</h2>
        <p class="text-gray-600 mt-2">Click below to Add Exam and Question</p>
        <a href="{{route('add.exam')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Course Content</h2>
        <p class="text-gray-600 mt-2">Click below to Add Course Content</p>
        <a href="{{route('add.course_content')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">View All Teacher</h2>
        <p class="text-gray-600 mt-2">Click below to View List Of Teacher</p>
        <a href="{{route('all.teacher')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">View All Junior Lecturer</h2>
        <p class="text-gray-600 mt-2">Click below to View List Of Junior Lecturer</p>
        <a href="{{route('all.junior')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">View All Grader List</h2>
        <p class="text-gray-600 mt-2">Click below to View List Of Grader</p>
        <a href="{{route('all.grader')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">View All Session List</h2>
        <p class="text-gray-600 mt-2">Click below to View List Of Sessions</p>
        <a href="{{route('all.session')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">View All Course List</h2>
        <p class="text-gray-600 mt-2">Click below to View List Of Course</p>
        <a href="{{route('all.course')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">View All Student List</h2>
        <p class="text-gray-600 mt-2">Click below to View List Of Student</p>
        <a href="{{route('all.student')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">View All Archives List</h2>
        <p class="text-gray-600 mt-2">Click below to View List Of Folders</p>
        <a href="{{route('all.archives')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">View All Temporary Enrollments Request</h2>
        <p class="text-gray-600 mt-2">Click below to View List Of Temporary Enrollments</p>
        <a href="{{route('temp.enroll')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">View All Course Content</h2>
        <p class="text-gray-600 mt-2">Click below to View List Of Course Content</p>
        <a href="{{route('all.course_content')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">View All Course Allocation in Session</h2>
        <p class="text-gray-600 mt-2">Click below to View List Of Course Allocation</p>
        <a href="{{route('all.course_allocation')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>

</div>


<div class=" max-w-6xl mx-auto grid grid-cols-2 gap-4 mt-4">
    <button class="btn-hover bg-blue-600 text-white p-6 rounded-lg text-center">
        <p class="font-bold">Offered Courses</p>
        <p class="text-3xl font-bold">33</p>
    </button>
    <button class="btn-hover bg-blue-600 text-white p-6 rounded-lg text-center">
        <p class="font-bold">Total Courses</p>
        <p class="text-3xl font-bold">60</p>
    </button>
</div>
</div>
<div class="max-w-6xl mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bg-white text-black p-6 rounded-lg">
        <h3 class="text-lg font-bold ">Students</h3>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <button class="bg-blue-600 p-6 rounded-lg text-center text-white btn-hover">
                <p class="font-bold">Graduate</p>
                <p class="text-3xl font-bold">700</p>
            </button>
            <button class="bg-blue-600 p-6 rounded-lg text-white text-center btn-hover">
                <p class="font-bold">Under-Graduate</p>
                <p class="text-3xl font-bold">2056</p>
            </button>
        </div>
    </div>
    <div class="bg-white text-black p-6 rounded-lg">
        <h3 class="text-lg font-bold">Teachers</h3>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <button class="bg-blue-600 p-6 rounded-lg text-center btn-hover">
                <p class="font-bold text-white">Lecturer</p>
                <p class="text-3xl font-bold text-white">26</p>
            </button>
            <button class="bg-blue-600 p-6 rounded-lg text-center btn-hover">
                <p class="font-bold text-white">Junior Lecturer</p>
                <p class="text-3xl font-bold text-white">12</p>
            </button>
        </div>
    </div>
</div>
<footer class="bg-blue-600 p-2 mt-20 shadow-md text-center">
    <h4 class=" font-bold text-2xl mb-4 mt-4 text-white">Learning Management System</h4>
    <p class="text-white text-1xl">&copy; 2025 LMS. All Rights Reserved.</p>
    <p class="text-white text-1xl">Sameer | Ali | Sharjeel</p>
</footer>
</body>
<script>
    let currentIndex = 0;
    const buttons = document.querySelectorAll(".btn-card");
    const visibleCount = 4;

    function updateVisibility() {
        buttons.forEach((btn, index) => {
            btn.classList.toggle("hidden", index < currentIndex || index >= currentIndex + visibleCount);
        });
    }

    document.getElementById("prevBtn").addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex -= 1;
            updateVisibility();
        }
    });

    document.getElementById("nextBtn").addEventListener("click", () => {
        if (currentIndex + visibleCount < buttons.length) {
            currentIndex += 1;
            updateVisibility();
        }
    });

    updateVisibility();


    let currentViewIndex = 0;
    const viewButtons = document.querySelectorAll(".view-btn-card");
    const viewVisibleCount = 4;

    function updateViewVisibility() {
        viewButtons.forEach((btn, index) => {
            btn.classList.toggle("hidden", index < currentViewIndex || index >= currentViewIndex + viewVisibleCount);
        });
    }

    document.getElementById("prevBtnView").addEventListener("click", () => {
        if (currentViewIndex > 0) {
            currentViewIndex -= 1;
            updateViewVisibility();
        }
    });

    document.getElementById("nextBtnView").addEventListener("click", () => {
        if (currentViewIndex + viewVisibleCount < viewButtons.length) {
            currentViewIndex += 1;
            updateViewVisibility();
        }
    });

    updateViewVisibility();

</script>

</html>
--}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Dashboard</title>
    @vite('resources/css/app.css')
    <style>
        /* Animation keyframes */
        @keyframes marquee {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-100%);
            }
        }

        /* Marquee styling */
        .marquee-container {
            display: flex;
            min-width: 200%;
            animation: marquee 50s linear infinite;
        }

        .marquee-container:hover {
            animation-play-state: paused;
        }

        /* Button animations */
        .btn-hover {
            transition: all 0.2s ease-in-out;
        }

        .btn-hover:hover {
            transform: scale(1.03);
        }

        /* Card styling */
        .card-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: white;
            border-radius: 0.75rem;
            padding: 1rem;
            min-height: 100px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
            color: #374151;
        }

        .card-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .card-button-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .card-button-text {
            font-weight: 500;
            text-align: center;
            font-size: 0.875rem;
        }

        /* Button container */
        .button-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1rem;
            transition: transform 0.3s ease;
        }

        /* Navigation buttons */
        .nav-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-button:hover {
            background-color: #f3f4f6;
            transform: scale(1.05);
        }

        .nav-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Pagination styling */
        .pagination-indicator {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .pagination-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #CBD5E0;
            transition: background-color 0.3s ease, transform 0.3s ease;
            cursor: pointer;
        }

        .pagination-dot.active {
            background-color: #3B82F6;
            transform: scale(1.3);
        }

        /* Section styling */
        .button-carousel {
            margin-bottom: 2rem;
            background-color: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Storage visualization */
        .progress-circle-container {
            position: relative;
            width: 160px;
            height: 160px;
            margin: 0 auto;
        }

        .progress-circle-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Memory section styling */
        .memory-section {
            background-color: #f9fafb;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 4px solid;
        }

        .temporary-memory {
            border-left-color: #EF4444;
        }

        .permanent-memory {
            border-left-color: #10B981;
        }

        .memory-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .memory-item:last-child {
            border-bottom: none;
        }

        /* Stats card styling */
        .stat-card {
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background-color: white;
        }

        .stat-header {
            padding: 1rem;
            color: white;
            font-weight: 600;
        }

        .stat-content {
            padding: 1rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        .stat-item {
            border-radius: 0.5rem;
            padding: 1rem;
            text-align: center;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #6B7280;
            margin-bottom: 0.25rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* Responsive styling */
        @media (max-width: 1024px) {
            .button-container {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 768px) {
            .button-container {
                grid-template-columns: repeat(3, 1fr);
            }

            .card-button {
                min-height: 90px;
                padding: 0.75rem;
            }

            .card-button-icon {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 640px) {
            .button-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .card-button {
                min-height: 80px;
                padding: 0.5rem;
            }

            .card-button-text {
                font-size: 0.75rem;
            }
        }

        /* Footer styling */
        footer {
            background: linear-gradient(to right, #2563EB, #4F46E5);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
            border-radius: 1rem 1rem 0 0;
        }

        .btn-action {
            display: flex;
            align-items: center;
            justify-center;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .button-container {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            /* Ensures 4 buttons in a row */
            gap: 8px;
        }

        @media (max-width: 768px) {
            .button-container {
                grid-template-columns: repeat(1, minmax(0, 1fr));
                /* Keeps 4 buttons per row on mobile */
            }
        }

    </style>
    <script>
        const MAX_STORAGE = 50 * 1024; // 50 GB in MB
        let folderSizeMB = 0; // Storage in MB
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

        function convertToMB(sizeString) {
            let size = parseFloat(sizeString);
            if (sizeString.includes("TB")) {
                return size * 1024 * 1024; // Convert TB to MB
            } else if (sizeString.includes("GB")) {
                return size * 1024; // Convert GB to MB
            } else if (sizeString.includes("KB")) {
                return size / 1024; // Convert KB to MB
            }
            return size; // Already in MB
        }

        async function loadFolderDetails() {
            API_BASE_URL = await getApiBaseUrl();
            try {
                const response = await fetch(`${API_BASE_URL}api/Archives/Directory`);
                const data = await response.json();

                if (data.details) {
                    folderSizeMB = convertToMB(data.total_size);
                    document.getElementById("folderSize").innerText = data.total_size;
                    document.getElementById("totalSizeText").innerText = `of 50 GB`;

                    updateProgressBar();
                    renderFolders(data.details);
                }
            } catch (error) {
                console.error("Error fetching folder details:", error);
            }
        }

        function updateProgressBar() {
            let usagePercent = (folderSizeMB / MAX_STORAGE) * 100;
            let progressOffset = 251.2 - (251.2 * (usagePercent / 100));

            document.getElementById("progressCircle").setAttribute("stroke-dashoffset", progressOffset);

            let warningText = document.getElementById("warningMessage");
            if (folderSizeMB >= 10 * 1024) { // 10GB warning
                warningText.innerText = "⚠️ Warning: You are nearing your storage limit!";
                warningText.classList.remove("hidden");
            } else {
                warningText.classList.add("hidden");
            }
        }

        function renderFolders(folders) {
            let temporaryMemory = document.getElementById("temporaryMemory");
            let permanentMemory = document.getElementById("permanentMemory");

            temporaryMemory.innerHTML = "";
            permanentMemory.innerHTML = "";

            folders.forEach(folder => {
                let folderItem = document.createElement("div");
                folderItem.className = "flex justify-between p-3 border-b";

                if (folder.folder_name === "Transcript") {
                    folderItem.innerHTML = `
                        <span>${folder.folder_name}</span>
                        <span>${folder.size}</span>
                        <button class="bg-red-500 text-white px-3 py-1 rounded" onclick="cleanTemporaryMemory()">Clean</button>
                    `;
                    temporaryMemory.appendChild(folderItem);
                } else {
                    folderItem.innerHTML = `
                        <a href="${API_BASE_URL}folder/${folder.folder_name}" class="text-blue-500">
                            ${folder.folder_name}
                        </a>
                        <span>${folder.size}</span>
                        <button class="bg-green-500 text-white px-3 py-1 rounded" onclick="compressFolder('${folder.path}')">Compress</button>
                    `;
                    permanentMemory.appendChild(folderItem);
                }
            });
        }

        async function compressFolder(folderPath) {
            try {
                // Prepare API request payload
                let formData = new FormData();
                formData.append("folder_path", folderPath);
                API_BASE_URL = await getApiBaseUrl();
                // Send POST request to API
                let response = await fetch(`${API_BASE_URL}api/Archives/compress-folder`, {
                    method: "POST"
                    , body: formData
                , });

                // Parse JSON response
                let data = await response.json();

                // Handle response
                if (response.ok) {
                    alert(
                        `✅ Compression Successful!\n\n` +
                        `📂 Folder Path: ${data.folder_path}\n` +
                        `📁 Total Files: ${data.total_files}\n` +
                        `📉 Compressed Files: ${data.compressed_files}\n` +
                        `⏳ Size Before: ${data.size_before}\n` +
                        `⚡ Size After: ${data.size_after}\n` +
                        `🔥 Size Reduced: ${data.size_reduced}`
                    );
                } else {
                    alert(`❌ Compression Failed!\nError: ${data.message}`);
                }
            } catch (error) {
                alert(`❌ API Request Failed!\nError: ${error.message}`);
            }
        }

        async function cleanTemporaryMemory() {
            showLoader();
            if (!confirm("Are you sure you want to clean the Transcript folder? This action cannot be undone.")) {
                hideLoader();
                return;
            }
            try {
                API_BASE_URL = await getApiBaseUrl();
                const response = await fetch(`${API_BASE_URL}api/Archives/clean-transcript`, {
                    method: "DELETE"
                    , headers: {
                        "Content-Type": "application/json"
                    , }
                , });

                const result = await response.json();

                if (response.ok) {
                    hideLoader();
                    alert("Temporary memory cleaned successfully!");
                    loadFolderDetails();
                } else {
                    hideLoader();
                    alert("Error: " + result.message);
                }
            } catch (error) {
                hideLoader();
                console.error("Error cleaning temporary memory:", error);
                alert("Failed to clean temporary memory. Please try again.");
            }
        }
        window.onload = loadFolderDetails;

    </script>
</head>

<body class="bg-gradient-to-r from-blue-50 to-indigo-50 min-h-screen">
    @include('components.navbar')
    <div class="max-w-7xl mx-auto px-3 py-3">

        <!-- Announcement Banner -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-md rounded-xl overflow-hidden mb-8">
            <div class="marquee-container flex space-x-16 whitespace-nowrap text-sm md:text-base font-medium px-4 py-3">
                <div class="marquee flex space-x-20">
                    <span>🚀 Current Session : {{session('currentSession')}}</span>
                    <span>🏛️ Session Start Date : {{session('startDate')}}</span>
                    <span>🎓 Session End Date : {{session('endDate')}}</span>
                    <span>📢 Students Week Soon</span>
                    <span>📝 Mids: 25 March 2025</span>
                </div>
                <div class="marquee flex space-x-16">
                    <span>🚀 Current Session : {{session('currentSession')}}</span>
                    <span>🏛️ Session Start Date : {{session('startDate')}}</span>
                    <span>🎓 Session End Date : {{session('endDate')}}</span>
                    <span>📢 New Student Portal Launched!</span>
                    <span>📝 Exam Forms Submission Ends Soon</span>
                </div>
            </div>
        </div>
        <div class=" grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Storage Stats Card -->
            <div class="bg-gradient-to-r from-blue-400 via-blue-300 to-white rounded-xl shadow-md p-2">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Storage Overview</h2>

                <div class="progress-circle-container mb-6">
                    <div class="progress-circle-content">
                        <span id="folderSize" class="text-xl font-bold text-blue-600">0 MB</span>
                        <span id="totalSizeText" class="text-sm text-gray-500">of 50 GB</span>
                    </div>
                    <svg class="w-full h-full" viewBox="0 0 100 100">
                        <circle class="text-gray-100" stroke-width="10" stroke="currentColor" fill="transparent" r="40" cx="50" cy="50"></circle>
                        <circle id="progressCircle" class="text-blue-500 transition-all duration-500 ease-out" stroke-width="10" stroke="currentColor" fill="transparent" r="40" cx="50" cy="50" stroke-dasharray="251.2" stroke-dashoffset="251.2" stroke-linecap="round"></circle>
                    </svg>
                </div>

                <p id="warningMessage" class="text-red-600 font-semibold text-center mb-4 bg-red-50 p-2 rounded-md hidden">
                    ⚠️ Warning: You are nearing your storage limit!
                </p>

                <div class="space-y-4">
                    <div class="memory-section temporary-memory">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <span class="inline-block w-3 h-3 bg-red-400 rounded-full mr-2"></span>
                            Temporary Memory
                        </h3>
                        <div id="temporaryMemory" class="space-y-2"></div>
                    </div>

                    <div class="memory-section permanent-memory">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <span class="inline-block w-4 h-3 bg-green-400 rounded-full mr-2"></span>
                            Permanent Memory
                        </h3>
                        <div id="permanentMemory" class="space-y-2"></div>
                    </div>
                </div>
            </div>

            <!-- Stats and Management Container -->
            <div class="md:col-span-2 space-y-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="stat-card">
                        <div class="stat-header bg-blue-600">
                            <h3 class="text-white font-semibold">Courses</h3>
                        </div>
                        <div class="stat-content">
                            <div class="stat-item bg-blue-50">
                                <p class="stat-label">Offered</p>
                                <p class="stat-value text-blue-700">{{session('offer_count')}}</p>
                            </div>
                            <div class="stat-item bg-blue-50">
                                <p class="stat-label">Total</p>
                                <p class="stat-value text-blue-700">{{session('course_count')}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header bg-blue-600">
                            <h3 class="text-white font-semibold">People</h3>
                        </div>
                        <div class="stat-content">
                            <div class="stat-item bg-blue-50">
                                <p class="stat-label">Students</p>
                                <p class="stat-value text-blue-700">{{session('student_count')}}</p>
                            </div>
                            <div class="stat-item bg-blue-50">
                                <p class="stat-label">Faculty</p>
                                <p class="stat-value text-blue-700">{{session('faculty_count')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-2 bg-white rounded-xl shadow-lg p-6 text-center">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{route('all.student')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Students
                        </a>
                        <a href="{{route('all.course')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Courses
                        </a>
                        <a href="{{route('all.teacher')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Teachers
                        </a>
                        <a href="{{route('show.enrollments')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            Pending Enrollments
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                        <a href="{{route('all.junior')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Junior Lecturers
                        </a>
                        <a href="{{route('all.session')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            Mark Sessions
                        </a>
                        <a href="{{route('all.archives')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            Archives?
                        </a>
                        <a href="{{route('temp.enroll')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Temporary Enrollments
                        </a>
                    </div>
                </div>

                <div class="md:col-span-2 bg-white rounded-xl shadow-lg p-6 mt-6 text-center">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Manage Users</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{route('add.admin')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-orange-500 hover:bg-orange-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            Add Admin
                        </a>
                        <a href="{{route('add.student')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-orange-500 hover:bg-orange-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            Add Students
                        </a>
                        <a href="{{route('add.datacell')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-orange-500 hover:bg-orange-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            Add Datacell
                        </a>
                        <a href="{{route('add.teacher')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-orange-500 hover:bg-orange-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            Add Teacher
                        </a>
                        <a href="{{route('add.junior')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-orange-500 hover:bg-orange-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            Add Junior Lecturer
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <section class="button-carousel m-5">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="inline-block w-6 h-6 bg-blue-500 rounded-md mr-2 flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                </svg>
            </span>
            Data Management
        </h2>

        <div class="relative flex items-center">
            <button id="prevBtn" class="nav-button mr-2 md:mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="overflow-hidden flex-1">
                <div id="cardContainer" class="button-container">
                    <!-- Upload Timetable -->
                    <a href="{{route('show.timetable')}}" class="card-button">
                        <span class="card-button-icon">📑</span>
                        <p class="card-button-text">Upload Timetable</p>
                    </a>

                    <!-- Add Students -->
                    <a href="{{route('show.student_upload')}}" class="card-button">
                        <span class="card-button-icon">👨‍🎓</span>
                        <p class="card-button-text">Add Students</p>
                    </a>

                    <!-- Add Teachers -->
                    <a href="{{route('show.excel_teacher')}}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Add Teachers</p>
                    </a>

                    <!-- Add Junior Lecturer -->
                    <a href="{{route('show.excel_junior')}}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Add Junior Lecturer</p>
                    </a>

                    <!-- Add Venue -->
                    <a href="{{route('show.excel_venue')}}" class="card-button">
                        <span class="card-button-icon">🏢</span>
                        <p class="card-button-text">Add Venue</p>
                    </a>

                    <!-- Add Course -->
                    <a href="{{route('show.excel_course')}}" class="card-button">
                        <span class="card-button-icon">📚</span>
                        <p class="card-button-text">Add Course</p>
                    </a>

                    <!-- Add Session -->
                    <a href="{{route('show.excel_session')}}" class="card-button">
                        <span class="card-button-icon">🗓️</span>
                        <p class="card-button-text">Add Session</p>
                    </a>

                    <!-- Add Excluded Days -->
                    <a href="{{route('show.excel_excludedDays')}}" class="card-button">
                        <span class="card-button-icon">📅</span>
                        <p class="card-button-text">Add Excluded Days</p>
                    </a>

                    <!-- Add Section Data -->
                    <a href="{{route('show.excel_sections')}}" class="card-button">
                        <span class="card-button-icon">🔢</span>
                        <p class="card-button-text">Add Section Data</p>
                    </a>

                    <a href="{{route('show.excel_excludedDays')}}" class="card-button">
                        <span class="card-button-icon">🔢</span>
                        <p class="card-button-text">Add Excluded Days</p>
                    </a>

                    <a href="{{route('add.datacell')}}" class="card-button">
                        <span class="card-button-icon">🔢</span>
                        <p class="card-button-text">Add DataCell</p>
                    </a>

                    <a href="{{route('add.admin')}}" class="card-button">
                        <span class="card-button-icon">🔢</span>
                        <p class="card-button-text">Add Admin</p>
                    </a>
                </div>
            </div>

            <button id="nextBtn" class="nav-button ml-2 md:ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="pagination-indicator" id="paginationIndicator">
            <!-- Pagination dots will be added dynamically -->
        </div>
    </section>
    <section class="button-carousel m-5">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="inline-block w-6 h-6 bg-indigo-500 rounded-md mr-2 flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </span>
            View Information
        </h2>

        <div class="relative flex items-center">
            <button id="prevBtnView" class="nav-button mr-2 md:mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="overflow-hidden flex-1">
                <div id="viewCardContainer" class="button-container">
                    <!-- All Courses -->
                    <a href="{{ route('allcourses') }}" class="card-button">
                        <span class="card-button-icon">📚</span>
                        <p class="card-button-text">All Courses</p>
                    </a>
                    <a href="{{ route('allcourses') }}" class="card-button">
                        <span class="card-button-icon">📚</span>
                        <p class="card-button-text">Assign Courses</p>
                    </a>

                    <!-- View Timetable -->
                    <a href="{{ route('full.timetable') }}" class="card-button">
                        <span class="card-button-icon">📊</span>
                        <p class="card-button-text">View Timetable</p>
                    </a>

                    <!-- View Students -->
                    <a href="{{route('datacell.student')}}" class="card-button">
                        <span class="card-button-icon">👨‍🎓</span>
                        <p class="card-button-text">View Students</p>
                    </a>

                    <!-- View Teachers -->
                    <a href="{{ route('all.teacher') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">View Teachers</p>
                    </a>
                    <a href="{{ route('show.offered_Course') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Teacher Offered Courses</p>
                    </a>
                    <a href="{{ route('show.enrollments') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Enrollments</p>
                    </a>

                    <a href="{{ route('all.grader') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Add / Assign Graders</p>
                    </a>

                    <!-- View All Junior Lecturers -->
                    <a href="{{route('all.junior')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Junior Lecturers</p>
                    </a>
                </div>
            </div>

            <button id="nextBtnView" class="nav-button ml-2 md:ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="pagination-indicator" id="viewPaginationIndicator">
            <!-- View pagination dots will be added dynamically -->
        </div>
    </section>


    <section class="button-carousel m-5">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="inline-block w-6 h-6 bg-green-500 rounded-md mr-2 flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </span>
            Additional Information
        </h2>

        <div class="relative flex items-center">
            <button id="prevBtnView3" class="nav-button mr-2 md:mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="overflow-hidden flex-1">
                <div id="viewCardContainer3" class="button-container">
                    <!-- All Courses -->
                    <a href="{{ route('show.topic_coursePerWeek') }}" class="card-button">
                        <span class="card-button-icon">📚</span>
                        <p class="card-button-text">Add Topic for Course</p>
                    </a>

                    <!-- View Timetable -->
                    <a href="{{ route('show.subject_result') }}" class="card-button">
                        <span class="card-button-icon">📊</span>
                        <p class="card-button-text">Add Full Subject Result List</p>
                    </a>

                    <!-- View Students -->
                    <a href="{{route('show.exam_marks')}}" class="card-button">
                        <span class="card-button-icon">👨‍🎓</span>
                        <p class="card-button-text">Add Subject Exam List</p>
                    </a>

                    <!-- View Teachers -->
                    <a href="{{ route('add.exam') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Add Exam</p>
                    </a>


                    <!-- View All Junior Lecturers -->
                    <a href="{{route('all.teacher')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Teachers</p>
                    </a>
                    <a href="{{route('all.session')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Session</p>
                    </a>
                    <a href="{{route('all.course')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Courses</p>
                    </a>
                    <a href="{{route('all.archives')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Archives List</p>
                    </a>
                    <a href="{{route('temp.enroll')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">Temporary Enrollments Request</p>
                    </a>
                    <a href="{{route('all.course_allocation')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Course Allocations</p>
                    </a>
                </div>
            </div>

            <button id="nextBtnView3" class="nav-button ml-2 md:ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="pagination-indicator" id="viewPaginationIndicator3">
            <!-- View pagination dots will be added dynamically -->
        </div>
    </section>
    </div>


    <footer class="bg-blue-600 p-2 mt-20 shadow-md text-center">
        <h4 class="font-bold text-2xl mb-4 mt-4 text-white">Learning Management System</h4>
        <p class="text-white text-1xl">&copy; 2025 LMS. All Rights Reserved.</p>
        <p class="text-white text-1xl">Sameer | Ali | Sharjeel</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize both carousels
            initializeCarousel('cardContainer', 'prevBtn', 'nextBtn', 'paginationIndicator');
            initializeCarousel('viewCardContainer', 'prevBtnView', 'nextBtnView', 'viewPaginationIndicator');
            initializeCarousel('viewCardContainer3', 'prevBtnView3', 'nextBtnView3', 'viewPaginationIndicator3');

            function initializeCarousel(containerId, prevBtnId, nextBtnId, paginationId) {
                const container = document.getElementById(containerId);
                const prevBtn = document.getElementById(prevBtnId);
                const nextBtn = document.getElementById(nextBtnId);
                const paginationContainer = document.getElementById(paginationId);

                const cards = container.querySelectorAll('.card-button');
                const totalCards = cards.length;

                // Determine how many cards to show based on screen size
                let cardsPerPage = getCardsPerPage();
                let currentPage = 0;
                let totalPages = Math.ceil(totalCards / cardsPerPage);

                // Create pagination dots
                createPaginationDots();

                function createPaginationDots() {
                    paginationContainer.innerHTML = '';
                    for (let i = 0; i < totalPages; i++) {
                        const dot = document.createElement('div');
                        dot.classList.add('pagination-dot');
                        if (i === 0) dot.classList.add('active');
                        paginationContainer.appendChild(dot);
                    }
                }

                // Update pagination dots
                function updatePagination() {
                    const dots = paginationContainer.querySelectorAll('.pagination-dot');
                    dots.forEach((dot, index) => {
                        if (index === currentPage) {
                            dot.classList.add('active');
                        } else {
                            dot.classList.remove('active');
                        }
                    });
                }

                // Show cards for current page
                function showCurrentPage() {
                    cards.forEach((card, index) => {
                        const startIndex = currentPage * cardsPerPage;
                        const endIndex = startIndex + cardsPerPage;

                        if (index >= startIndex && index < endIndex) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Update button states
                    prevBtn.disabled = currentPage === 0;
                    nextBtn.disabled = currentPage >= totalPages - 1;

                    // Update visual feedback for disabled buttons
                    prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
                    nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';

                    updatePagination();
                }

                // Previous button click
                prevBtn.addEventListener('click', () => {
                    if (currentPage > 0) {
                        currentPage--;
                        showCurrentPage();
                    }
                });

                // Next button click
                nextBtn.addEventListener('click', () => {
                    if (currentPage < totalPages - 1) {
                        currentPage++;
                        showCurrentPage();
                    }
                });

                // Handle pagination dot clicks
                paginationContainer.addEventListener('click', (e) => {
                    if (e.target.classList.contains('pagination-dot')) {
                        const dots = Array.from(paginationContainer.querySelectorAll('.pagination-dot'));
                        const clickedIndex = dots.indexOf(e.target);

                        if (clickedIndex !== -1 && clickedIndex !== currentPage) {
                            currentPage = clickedIndex;
                            showCurrentPage();
                        }
                    }
                });

                // Handle window resize
                window.addEventListener('resize', () => {
                    const newCardsPerPage = getCardsPerPage();

                    if (newCardsPerPage !== cardsPerPage) {
                        cardsPerPage = newCardsPerPage;
                        totalPages = Math.ceil(totalCards / cardsPerPage);

                        // Recreate pagination dots
                        createPaginationDots();

                        // Adjust current page if needed
                        if (currentPage >= totalPages) {
                            currentPage = totalPages - 1;
                        }

                        showCurrentPage();
                    }
                });

                function getCardsPerPage() {
                    if (window.innerWidth < 480) return 3;
                    if (window.innerWidth < 768) return 4;
                    if (window.innerWidth < 1024) return 5;
                    return 5;
                }

                // Initial setup
                showCurrentPage();
            }
        });

    </script>
    @include('components.loader')
    @include('components.alert')
</body>

</html>
