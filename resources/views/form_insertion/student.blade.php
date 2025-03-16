<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS - Add Student</title>
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
<body class="bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100 min-h-screen p-0 m-0">
    @include('components.navbar', [
    'username' => session('username', 'Guest'),
    'profileImage' => session('profileImage', asset('images/male.png')),
    'designation' => session('designation', 'N/A'),
    'type' => session('type', 'User')
    ])
    <br/>
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Add Student</h2>
        <form id="studentForm" enctype="multipart/form-data" class="max-w-4xl mx-auto">
            <!-- Profile Image Upload -->
            <div class="flex justify-center relative mb-6">
                <div class="relative">
                    <img id="profilePreview" src="/default-profile.png" class="w-32 h-32 rounded-full object-cover border-4 border-gray-300 cursor-pointer" onclick="triggerFileInput()">
                    <span class="absolute bottom-1 right-1 bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center cursor-pointer shadow-md text-lg font-bold" onclick="triggerFileInput()">+</span>
                    <input type="file" id="profileImageInput" name="image" class="hidden" accept="image/*" onchange="previewImage(event)">
                </div>
            </div>
            <button type="button" class="block mx-auto bg-red-500 text-white px-4 py-1 rounded-md text-sm mb-6" onclick="removeImage()">Remove Image</button>

            <!-- Form Fields: Two per Row -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700">Registration Number *</label>
                    <input type="text" name="RegNo" id="RegNo" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700">Full Name *</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700">Email *</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700">CGPA</label>
                    <input type="number" name="cgpa" id="cgpa" class="w-full p-2 border border-gray-300 rounded" step="0.01">
                </div>
                <div>
                    <label class="block text-gray-700">Gender *</label>
                    <select name="gender" id="gender" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700">Date of Birth *</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700">Guardian Name</label>
                    <input type="text" name="guardian" id="guardian" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-gray-700">Status *</label>
                    <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="">Select Status</option>
                        <option value="Graduate">Graduate</option>
                        <option value="UnderGraduate">Undergraduate</option>
                        <option value="Freeze">Freeze</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700">Program *</label>
                    <select name="program_id" id="program_id" class="w-full p-2 border border-gray-300 rounded" required></select>
                </div>
                <div>
                    <label class="block text-gray-700">Session *</label>
                    <select name="session_id" id="session_id" class="w-full p-2 border border-gray-300 rounded" required></select>
                </div>
                <div>
                    <label class="block text-gray-700">Section *</label>
                    <select name="section_id" id="section_id" class="w-full p-2 border border-gray-300 rounded" required></select>
                </div>
            </div>

            <button type="submit" class="w-full mt-6 bg-blue-500 text-white py-2 rounded">Submit</button>
        </form>


    </div>

    <script>
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
        document.addEventListener("DOMContentLoaded", async function() {
            API_BASE_URL = await getApiBaseUrl();
            fetchDropdownData(`${API_BASE_URL}api/Dropdown/AllSession`, 'session_id');
            fetchDropdownData(`${API_BASE_URL}api/Dropdown/AllProgram`, 'program_id');
            fetchDropdownData(`${API_BASE_URL}api/Dropdown/AllSection`, 'section_id');
        });


        function fetchDropdownData(apiUrl, elementId) {
            fetch(apiUrl)
                .then(response => response.json())
                .then(response => {
                    const dropdown = document.getElementById(elementId);
                    dropdown.innerHTML = '<option value="">Select an option</option>';
                    response.forEach(item => {
                        dropdown.innerHTML += `<option value="${item.id}">${item.data}</option>`;
                    });
                })
                .catch(error => console.error("Error fetching data:", error));
        }

        function triggerFileInput() {
            document.getElementById('profileImageInput').click();
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('profilePreview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function removeImage() {
            document.getElementById('profilePreview').src = '/default-profile.png';
            document.getElementById('profileImageInput').value = "";
        }

        document.getElementById('studentForm').addEventListener('submit', async function(event) {
            showLoader();
            event.preventDefault();
            API_BASE_URL = await getApiBaseUrl();
            const formData = new FormData(this);
            fetch(`${API_BASE_URL}api/Insertion/add-single-student`, {
                    method: 'POST'
                    , body: formData
                })
                .then(async response => {
                    let data;
                    try {
                        data = await response.json(); // Attempt to parse JSON response
                    } catch (error) {
                        throw new Error(`Unexpected server response: ${response.statusText}`);
                    }

                    if (!response.ok) {
                        throw new Error(data.message || `Error ${response.status}: Something went wrong`);
                    }

                    return data;
                })
                .then(data => {
                    if (data.username && data.password) {
                        hideLoader();
                        showAlert(`✅ ${data.message}\n👤 Username: ${data.username}\n🔑 Password: ${data.password}`,'success');
                    } else {
                        hideLoader();
                        showAlert(`✅ ${data.message}`);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    hideLoader();
                    let errorMessage = error.message || "Something went wrong!";
                if (typeof error.errors === "object") {
                    errorMessage += "\n" + Object.values(error.errors).flat().join("\n");
                } else if (typeof error.errors === "string") {
                    errorMessage += "\n" + error.errors; // Directly append if it's a string
                }
                    showAlert(`❌ ${errorMessage}`);
                });


        });
        window.addEventListener("load", function() {
            document.getElementById("loader").classList.add("hidden");
        });

        function showLoader() {
            document.getElementById("loader").classList.remove("hidden");
        }

        function hideLoader() {
            document.getElementById("loader").classList.add("hidden");
        }
        function showAlert(message, type = "error") {
        // Remove existing alert if present
        const existingAlert = document.getElementById("custom-alert");
        if (existingAlert) existingAlert.remove();

        // Define alert colors based on type
        const colors = {
            success: "bg-green-600"
            , error: "bg-red-600"
            , warning: "bg-yellow-600"
            , info: "bg-blue-600"
        , };

        // Create alert div
        const alertDiv = document.createElement("div");
        alertDiv.id = "custom-alert";
        alertDiv.className = `${colors[type]} text-white fixed top-24 right-5 px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3 animate-slide-in transition-all duration-300 z-50`;

        // Alert icon (SVG)
        const icon = document.createElement("div");
        icon.innerHTML = `
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M10.29 3.86L1.82 18.14A2 2 0 003.73 21h16.54a2 2 0 001.91-2.86L13.71 3.86a2 2 0 00-3.42 0zM12 9v4m0 4h.01">
            </path>
        </svg>`;

        // Alert message
        const messageText = document.createElement("span");
        messageText.className = "font-semibold";
        messageText.innerText = message;

        // Close button
        const closeButton = document.createElement("button");
        closeButton.innerHTML = "✖";
        closeButton.className = "text-white hover:text-gray-300 focus:outline-none";
        closeButton.onclick = () => alertDiv.remove();

        // Append elements to alert
        alertDiv.appendChild(icon);
        alertDiv.appendChild(messageText);
        alertDiv.appendChild(closeButton);

        // Append alert to body
        document.body.appendChild(alertDiv);

        // Auto-remove alert after 4 seconds
        setTimeout(() => {
            alertDiv.remove();
            location.reload();
        }, 10000);
    }

    </script>
    @include('components.loader')
    @include('components.footer')
</body>
</html>
