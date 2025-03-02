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

    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
        <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Add New Student</h2>
        
        <form action="/students/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Registration Number -->
                <div class="mb-4">
                    <label for="regNo" class="block text-gray-700 font-semibold mb-1">Registration Number <span class="text-red-500">*</span></label>
                    <input type="text" id="regNo" name="regNo" class="w-full px-3 py-2 border border-gray-300 rounded-md" maxlength="20" required>
                </div>
                
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-1">Student Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md" maxlength="100" required>
                </div>
                
                <!-- CGPA -->
                <div class="mb-4">
                    <label for="cgpa" class="block text-gray-700 font-semibold mb-1">CGPA</label>
                    <input type="number" id="cgpa" name="cgpa" class="w-full px-3 py-2 border border-gray-300 rounded-md" step="0.01" min="0" max="4.00">
                </div>
                <div class="mb-4">
                    <label for="gender" class="block text-gray-700 font-semibold mb-1">Gender <span class="text-red-500">*</span></label>
                    <select id="gender" name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="date_of_birth" class="block text-gray-700 font-semibold mb-1">Date of Birth <span class="text-red-500">*</span></label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="guardian" class="block text-gray-700 font-semibold mb-1">Guardian Name</label>
                    <input type="text" id="guardian" name="guardian" class="w-full px-3 py-2 border border-gray-300 rounded-md" maxlength="100">
                </div>
                <div class="mb-4">
                    <label for="program" class="block text-gray-700 font-semibold mb-1">Program <span class="text-red-500">*</span></label>
                    <select id="program" name="program" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                        <option value="">Select Program</option>
                        <option value="BCS">BS Computer Science</option>
                        <option value="BSE">BS Software Engineering</option>
                        <option value="BIT">BS Information Technology</option>
                        <option value="BAI">BS Artifical Intelligence</option>
                        <option value="MCS">MS Computer Science</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="section" class="block text-gray-700 font-semibold mb-1">Section <span class="text-red-500">*</span></label>
                    <select id="section" name="section" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                        <option value="">Select Section</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="session" class="block text-gray-700 font-semibold mb-1">Session <span class="text-red-500">*</span></label>
                    <select id="session" name="session" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                        <option value="">Select Session</option>
                        <option value="2021-2025">2021-2025</option>
                        <option value="2022-2026">2022-2026</option>
                        <option value="2023-2027">2023-2027</option>
                        <option value="2024-2028">2024-2028</option>
                        <option value="2025-2029">2025-2029</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-semibold mb-1">Student Image</label>
                    <input type="file" id="image" name="image" class="w-full px-3 py-2 border border-gray-300 rounded-md" accept="image/*">
                </div>
            </div>
            
            <div class="flex justify-center space-x-4 pt-4">
                <button type="submit" class="btn bg-green-500 text-white w-64 py-3 rounded-lg hover:bg-green-600 transition">
                    Save Student
                </button>
                <a href="/students" class="btn bg-gray-500 text-white w-64 py-3 rounded-lg hover:bg-gray-600 transition text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <footer class="bg-blue-600 p-2 mt-20 shadow-md text-center text-white">
        <h4 class="font-bold text-2xl mb-4 mt-4">Learning Management System</h4>
        <p>&copy; 2025 LMS. All Rights Reserved.</p>
        <p>Sameer | Ali | Sharjeel</p>
    </footer>
</body>
</html>