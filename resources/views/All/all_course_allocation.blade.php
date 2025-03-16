<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allocated Courses</title>
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
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Allocated Courses</h2>

        <!-- Filters Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <select id="sessionFilter" class="border p-3 rounded w-full" onchange="filterData()">
                <option value="">All Sessions</option>
            </select>
            <input type="text" id="sectionFilter" class="border p-3 rounded w-full" placeholder="Filter by Section" onkeyup="filterData()">
            <input type="text" id="courseCodeFilter" class="border p-3 rounded w-full" placeholder="Filter by Course Code" onkeyup="filterData()">
            <input type="text" id="courseNameFilter" class="border p-3 rounded w-full" placeholder="Filter by Course Name" onkeyup="filterData()">
            <input type="text" id="teacherFilter" class="border p-3 rounded w-full" placeholder="Filter by Teacher" onkeyup="filterData()">
            <input type="text" id="juniorFilter" class="border p-3 rounded w-full" placeholder="Filter by Junior Lecturer" onkeyup="filterData()">
            <select id="sessionTypeFilter" class="border p-3 rounded w-full" onchange="filterData()">
                <option value="">All</option>
                <option value="Current">Current</option>
                <option value="Previous">Previous</option>
            </select>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-md p-4">
            <table class="table-auto w-full border-collapse border border-gray-300 text-gray-700">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="border p-3">Course Code</th>
                        <th class="border p-3">Course Name</th>
                        <th class="border p-3">Teacher</th>
                        <th class="border p-3">Junior Lecturer</th>
                        <th class="border p-3">Session</th>
                        <th class="border p-3">Section</th>
                        <th class="border p-3">Total Enrollments</th>
                        <th class="border p-3">Action</th>
                    </tr>
                </thead>
                <tbody id="courseTableBody">
                    <tr>
                        <td colspan="8" class="text-center p-4">Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let courses = [];
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

        async function loadAllocations() {
            try {
                API_BASE_URL = await getApiBaseUrl();
                const response = await fetch(`${API_BASE_URL}api/Admin/getCourseAllocation`);
                const result = await response.json();
                if (response.ok) {
                    courses = result.data;
                    populateFilters();
                    renderTable(result.data);
                }
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }
        document.addEventListener("DOMContentLoaded", loadAllocations);

        function populateFilters() {
            let sessionFilter = document.getElementById("sessionFilter");
            let uniqueSessions = [...new Set(courses.map(c => c.SessionName))];
            uniqueSessions.forEach(session => {
                let option = document.createElement("option");
                option.value = session;
                option.textContent = session;
                sessionFilter.appendChild(option);
            });
        }

        function renderTable(data) {
            let tableBody = document.getElementById("courseTableBody");
            tableBody.innerHTML = "";
            if (data.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="8" class="text-center p-4">No data found</td></tr>';
                return;
            }
            data.forEach(course => {
                const encodedData = btoa(JSON.stringify(course)); // Encode student object in Base64
                const studentDetailsUrl = `{{ route('course.details', ['course' => '__PLACEHOLDER__']) }}`.replace('__PLACEHOLDER__', encodedData);
                let row = `<tr class="hover:bg-gray-100">
                <td class="border p-3">${course.CourseCode}</td>
                <td class="border p-3">${course.CourseName}</td>
                <td class="border p-3">${course.Teacher}</td>
                <td class="border p-3">${course.JuniorLecturer}</td>
                <td class="border p-3">${course.SessionName}</td>
                <td class="border p-3">${course.Section_name}</td>
                <td class="border p-3">${course.total_enrollments}</td>
                <td class="border p-3">
                    <a href="${studentDetailsUrl}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">View</a>
                </td>

            </tr>`;
                tableBody.innerHTML += row;
            });
        }     
        function filterData() {
            let sessionFilter = document.getElementById("sessionFilter").value.toLowerCase();
            let sectionFilter = document.getElementById("sectionFilter").value.toLowerCase();
            let courseCodeFilter = document.getElementById("courseCodeFilter").value.toLowerCase();
            let courseNameFilter = document.getElementById("courseNameFilter").value.toLowerCase();
            let teacherFilter = document.getElementById("teacherFilter").value.toLowerCase();
            let juniorFilter = document.getElementById("juniorFilter").value.toLowerCase();
            let sessionTypeFilter = document.getElementById("sessionTypeFilter").value;
            let filteredData = courses.filter(course => {
                return (
                    (sessionFilter === "" || course.SessionName.toLowerCase().includes(sessionFilter)) &&
                    (sectionFilter === "" || course.Section_name.toLowerCase().includes(sectionFilter)) &&
                    (courseCodeFilter === "" || course.CourseCode.toLowerCase().includes(courseCodeFilter)) &&
                    (courseNameFilter === "" || course.CourseName.toLowerCase().includes(courseNameFilter)) &&
                    (teacherFilter === "" || course.Teacher.toLowerCase().includes(teacherFilter)) &&
                    (juniorFilter === "" || course.JuniorLecturer.toLowerCase().includes(juniorFilter))
                );
            });
            renderTable(filteredData);
        }

    </script>
    @include('components.footer')
</body>
</html>
