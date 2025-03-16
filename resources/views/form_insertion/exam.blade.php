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
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Upload Exam Data</h2>

    <!-- Course Dropdown -->
    <div class="mb-4">
        <label for="course" class="block text-gray-700 font-medium">Select Course:</label>
        <select id="course" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500">
        </select>
    </div>

    <!-- Exam Type Dropdown -->
    <div class="mb-4">
        <label for="examType" class="block text-gray-700 font-medium">Exam Type:</label>
        <select id="examType" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500">
            <option value="Mid">Mid</option>
            <option value="Final">Final</option>
        </select>
    </div>

    <!-- Solid Marks -->
    <div class="mb-4">
        <label for="solidMarks" class="block text-gray-700 font-medium">Solid Marks:</label>
        <input type="number" id="solidMarks" min="12" max="30" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500" placeholder="Enter marks (12-30)">
    </div>

    <!-- File Upload -->
    <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Upload Question Paper (PDF/Word):</label>
        <div id="dropArea" class="w-full p-6 border-2 border-dashed border-gray-300 rounded-lg text-center cursor-pointer bg-gray-50 hover:bg-gray-100">
            Drag & Drop file here or <span class="text-blue-500 font-medium">Click to Upload</span>
        </div>
        <input type="file" id="fileInput" class="hidden" accept=".pdf,.doc,.docx">
        <div id="fileList" class="mt-2"></div> <!-- Uploaded file will be displayed here -->
    </div>

    <!-- Add Question Section -->
    <button id="addQuestionForm" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 w-full">Add Question</button>

    <div id="questionForm" class="hidden mt-4 p-4 bg-gray-50 border rounded-md">
        <div class="mb-2">
            <label for="questionNo" class="block text-gray-700 font-medium">Question No:</label>
            <input type="number" id="questionNo" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-2">
            <label for="questionMarks" class="block text-gray-700 font-medium">Marks:</label>
            <input type="number" id="questionMarks" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500">
        </div>
        <button id="saveQuestion" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 w-full">Save Question</button>
    </div>

    <!-- Questions Table -->
    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Question No</th>
                <th class="border border-gray-300 px-4 py-2">Marks</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody id="questionsTable">
            <!-- Questions will be added here dynamically -->
        </tbody>
    </table>

    <!-- Upload Button -->
    <button id="uploadButton" class="bg-blue-600 text-white px-4 py-2 rounded-md mt-4 w-full hover:bg-blue-700">Upload</button>
</div>

