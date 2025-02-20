<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    @vite('resources/css/app.css')
    <script>
        let searchType = '';
        let searchValue = '';

        function updateSearchType(value) {
            searchType = value;
            document.getElementById('search-input').style.display = (value === 'InTakeSession' || value === 'Section' || value === 'Program') ? 'none' : 'block';
            document.getElementById('dropdowns').style.display = (value === 'InTakeSession' || value === 'Section' || value === 'Program') ? 'block' : 'none';
            refreshStudents();
        }

        function updateSearchValue(value) {
            searchValue = value;
            refreshStudents();
        }

        function refreshStudents() {
            console.log('Searching by:', searchType, 'Value:', searchValue);
        }
        
    </script>
    <style>
        @media (min-width: 1024px) { table { font-size: 18px; width: 98%; } th, td { padding: 12px; } }
        @media (max-width: 768px) { .table-container { width: 100%; overflow-x: auto; } table { width: 100%; font-size: 14px; min-width: 800px; } th, td { padding: 8px; } }
    </style>
</head>
<body class="bg-gray-100">
    @include('components.navbar', [
        'username' => session('username', 'Guest'),
        'profileImage' => session('profileImage', asset('images/male.png')),
        'designation' => session('designation', 'N/A'),
        'type' => session('type', 'User')
    ])

    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-blue-700 text-center mb-4">Student List</h2>
        
        <div class="mb-4 flex flex-col sm:flex-row justify-center items-center gap-4">
            <select class="border p-2" onchange="updateSearchType(this.value)">
                <option value="">Search By</option>
                <option value="RegNo">Reg No</option>
                <option value="name">Name</option>
                <option value="cgpa">CGPA</option>
                <option value="InTakeSession">Intake Session</option>
                <option value="Section">Section</option>
                <option value="Program">Program</option>
            </select>
            
            <input type="text" id="search-input" class="border p-2" oninput="updateSearchValue(this.value)" placeholder="Enter search term" style="display: none;">
            
            <div id="dropdowns" style="display: none;">
                <select id="intake-session" class="border p-2" onchange="updateSearchValue(this.value)">
                    <option value="">Select Intake Session</option>
                    <option value="Fall-2021">Fall-2021</option>
                    <option value="Spring-2021">Spring-2021</option>
                </select>
                
                <select id="section-program" class="border p-2" onchange="updateSearchValue(this.value)">
                    <option value="">Select Program</option>
                    <option value="BCS">BCS</option>
                    <option value="BAI">BAI</option>
                    <option value="BSE">BSE</option>
                </select>
                <select id="section-semester" class="border p-2" onchange="updateSearchValue(this.value)">
                    <option value="">Select Semester</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <select id="section-group" class="border p-2" onchange="updateSearchValue(this.value)">
                    <option value="">Select Group</option>
                    @foreach (range('A', 'E') as $group)
                        <option value="{{ $group }}">{{ $group }}</option>
                    @endforeach
                </select>
                
                <select id="program" class="border p-2" onchange="updateSearchValue(this.value)">
                    <option value="">Select Program</option>
                    <option value="BSE">BSE</option>
                    <option value="BAI">BAI</option>
                    <option value="BIT">BIT</option>
                    <option value="BCS">BCS</option>
                </select>
            </div>
        </div>

        <div class="table-container mx-auto">
            <table class="border border-gray-300 shadow-lg bg-white">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2">Image</th>
                        <th class="px-4 py-2">Reg No</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">CGPA</th>
                        <th class="px-4 py-2">Gender</th>
                        <th class="px-4 py-2">Guardian</th>
                        <th class="px-4 py-2">Section</th>
                        <th class="px-4 py-2">Program</th>
                        <th class="px-4 py-2">Intake Session</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($students))
                        @foreach ($students as $student)
                            <tr class="border-b border-gray-300 text-center">
                                <td class="px-4 py-2">
                                    <img src="{{ $student['image'] ?? asset('images/default-profile.png') }}" alt="Profile" class="w-12 h-12 rounded-full mx-auto">
                                </td>
                                <td class="px-4 py-2">{{ $student['RegNo'] }}</td>
                                <td class="px-4 py-2">{{ $student['name'] }}</td>
                                <td class="px-4 py-2">{{ $student['cgpa'] }}</td>
                                <td class="px-4 py-2">{{ $student['gender'] }}</td>
                                <td class="px-4 py-2">{{ $student['guardian'] }}</td>
                                <td class="px-4 py-2">{{ $student['section']['program'] }}-{{ $student['section']['semester'] }}{{ $student['section']['group'] }}</td>
                                <td class="px-4 py-2">{{ $student['program']['name'] }}</td>
                                <td class="px-4 py-2">{{ $student['session']['name'] }}-{{ $student['session']['year'] }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ url('/student/details/' . (int) $student['id']) }}" class="bg-blue-500 text-white px-4 py-2 rounded">View</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="text-center py-4 text-gray-500">No students available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
