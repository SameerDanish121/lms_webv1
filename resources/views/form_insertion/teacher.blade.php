<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS - Add New Teacher</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100 min-h-screen p-0 m-0">

    @include('components.navbar', [
        'username' => session('username', 'Guest'),
        'profileImage' => session('profileImage', asset('images/male.png')),
        'designation' => session('designation', 'N/A'),
        'type' => session('type', 'User')
    ])

    <div class="flex items-center justify-center p-10">
        <div class="w-4/5 bg-white shadow-lg rounded-lg p-10">
            <h2 class="text-3xl font-bold text-center text-orange-500 mb-6">Add New Teacher</h2>
            <form id="teacherForm" class="grid grid-cols-2 gap-8">

                <div class="space-y-4">
                    <div>
                        <label class="block text-lg font-semibold">Teacher Name</label>
                        <input type="text" id="name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-lg font-semibold">Date of Birth</label>
                        <input type="date" id="dob" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-lg font-semibold">Gender</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="gender" value="Male" id="male" class="hidden">
                                <span class="w-5 h-5 border-2 border-gray-500 rounded-full flex items-center justify-center mr-2 transition-all">
                                    <span class="inner-circle w-3 h-3 bg-transparent rounded-full"></span>
                                </span> Male
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="gender" value="Female" id="female" class="hidden">
                                <span class="w-5 h-5 border-2 border-gray-500 rounded-full flex items-center justify-center mr-2 transition-all">
                                    <span class="inner-circle w-3 h-3 bg-transparent rounded-full"></span>
                                </span> Female
                            </label>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-lg font-semibold">Email (Optional)</label>
                        <input type="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-lg font-semibold">Upload Picture (Optional)</label>
                        <div class="flex items-center space-x-3">
                            <img id="imagePreview" class="w-12 h-12 object-cover rounded-full border hidden">
                            <input type="file" id="picture" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </form>

            <div class="text-center mt-6">
                <button onclick="submitForm()" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition transform hover:scale-105">
                    Submit
                </button>
            </div>

            <div id="message" class="mt-4 text-center text-lg font-semibold"></div>
        </div>
    </div>
    <script>
        window.addEventListener("load", function() {
            document.getElementById("loader").classList.add("hidden");
        });

        function showLoader() {
            document.getElementById("loader").classList.remove("hidden");
        }

        function hideLoader() {
            document.getElementById("loader").classList.add("hidden");
        }

    </script>

    <div id="loader" class="hidden fixed top-0 left-0 w-full h-full flex justify-center items-center bg-white bg-opacity-50">
        <div class="w-20 h-20 border-4 border-transparent text-blue-400 text-4xl animate-spin flex items-center justify-center border-t-blue-400 rounded-full">
            <div class="w-16 h-16 border-4 border-transparent text-red-400 text-2xl animate-spin flex items-center justify-center border-t-red-400 rounded-full"></div>
        </div>
    </div>
    <footer class="bg-blue-600 p-2 mt-20 shadow-md text-center text-white">
        <h4 class="font-bold text-2xl mb-2">Learning Management System</h4>
        <p>&copy; 2025 LMS. All Rights Reserved.</p>
        <p>Sameer | Ali | Sharjeel</p>
    </footer>

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
        async function initializeApiBaseUrl() {
            API_BASE_URL = await getApiBaseUrl();
        }
        initializeApiBaseUrl();
        document.addEventListener("DOMContentLoaded", function () {
            // Attach event listeners for gender selection
            document.querySelectorAll('input[name="gender"]').forEach(radio => {
                radio.addEventListener("change", updateRadioStyle);
            });

            // Call function initially to check if any radio is pre-selected
            updateRadioStyle();

            // Attach event listener for image preview
            document.getElementById("picture").addEventListener("change", previewImage);
        });

        function updateRadioStyle() {
            setTimeout(() => {
                document.querySelectorAll('input[name="gender"]').forEach(radio => {
                    let parentSpan = radio.nextElementSibling;
                    let innerCircle = parentSpan.querySelector(".inner-circle");

                    if (radio.checked) {
                        innerCircle.classList.add("bg-blue-500");
                        innerCircle.classList.remove("bg-transparent");
                    } else {
                        innerCircle.classList.remove("bg-blue-500");
                        innerCircle.classList.add("bg-transparent");
                    }
                });
            }, 50); // Slight delay to ensure DOM updates
        }

        function previewImage(event) {
            const imagePreview = document.getElementById("imagePreview");
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove("hidden");
                };
                reader.readAsDataURL(file);
            }
        }
        function showLoader() {
        document.getElementById("loader").classList.remove("hidden");
    }

    function hideLoader() {
        document.getElementById("loader").classList.add("hidden");
    }
        async function submitForm() {
            showLoader();
            let name = document.getElementById("name").value.trim();
            let dob = document.getElementById("dob").value;
            let gender = document.querySelector('input[name="gender"]:checked') ? document.querySelector('input[name="gender"]:checked').value : "";
            let email = document.getElementById("email").value.trim();
            let picture = document.getElementById("picture").files[0];

            if (!name || !dob || !gender) {
                hideLoader();
                showMessage("Please fill in all required fields.", "text-red-600");
                return;
            }

            let formData = new FormData();
            formData.append("name", name);
            formData.append("date_of_birth", dob);
            formData.append("gender", gender);
            if (email) formData.append("email", email);
            if (picture) formData.append("image", picture);

            try {
                let response = await fetch(`${API_BASE_URL}api/Insertion/add-single-teacher`, {
                    method: "POST",
                    body: formData
                });

                let result = await response.json();
                if (response.ok) {
                    hideLoader();
                    showAlert(`Added Successful!\nLogs: ${result["message"]}\n Username: ${result["username"]}\n Password: ${result["password"]}`, 'success');
                    clearForm();
                } else {
                    hideLoader();
                    showMessage(result.message || "An error occurred while adding the teacher.", "text-red-600");
                }
            } catch (error) {
                hideLoader();
                showMessage("Server error. Please try again later.", "text-red-600");
            }
        }

        function showMessage(message, className) {
            let messageDiv = document.getElementById("message");
            messageDiv.innerHTML = message;
            messageDiv.className = className;
        }

        function clearForm() {
            document.getElementById("teacherForm").reset();
            document.getElementById("imagePreview").classList.add("hidden");
            document.getElementById("imagePreview").src = "";
            updateRadioStyle(); // Ensure radio buttons reset visually
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
        }, 10000);
    }
    </script>

</body>
</html>
