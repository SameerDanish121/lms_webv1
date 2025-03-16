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
    @include('components.navbar', [
    'username' => session('username', 'Guest'),
    'profileImage' => session('profileImage', asset('images/male.png')),
    'designation' => session('designation', 'N/A'),
    'type' => session('userType', 'User')
    ])

    <div class="max-w-6xl mx-auto py-8 px-4">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-3xl font-bold text-gray-700 mb-4 text-center">Temporary Enrolments</h2>
            <p class="text-gray-500 text-center mb-6">Manage and review student enrolment requests.</p>

            <!-- Search Fields -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <input type="text" id="searchRegNo" class="p-2 border rounded w-full" placeholder="Search by RegNo or Name">
                <input type="text" id="searchSection" class="p-2 border rounded w-full" placeholder="Search by Section">
                <input type="text" id="searchCourse" class="p-2 border rounded w-full" placeholder="Search by Course">
            </div>

            <div id="enrollmentsContainer" class="space-y-6"></div>
        </div>
    </div>

    <script>
        let enrollments = [];
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
        async function loadData() {
            try {
                API_BASE_URL = await getApiBaseUrl();
                let response = await fetch(`${API_BASE_URL}api/Datacells/temporary-enrollments`);
                let result = await response.json();
                if (!result.data) return;
                enrollments = result.data.sort((a, b) => new Date(b["Date Time"]) - new Date(a["Date Time"]));
                displayEnrollments(enrollments);
            } catch (error) {
                console.error("Error fetching enrollments:", error);
            }
        }

        function displayEnrollments(data) {
            const container = document.getElementById("enrollmentsContainer");
            container.innerHTML = "";
            data.forEach(enrollment => {
                const div = document.createElement("div");
                div.className = "bg-gray-50 p-6 rounded-lg shadow-md flex items-center space-x-4";
                const studentImage = enrollment["image"] ? enrollment["image"] : 'images/default_avatar.png';

                div.innerHTML = `
                    <img src="${studentImage}" alt="Student Avatar" class="w-16 h-16 rounded-full shadow-md">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-700">${enrollment["Student Name"]} (${enrollment["RegNo"]})</h3>
                        <p class="text-gray-500"><strong>Teacher:</strong> ${enrollment["Teacher Name"]}</p>
                        <p class="text-gray-500"><strong>Course:</strong> ${enrollment["Course Name"]}</p>
                        <p class="text-gray-500"><strong>Section:</strong> ${enrollment["Section Name"]}</p>
                        <p class="text-gray-500"><strong>Session:</strong> ${enrollment["Session Name"]}</p>
                        <p class="text-gray-500"><strong>Venue:</strong> ${enrollment["Venue"]}</p>
                        <p class="text-gray-500"><strong>Requested At:</strong> ${new Date(enrollment["Date Time"]).toLocaleString()}</p>
                        <p class="italic text-gray-600 mt-2">${enrollment["Message"]}</p>
                        <div class="mt-4">
                            <button class="bg-green-500 text-white px-4 py-2 rounded btn" onclick="${acceptEnrollment(enrollment["Request id"])}">Accept</button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded btn ml-2" onclick="${rejectEnrollment(enrollment["Request id"])}">Reject</button>
                        </div>
                    </div>
                `;
                container.appendChild(div);
            });
        }

        document.querySelectorAll("input").forEach(input => {
            input.addEventListener("keyup", () => {
                const regNoQuery = document.getElementById("searchRegNo").value.toLowerCase();
                const sectionQuery = document.getElementById("searchSection").value.toLowerCase();
                const courseQuery = document.getElementById("searchCourse").value.toLowerCase();
                const filtered = enrollments.filter(e =>
                    (e["RegNo"].toLowerCase().includes(regNoQuery) || e["Student Name"].toLowerCase().includes(regNoQuery)) &&
                    e["Section Name"].toLowerCase().includes(sectionQuery) &&
                    e["Course Name"].toLowerCase().includes(courseQuery)
                );
                displayEnrollments(filtered);
            });
        });

        async function processTemporaryEnrollment(tempEnrollId, verification) {
            try {
                API_BASE_URL = await getApiBaseUrl();
                const response = await fetch(`${API_BASE_URL}api/Datacells/process-temporary-enrollments`, {
                    method: 'POST'
                    , headers: {
                        'Content-Type': 'application/json'
                    , }
                    , body: JSON.stringify({
                        temp_enroll_id: tempEnrollId
                        , verification: verification
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    alert(`Success: ${data.message}`);
                    reloadData(); // Reload data after successful API call
                } else {
                    console.error('Error:', data);
                    alert(`Error: ${data.message}`);
                }
            } catch (error) {
                console.error('Request failed:', error);
                alert('An unexpected error occurred. Please try again.');
            }
        }

        // Function to reload the data (Modify this function as per your needs)
        function reloadData() {
            console.log("Reloading data...");
            location.reload(); // Simple way to refresh the page
        }

        // Example usage:
        function acceptEnrollment(tempEnrollId) {
            processTemporaryEnrollment(tempEnrollId, 'Accepted');
        }

        function rejectEnrollment(tempEnrollId) {
            processTemporaryEnrollment(tempEnrollId, 'Rejected');
        }


        loadData();

    </script>

    @include('components.footer')
</body>
</html>
