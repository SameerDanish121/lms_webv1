<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporary Enrolments</title>
    @vite('resources/css/app.css')
    <style>
        .btn {
            transition: transform 0.3s ease-in-out;
        }
        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100 min-h-screen flex flex-col justify-between">

    {{-- Navbar --}}
    @include('components.navbar', [
        'username' => session('username', 'Guest'),
        'profileImage' => session('profileImage', asset('images/male.png')),
        'designation' => session('designation', 'N/A'),
        'type' => session('userType', 'User')
    ])

    <div class="max-w-6xl mx-auto py-8 px-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-3xl font-bold text-gray-700 mb-4 text-center">Temporary Enrolments</h2>
            <p class="text-gray-500 text-center mb-6">Manage and review student enrolment requests.</p>

            <div id="enrolments-container" class="space-y-6"></div>
        </div>
    </div>

    {{-- Footer --}}

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(() => {
                loadEnrolments();
            }, 200);
        });

        function loadEnrolments() {
            const enrolmentsData = [
                {
                    reg_no: "BAI-123",
                    student_name: "Ali Khan",
                    teacher_name: "Dr. Amir Rasheed",
                    course_name: "Operating Systems",
                    section_name: "BAI 5A",
                    session_name: "Fall 2024",
                    date_time: "March 5, 2025 - 10:00 AM",
                    venue: "Room 201"
                },
                {
                    reg_no: "BSE-456",
                    student_name: "Sara Ahmed",
                    teacher_name: "Dr. Amir Rasheed",
                    course_name: "Data Structures",
                    section_name: "BSE 3B",
                    session_name: "Spring 2025",
                    date_time: "March 6, 2025 - 12:00 PM",
                    venue: "Room 305"
                }
            ];

            const container = document.getElementById("enrolments-container");
            if (!container) {
                console.error("Container not found!");
                return;
            }

            container.innerHTML = '';

            enrolmentsData.forEach((enrolment) => {
                const card = document.createElement("div");
                card.className = "bg-blue-200 shadow-2xl rounded-xl p-6 mb-8";

                card.innerHTML = `
                    <!-- Name & Section in One Row -->
                    <div class="flex justify-between items-center border-b pb-2 mb-3">
                        <h3 class="text-xl font-bold text-blue-700">${enrolment.student_name}</h3>
                        <span class="text-gray-600 text-sm font-medium">${enrolment.section_name}</span>
                    </div>

                    <!-- All Other Details in a Single Horizontal Row -->
                    <div class="flex flex-wrap justify-between text-gray-700 space-x-6">
                        <p><strong>Teacher:</strong> ${enrolment.teacher_name}</p>
                        <p><strong>Course:</strong> ${enrolment.course_name}</p>
                        <p><strong>Session:</strong> ${enrolment.session_name}</p>
                        <p><strong>Venue:</strong> ${enrolment.venue}</p>
                        <p><strong>Date & Time:</strong> ${enrolment.date_time}</p>
                    </div>

                    <p class="text-blue-700 font-semibold mt-4">
                        Teacher ${enrolment.teacher_name} requests to enroll student ${enrolment.student_name} 
                        (${enrolment.reg_no}) in section ${enrolment.section_name} for the course 
                        ${enrolment.course_name} in the session ${enrolment.session_name}.
                    </p>

                    <div class="flex justify-end space-x-4 mt-4">
                        <button class="btn bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                            Accept
                        </button>
                        <button class="btn bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300">
                            Reject
                        </button>
                    </div>
                `;
                container.appendChild(card);
            });
        }
    </script>

    <footer class="bg-blue-600 p-2 mt-20 shadow-md text-center text-white">
        <h4 class="font-bold text-2xl mb-4 mt-4">Learning Management System</h4>
        <p>&copy; 2025 LMS. All Rights Reserved.</p>
        <p>Sameer | Ali | Sharjeel</p>
    </footer>
</body>
</html>