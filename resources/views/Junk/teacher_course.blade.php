<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Courses</title>
    @php
    $teacher="DR Amir Rasheed"
    @endphp
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100 min-h-screen p-0 m-0">

    @include('components.navbar', [
        'username' => session('username', 'Guest'),
        'profileImage' => session('profileImage', asset('images/male.png')),
        'designation' => session('designation', 'N/A'),
        'type' => session('userType', 'User')
    ])

    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="bg-blue-200 shadow-2xl rounded-xl p-6 mb-8">
            <h1 class="text-3xl font-bold text-blue-700 mb-2">{{ $teacher }}</h1>
            <p class="text-gray-600 mb-6">View Offered Courses Of {{ $teacher }}</p>

            <div id="courses-container" class="mt-8"></div>
        </div>
    </div>

    @include('components.footer')

    <script>
     document.addEventListener("DOMContentLoaded", function () {
    setTimeout(() => {
        console.log("Script Loaded!");
        loadCourses();
    }, 200);
});

function loadCourses() {
    const coursesData = [
        { "course_name": "Operating Systems", "section": "BAI 5A", "total_students": 42 },
        { "course_name": "Operating Systems", "section": "BAI 5B", "total_students": 38 },
        { "course_name": "Data Structures", "section": "BAI 3A", "total_students": 50 },
        { "course_name": "Data Structures", "section": "BSE 3B", "total_students": 48 },
        { "course_name": "Programming Fundamentals", "section": "BAI 1A", "total_students": 55 }
    ];

    const container = document.getElementById("courses-container");
    if (!container) {
        console.error("Container not found!");
        return;
    }

    const groupedCourses = {};
    coursesData.forEach(course => {
        if (!groupedCourses[course.course_name]) {
            groupedCourses[course.course_name] = [];
        }
        groupedCourses[course.course_name].push(course);
    });

    Object.keys(groupedCourses).forEach((courseName, index) => {
        const courseGroup = document.createElement("div");
        courseGroup.className = "mb-10 bg-white p-10 shadow-xl rounded-lg border-l-4 border-blue-600";

        courseGroup.innerHTML = `
            <div class="flex items-center mb-4">
                <div class="w-2 h-8 bg-blue-600 rounded-full mr-2"></div>
                <h2 class="text-2xl font-bold text-blue-700">${courseName}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                ${groupedCourses[courseName].map(section => `
                    <div class="course-card bg-gradient-to-br from-blue-500 to-blue-300 rounded-xl shadow-xl hover:shadow-2xl transform hover:scale-105 transition duration-300">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="text-md font-medium text-white mb-1">Section</div>
                                    <div class="text-2xl font-bold text-white">${section.section}</div>
                                </div>
                                <div class="bg-white text-black px-3 py-1 rounded-full text-sm font-medium shadow-md">
                                    ${section.total_students} Students
                                </div>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <button class="bg-white text-black-600 px-3 py-1 rounded-lg shadow-md hover:bg-blue-600 hover:text-white transition duration-500">
                                    View Details
                                </button>
                                <div class="flex space-x-2">
                                    <button class="p-2 rounded-full bg-white/20 shadow-md hover:bg-white/50  transition duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button class="p-2 rounded-full bg-white/20 shadow-md hover:bg-white/30 transition duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
        container.appendChild(courseGroup);
    });
}
  </script>
</body>
</html>