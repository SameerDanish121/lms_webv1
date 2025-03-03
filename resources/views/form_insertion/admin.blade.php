<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS - Add New Admin</title>
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
            <h2 class="text-3xl font-bold text-center text-orange-500 mb-6">Add New Admin</h2>
            <form id="adminForm" class="grid grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-4">
                    <!-- Name Field -->
                    <div>
                        <label class="block text-lg font-semibold">Name</label>
                        <input type="text" id="name"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- Phone Number Field -->
                    <div>
                        <label class="block text-lg font-semibold">Phone Number</label>
                        <div class="flex space-x-2">
                            <!-- Country Code Dropdown -->
                            <select id="countryCode"
                                class="w-1/4 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="+1">+1 (USA)</option>
                                <option value="+44">+44 (UK)</option>
                                <option value="+92">+92 (PK)</option>
                                <option value="+91">+91 (IN)</option>
                                <!-- Add more country codes as needed -->
                            </select>
                            <!-- Phone Number Input -->
                            <input type="tel" id="phone"
                                class="w-3/4 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <p id="phoneError" class="text-red-500 text-sm hidden">Invalid phone number format.</p>
                    </div>

                    <!-- Designation Field -->
                    <div>
                        <label class="block text-lg font-semibold">Designation</label>
                        <input type="text" id="designation"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <!-- Email Field -->
                    <div>
                        <label class="block text-lg font-semibold">Email (Optional)</label>
                        <input type="email" id="email"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Image Upload Field -->
                    <div>
                      

                        <label class="block text-lg font-semibold">Upload Picture (Optional)</label>
                        <div class="flex items-center space-x-3">
                            <img id="imagePreview" class="w-12 h-12 object-cover rounded-full border hidden">
                            <input type="file" id="picture" accept="image/*"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                        <img id="imagePreview" class="w-16 h-16 object-cover rounded-full border hidden" alt="Selected Image">
                    </div>
                </div>
            </form>

            <!-- Submit Button -->
            <div class="text-center mt-6">
                <button onclick="submitForm()"
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition transform hover:scale-105">
                    Submit
                </button>
            </div>

            <!-- Message Display -->
            <div id="message" class="mt-4 text-center text-lg font-semibold"></div>
        </div>
    </div>

    <!-- Loader -->
    @include('components.loader')
    <script>
         document.getElementById("picture").addEventListener("change", function (event) {
        let file = event.target.files[0];
        let imagePreview = document.getElementById("imagePreview");

        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove("hidden");
                imagePreview.classList.add("block");
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = "";
            imagePreview.classList.add("hidden");
        }
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

    </script>
    <!-- Footer -->
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

        // Function to validate phone number based on country code
        function validatePhoneNumber(countryCode, phoneNumber) {
            const phonePatterns = {
                "+1": /^[2-9]\d{9}$/, // USA: 10 digits, no leading 1 or 0
                "+44": /^7\d{9}$/,    // UK: 10 digits starting with 7
                "+92": /^3\d{9}$/,    // PK: 10 digits starting with 3
                "+91": /^[6-9]\d{9}$/ // IN: 10 digits starting with 6-9
            };
            return phonePatterns[countryCode].test(phoneNumber);
        }

        // Function to show alert
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
        // Function to submit form
        async function submitForm() {
            showLoader();

            // Get form values
            let name = document.getElementById("name").value.trim();
            let countryCode = document.getElementById("countryCode").value;
            let phone = document.getElementById("phone").value.trim();
            let designation = document.getElementById("designation").value.trim();
            let email = document.getElementById("email").value.trim();
            let picture = document.getElementById("picture").files[0];

            // Validate required fields
            if (!name || !phone || !designation) {
                hideLoader();
                showAlert("Please fill in all required fields.", "error");
                return;
            }

            // Validate phone number
            if (!validatePhoneNumber(countryCode, phone)) {
                hideLoader();
                showAlert("Invalid phone number format for the selected country code.", "error");
                return;
            }

            // Prepare form data
            let formData = new FormData();
            formData.append("name", name);
            formData.append("phone_number", `${countryCode}${phone}`);
            formData.append("Designation", designation);
            if (email) formData.append("email", email); // Add email only if provided
            if (picture) formData.append("image", picture); // Add image only if provided

            try {
                // Send data to the server
                let response = await fetch(`${API_BASE_URL}api/Insertion/add-admin`, {
                    method: "POST",
                    body: formData
                });

                let result = await response.json();
                if (response.ok) {
                    hideLoader();
                    showAlert(`Added Successfully!\nLogs: ${result["message"]}\n Username: ${result["username"]}\n Password: ${result["password"]}`, 'success');
                    clearForm();
                } else {
                    hideLoader();
                    showAlert(result.message || "An error occurred while adding the admin.", "error");
                }
            } catch (error) {
                hideLoader();
                showAlert("Server error. Please try again later.", "error");
            }
        }

        // Function to clear form
        function clearForm() {
            document.getElementById("adminForm").reset();
            document.getElementById("imagePreview").classList.add("hidden");
            document.getElementById("imagePreview").src = "";
        }
    </script>
</body>

</html>