<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notifications</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100 min-h-screen p-0 m-0">
    @include('components.navbar', [
        'username' => session('username', 'Guest'),
        'profileImage' => session('profileImage', asset('images/male.png')),
        'designation' => session('designation', 'N/A'),
        'type' => session('type', 'User')
    ])
    
    <div class="container mx-auto px-4 py-8 flex-grow">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-blue-800 mb-6">Send Notification</h1>

            <form action="#" method="POST">
                @csrf
                
                <div class="mb-4">
                    <input type="checkbox" id="broadcast" checked onchange="toggleBroadcast()">
                    <label for="broadcast" class="text-sm font-medium text-gray-700">Broadcast</label>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Recipient</label>
                    <select id="recipient_type" name="recipient_type" class="w-full px-4 py-2 border rounded-md" onchange="updateSearchBy()">
                        <option value="" selected>Select</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="lecturer">Junior Lecturer</option>
                    </select>
                </div>
                
                <div class="mb-4" id="searchByContainer">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search By</label>
                    <select id="search_by" class="w-full px-4 py-2 border rounded-md" onchange="clearSelection()">
                        <option value="section">Section</option>
                        <option value="name">Name</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <input type="text" id="searchInput" placeholder="Search..." class="w-full px-4 py-2 border rounded-md" onfocus="showSuggestions()" oninput="filterSuggestions()">
                    <div id="suggestions" class="mt-2 bg-gray-100 rounded-md shadow-md p-2 hidden"></div>
                </div>

                <div class="mb-4" id="selectedItems"></div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" class="w-full px-4 py-2 border rounded-md">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea name="message" rows="5" class="w-full px-4 py-2 border rounded-md"></textarea>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Send</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const students = ['Ali Khan', 'Sameer Danish', 'Sharjeel Ijaz'];
        const sections = ['BCS-7A', 'BCS-7B', 'BCS-8A'];
        const teachers = ['Mr. Ahsan', 'Ms. Fatima'];
        const lecturers = ['Dr. Zubair', 'Prof. Hina'];

        function toggleBroadcast() {
            const isBroadcast = document.getElementById('broadcast').checked;
            document.getElementById('recipient_type').disabled = false;
            document.getElementById('searchByContainer').style.display = isBroadcast ? 'none' : 'block';
        }

        function updateSearchBy() {
            let recipient = document.getElementById('recipient_type').value;
            let searchBy = document.getElementById('search_by');
            searchBy.innerHTML = '';
            
            if (recipient === 'student') {
                searchBy.innerHTML = '<option value="section">Section</option><option value="name">Name</option>';
            } else if (recipient === 'teacher' || recipient === 'lecturer') {
                searchBy.innerHTML = '<option value="name">Name</option>';
            }
            clearSelection();
        }

        function clearSelection() {
            document.getElementById('selectedItems').innerHTML = '';
            document.getElementById('searchInput').value = '';
            document.getElementById('suggestions').classList.add('hidden');
        }

        function filterSuggestions() {
            let query = document.getElementById('searchInput').value.toLowerCase();
            let recipient = document.getElementById('recipient_type').value;
            let searchBy = document.getElementById('search_by').value;
            let list = [];
            
            if (recipient === 'student' && searchBy === 'section') list = sections;
            if (recipient === 'student' && searchBy === 'name') list = students;
            if (recipient === 'teacher') list = teachers;
            if (recipient === 'lecturer') list = lecturers;
            
            let suggestions = list.filter(item => item.toLowerCase().includes(query));
            let suggestionsBox = document.getElementById('suggestions');
            
            suggestionsBox.innerHTML = suggestions.length ? 
                suggestions.map(s => `<div class='cursor-pointer p-1 hover:bg-blue-200' onclick='selectItem("${s}")'>${s}</div>`).join('') 
                : '<div class="text-red-500">No match found</div>';
            
            suggestionsBox.classList.toggle('hidden', suggestions.length === 0);
        }

        function showSuggestions() {
            if (document.getElementById('searchInput').value) {
                document.getElementById('suggestions').classList.remove('hidden');
            }
        }

        function selectItem(item) {
            let selectedDiv = document.getElementById('selectedItems');
            if (!Array.from(selectedDiv.children).some(child => child.textContent.includes(item))) {
                let label = document.createElement('span');
                label.className = "bg-blue-300 text-white px-2 py-1 m-1 rounded inline-block";
                label.innerHTML = `${item} <span class='text-red-500 cursor-pointer' onclick='this.parentElement.remove()'>❌</span>`;
                selectedDiv.appendChild(label);
            }
        }
    </script>
</body>
</html>
