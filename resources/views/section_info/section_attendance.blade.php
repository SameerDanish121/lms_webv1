<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance List</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-5">
    <div class="container mx-auto bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">Attendance List</h2>


        <div class="flex items-center mb-4 space-x-3">
            <div class="relative w-1/3">
                <input type="text" id="searchInput" placeholder="Search by RegNo or Name" class="border p-3 rounded w-full pl-10 focus:outline-blue-500">
                <span class="absolute left-3 top-3 text-gray-500">🔍</span>
            </div>
        </div>


        <div id="attendanceTables"></div>
    </div>

    <script>
        const dummyData = [{
                course_name: "Compiler Construction"
                , section_name: "BCS-7A"
                , teacher_name: "Dr. Ayesha"
                , total_classes_conducted: 30
                , total_labs_conducted: 10
                , students: [{
                        img: "https://via.placeholder.com/50"
                        , regNo: "001"
                        , name: "Ahmed"
                        , labAttended: 7
                        , labPercentage: 70
                        , classAttended: 25
                        , classPercentage: 83
                        , totalPercentage: 80
                    }
                    , {
                        img: "https://via.placeholder.com/50"
                        , regNo: "002"
                        , name: "Aisha"
                        , labAttended: 8
                        , labPercentage: 80
                        , classAttended: 28
                        , classPercentage: 93
                        , totalPercentage: 90
                    }
                ]
            }
            , {
                course_name: "Data Structures"
                , section_name: "BCS-7A"
                , teacher_name: "Mr. Kamran"
                , total_classes_conducted: 28
                , total_labs_conducted: 8
                , students: [{
                        img: "https://via.placeholder.com/50"
                        , regNo: "003"
                        , name: "Zain"
                        , labAttended: 6
                        , labPercentage: 75
                        , classAttended: 22
                        , classPercentage: 78
                        , totalPercentage: 77
                    }
                    , {
                        img: "https://via.placeholder.com/50"
                        , regNo: "004"
                        , name: "Sara"
                        , labAttended: 7
                        , labPercentage: 88
                        , classAttended: 24
                        , classPercentage: 85
                        , totalPercentage: 84
                    }
                ]
            }
        ];

        function populateTables() {
            const container = document.getElementById("attendanceTables");
            container.innerHTML = "";

            dummyData.forEach(course => {
                let tableHtml = `
            <div class="mb-6 bg-gray-50 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-blue-600">${course.course_name} - ${course.section_name}</h3>
                <p class="text-blue-700">Teacher: ${course.teacher_name} <p class="text-gray-700"> Total Classes: ${course.total_classes_conducted} | Total Labs: ${course.total_labs_conducted}</p></p>
                <table class="w-full border-collapse border border-gray-300 text-sm text-left mt-4">
                    <thead>
                        <tr class="bg-blue-500 text-white text-center">
                            <th class="border px-3 py-2">RegNo</th>
                            <th class="border px-3 py-2">Name</th>
                            <th class="border px-3 py-2">Lab Attended</th>
                            <th class="border px-3 py-2">Lab %</th>
                            <th class="border px-3 py-2">Class Attended</th>
                            <th class="border px-3 py-2">Class %</th>
                            <th class="border px-3 py-2">Total %</th>
                            <th class="border px-3 py-2">Details</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

                course.students.forEach(student => {
                    tableHtml += `
                <tr class="border text-center hover:bg-gray-100">
                    <td class="border px-3 py-2">${student.regNo}</td>
                    <td class="border px-3 py-2">${student.name}</td>
                    <td class="border px-3 py-2">${student.labAttended}</td>
                    <td class="border px-3 py-2">${student.labPercentage}%</td>
                    <td class="border px-3 py-2">${student.classAttended}</td>
                    <td class="border px-3 py-2">${student.classPercentage}%</td>
                    <td class="border px-3 py-2 font-bold">${student.totalPercentage}%</td>
                    <td class="border px-3 py-2 text-blue-500 cursor-pointer">View Details</td>
                </tr>`;
                });

                tableHtml += `</tbody></table></div>`;
                container.innerHTML += tableHtml;
            });
        }

        function filterSearch() {
            let query = document.getElementById("searchInput").value.toLowerCase();
            document.querySelectorAll("tbody tr").forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? "" : "none";
            });
        }

        document.getElementById("searchInput").addEventListener("keyup", filterSearch);

        window.onload = function() {
            populateTables();
        };

    </script>
</body>
</html>
