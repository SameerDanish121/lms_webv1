<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    @include('components.navbar', [
    'username' => session('username', 'Guest'),
    'profileImage' => session('profileImage', asset('images/male.png')),
    'designation' => session('designation', 'N/A'),
    'type' => session('type', 'User')
    ])

    <div class="container mx-auto p-6">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">{{ $course['CourseName'] ?? 'Course Details' }}</h2>

            <div class="flex flex-col md:flex-row items-center gap-6">
                <!-- Teacher Section -->
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 rounded-full overflow-hidden border-2">
                        <img src="{{ $course['TeacherPhoto'] ?? asset('images/male.png') }}" alt="Teacher" class="w-full h-full object-cover">
                    </div>
                    <p class="text-lg font-semibold mt-2 text-center">{{ $course['Teacher'] ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-600 mt-1">Teacher</p>
                </div>
                <div class="flex-1">
                    <p class="text-lg font-semibold">Course Code: {{ $course['CourseCode'] ?? 'N/A' }}</p>
                    <p class="text-lg font-semibold">Course Name: {{ $course['CourseName'] ?? 'N/A' }}</p>
                    <p class="text-gray-600">Session: {{ $course['SessionName'] ?? 'N/A' }}</p>
                    <p class="text-gray-600">Section: {{ $course['Section_name'] ?? 'N/A' }}</p>
                    <p class="text-gray-600">Total Enrollments: {{ $course['total_enrollments'] ?? 0 }}</p>
                </div>

                <!-- Junior Lecturer Section (Only if No Lab is not present) -->
                @if($course['JuniorLecturer'] !== "Non-Lab")
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 rounded-full overflow-hidden border-2">
                        <img src="{{ $course['JuniorPhoto'] ?? asset('images/male.png') }}" alt="Junior Lecturer" class="w-full h-full object-cover">
                    </div>
                    <p class="text-lg font-semibold mt-2 text-center">{{ $course['JuniorLecturer'] }}</p>
                    <p class="text-sm text-gray-600 mt-1">Junior Lecturer</p>
                </div>
                @endif
            </div>

            <!-- Tabs Section -->
            <div class="mt-6">
                <div class="flex border-b">
                    <button class="tab-btn px-4 py-2 text-gray-600 hover:text-blue-600 border-b-2 border-transparent focus:outline-none" onclick="showTab('attendance')">Attendance</button>
                    <button class="tab-btn px-4 py-2 text-gray-600 hover:text-blue-600 border-b-2 border-transparent focus:outline-none" onclick="showTab('task')">Task Results</button>
                    <button class="tab-btn px-4 py-2 text-gray-600 hover:text-blue-600 border-b-2 border-transparent focus:outline-none" onclick="showTab('exam')">Exam</button>
                </div>

                <div class="p-4" id="tabContent">
                    <div id="attendance" class="tab-content">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-2">
                            <div class="text-sm md:text-base">
                                <span class="font-semibold">Total Lectures: <span id="totalLectures"></span></span>
                                <span id="totalLabsLabel" class="ml-3 font-semibold hidden">Labs: <span id="totalLabs"></span></span>
                                <span class="ml-3 font-semibold">Classes: <span id="totalClasses"></span></span>
                            </div>
                            <div class="flex gap-2">
                                <input type="text" id="searchInput" placeholder="Search RegNo or Name" class="border p-1 rounded text-sm w-40 md:w-64">
                                <button id="sortButton" class="bg-blue-500 text-white px-3 py-1 text-sm rounded hover:bg-blue-600">
                                    Sort
                                </button>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 text-xs md:text-sm">
                                <thead class="bg-gray-200 text-gray-700">
                                    <tr class="text-[10px] md:text-xs">
                                        <th class="px-1 md:px-3 py-1 border">Image</th>
                                        <th class="px-1 md:px-3 py-1 border">RegNo</th>
                                        <th class="px-1 md:px-3 py-1 border">Student</th>
                                        <th class="px-1 md:px-3 py-1 border">Lectures</th>
                                        <th class="px-1 md:px-3 py-1 border">Lecture %</th>
                                        <th id="labAttendedHeader" class="px-1 md:px-3 py-1 border hidden">Labs</th>
                                        <th id="labPercentageHeader" class="px-1 md:px-3 py-1 border hidden">Lab %</th>
                                        <th class="px-1 md:px-3 py-1 border">Total Attended</th>
                                        <th class="px-1 md:px-3 py-1 border">Total %</th>
                                        <th class="px-1 md:px-3 py-1 border">Absent</th>
                                        <th class="px-1 md:px-3 py-1 border">Details</th>
                                    </tr>
                                </thead>
                                <tbody id="attendanceTableBody" class="text-gray-700 text-[10px] md:text-xs">
                                    <!-- Data will be inserted here -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div id="task" class="tab-content hidden">
                        {{-- <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-2">
                            <h2 class="text-lg md:text-xl font-bold text-gray-800 bg-gray-100 py-3 rounded-lg shadow text-center w-full">
                                Task Results
                            </h2>
                            <div class="flex gap-2">
                                <input type="text" id="taskSearch" placeholder="Search Name or RegNo" class="border p-1 rounded text-sm w-40 md:w-64" onkeyup="searchTaskResults()">
                                <button id="sortTaskButton" class="bg-blue-500 text-white px-3 py-1 text-sm rounded hover:bg-blue-600">
                                    Sort by %
                                </button>
                            </div>
                        </div> --}}
                        <div class="flex flex-col md:flex-row justify-between items-center mb-4 p-3 bg-white rounded-lg shadow-md">
                            <h2 class="text-xl font-semibold text-gray-900">
                                Task Results
                            </h2>
                            <div class="flex gap-2 w-full md:w-auto">
                                <input type="text" id="taskSearch" placeholder="Search by Name or RegNo" 
                                       class="border border-gray-300 p-2 rounded-md text-sm w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <button id="sortTaskButton" 
                                        class="bg-blue-500 text-white px-4 py-2 text-sm rounded-md hover:bg-blue-600 transition">
                                    Sort %
                                </button>
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 text-xs md:text-sm">
                                <thead class="bg-gray-200 text-gray-700">
                                    <tr class="text-[10px] md:text-xs">
                                        <th class="px-1 md:px-3 py-1 border">Image</th>
                                        <th class="px-1 md:px-3 py-1 border">Name</th>
                                        <th class="px-1 md:px-3 py-1 border">Reg No</th>
                                        <th class="px-1 md:px-3 py-1 border">Assignment</th>
                                        <th class="px-1 md:px-3 py-1 border">Quiz</th>
                                        <th id="labTaskHeader" class="px-1 md:px-3 py-1 border hidden">Lab Task</th>
                                        <th class="px-1 md:px-3 py-1 border">Overall</th>
                                        <th class="px-1 md:px-3 py-1 border">Details</th>
                                    </tr>
                                </thead>
                                <tbody id="taskResultsBody" class="text-gray-700 text-[10px] md:text-xs"></tbody>
                            </table>
                        </div>
                    </div>
                    <div id="exam" class="tab-content hidden">
                        <div class="container mx-auto p-6">
                            <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md p-6">
                                <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">Exam Results</h2>
                                <div class="mb-4">
                                    <input type="text" id="searchInput" placeholder="Search by Name or RegNo" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div class="mb-4">
                                    <select id="examFilter" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="Mid">Mid Exam</option>
                                        <option value="Final">Final Exam</option>
                                    </select>
                                </div>
                                <div id="examResults">
                                    <p class="text-center text-gray-600">Fetching exam results...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function fetchAttendanceData() {
            const teacherOfferedCourseId = `{{ $course['t_offered_course_id'] }}`;
            const isNonLab = `{{ $course['JuniorLecturer'] }}` === "Non-Lab";

            fetch(`http://127.0.0.1:8000/api/Teachers/section-attendance-list?teacher_offered_course_id=${teacherOfferedCourseId}`)
                .then(response => response.json())
                .then(data => {
                    // Set Labels
                    document.getElementById("totalLectures").textContent = data.total_conducted;
                    document.getElementById("totalClasses").textContent = data.classes_conducted;
                    if (!isNonLab) {
                        document.getElementById("totalLabsLabel").classList.remove("hidden");
                        document.getElementById("totalLabs").textContent = data.lab_conducted;
                        document.getElementById("labAttendedHeader").classList.remove("hidden");
                        document.getElementById("labPercentageHeader").classList.remove("hidden");
                    }

                    // Populate Table
                    const tableBody = document.getElementById("attendanceTableBody");
                    tableBody.innerHTML = ""; // Clear previous data

                    data.students.forEach(student => {
                        let totalLectures = data.total_conducted;
                        let absent = totalLectures - student.Lecture_Attended;
                        let row = `
                <tr class="${student.Total_Percentage < 75 ? 'bg-orange-100' : 'hover:bg-gray-100'} transition duration-200">
    <td class="border px-3 py-2 text-center">
        ${student.Student_Image 
            ? `<img src="${student.Student_Image}" class="w-10 h-10 md:w-12 md:h-12 rounded-full shadow">`
            : `<div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-gray-300 text-gray-700 font-semibold rounded-full">
                 ${student.Student_Name.split(' ').map(n => n[0]).join('').toUpperCase()}
               </div>`}
    </td>
    <td class="border px-3 py-2 text-gray-700">${student.RegNo}</td>
    <td class="border px-3 py-2 font-medium">${student.Student_Name}</td>
    <td class="border px-3 py-2 text-center">${student.Lecture_Attended}</td>
    <td class="border px-3 py-2 text-center">${student.Lecture_Percentage}%</td>
    ${!isNonLab ? `<td class="border px-3 py-2 text-center">${student.Lab_Attended}</td>` : ""}
    ${!isNonLab ? `<td class="border px-3 py-2 text-center">${student.Lab_Percentage}%</td>` : ""}
    <td class="border px-3 py-2 text-center">${student.Total_Attended_Lectures}</td>
    <td class="border px-3 py-2 text-center font-semibold ${student.Total_Percentage < 75 ? 'text-red-600' : 'text-green-600'}">
        ${student.Total_Percentage}%
    </td>
    <td class="border px-3 py-2 text-center">${absent}</td>
    <td class="border px-3 py-2 text-center">
        <button class="bg-green-500 text-white text-xs md:text-sm px-3 py-1 md:px-4 md:py-1.5 rounded-full hover:bg-green-700 transition">
            Details
        </button>
    </td>
</tr>

                `;
                        tableBody.innerHTML += row;
                    });
                });
        }

        document.getElementById("searchInput").addEventListener("input", function() {
            let searchValue = this.value.toLowerCase();
            document.querySelectorAll("#attendanceTableBody tr").forEach(row => {
                let regNo = row.children[1].textContent.toLowerCase();
                let name = row.children[2].textContent.toLowerCase();
                row.style.display = regNo.includes(searchValue) || name.includes(searchValue) ? "" : "none";
            });
        });

        // Sorting Function
        let sortAsc = true;
        document.getElementById("sortButton").addEventListener("click", function() {
            let rows = Array.from(document.querySelectorAll("#attendanceTableBody tr"));
            rows.sort((a, b) => {
                let valA = parseFloat(a.children[7].textContent);
                let valB = parseFloat(b.children[7].textContent);
                return sortAsc ? valA - valB : valB - valA;
            });
            sortAsc = !sortAsc;
            document.getElementById("attendanceTableBody").innerHTML = "";
            rows.forEach(row => document.getElementById("attendanceTableBody").appendChild(row));
        });
        let taskResultsData = [];
        let filteredtaskResultData = [];
        //Attendace-End//////////////
        function showTab(tabId) {
            document.querySelectorAll(".tab-content").forEach(tab => tab.classList.add("hidden"));
            document.getElementById(tabId).classList.remove("hidden");
            if (tabId === "attendance") {
                fetchAttendanceData();
            }
        }
        document.addEventListener("DOMContentLoaded", async function() {
            const teacherOfferedCourseId = `{{ $course['t_offered_course_id'] }}`;
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
            fetchAttendanceData();

            let examData = [];
            let filteredData = [];
            let apiResponseData = {};
            async function fetchExamResults() {
                try {
                    API_BASE_URL = await getApiBaseUrl();
                    const apiUrl = `${API_BASE_URL}api/Teachers/get-exam-result?teacher_offered_course_id=${teacherOfferedCourseId}`;
                    const response = await fetch(apiUrl, {
                        method: "GET"
                        , headers: {
                            "Content-Type": "application/json"
                        }
                    });

                    if (!response.ok) {
                        return;
                    }
                    const result = await response.json();
                    if (response.ok) {
                        examData = result['students'];
                        filteredData = examData;
                        apiResponseData = result; // Store full response
                        renderExamResults(); // Render UI
                    } else {
                        document.getElementById("examResults").innerHTML = `<p class="text-red-500 text-center">No exam results found.</p>`;
                    }
                } catch (error) {
                    document.getElementById("examResults").innerHTML = `<p class="text-red-500 text-center">No exam results found.</p>`;
                }
            }

            function renderExamResults() {
                const examType = document.getElementById("examFilter").value;
                const resultsDiv = document.getElementById("examResults");
                resultsDiv.innerHTML = "";
                filteredData.forEach(student => {
                    if (student["Exam Results"] && student["Exam Results"][examType]) {
                        const exam = student["Exam Results"][examType];
                        let questionTable = `
                                                <table class="w-full border-collapse border border-gray-300 mt-4">
                                                    <thead class="bg-gray-200">
                                                        <tr>
                                                            <th class="border border-gray-300 px-4 py-2">Q No</th>
                                                            <th class="border border-gray-300 px-4 py-2">Total Marks</th>
                                                            <th class="border border-gray-300 px-4 py-2">Obtained Marks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        ${exam.Questions.map(q => `
                                                            <tr class="text-center">
                                                                <td class="border border-gray-300 px-4 py-2">${q["Question No"]}</td>
                                                                <td class="border border-gray-300 px-4 py-2">${q["Total Marks"]}</td>
                                                                            <td class="border border-gray-300 px-4 py-2">${q["Obtained Marks"]}</td>
                                                            </tr>
                                                        `).join('')}
                                                    </tbody>
                                                </table>
                                            `;

                        let studentTable = `
                                                <div class="border rounded-lg shadow p-4 mb-6">
                                                    <div class="flex items-center space-x-4">
                                                        <img src="https://ui-avatars.com/api/?name=${student.name}&background=random" alt="Student" class="w-16 h-16 rounded-full border">
                                                        <div>
                                                            <p class="text-lg font-semibold">${student.name}</p>
                                                            <p class="text-sm text-gray-600">${student.RegNo}</p>
                                                        </div>
                                                    </div>
                                                   
                                                     <div class="mb-3">
        <h5 class="text-secondary">Performance</h5>
        <ul class="list-unstyled">
            <li><strong>Total Obtained Marks:</strong> ${exam["Total Obtained Marks"]} / ${exam["Total Marks"]}</li>
            <li><strong>Total Solid Obtained Marks:</strong> ${exam["Total Solid Obtained Marks"]} / ${exam["Solid Marks"]}</li>
            <li><strong>Percentage:</strong> ${exam.Percentage}%</li>
        </ul>
        </div>
        <div class="mt-3">
        <h5 class="text-secondary">Question-Wise Breakdown</h5>
        ${questionTable}
        </div>
                                                </div>
                                            `;

                        resultsDiv.innerHTML += studentTable;
                    }
                });
            }
            await fetchExamResults();
            document.getElementById("examFilter").addEventListener("change", renderExamResults);
            document.getElementById("searchInput").addEventListener("keyup", function() {
                const query = this.value.toLowerCase();
                filteredData = examData.filter(student =>
                    student.name.toLowerCase().includes(query) ||
                    student.RegNo.toLowerCase().includes(query)
                );
                renderExamResults();
            });

            let JuniorLecturer = `{{ $course['JuniorLecturer'] }}`;
            async function fetchTaskResults() {
                const courseId = `{{ $course['t_offered_course_id'] }}`;
                try {
                    const apiUrl = `http://127.0.0.1:8000/api/Teachers/section-task-result?teacher_offered_course_id=${courseId}`;
                    const response = await fetch(apiUrl, {
                        method: "GET"
                        , headers: {
                            "Content-Type": "application/json"
                        }
                    });

                    if (!response.ok) return;

                    const result = await response.json();
                    taskResultsData = result["Results"];
                    filteredtaskResultData = [...taskResultsData];
                    renderTaskResults();
                } catch (error) {
                    console.error(error);
                }
            }

            function renderTaskResults() {
                let tbody = document.getElementById("taskResultsBody");
                tbody.innerHTML = "";

                let labTaskHeader = document.getElementById("labTaskHeader");
                let hasLabTask = `{{ $course['JuniorLecturer'] }}` !== "Non-Lab";
                if (hasLabTask) {
                    labTaskHeader.classList.remove("hidden");
                } else {
                    labTaskHeader.classList.add("hidden");
                }
                filteredtaskResultData.forEach(student => {
                    let highlightClass = student["Overall_Percentage"] < 50 ? 'bg-red-100' : 'hover:bg-gray-100';
                    let row = `<tr class="${highlightClass} transition duration-200">
                <td class="border px-3 py-2 text-center">
                    <img src="${student.image ?? `https://ui-avatars.com/api/?name=${student.Student_name}&background=random`}" class="w-10 h-10 md:w-12 md:h-12 rounded-full border">
                </td>
                <td class="border px-3 py-2 font-medium">${student.Student_name}</td>
                <td class="border px-3 py-2 text-gray-700">${student.RegNo}</td>
                <td class="border px-3 py-2 text-center">${student["Assignment_Task_Obtained Marks"]} / ${student["Assignment_Task_Total Marks"]} (${student["Assignment_Task_Percentage"]})</td>
                <td class="border px-3 py-2 text-center">${student["Quiz_Task_Obtained Marks"]} / ${student["Quiz_Task_Total Marks"]} (${student["Quiz_Task_Percentage"]})</td>
                ${labTaskHeader ? `<td class='border px-3 py-2 text-center'>${student["Lab_Task_Obtained Marks"]} / ${student["Lab_Task_Total Marks"]} (${student["Lab_Task_Percentage"]})</td>` : ""}
                <td class="border px-3 py-2 text-center font-bold">${student["Overall_Obtained_Marks"]} / ${student["Overall_Total_Marks"]} (${student["Overall_Percentage"]} %)</td>               
             <td class="border px-3 py-2 text-center">
        <button class="bg-green-500 text-white text-xs md:text-sm px-3 py-1 md:px-4 md:py-1.5 rounded-full hover:bg-green-700 transition">
            Details
        </button>
    </td>
                </tr>`;
                    tbody.innerHTML += row;
                });

                document.getElementById("labTaskHeader").classList.toggle("hidden", !hasLabTask);
            }

            function searchTaskResults() {
                let searchInput = document.getElementById("taskSearch").value.toLowerCase();
                filteredtaskResultData = taskResultsData.filter(student =>
                    student.Student_name.toLowerCase().includes(searchInput) || student.RegNo.includes(searchInput)
                );
                renderTaskResults();
            }
            let isSortedDescending = false;
            document.getElementById("taskSearch").addEventListener("input", searchTaskResults);
            document.getElementById("sortTaskButton").addEventListener("click", () => {
                filteredtaskResultData.sort((a, b) => {
                    let aPercentage = parseFloat(a["Overall_Percentage"]) || 0;
                    let bPercentage = parseFloat(b["Overall_Percentage"]) || 0;
                    return isSortedDescending ? aPercentage - bPercentage : bPercentage - aPercentage;
                });

                isSortedDescending = !isSortedDescending;
                renderTaskResults();
            });

            fetchTaskResults();
        });


        (async function initialize() {
            await fetchExamResults();
            fetchAttendanceData();
            setupEventListeners();
        })();

    </script>
    @include('components.footer')
</body>
</html>
