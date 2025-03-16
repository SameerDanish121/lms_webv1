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
        async function downloadTranscript(studentId) {
            try {
                let API_BASE_URL = await getApiBaseUrl();
                const response = await fetch(`${API_BASE_URL}api/Students/TranscriptPDF?student_id=${studentId}`);

                if (!response.ok) {
                    throw new Error("Failed to fetch transcript.");
                }

                const blob = await response.blob(); // Convert response to Blob
                const link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = `Transcript_${studentId}.pdf`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                URL.revokeObjectURL(link.href); // Free up memory
            } catch (error) {
                console.error("Error downloading transcript:", error);
                alert("Failed to download transcript.");
            }
        }

    </script>
</head>
<body class="bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100 min-h-screen p-0 m-0">
    @include('components.navbar')
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl text-center">
            <div class="flex flex-col items-center">
                <img src="{{ !empty($student['image']) ? $student['image'] : asset('images/male.png') }}" alt="Profile Image" class="w-40 h-40 rounded-full border-4 border-blue-500 shadow-md">
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
            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('transcript.view', ['student_id' => $student['id']]) }}" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                    View Transcript
                </a>
                <button onclick="downloadTranscript({{ $student['id'] }})" class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">
                    Download Transcript
                </button>
            </div>
            <div class="mt-8">
                <div class="flex justify-center border-b-2 border-gray-200">
                    <button class="tab-button px-6 py-2 text-lg font-semibold text-blue-600 border-b-4 border-blue-600 focus:outline-none" onclick="showTab('current')">
                        Current Enrollments
                    </button>
                    <button class="tab-button px-6 py-2 text-lg font-semibold text-gray-600 hover:text-blue-600 border-b-4 border-transparent hover:border-blue-600 focus:outline-none" onclick="showTab('previous')">
                        Previous Enrollments
                    </button>
                </div>
    
                <div id="current" class="tab-content mt-4">
                    <h2 class="text-2xl font-bold text-blue-700 mb-4">Registration Form</h2>
                    
                    <div id="current-summary" class="bg-white p-6 rounded-lg shadow-md mb-4 border border-gray-300">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-bold text-gray-700">Total Credit Hours:</span> 
                            <span id="total-credit-hours" class="italic text-gray-600">0</span>
                        </div>
                    
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-bold text-gray-700">Session:</span> 
                            <span id="current-session" class="italic text-gray-600">{{ $student['session']['name'] }} - {{ $student['session']['year'] }}</span>
                        </div>
                    
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-700">Current Section:</span> 
                            <span id="current-section" class="italic text-gray-600">N/A</span>
                        </div>
                    </div>
                    
                
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-blue-500 text-white">
                                <th class="border border-gray-300 px-4 py-2">Course No.</th>
                                <th class="border border-gray-300 px-4 py-2">Credits Hours</th>
                                <th class="border border-gray-300 px-4 py-2">Title Of Course</th>
                                <th class="border border-gray-300 px-4 py-2">Section</th>
                                <th class="border border-gray-300 px-4 py-2">Short Form</th>
                                <th class="border border-gray-300 px-4 py-2">Type</th>
                                <th class="border border-gray-300 px-4 py-2">Teacher</th>
                                <th class="border border-gray-300 px-4 py-2">Lab</th>
                            </tr>
                        </thead>
                        <tbody id="current-enrollments">
                            <tr>
                                <td colspan="8" class="text-center p-4 text-gray-500">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
    
                <div id="previous" class="tab-content mt-4 hidden">
                    <div class="container mx-auto p-6">
                        <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Previous Enrollments</h2>
                    
                        <!-- Search Bar -->
                        <div class="mb-4">
                            <input type="text" id="searchSessions" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Search by Session...">
                        </div>
                    
                        <div id="previousEnrollmentsContainer" class="space-y-4">
                            <!-- Data will be dynamically inserted here -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
    <script>
        function showTab(tab) {
            document.getElementById('current').classList.add('hidden');
            document.getElementById('previous').classList.add('hidden');
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('text-blue-600', 'border-blue-600'));
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.add('text-gray-600', 'hover:text-blue-600', 'border-transparent', 'hover:border-blue-600'));

            document.getElementById(tab).classList.remove('hidden');
            event.currentTarget.classList.add('text-blue-600', 'border-blue-600');
        }
        document.addEventListener("DOMContentLoaded", function () {
        fetchCurrentEnrollments();
    });

    function fetchCurrentEnrollments() {
        const studentId = {{ $student['id'] }};
        fetch(`http://127.0.0.1:8000/api/Students/getActiveEnrollments?student_id=${studentId}`)
            .then(response => response.json())
            .then(data => {
                if (data["Course Content"]) {
                    displayCurrentEnrollments(data["Course Content"]);
                } else {
                    document.getElementById("current-enrollments").innerHTML =
                        `<tr><td colspan="8" class="text-center p-4 text-red-500">No enrollments found.</td></tr>`;
                }
            })
            .catch(error => {
                console.error("Error fetching enrollments:", error);
                document.getElementById("current-enrollments").innerHTML =
                    `<tr><td colspan="8" class="text-center p-4 text-red-500">Failed to load data.</td></tr>`;
            });
    }

    function displayCurrentEnrollments(courses) {
        let totalCreditHours = 0;
        let sectionCounts = {};

        const tableBody = document.getElementById("current-enrollments");
        tableBody.innerHTML = "";

        courses.forEach(course => {
            totalCreditHours += course.credit_hours;

            // Count occurrences of each section
            if (sectionCounts[course.section]) {
                sectionCounts[course.section]++;
            } else {
                sectionCounts[course.section] = 1;
            }

            // Append course row to the table
            tableBody.innerHTML += `
                <tr class="border border-gray-300 text-center">
                    <td class="border border-gray-300 px-4 py-2">${course.course_code}</td>
                    <td class="border border-gray-300 px-4 py-2">${course.credit_hours}</td>
                    <td class="border border-gray-300 px-4 py-2">${course.course_name}</td>
                    <td class="border border-gray-300 px-4 py-2">${course.section}</td>
                    <td class="border border-gray-300 px-4 py-2">${course["Short Form"]}</td>
                    <td class="border border-gray-300 px-4 py-2">${course["Type"]}</td>
                    <td class="border border-gray-300 px-4 py-2">${course.teacher_name}</td>
                    <td class="border border-gray-300 px-4 py-2">${course.junior_lecturer_name}</td>
                </tr>`;
        });

        // Determine the most common section
        let mostFrequentSection = Object.keys(sectionCounts).reduce((a, b) =>
            sectionCounts[a] > sectionCounts[b] ? a : b, "");

        // Update the summary section
        document.getElementById("total-credit-hours").textContent = totalCreditHours;
        document.getElementById("current-section").textContent = mostFrequentSection || "N/A";
    }
    document.addEventListener("DOMContentLoaded", function() {
        const studentId = "{{ $student['id'] }}";
        fetchPreviousEnrollments(studentId);
    });

    function fetchPreviousEnrollments(studentId) {
        fetch(`http://127.0.0.1:8000/api/Students/getPreviousEnrollments?student_id=${studentId}`)
        .then(response => response.json())
        .then(data => {
            if (data["Course Content"]) {
                renderPreviousEnrollments(data["Course Content"]);
            }
        })
        .catch(error => console.error("Error fetching previous enrollments:", error));
    }

    function renderPreviousEnrollments(enrollments) {
        const container = document.getElementById("previousEnrollmentsContainer");
        container.innerHTML = "";

        Object.keys(enrollments).forEach(session => {
            const courses = enrollments[session];
            const totalCreditHours = courses.reduce((sum, course) => sum + course.credit_hours, 0);

            let sessionHTML = `
                <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-300">
                    <button class="w-full text-left px-6 py-3 bg-blue-600 text-white font-semibold text-lg flex justify-between items-center" onclick="toggleSession('${session.replace(/\s+/g, '')}')">
                        <span>${session} (Total Credit Hours: ${totalCreditHours})</span>
                        <span class="text-xl">▼</span>
                    </button>

                    <div id="${session.replace(/\s+/g, '')}" class="hidden p-6 bg-gray-100">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-700 border border-gray-300 rounded-lg">
                                <thead class="bg-gray-300 text-gray-800 uppercase font-semibold">
                                    <tr>
                                        <th class="px-4 py-2 border">Course Name</th>
                                        <th class="px-4 py-2 border">Code</th>
                                        <th class="px-4 py-2 border">Credit Hours</th>
                                        <th class="px-4 py-2 border">Type</th>
                                        <th class="px-4 py-2 border">Short Form</th>
                                        <th class="px-4 py-2 border">Pre-Requisite/Main</th>
                                        <th class="px-4 py-2 border">Section</th>
                                        <th class="px-4 py-2 border">Teacher</th>
                                        <th class="px-4 py-2 border">Junior Lecturer</th>
                                        <th class="px-4 py-2 border">Result</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-300">
            `;

            courses.forEach(course => {
                let resultInfo = course["result Info"];
                let resultTable = `<span class="text-gray-500">N/A</span>`;

                if (typeof resultInfo === "object") {
                    resultTable = `
                        <table class="w-full text-xs text-gray-700 border border-gray-300 bg-gray-200 rounded-lg">
                            <tr class="border-b"><th class="px-2 py-1 border">Mid</th><td class="px-2 py-1">${resultInfo.mid ?? "N/A"}</td></tr>
                            <tr class="border-b"><th class="px-2 py-1 border">Final</th><td class="px-2 py-1">${resultInfo.final ?? "N/A"}</td></tr>
                            <tr class="border-b"><th class="px-2 py-1 border">Internal</th><td class="px-2 py-1">${resultInfo.internal ?? "N/A"}</td></tr>
                            <tr class="border-b"><th class="px-2 py-1 border">Lab</th><td class="px-2 py-1">${resultInfo.lab ?? "N/A"}</td></tr>
                            <tr class="border-b"><th class="px-2 py-1 border">Grade</th><td class="px-2 py-1">${resultInfo.grade ?? "N/A"}</td></tr>
                            <tr><th class="px-2 py-1 border">Quality Points</th><td class="px-2 py-1">${resultInfo.quality_points ?? "N/A"}</td></tr>
                        </table>
                    `;
                }

                sessionHTML += `
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-4 py-2 border">${course.course_name}</td>
                        <td class="px-4 py-2 border">${course.course_code}</td>
                        <td class="px-4 py-2 border">${course.credit_hours}</td>
                        <td class="px-4 py-2 border">${course.Type}</td>
                        <td class="px-4 py-2 border">${course["Short Form"]}</td>
                        <td class="px-4 py-2 border">${course["Pre-Requisite/Main"]}</td>
                        <td class="px-4 py-2 border">${course.section}</td>
                        <td class="px-4 py-2 border">${course.teacher_name}</td>
                        <td class="px-4 py-2 border">${course.junior_lecturer_name}</td>
                        <td class="px-4 py-2 border">${resultTable}</td>
                    </tr>
                `;
            });

            sessionHTML += `</tbody></table></div></div></div>`;
            container.innerHTML += sessionHTML;
        });
    }

    function toggleSession(sessionId) {
        const sessionDiv = document.getElementById(sessionId);
        sessionDiv.classList.toggle("hidden");
    }

    // Search Functionality
    document.getElementById("searchSessions").addEventListener("input", function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll(".session-container").forEach(session => {
            let sessionName = session.querySelector("h3").innerText.toLowerCase();
            session.style.display = sessionName.includes(filter) ? "" : "none";
        });
    });
    </script>
   <style>
    .session-container {
        transition: all 0.3s ease-in-out;
    }
    .table-sm td, .table-sm th {
        font-size: 12px;
    }
</style>
</body>
</html>
