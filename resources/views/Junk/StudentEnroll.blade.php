<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrolments</title>
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
    
    @include('components.navbar', [
        'username' => session('username', 'Guest'),
        'profileImage' => session('profileImage', asset('images/male.png')),
        'designation' => session('designation', 'N/A'),
        'type' => session('userType', 'User')
    ])
    
    <div class="max-w-6xl mx-auto py-8 px-8 w-full">
        <div class="bg-white shadow-md rounded-lg p-12 w-full">
            <h2 class="text-3xl font-bold text-gray-700 mb-4 text-center">Student Enrolments</h2>
            
            <div class="flex space-x-4 mb-6">
                <select id="search-by" class="border px-4 py-2 rounded-lg">
                    <option value="name">Search by Name</option>
                    <option value="section">Search by Section</option>
                    <option value="regno">Search by Reg No</option>
                </select>
                <input type="text" id="search-input" class="border px-4 py-2 rounded-lg flex-1" placeholder="Enter value...">
                <button id="search-button" onclick="loadStudents()" class="btn bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Search</button>
            </div>

            <div id="students-container" class="space-y-8 w-full"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            loadStudents();
        });

        function loadStudents() {
            const studentsData = [
                {
                    reg_no: "21-Arid-1221",
                    student_name: "Ali Khan",
                    section_name: "BAI 5A",
                    subjects: ["Operating Systems", "Database Systems", "Software Engineering"]
                },
                {
                    reg_no: "21-Arid-3412",
                    student_name: "Sara Ahmed",
                    section_name: "BSE 3B",
                    subjects: ["Data Structures", "Web Development", "Computer Networks"]
                }
            ];

            const container = document.getElementById("students-container");
            container.innerHTML = '';
            
            studentsData.forEach((student) => {
                const card = document.createElement("div");
                card.className = "bg-blue-200 shadow-2xl rounded-xl p-8 mb-8 w-full";
                card.style.maxWidth = (document.getElementById("search-by").offsetWidth + document.getElementById("search-input").offsetWidth + document.getElementById("search-button").offsetWidth + 32) + 'px';

                card.innerHTML = `
                    <div class="flex justify-between items-center border-b pb-2 mb-3">
                        <h3 class="text-2xl font-bold text-blue-700">${student.student_name}</h3>
                        <span class="text-gray-600 text-lg font-medium">${student.reg_no} - ${student.section_name}</span>
                    </div>
                    <div class="flex flex-wrap text-gray-700 space-x-4 text-lg">
                        ${student.subjects.map(sub => <span class="bg-gray-300 px-4 py-2 rounded-lg">${sub}</span>).join(' ')}
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