<script>
    function showLoader() {
        document.getElementById("loader").classList.remove("hidden");
    }

    function hideLoader() {
        document.getElementById("loader").classList.add("hidden");
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
    document.addEventListener("DOMContentLoaded", async function () {
        const form = document.getElementById("uploadButton");
        const questionsTable = document.getElementById("questionsTable");

        // Fetch course options from API
        async function fetchCourses() {
            try {
                API_BASE_URL = await getApiBaseUrl();
                let response = await fetch(`${API_BASE_URL}api/Dropdown/AllOfferedCourse`);
                let data = await response.json();
                const dropdown = document.getElementById("course");

                if (Array.isArray(data)) {
                    dropdown.innerHTML = "";
                    data.forEach(course => {
                        const option = document.createElement("option");
                        option.value = course.id;
                        option.textContent = course.data;
                        dropdown.appendChild(option);
                    });
                }
            } catch (error) {
                console.error("Error fetching courses:", error);
            }
        }

        fetchCourses(); // Call on page load

        // Handle file upload
        const dropArea = document.getElementById("dropArea");
        const fileInput = document.getElementById("fileInput");
        let uploadedFile = null;

        dropArea.addEventListener("click", () => fileInput.click());
        fileInput.addEventListener("change", function () {
            uploadedFile = fileInput.files[0];
            displayUploadedFile(uploadedFile);
        });

        function displayUploadedFile(file) {
            const fileList = document.getElementById("fileList");
            fileList.innerHTML = `<div class="p-2 bg-gray-200 rounded-md mt-2 flex justify-between">
                <span>${file.name}</span>
                <button class="text-red-500" onclick="removeFile()">Remove</button>
            </div>`;
        }

        function removeFile() {
            uploadedFile = null;
            fileInput.value = "";
            document.getElementById("fileList").innerHTML = "";
        }

        // Handle question addition
        document.getElementById("addQuestionForm").addEventListener("click", () => {
            document.getElementById("questionForm").classList.toggle("hidden");
        });

        document.getElementById("saveQuestion").addEventListener("click", () => {
            const qNo = document.getElementById("questionNo").value.trim();
            const qMarks = document.getElementById("questionMarks").value.trim();

            if (!qNo || !qMarks || isNaN(qNo) || isNaN(qMarks)) {
                showAlert("Please enter valid question number and marks!");
                return;
            }

            const newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td class="border border-gray-300 px-4 py-2">${qNo}</td>
                <td class="border border-gray-300 px-4 py-2">${qMarks}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <button class="text-red-500" onclick="this.parentElement.parentElement.remove()">Remove</button>
                </td>
            `;
            questionsTable.appendChild(newRow);

            // Clear input fields
            document.getElementById("questionNo").value = "";
            document.getElementById("questionMarks").value = "";
        });

        // **Form Submission with API Call**
        form.addEventListener("click", async function () {
            showLoader();
            const offered_course_id = document.getElementById("course").value;
            const type = document.getElementById("examType").value;
            const solidMarks = document.getElementById("solidMarks").value;

            if (!offered_course_id || !type || !solidMarks) {
                hideLoader();
                showAlert("Please fill all required fields!");
                return;
            }

            if (!uploadedFile) {
                hideLoader();
                showAlert("Please upload a valid question paper!");
                return;
            }

            let questions = [];
            questionsTable.querySelectorAll("tr").forEach(row => {
                const cells = row.querySelectorAll("td");
                if (cells.length > 1) {
                    questions.push({
                        q_no: parseInt(cells[0].innerText),
                        marks: parseInt(cells[1].innerText)
                    });
                }
            });

            if (questions.length === 0) {
                hideLoader();
                showAlert(`Please add at least one question!`, "error");
                return;
            }

            let formData = new FormData();
            formData.append("offered_course_id", offered_course_id);
            formData.append("type", type);
            formData.append("Solid_marks", solidMarks);
            formData.append("QuestionPaper", uploadedFile);
            questions.forEach((q, index) => {
                formData.append(`questions[${index}][q_no]`, q.q_no);
                formData.append(`questions[${index}][marks]`, q.marks);
            });
            try {
                API_BASE_URL = await getApiBaseUrl();
                let response = await fetch(`${API_BASE_URL}api/Uploading/uplaod/Exam`, {
                    method: "POST",
                    body: formData
                });
                let result = await response.json();
                if (response.ok) {
                    hideLoader();
                    showAlert('Exam Created Successfully', 'success');
                    location.reload();
                } else {
                    hideLoader();
                let errorMessage = result.message || "Something went wrong!";
                if (typeof result.errors === "object") {
                    errorMessage += "\n" + Object.values(result.errors).flat().join("\n");
                } else if (typeof result.errors === "string") {
                    errorMessage += "\n" + result.errors; // Directly append if it's a string
                }
                showAlert(`Upload Failed: \n${errorMessage}`, "error");
                }
            } catch (error) {
                let errorMessage = error.message || "Something went wrong!";
                if (typeof error.errors === "object") {
                    errorMessage += "\n" + Object.values(error.errors).flat().join("\n");
                } else if (typeof error.errors === "string") {
                    errorMessage += "\n" + error.errors; // Directly append if it's a string
                }
                console.error("API error:", error);
                hideLoader();
                showAlert(`Failed to connect to server.\n ${errorMessage}`, "error");
            }
        });
    });
    function showAlert(message, type = "error") {
        const existingAlert = document.getElementById("custom-alert");
        if (existingAlert) existingAlert.remove();
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

    @include('components.loader')
    @include('components.footer')
</body>
</html>