<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session List</title>
    @vite('resources/css/app.css')
    <script>
        let sessions = [];
        let filteredSessions = [];
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

        async function loadSessions() {
            try {
                API_BASE_URL = await getApiBaseUrl();
                const response = await fetch(`${API_BASE_URL}api/Admin/sessions`);
                const data = await response.json();
                if (data.data) {
                    sessions = data.data;
                    filteredSessions = [...sessions];
                    renderSessions();
                }
            } catch (error) {
                console.error("Error fetching sessions:", error);
            }
        }

        function searchSessions() {
            const searchText = document.getElementById("search-input").value.toLowerCase();
            filteredSessions = sessions.filter(session =>
                session.name.toLowerCase().includes(searchText)
            );
            renderSessions();
        }

        function filterByStatus() {
            const statusFilter = document.getElementById("status-filter").value;
            if (statusFilter === "All") {
                filteredSessions = [...sessions];
            } else {
                filteredSessions = sessions.filter(session => session.status === statusFilter);
            }
            renderSessions();
        }

        function renderSessions() {
            const tableBody = document.getElementById("session-table-body");
            tableBody.innerHTML = "";

            if (filteredSessions.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-gray-500">No sessions found.</td></tr>';
                return;
            }

            filteredSessions.forEach(session => {
                tableBody.innerHTML += `
                    <tr class="border-b border-gray-300 text-center">
                        <td class="px-4 py-2">${session.id}</td>
                        <td class="px-4 py-2">${session.name}</td>
                        <td class="px-4 py-2">${session.start_date}</td>
                        <td class="px-4 py-2">${session.end_date}</td>
                        <td class="px-4 py-2">${session.remaining_time}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded ${
                                session.status === 'Current' ? 'bg-green-500 text-white' :
                                session.status === 'Upcoming' ? 'bg-yellow-500 text-white' :
                                'bg-gray-500 text-white'
                            }">${session.status}</span>
                        </td>
                        <td class="px-4 py-2">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded" onclick="openEditForm(${session.id}, '${session.name}', '${session.start_date}', '${session.end_date}')">Edit</button>
                        </td>
                    </tr>`;
            });
        }

        function resetSearch() {
            document.getElementById("search-input").value = "";
            document.getElementById("status-filter").value = "All";
            filteredSessions = [...sessions];
            renderSessions();
        }

        function openEditForm(id, name, startDate, endDate) {
            document.getElementById("edit-session-id").value = id;
            document.getElementById("edit-session-name").value = name;
            document.getElementById("edit-start-date").value = startDate;
            document.getElementById("edit-end-date").value = endDate;
            document.getElementById("edit-modal").classList.remove("hidden");
        }

        function closeEditForm() {
            document.getElementById("edit-modal").classList.add("hidden");
        }

        function openAddForm() {
            // Reset form fields
            document.getElementById("session-name").value = ""; // Dropdown (Fall/Spring/Summer)
            document.getElementById("session-year").value = ""; // Dropdown for year
            document.getElementById("start-date").value = "";
            document.getElementById("end-date").value = "";

            // Show modal
            document.getElementById("add-session-modal").classList.remove("hidden");
        }


        function closeAddSessionForm() {
            document.getElementById("add-session-modal").classList.add("hidden");
        }
        async function addSession() {
            showLoader();
            API_BASE_URL = await getApiBaseUrl();

            // Get values from form fields
            const name = document.getElementById("session-name").value; // Dropdown (Fall/Spring/Summer)
            const year = parseInt(document.getElementById("session-year").value); // Dropdown for year
            const startDate = document.getElementById("start-date").value;
            const endDate = document.getElementById("end-date").value;

            // Validate Dates
            if (!startDate || !endDate) {
                hideLoader();
                alert("Please select both start and end dates.");

                return;
            }
            if (new Date(startDate) >= new Date(endDate)) {
                hideLoader();
                alert("Start date must be before the end date.");
                return;
            }

            try {
                const response = await fetch(`${API_BASE_URL}api/Insertion/add-session`, {
                    method: "POST"
                    , headers: {
                        "Content-Type": "application/json"
                    }
                    , body: JSON.stringify({
                        name
                        , year
                        , start_date: startDate
                        , end_date: endDate
                    })
                });

                const data = await response.json();
                if (!response.ok) {
                    hideLoader();
                    throw new Error(data.message || "Failed to add session");
                }
                hideLoader();
                alert(data.message);
                closeAddSessionForm(); // Close the modal after success
                loadSessions(); // Refresh session list
            } catch (error) {
                hideLoader();
                alert(`Error adding session: ${error.message}`);
            }
        }


        async function updateSession() {
            showLoader();
            API_BASE_URL = await getApiBaseUrl();
            const id = document.getElementById("edit-session-id").value;
            const nameInput = document.getElementById("edit-session-name").value;
            const startDate = document.getElementById("edit-start-date").value;
            const endDate = document.getElementById("edit-end-date").value;
            // Validate dates
            if (new Date(startDate) >= new Date(endDate)) {
                hideLoader();
                alert("Start date must be before the end date.");
                return;
            }

            try {
                const response = await fetch(`${API_BASE_URL}api/Insertion/update-session/${id}`, {
                    method: "POST"
                    , headers: {
                        "Content-Type": "application/json"
                    }
                    , body: JSON.stringify({
                        name:nameInput
                        , start_date: startDate
                        , end_date: endDate
                    })
                });

                const data = await response.json();
                if (!response.ok) {
                    hideLoader();
                    throw new Error(data.message || "Failed to update session");
                }
                hideLoader();
                alert(data.message);
                closeEditForm();
                loadSessions();
            } catch (error) {
                hideLoader();
                alert(`Error updating session: ${error.message}`);
            }
        }

        document.addEventListener("DOMContentLoaded", loadSessions);

    </script>
