<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Notes</title>
    @vite('resources/css/app.css')
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
        }
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .glass-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.8);
        }
        .card-hover-effect:hover {
            box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.25), 0 10px 10px -5px rgba(59, 130, 246, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-200 via-blue-100 to-white min-h-screen">
    @include('components.navbar', [
        'username' => session('username', 'Guest'),
        'profileImage' => session('profileImage', asset('images/male.png')),
        'designation' => session('designation', 'N/A'),
        'type' => session('userType', 'User')
    ])

    <div class="max-w-6xl mx-auto px-4 py-12">
        <div class="relative overflow-hidden bg-white rounded-2xl shadow-xl p-8">

            <div class="relative">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-blue-900 mb-2 text-shadow">OOP Course Content</h1>
                        <p class="text-blue-600">Week-wise Course Notes</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <button class="gradient-blue text-white px-6 py-3 rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add New Content
                        </button>
                    </div>
                </div>

                <div id="courseContainer" class="space-y-8"></div>
            </div>
        </div>
    </div>

    {{-- @include('components.footer') --}}

    <script>
        const courseContent = {
            success: "Fetched Successfully!",
            "Course Content": {
                "1": [
                    {
                        course_content_id: 2,
                        title: "CC-Week1-Lec(1-2)",
                        type: "Notes",
                        week: 1,
                        File: "http://example.com/files/CC-Week1-Lec(1-2).pdf",
                        topics: [
                            { topic_id: 3, topic_name: "Introduction to Compilers", status: "Not-Covered" },
                            { topic_id: 4, topic_name: "Compiler Phases Overview", status: "Covered" },
                            { topic_id: 5, topic_name: "Role of Lexical Analysis", status: "Not-Covered" },
                        ],
                    },
                    {
                        course_content_id: 36,
                        title: "CC-Week1-QuizAssignment#(1)",
                        type: "Quiz",
                        week: 1,
                        File: "http://example.com/files/CC-Week1-QuizAssignment(1).pdf",
                    },
                ],

            },
        };

        const courseData = courseContent["Course Content"];
        const container = document.getElementById("courseContainer");


        const getTypeIcon = (type) => {
            const icons = {
                'Notes': '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>',
                'Quiz': '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
                'Assignment': '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>'
            };
            return icons[type] || icons['Notes'];
        };


        const getStatusColor = (status) => {
            if (status === "Covered") return "bg-green-100 text-green-800";
            return "bg-yellow-100 text-yellow-800";
        };


        let delay = 0;
        Object.keys(courseData).forEach(week => {
            const weekDiv = document.createElement("div");
            weekDiv.classList.add("bg-gradient-to-r", "from-blue-50", "to-white", "rounded-xl", "shadow-lg", "overflow-hidden", "transform", "transition-all", "duration-500", "opacity-0");
            weekDiv.style.transform = "translateY(20px)";
            weekDiv.style.animation = fadeIn 0.5s ease-out ${delay}s forwards;


            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeIn {
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            `;
            document.head.appendChild(style);

            delay += 0.15;

            const weekHeader = document.createElement("div");
            weekHeader.classList.add("gradient-blue", "p-5", "flex", "justify-between", "items-center");

            const weekTitle = document.createElement("h2");
            weekTitle.classList.add("text-xl", "font-bold", "text-white");
            weekTitle.textContent = Week ${week};

            const actionsDiv = document.createElement("div");
            actionsDiv.classList.add("flex", "space-x-2");

            const updateButton = document.createElement("button");
            updateButton.classList.add("px-4", "py-2", "bg-white", "bg-opacity-20", "hover:bg-opacity-30", "text-white", "rounded-lg", "transition-all", "duration-300", "flex", "items-center", "space-x-1");
            updateButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span>Edit</span>
            `;

            actionsDiv.appendChild(updateButton);
            weekHeader.appendChild(weekTitle);
            weekHeader.appendChild(actionsDiv);
            weekDiv.appendChild(weekHeader);

            const contentWrapper = document.createElement("div");
            contentWrapper.classList.add("p-6", "space-y-4");

            courseData[week].forEach((item, index) => {
                const itemDiv = document.createElement("div");
                itemDiv.classList.add(
                    "bg-white",
                    "rounded-xl",
                    "shadow-md",
                    "p-5",
                    "hover:shadow-xl",
                    "transition-all",
                    "duration-300",
                    "card-hover-effect",
                    "transform",
                    "hover:-translate-y-1",
                    "border",
                    "border-blue-50"
                );

                const headerDiv = document.createElement("div");
                headerDiv.classList.add("flex", "justify-between", "items-start", "mb-4");

                const titleDiv = document.createElement("div");
                titleDiv.classList.add("flex", "items-center", "space-x-3");

                const typeIcon = document.createElement("div");
                typeIcon.classList.add("p-2", "bg-blue-100", "text-blue-600", "rounded-lg");
                typeIcon.innerHTML = getTypeIcon(item.type);

                const titleContent = document.createElement("div");

                const typeSpan = document.createElement("span");
                typeSpan.classList.add("text-xs", "font-semibold", "text-blue-500", "block");
                typeSpan.textContent = item.type;

                const titleLink = document.createElement("a");
                titleLink.href = item.File;
                titleLink.classList.add("text-lg", "font-medium", "text-blue-900", "hover:text-blue-600", "transition-colors", "duration-300");
                titleLink.textContent = item.title;

                titleContent.appendChild(typeSpan);
                titleContent.appendChild(titleLink);

                titleDiv.appendChild(typeIcon);
                titleDiv.appendChild(titleContent);

                const actionsDiv = document.createElement("div");
                actionsDiv.classList.add("flex", "space-x-2");

                const downloadBtn = document.createElement("a");
                downloadBtn.href = item.File;
                downloadBtn.classList.add("p-2", "text-blue-600", "hover:text-blue-800", "transition-colors", "duration-300");
                downloadBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                `;

                actionsDiv.appendChild(downloadBtn);
                headerDiv.appendChild(titleDiv);
                headerDiv.appendChild(actionsDiv);
                itemDiv.appendChild(headerDiv);


                if (item.topics && item.topics.length > 0) {
                    const topicsDiv = document.createElement("div");
                    topicsDiv.classList.add("mt-4", "space-y-2");

                    const topicsHeader = document.createElement("h3");
                    topicsHeader.classList.add("text-sm", "font-medium", "text-gray-500", "mb-2");
                    topicsHeader.textContent = "Topics covered:";
                    topicsDiv.appendChild(topicsHeader);

                    item.topics.forEach(topic => {
                        const topicItem = document.createElement("div");
                        topicItem.classList.add("flex", "items-center", "justify-between", "py-1");

                        const topicName = document.createElement("span");
                        topicName.classList.add("text-sm", "text-gray-700");
                        topicName.textContent = topic.topic_name;

                        const statusBadge = document.createElement("span");
                        statusBadge.classList.add("px-2", "py-1", "rounded-full", "text-xs", "font-medium", ...getStatusColor(topic.status).split(" "));
                        statusBadge.textContent = topic.status;

                        topicItem.appendChild(topicName);
                        topicItem.appendChild(statusBadge);
                        topicsDiv.appendChild(topicItem);
                    });

                    itemDiv.appendChild(topicsDiv);
                }

                contentWrapper.appendChild(itemDiv);
            });

            weekDiv.appendChild(contentWrapper);
            container.appendChild(weekDiv);
        });
    </script>
</body>
</html>