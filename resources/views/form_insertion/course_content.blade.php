<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Course Content Form</title>
</head>
<body class="p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Add Course Content</h2>

        <label class="block mb-2">Offered Course:</label>
        <select id="offeredCourse" class="border p-2 w-full mb-4">
            <option value="1">Course 1</option>
            <option value="2">Course 2</option>
        </select>

        <label class="block mb-2">Type:</label>
        <select id="contentType" class="border p-2 w-full mb-4" onchange="toggleMCQFields()">
            <option value="Notes">Notes</option>
            <option value="Quiz">Quiz</option>
            <option value="Assignment">Assignment</option>
        </select>

        <label class="block mb-2">Week Number:</label>
        <input type="number" id="weekNo" class="border p-2 w-full mb-4">

        <div id="mcqSection" class="hidden">
            <h3 class="font-bold">MCQs</h3>
            <div id="mcqContainer"></div>
            <button onclick="addMCQ()" class="bg-green-500 text-white p-2 mt-2">Add MCQ</button>
        </div>

        <button onclick="addContent()" class="bg-blue-500 text-white p-2 w-full mt-4">Add to Table</button>
        
        <table class="w-full mt-6 border">
            <thead>
                <tr>
                    <th class="border p-2">Type</th>
                    <th class="border p-2">Week</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody id="contentTable"></tbody>
        </table>

        <button onclick="submitData()" class="bg-red-500 text-white p-2 w-full mt-4">Submit</button>
    </div>

    <script>
        let contentList = [];
        function toggleMCQFields() {
            document.getElementById('mcqSection').classList.toggle('hidden', document.getElementById('contentType').value !== 'Quiz');
        }
        function addMCQ() {
            let container = document.getElementById('mcqContainer');
            let index = container.children.length;
            container.innerHTML += `
                <div class='border p-2 mb-2'>
                    <input type='text' placeholder='Question' class='border p-2 w-full mb-1'>
                    <input type='text' placeholder='Option 1' class='border p-2 w-full mb-1'>
                    <input type='text' placeholder='Option 2' class='border p-2 w-full mb-1'>
                    <input type='text' placeholder='Option 3' class='border p-2 w-full mb-1'>
                    <input type='text' placeholder='Option 4' class='border p-2 w-full mb-1'>
                    <input type='text' placeholder='Correct Answer' class='border p-2 w-full'>
                </div>`;
        }
        function addContent() {
            let type = document.getElementById('contentType').value;
            let weekNo = document.getElementById('weekNo').value;
            if (!weekNo) return alert('Week number is required');
            let content = { type, weekNo };
            if (type === 'Quiz') {
                let mcqs = [];
                document.querySelectorAll('#mcqContainer div').forEach(div => {
                    let inputs = div.querySelectorAll('input');
                    mcqs.push({
                        question_text: inputs[0].value,
                        option1: inputs[1].value,
                        option2: inputs[2].value,
                        option3: inputs[3].value,
                        option4: inputs[4].value,
                        Answer: inputs[5].value,
                    });
                });
                content['MCQS'] = mcqs;
            }
            contentList.push(content);
            updateTable();
        }
        function updateTable() {
            let table = document.getElementById('contentTable');
            table.innerHTML = '';
            contentList.forEach((item, index) => {
                table.innerHTML += `<tr class='border'>
                    <td class='border p-2'>${item.type}</td>
                    <td class='border p-2'>${item.weekNo}</td>
                    <td class='border p-2'><button onclick='removeContent(${index})' class='bg-red-500 text-white p-1'>Remove</button></td>
                </tr>`;
            });
        }
        function removeContent(index) {
            contentList.splice(index, 1);
            updateTable();
        }
        function submitData() {
            let offeredCourseId = document.getElementById('offeredCourse').value;
            fetch('http://127.0.0.1:8000/api/course-content', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    offered_course_id: offeredCourseId,
                    data: contentList
                })
            }).then(res => res.json()).then(response => {
                alert(response.message);
                contentList = [];
                updateTable();
            }).catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