</head>
<body class="bg-gray-100">
    @include('components.navbar', [
    'username' => session('username', 'Guest'),
    'profileImage' => session('profileImage', asset('images/male.png')),
    'designation' => session('designation', 'N/A'),
    'type' => session('userType', 'User')
    ])
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-blue-700 text-center mb-4">Session List</h2>

        <div class="mb-4 flex flex-col sm:flex-row justify-center items-center gap-4">
            <input type="text" id="search-input" class="border p-2 w-full sm:w-96" oninput="searchSessions()" placeholder="Search by Name">
            <select id="status-filter" class="border p-2 w-full sm:w-48" onchange="filterByStatus()">
                <option value="All">All</option>
                <option value="Current">Current</option>
                <option value="Upcoming">Upcoming</option>
                <option value="Previous">Previous</option>
            </select>
            <button onclick="openAddForm()" class="bg-green-500 text-white px-4 py-2 rounded">Add Session</button>
            <button onclick="resetSearch()" class="bg-gray-500 text-white px-4 py-2 rounded">Reset</button>
        </div>

        <div class="table-container mx-auto max-w-5xl">
            <table class="border border-gray-300 shadow-lg bg-white w-full">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Start Date</th>
                        <th class="px-4 py-2">End Date</th>
                        <th class="px-4 py-2">Time Left</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody id="session-table-body">
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id="edit-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-xl font-bold mb-4">Edit Session</h2>
            <input type="hidden" id="edit-session-id">
            <input type="text" id="edit-session-name" placeholder="Session Name" class="border p-2 w-full mb-2">
            <input type="date" id="edit-start-date" class="border p-2 w-full mb-2">
            <input type="date" id="edit-end-date" class="border p-2 w-full mb-2">
            <button onclick="updateSession()" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
            <button onclick="closeEditForm()" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
        </div>
    </div>
    <div id="add-session-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-2xl font-bold mb-4 text-center">Add New Session</h2>

            <!-- Session Name Dropdown -->
            <label class="block font-semibold mb-1">Session Name</label>
            <select id="session-name" class="border p-2 w-full mb-2 rounded">
                <option value="Fall">Fall</option>
                <option value="Spring">Spring</option>
                <option value="Summer">Summer</option>
            </select>

            <!-- Year Dropdown -->
            <label class="block font-semibold mb-1">Year</label>
            <select id="session-year" class="border p-2 w-full mb-2 rounded"></select>

            <!-- Start Date -->
            <label class="block font-semibold mb-1">Start Date</label>
            <input type="date" id="start-date" class="border p-2 w-full mb-2 rounded">

            <!-- End Date -->
            <label class="block font-semibold mb-1">End Date</label>
            <input type="date" id="end-date" class="border p-2 w-full mb-4 rounded">

            <!-- Buttons -->
            <div class="flex justify-end space-x-2">
                <button onclick="addSession()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Save
                </button>
                <button onclick="closeAddSessionForm()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <script>
        // Auto-fill year dropdown (current year ± 5 years)
        function populateYearDropdown() {
            const yearDropdown = document.getElementById("session-year");
            const currentYear = new Date().getFullYear();
            for (let i = currentYear - 5; i <= currentYear + 5; i++) {
                let option = document.createElement("option");
                option.value = i;
                option.textContent = i;
                if (i === currentYear) option.selected = true; // Default to current year
                yearDropdown.appendChild(option);
            }
        }

        // Run function on page load
        window.onload = populateYearDropdown;

    </script>
    @include('components.loader')
    @include('components.footer')
</body>
</html>
