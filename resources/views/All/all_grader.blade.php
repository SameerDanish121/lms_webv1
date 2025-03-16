<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grader List</title>
    @vite('resources/css/app.css')
    <style>
        .table-container {
            transition: all 0.3s ease-in-out;
        }

        .search-active .table-container {
            max-width: 80%;
        }

    </style>
    <script>
        let graders = [];
        let filteredGraders = [];
        let API_BASE_URL = "http://127.0.0.1:8000/";
        let itemsToShow = 10;
        let selectedType = "";
        let selectedStatus = "";

        async function getApiBaseUrl() {
            try {
                let response = await fetch('/get-api-url');
                let data = await response.json();
                return data.api_base_url;
            } catch (error) {
                return API_BASE_URL;
            }
        }

        async function loadGraders() {
            try {
                API_BASE_URL = await getApiBaseUrl();
                const response = await fetch(`${API_BASE_URL}api/Admin/grades`);
                const data = await response.json();
                if (data.Grader) {
                    graders = data.Grader;
                    filteredGraders = [...graders];
                    renderGraders();
                }
            } catch (error) {
                console.error("Error fetching graders:", error);
            }
        }

        function searchGraders() {
            const nameSearch = document.getElementById("search-name").value.toLowerCase();
            const teacherSearch = document.getElementById("search-teacher").value.toLowerCase();

            filteredGraders = graders.filter(grader =>
                (grader.name.toLowerCase().includes(nameSearch) || nameSearch === "") &&
                (grader["Grader of Teacher in Current Session"].toLowerCase().includes(teacherSearch) || teacherSearch === "") &&
                (selectedType === "" || grader.type === selectedType) &&
                (selectedStatus === "" || grader.status === selectedStatus)
            );

            renderGraders();
            document.getElementById("table-wrapper").classList.add("search-active");
        }

        function resetSearch() {
            document.getElementById("search-name").value = "";
            document.getElementById("search-teacher").value = "";
            document.getElementById("status-filter").value = "";
            document.querySelectorAll("input[name='type-filter']").forEach(radio => radio.checked = false);
            selectedType = "";
            selectedStatus = "";
            filteredGraders = [...graders];
            renderGraders();
            document.getElementById("table-wrapper").classList.remove("search-active");
        }

        function handleTypeFilter(type) {
            selectedType = type;
            searchGraders();
        }

        function handleStatusFilter(status) {
            selectedStatus = status;
            searchGraders();
        }

        function renderGraders() {
            const tableBody = document.getElementById("grader-table-body");
            tableBody.innerHTML = "";

            if (filteredGraders.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="8" class="text-center py-4 text-gray-500">No graders found.</td></tr>';
                return;
            }

            filteredGraders.forEach(grader => {
                let actionColumn = grader["Grader of Teacher in Current Session"];
                if (grader["Grader of Teacher in Current Session"] === "N/A" && grader.status.toLowerCase() === "in-active") {
                    actionColumn = `<button onclick="assignGrader(${grader.grader_id}, '${grader.name}','${grader.regNo}','${grader.image}')" class="bg-green-500 text-white px-3 py-1 rounded">Assign</button>`;
                }
                const encodedData = btoa(JSON.stringify(grader.student_id)); // Encode student object in Base64
                const studentDetailsUrl = `{{ route('grader.details', ['student_id' => '__PLACEHOLDER__']) }}`.replace('__PLACEHOLDER__', encodedData);
                tableBody.innerHTML += `
                    <tr class="border-b border-gray-300 text-center">
                        <td class="px-4 py-2">
                            <img src="${grader.image ? grader.image : '{{ asset('images/male.png') }}'}" alt="Profile" class="w-12 h-12 rounded-full mx-auto">
                        </td>
                        <td class="px-4 py-2">${grader.name}</td>
                        <td class="px-4 py-2">${grader.regNo}</td>
                        <td class="px-4 py-2">${grader.section}</td>
                        <td class="px-4 py-2">${grader.type}</td>
                        <td class="px-4 py-2">${grader.status}</td>
                        <td class="px-4 py-2">${actionColumn}</td>
                        <td class="px-4 py-2">
                             <a href="${studentDetailsUrl}" class="bg-blue-500 text-white px-4 py-2 rounded">History</a>
                        </td>
                    </tr>`;
            });
        }

        async function confirmAssignment() {
            try {
                let API_BASE_URL = await getApiBaseUrl(); // Await is allowed inside async function
                let graderId = document.getElementById("graderId").value;
                let teacherId = document.getElementById("teacherDropdown").value;

                if (!teacherId) {
                    alert("Please select a teacher.");
                    return;
                }

                let requestData = {
                    grader_id: graderId
                    , teacher_id: teacherId
                };

                let response = await fetch(`${API_BASE_URL}api/Datacells/assign-grader`, {
                    method: "POST"
                    , headers: {
                        "Content-Type": "application/json"
                    }
                    , body: JSON.stringify(requestData)
                });

                let data = await response.json();

                if (data.status === "success") {
                    alert("Grader assigned successfully!");
                    console.log(data);
                    await loadGraders(); // Ensure loadGraders is awaited if it's async
                    closeModal();
                } else {
                    alert("Error: " + data.message);
                    console.error(data);
                }
            } catch (error) {
                alert("An unexpected error occurred: " + error.message);
                console.error(error);
            }
        }

        async function assignGrader(graderId, name, regNo, imageUrl = null) {
            document.getElementById("graderName").innerText = name;
            document.getElementById("graderRegNo").innerText = "RegNo: " + regNo;
            document.getElementById("graderId").value = graderId;

            let imageElement = document.getElementById("graderImage");
            let defaultAvatar = document.getElementById("defaultAvatar");

            if (imageUrl) {
                imageElement.src = imageUrl;
                imageElement.classList.remove("hidden");
                defaultAvatar.classList.add("hidden");
            } else {
                imageElement.classList.add("hidden");
                defaultAvatar.classList.remove("hidden");
            }
            try {
                API_BASE_URL = await getApiBaseUrl();
                let response = await fetch(`${API_BASE_URL}api/Admin/un-assigned/teacher-for-grader`);
                let data = await response.json();

                let teacherDropdown = document.getElementById("teacherDropdown");
                teacherDropdown.innerHTML = `<option value="">Select Teacher</option>`; // Reset options

                if (data["Unassigned Teachers"] && data["Unassigned Teachers"].length > 0) {
                    data["Unassigned Teachers"].forEach(teacher => {
                        let option = document.createElement("option");
                        option.value = teacher.id;
                        option.textContent = teacher.name;
                        teacherDropdown.appendChild(option);
                    });
                } else {
                    teacherDropdown.innerHTML = `<option value="">No Teachers Available</option>`;
                }
            } catch (error) {
                console.error("Error fetching unassigned teachers:", error);
                alert("Failed to load unassigned teachers. Please try again.");
            }

            document.getElementById("assignModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("assignModal").classList.add("hidden");
        }

        document.addEventListener("DOMContentLoaded", loadGraders);
        async function openAddGraderForm() {
            document.getElementById("addGraderForm").classList.remove("hidden");
            await populateDropdowns();
        }

        async function populateDropdowns() {
            let API_BASE_URL = await getApiBaseUrl();

            try {
                let teachersResponse = await fetch(`${API_BASE_URL}api/Dropdown/get-teachers`);
                let teachersData = await teachersResponse.json();
                let teacherDropdown = document.getElementById("teacherDropdown");
                teacherDropdown.innerHTML = '<option value="">Select Teacher</option>';
                teachersData.forEach(teacher => {
                    teacherDropdown.innerHTML += `<option value="${teacher.id}">${teacher.name}</option>`;
                });

                // Fetch students
                let studentsResponse = await fetch(`${API_BASE_URL}api/Dropdown/get-students`);
                let studentsData = await studentsResponse.json();
                let studentDropdown = document.getElementById("studentDropdown");
                studentDropdown.innerHTML = '<option value="">Select Student</option>';
                studentsData.forEach(student => {
                    studentDropdown.innerHTML += `<option value="${student.id}">${student.name}</option>`;
                });

                // Fetch sessions
                let sessionResponse = await fetch(`${API_BASE_URL}api/Dropdown/AllSession`);
                let sessionData = await sessionResponse.json();
                let sessionDropdown = document.getElementById("sessionDropdown");
                sessionData.forEach(student => {
                    sessionDropdown.innerHTML += `<option value="${student.id}">${student.name}</option>`;
                });


            } catch (error) {
                alert("Failed to fetch dropdown data: " + error.message);
            }
        }

        async function addGrader() {
            let API_BASE_URL = await getApiBaseUrl();
            let teacherId = document.getElementById("teacherDropdown").value;
            let studentId = document.getElementById("studentDropdown").value;
            let sessionId = document.getElementById("sessionDropdown").value;
            let type = document.getElementById("typeDropdown").value; // Optional field
            //alert(`Teacher ID: ${teacherId}, Student ID: ${studentId}, Session ID: ${sessionId}, Type: ${type}`);
            if (!teacherId || !studentId || !sessionId) {
                alert("Please fill in all required fields.");
                return;
            }

            let requestData = {
                teacher_id: teacherId
                , grader_id: studentId
                , session_id: sessionId
                , type: type || null
            };

            try {
                let response = await fetch(`${API_BASE_URL}api/Datacells/add-grader`, {
                    method: "POST"
                    , headers: {
                        "Content-Type": "application/json"
                    }
                    , body: JSON.stringify(requestData)
                });

                let data = await response.json();

                if (data.status === "success") {
                    alert("Grader added successfully!");
                    console.log(data);
                    resetAddGraderForm();
                    document.getElementById("addGraderForm").classList.add("hidden");
                   await loadGraders(); // Ensure loadGraders is awaited if it's async
                } else {
                    let error=parseErrorMessage(data.error);
                    alert("Error: " + error);
                    console.error(data);
                }
            } catch (error) {
                let errors=parseErrorMessage(error.error);
                alert("An unexpected error occurred: " + errors);
                console.error(error);
            }
        }

        function parseErrorMessage(error) {
            if (typeof error === 'string') {
                return error; // Return as-is if it's already plain text
            } else if (typeof error === 'object' && error !== null) {
                if (Array.isArray(error)) {
                    return error.join(', '); // Convert array errors to comma-separated text
                } else {
                    let messages = [];
                    for (const key in error) {
                        if (Array.isArray(error[key])) {
                            messages.push(`${key}: ${error[key].join(', ')}`);
                        } else {
                            messages.push(`${key}: ${error[key]}`);
                        }
                    }
                    return messages.join('\n'); // Return as multi-line text
                }
            }
            return "An unexpected error occurred."; // Default fallback
        }

        function resetAddGraderForm() {
            document.getElementById("teacherDropdown").value = "";
            document.getElementById("studentDropdown").value = "";
            document.getElementById("typeDropdown").value = "";
        }

    </script>
</head>

<body class="bg-gray-100">
    @include('components.navbar')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-blue-700 text-center mb-4">Grader Distribution For Current
            Session</h2>

        <div class="mb-6 p-4 bg-white shadow-md rounded-lg">
            <h3 class="text-lg font-semibold text-gray-700 mb-3 text-center sm:text-left">Search & Filters</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <!-- Search by Grader Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Grader Name</label>
                    <input type="text" id="search-name" class="border rounded-lg p-2 w-full" oninput="searchGraders()" placeholder="Enter grader name">
                </div>

                <!-- Search by Teacher Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Teacher Name</label>
                    <input type="text" id="search-teacher" class="border rounded-lg p-2 w-full" oninput="searchGraders()" placeholder="Enter teacher name">
                </div>

                <!-- Type Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Type</label>
                    <div class="flex items-center gap-4">
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="type-filter" value="merit" onclick="handleTypeFilter(this.value)">
                            <span class="text-sm text-gray-700">Merit-based</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="type-filter" value="need-based" onclick="handleTypeFilter(this.value)">
                            <span class="text-sm text-gray-700">Need-based</span>
                        </label>
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                    <select id="status-filter" class="border rounded-lg p-2 w-full" onchange="handleStatusFilter(this.value)">
                        <option value="">Select Status</option>
                        <option value="active">Active</option>
                        <option value="in-active">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-between mt-4">
                <button onclick="resetSearch()" class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                    Reset Filters
                </button>
                <button onclick="openAddGraderForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Add Grader
                </button>
            </div>
        </div>
        <div id="addGraderForm" class="hidden mb-6 p-4 bg-white shadow-md rounded-lg">
            <h3 class="text-lg font-semibold text-gray-700 mb-3 text-center sm:text-left">Add New Grader</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <!-- Teacher Dropdown -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Select Teacher</label>
                    <select id="teacherDropdown" class="border rounded-lg p-2 w-full">
                        <option value="">Select Teacher</option>
                    </select>
                </div>

                <!-- Student Dropdown -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Select Student</label>
                    <select id="studentDropdown" class="border rounded-lg p-2 w-full">
                        <option value="">Select Student</option>
                    </select>
                </div>

                <!-- Session Dropdown -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Select Session</label>
                    <select id="sessionDropdown" class="border rounded-lg p-2 w-full">
                        <option value="">Select Session</option>
                    </select>
                </div>

                <!-- Type (Optional) -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Type (Optional)</label>
                    <select id="typeDropdown" class="border rounded-lg p-2 w-full">
                        <option value="">Select Type</option>
                        <option value="merit">Merit-based</option>
                        <option value="need-based">Need-based</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center sm:justify-end mt-4">
                <button onclick="addGrader()" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
                    Submit
                </button>
            </div>
        </div>
        <div id="table-wrapper" class="table-container mx-auto max-w-5xl">
            <table class="border border-gray-300 shadow-lg bg-white w-full">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2">Image</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Reg No</th>
                        <th class="px-4 py-2">Section</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Grader Of</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody id="grader-table-body"></tbody>
            </table>
        </div>
    </div>

    <div id="assignModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 w-96 sm:w-[450px] rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Assign Grader</h2>

            <!-- Grader Info Section -->
            <div class="flex flex-col items-center">
                <!-- Circular Image Placeholder -->
                <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                    <img id="graderImage" src="" class="w-full h-full object-cover hidden">
                    <span id="defaultAvatar" class="text-gray-500 text-sm">No Image</span>
                </div>

                <!-- Grader Name & RegNo -->
                <p id="graderName" class="mt-2 text-lg font-bold text-gray-800"></p>
                <p id="graderRegNo" class="text-gray-600 text-sm"></p>

                <!-- Hidden Grader ID -->
                <input type="hidden" id="graderId">
            </div>

            <!-- Teacher Dropdown -->
            <div class="mt-4">
                <label class="block text-gray-700 font-medium mb-1">Select Teacher</label>
                <select id="teacherDropdown" class="border p-2 w-full rounded-md">
                    <option value="">Select Teacher</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between mt-6">
                <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
                <button onclick="confirmAssignment()" class="bg-green-500 text-white px-4 py-2 rounded-md">Confirm</button>
            </div>
        </div>
    </div>

    @include('components.footer')
</body>

</html>
