{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Dashboard</title>
    @vite('resources/css/app.css')
    <style>
        /* Animation keyframes */
        @keyframes marquee {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-100%);
            }
        }

        /* Marquee styling */
        .marquee-container {
            display: flex;
            min-width: 200%;
            animation: marquee 50s linear infinite;
        }

        .marquee-container:hover {
            animation-play-state: paused;
        }

        /* Button animations */
        .btn-hover {
            transition: all 0.2s ease-in-out;
        }

        .btn-hover:hover {
            transform: scale(1.03);
        }

        /* Card styling */
        .card-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: white;
            border-radius: 0.75rem;
            padding: 1rem;
            min-height: 100px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
            color: #374151;
        }

        .card-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .card-button-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .card-button-text {
            font-weight: 500;
            text-align: center;
            font-size: 0.875rem;
        }

        /* Button container */
        .button-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1rem;
            transition: transform 0.3s ease;
        }

        /* Navigation buttons */
        .nav-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-button:hover {
            background-color: #f3f4f6;
            transform: scale(1.05);
        }

        .nav-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Pagination styling */
        .pagination-indicator {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .pagination-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #CBD5E0;
            transition: background-color 0.3s ease, transform 0.3s ease;
            cursor: pointer;
        }

        .pagination-dot.active {
            background-color: #3B82F6;
            transform: scale(1.3);
        }

        /* Section styling */
        .button-carousel {
            margin-bottom: 2rem;
            background-color: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Storage visualization */
        .progress-circle-container {
            position: relative;
            width: 160px;
            height: 160px;
            margin: 0 auto;
        }

        .progress-circle-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Memory section styling */
        .memory-section {
            background-color: #f9fafb;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 4px solid;
        }

        .temporary-memory {
            border-left-color: #EF4444;
        }

        .permanent-memory {
            border-left-color: #10B981;
        }

        .memory-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .memory-item:last-child {
            border-bottom: none;
        }

        /* Stats card styling */
        .stat-card {
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background-color: white;
        }

        .stat-header {
            padding: 1rem;
            color: white;
            font-weight: 600;
        }

        .stat-content {
            padding: 1rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        .stat-item {
            border-radius: 0.5rem;
            padding: 1rem;
            text-align: center;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #6B7280;
            margin-bottom: 0.25rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* Responsive styling */
        @media (max-width: 1024px) {
            .button-container {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 768px) {
            .button-container {
                grid-template-columns: repeat(3, 1fr);
            }

            .card-button {
                min-height: 90px;
                padding: 0.75rem;
            }

            .card-button-icon {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 640px) {
            .button-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .card-button {
                min-height: 80px;
                padding: 0.5rem;
            }

            .card-button-text {
                font-size: 0.75rem;
            }
        }

        /* Footer styling */
        footer {
            background: linear-gradient(to right, #2563EB, #4F46E5);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
            border-radius: 1rem 1rem 0 0;
        }

        .btn-action {
            display: flex;
            align-items: center;
            justify-center;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .button-container {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            /* Ensures 4 buttons in a row */
            gap: 8px;
        }

        @media (max-width: 768px) {
            .button-container {
                grid-template-columns: repeat(1, minmax(0, 1fr));
                /* Keeps 4 buttons per row on mobile */
            }
        }

    </style>
       
</head>

<body class="bg-gradient-to-r from-blue-50 to-indigo-50 min-h-screen">
    @include('components.navbar')
    <div class="max-w-7xl mx-auto px-3 py-3">

        <!-- Announcement Banner -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-md rounded-xl overflow-hidden mb-8">
            <div class="marquee-container flex space-x-16 whitespace-nowrap text-sm md:text-base font-medium px-4 py-3">
                <div class="marquee flex space-x-20">
                    <span>🚀 Current Session : {{session('currentSession')}}</span>
                    <span>🏛️ Session Start Date : {{session('startDate')}}</span>
                    <span>🎓 Session End Date : {{session('endDate')}}</span>
                    <span>📢 Students Week Soon</span>
                    <span>📝 Mids: 25 March 2025</span>
                </div>
                <div class="marquee flex space-x-16">
                    <span>🚀 Current Session : {{session('currentSession')}}</span>
                    <span>🏛️ Session Start Date : {{session('startDate')}}</span>
                    <span>🎓 Session End Date : {{session('endDate')}}</span>
                    <span>📢 New Student Portal Launched!</span>
                    <span>📝 Exam Forms Submission Ends Soon</span>
                </div>
            </div>
        </div>
        <div class=" grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="md:col-span-2 space-y-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="stat-card">
                        <div class="stat-header bg-blue-600">
                            <h3 class="text-white font-semibold">Courses</h3>
                        </div>
                        <div class="stat-content">
                            <div class="stat-item bg-blue-50">
                                <p class="stat-label">Offered</p>
                                <p class="stat-value text-blue-700">{{session('offer_count')}}</p>
                            </div>
                            <div class="stat-item bg-blue-50">
                                <p class="stat-label">Total</p>
                                <p class="stat-value text-blue-700">{{session('course_count')}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header bg-blue-600">
                            <h3 class="text-white font-semibold">People</h3>
                        </div>
                        <div class="stat-content">
                            <div class="stat-item bg-blue-50">
                                <p class="stat-label">Students</p>
                                <p class="stat-value text-blue-700">{{session('student_count')}}</p>
                            </div>
                            <div class="stat-item bg-blue-50">
                                <p class="stat-label">Faculty</p>
                                <p class="stat-value text-blue-700">{{session('faculty_count')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-2 bg-white rounded-xl shadow-lg p-6 text-center">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{route('all.student')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Students
                        </a>
                        <a href="{{route('all.course')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Courses
                        </a>
                        <a href="{{route('all.teacher')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Teachers
                        </a>
                        <a href="{{route('all.junior')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Junior Lecturers
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                        
                        <a href="{{route('all.session')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            Mark Sessions
                        </a>
                        <a href="{{route('all.archives')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            Archives?
                        </a>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="button-carousel m-5">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="inline-block w-6 h-6 bg-blue-500 rounded-md mr-2 flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                </svg>
            </span>
            Data Management
        </h2>

        <div class="relative flex items-center">
            <button id="prevBtn" class="nav-button mr-2 md:mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="overflow-hidden flex-1">
                <div id="cardContainer" class="button-container">
                    <!-- Upload Timetable -->
                    <a href="{{route('show.timetable')}}" class="card-button">
                        <span class="card-button-icon">📑</span>
                        <p class="card-button-text">Upload Timetable</p>
                    </a>
                    <a href=" {{ route('full.timetable') }}" class="card-button">
                        <span class="card-button-icon">📅</span>
                        <p class="card-button-text">View Full Timetable</p>
                    </a>
                    <a href="{{route('show.excel_excludedDays')}}" class="card-button">
                        <span class="card-button-icon">📅</span>
                        <p class="card-button-text">Add Excluded Days</p>
                    </a>
                    <a href=" {{route('show.grader')}}" class="card-button">
                        <span class="card-button-icon">📅</span>
                        <p class="card-button-text">Assign Grader To Grader</p>
                    </a>
            </div>

            <button id="nextBtn" class="nav-button ml-2 md:ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="pagination-indicator" id="paginationIndicator">
        </div>
    </section>
    <section class="button-carousel m-5">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="inline-block w-6 h-6 bg-indigo-500 rounded-md mr-2 flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </span>
            View Information
        </h2>

        <div class="relative flex items-center">
            <button id="prevBtnView" class="nav-button mr-2 md:mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="overflow-hidden flex-1">
                <div id="viewCardContainer" class="button-container">
                    <!-- All Courses -->
                    <a href="{{ route('allcourses') }}" class="card-button">
                        <span class="card-button-icon">📚</span>
                        <p class="card-button-text">All Courses</p>
                    </a>
                    <!-- View Timetable -->
                    <a href="{{ route('full.timetable') }}" class="card-button">
                        <span class="card-button-icon">📊</span>
                        <p class="card-button-text">View Timetable</p>
                    </a>

                    <!-- View Students -->
                    <a href="{{route('datacell.student')}}" class="card-button">
                        <span class="card-button-icon">👨‍🎓</span>
                        <p class="card-button-text">View Students</p>
                    </a>

                    <!-- View Teachers -->
                    <a href="{{ route('all.teacher') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">View Teachers</p>
                    </a>
                    <a href="{{ route('show.offered_Course') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Teacher Offered Courses</p>
                    </a>
                    <a href="{{ route('show.enrollments') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Enrollments</p>
                    </a>

                    <a href="{{ route('all.grader') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Add / Assign Graders</p>
                    </a>

                    <!-- View All Junior Lecturers -->
                    <a href="{{route('all.junior')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Junior Lecturers</p>
                    </a>
                </div>
            </div>

            <button id="nextBtnView" class="nav-button ml-2 md:ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="pagination-indicator" id="viewPaginationIndicator">
            <!-- View pagination dots will be added dynamically -->
        </div>
    </section>


    <section class="button-carousel m-5">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="inline-block w-6 h-6 bg-green-500 rounded-md mr-2 flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </span>
            Additional Information
        </h2>

        <div class="relative flex items-center">
            <button id="prevBtnView3" class="nav-button mr-2 md:mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="overflow-hidden flex-1">
                <div id="viewCardContainer3" class="button-container">
                    <!-- All Courses -->
                    <!-- View All Junior Lecturers -->
                    <a href="{{route('all.teacher')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Teachers</p>
                    </a>
                    <a href="{{route('all.session')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Session</p>
                    </a>
                    <a href="{{route('all.course')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Courses</p>
                    </a>
                    <a href="{{route('all.archives')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Archives List</p>
                    </a>
                    <a href="{{route('temp.enroll')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">Temporary Enrollments Request</p>
                    </a>
                    <a href="{{route('all.course_allocation')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Course Allocations</p>
                    </a>
                </div>
            </div>

            <button id="nextBtnView3" class="nav-button ml-2 md:ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="pagination-indicator" id="viewPaginationIndicator3">
            <!-- View pagination dots will be added dynamically -->
        </div>
    </section>
    </div>


   @include('components.footer')
   <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize both carousels
        initializeCarousel('cardContainer', 'prevBtn', 'nextBtn', 'paginationIndicator');
        initializeCarousel('viewCardContainer', 'prevBtnView', 'nextBtnView', 'viewPaginationIndicator');
        initializeCarousel('viewCardContainer3', 'prevBtnView3', 'nextBtnView3', 'viewPaginationIndicator3');

        function initializeCarousel(containerId, prevBtnId, nextBtnId, paginationId) {
            const container = document.getElementById(containerId);
            const prevBtn = document.getElementById(prevBtnId);
            const nextBtn = document.getElementById(nextBtnId);
            const paginationContainer = document.getElementById(paginationId);

            const cards = container.querySelectorAll('.card-button');
            const totalCards = cards.length;

            // Determine how many cards to show based on screen size
            let cardsPerPage = getCardsPerPage();
            let currentPage = 0;
            let totalPages = Math.ceil(totalCards / cardsPerPage);

            // Create pagination dots
            createPaginationDots();

            function createPaginationDots() {
                paginationContainer.innerHTML = '';
                for (let i = 0; i < totalPages; i++) {
                    const dot = document.createElement('div');
                    dot.classList.add('pagination-dot');
                    if (i === 0) dot.classList.add('active');
                    paginationContainer.appendChild(dot);
                }
            }

            // Update pagination dots
            function updatePagination() {
                const dots = paginationContainer.querySelectorAll('.pagination-dot');
                dots.forEach((dot, index) => {
                    if (index === currentPage) {
                        dot.classList.add('active');
                    } else {
                        dot.classList.remove('active');
                    }
                });
            }

            // Show cards for current page
            function showCurrentPage() {
                cards.forEach((card, index) => {
                    const startIndex = currentPage * cardsPerPage;
                    const endIndex = startIndex + cardsPerPage;

                    if (index >= startIndex && index < endIndex) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update button states
                prevBtn.disabled = currentPage === 0;
                nextBtn.disabled = currentPage >= totalPages - 1;

                // Update visual feedback for disabled buttons
                prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
                nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';

                updatePagination();
            }

            // Previous button click
            prevBtn.addEventListener('click', () => {
                if (currentPage > 0) {
                    currentPage--;
                    showCurrentPage();
                }
            });

            // Next button click
            nextBtn.addEventListener('click', () => {
                if (currentPage < totalPages - 1) {
                    currentPage++;
                    showCurrentPage();
                }
            });

            // Handle pagination dot clicks
            paginationContainer.addEventListener('click', (e) => {
                if (e.target.classList.contains('pagination-dot')) {
                    const dots = Array.from(paginationContainer.querySelectorAll('.pagination-dot'));
                    const clickedIndex = dots.indexOf(e.target);

                    if (clickedIndex !== -1 && clickedIndex !== currentPage) {
                        currentPage = clickedIndex;
                        showCurrentPage();
                    }
                }
            });

            // Handle window resize
            window.addEventListener('resize', () => {
                const newCardsPerPage = getCardsPerPage();

                if (newCardsPerPage !== cardsPerPage) {
                    cardsPerPage = newCardsPerPage;
                    totalPages = Math.ceil(totalCards / cardsPerPage);

                    // Recreate pagination dots
                    createPaginationDots();

                    // Adjust current page if needed
                    if (currentPage >= totalPages) {
                        currentPage = totalPages - 1;
                    }

                    showCurrentPage();
                }
            });

            function getCardsPerPage() {
                if (window.innerWidth < 480) return 3;
                if (window.innerWidth < 768) return 4;
                if (window.innerWidth < 1024) return 5;
                return 5;
            }

            // Initial setup
            showCurrentPage();
        }
    });

</script>
    @include('components.loader')
    @include('components.alert')
</body>

</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Dashboard</title>
    @vite('resources/css/app.css')
    <style>
        /* Animation keyframes */
        @keyframes marquee {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-100%);
            }
        }

        /* Marquee styling */
        .marquee-container {
            display: flex;
            min-width: 200%;
            animation: marquee 50s linear infinite;
        }

        .marquee-container:hover {
            animation-play-state: paused;
        }

        /* Button animations */
        .btn-hover {
            transition: all 0.2s ease-in-out;
        }

        .btn-hover:hover {
            transform: scale(1.03);
        }

        /* Card styling */
        .card-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: white;
            border-radius: 0.75rem;
            padding: 1rem;
            min-height: 100px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
            color: #374151;
        }

        .card-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .card-button-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .card-button-text {
            font-weight: 500;
            text-align: center;
            font-size: 0.875rem;
        }

        /* Button container */
        .button-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1rem;
            transition: transform 0.3s ease;
        }

        /* Navigation buttons */
        .nav-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-button:hover {
            background-color: #f3f4f6;
            transform: scale(1.05);
        }

        .nav-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Pagination styling */
        .pagination-indicator {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .pagination-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #CBD5E0;
            transition: background-color 0.3s ease, transform 0.3s ease;
            cursor: pointer;
        }

        .pagination-dot.active {
            background-color: #3B82F6;
            transform: scale(1.3);
        }

        /* Section styling */
        .button-carousel {
            margin-bottom: 2rem;
            background-color: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Storage visualization */
        .progress-circle-container {
            position: relative;
            width: 160px;
            height: 160px;
            margin: 0 auto;
        }

        .progress-circle-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Memory section styling */
        .memory-section {
            background-color: #f9fafb;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 4px solid;
        }

        .temporary-memory {
            border-left-color: #EF4444;
        }

        .permanent-memory {
            border-left-color: #10B981;
        }

        .memory-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .memory-item:last-child {
            border-bottom: none;
        }

        /* Stats card styling */
        .stat-card {
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background-color: white;
        }

        .stat-header {
            padding: 1rem;
            color: white;
            font-weight: 600;
        }

        .stat-content {
            padding: 1rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        .stat-item {
            border-radius: 0.5rem;
            padding: 1rem;
            text-align: center;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #6B7280;
            margin-bottom: 0.25rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* Responsive styling */
        @media (max-width: 1024px) {
            .button-container {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 768px) {
            .button-container {
                grid-template-columns: repeat(3, 1fr);
            }

            .card-button {
                min-height: 90px;
                padding: 0.75rem;
            }

            .card-button-icon {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 640px) {
            .button-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .card-button {
                min-height: 80px;
                padding: 0.5rem;
            }

            .card-button-text {
                font-size: 0.75rem;
            }
        }

        /* Footer styling */
        footer {
            background: linear-gradient(to right, #2563EB, #4F46E5);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
            border-radius: 1rem 1rem 0 0;
        }

        .btn-action {
            display: flex;
            align-items: center;
            justify-center;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .button-container {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            /* Ensures 4 buttons in a row */
            gap: 8px;
        }

        @media (max-width: 768px) {
            .button-container {
                grid-template-columns: repeat(1, minmax(0, 1fr));
                /* Keeps 4 buttons per row on mobile */
            }
        }

    </style>

</head>
<body class="bg-gradient-to-r from-blue-50 to-indigo-50 min-h-screen">
    @include('components.navbar')
    <div class="max-w-7xl mx-auto px-3 py-3">

        <!-- Announcement Banner -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-md rounded-xl overflow-hidden mb-8">
            <div class="marquee-container flex space-x-16 whitespace-nowrap text-sm md:text-base font-medium px-4 py-3">
                <div class="marquee flex space-x-20">
                    <span>🚀 Current Session : {{session('currentSession')}}</span>
                    <span>🏛️ Session Start Date : {{session('startDate')}}</span>
                    <span>🎓 Session End Date : {{session('endDate')}}</span>
                    <span>📢 Students Week Soon</span>
                    <span>📝 Mids: 25 March 2025</span>
                </div>
                <div class="marquee flex space-x-16">
                    <span>🚀 Current Session : {{session('currentSession')}}</span>
                    <span>🏛️ Session Start Date : {{session('startDate')}}</span>
                    <span>🎓 Session End Date : {{session('endDate')}}</span>
                    <span>📢 New Student Portal Launched!</span>
                    <span>📝 Exam Forms Submission Ends Soon</span>
                </div>
            </div>
        </div>
        <div class=" grader grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Storage Stats Card -->
            <div class="bg-gradient-to-r from-blue-400 via-blue-300 to-white
  rounded-xl shadow-md p-2">
  <div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl sm:text-3xl font-bold text-blue-700 text-center mb-4">Grader Distribution For Current
        Session</h2>

    <div class="mb-6 p-4 bg-white shadow-md rounded-lg">
        <h3 class="text-lg font-semibold text-gray-700 mb-3 text-center sm:text-left">Search & Filters</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- Search by Grader Name -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Grader Name</label>
                <input type="text" id="search-name" class="border rounded-lg p-2 w-full" oninput="searchGraders()" placeholder="Enter grader name">
            </div>

            <!-- Search by Teacher Name -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Teacher Name</label>
                <input type="text" id="search-teacher" class="border rounded-lg p-2 w-full" oninput="searchGraders()" placeholder="Enter teacher name">
            </div>

            <!-- Type Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Type</label>
                <div class="flex items-center gap-4">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="type-filter" value="merit" onclick="handleTypeFilter(this.value)">
                        <span class="text-sm text-gray-700">Merit-based</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="type-filter" value="need-based" onclick="handleTypeFilter(this.value)">
                        <span class="text-sm text-gray-700">Need-based</span>
                    </label>
                </div>
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                <select id="status-filter" class="border rounded-lg p-2 w-full" onchange="handleStatusFilter(this.value)">
                    <option value="">Select Status</option>
                    <option value="active">Active</option>
                    <option value="in-active">Inactive</option>
                </select>
            </div>
        </div>
        <div class="flex justify-between mt-4">
            <button onclick="resetSearch()" class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                Reset Filters
            </button>
            <button onclick="openAddGraderForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                Add Grader
            </button>
        </div>
    </div>
    <div id="addGraderForm" class="hidden mb-6 p-4 bg-white shadow-md rounded-lg">
        <h3 class="text-lg font-semibold text-gray-700 mb-3 text-center sm:text-left">Add New Grader</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- Teacher Dropdown -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Select Teacher</label>
                <select id="teacherDropdown" class="border rounded-lg p-2 w-full">
                    <option value="">Select Teacher</option>
                </select>
            </div>

            <!-- Student Dropdown -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Select Student</label>
                <select id="studentDropdown" class="border rounded-lg p-2 w-full">
                    <option value="">Select Student</option>
                </select>
            </div>

            <!-- Session Dropdown -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Select Session</label>
                <select id="sessionDropdown" class="border rounded-lg p-2 w-full">
                    <option value="">Select Session</option>
                </select>
            </div>

            <!-- Type (Optional) -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Type (Optional)</label>
                <select id="typeDropdown" class="border rounded-lg p-2 w-full">
                    <option value="">Select Type</option>
                    <option value="merit">Merit-based</option>
                    <option value="need-based">Need-based</option>
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center sm:justify-end mt-4">
            <button onclick="addGrader()" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
                Submit
            </button>
        </div>
    </div>
    <div id="table-wrapper" class="table-container mx-auto max-w-5xl">
        <table class="border border-gray-300 shadow-lg bg-white w-full">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Reg No</th>
                    <th class="px-4 py-2">Section</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Grader Of</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody id="grader-table-body"></tbody>
        </table>
    </div>
</div>

<div id="assignModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 w-96 sm:w-[450px] rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Assign Grader</h2>

        <!-- Grader Info Section -->
        <div class="flex flex-col items-center">
            <!-- Circular Image Placeholder -->
            <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                <img id="graderImage" src="" class="w-full h-full object-cover hidden">
                <span id="defaultAvatar" class="text-gray-500 text-sm">No Image</span>
            </div>

            <!-- Grader Name & RegNo -->
            <p id="graderName" class="mt-2 text-lg font-bold text-gray-800"></p>
            <p id="graderRegNo" class="text-gray-600 text-sm"></p>

            <!-- Hidden Grader ID -->
            <input type="hidden" id="graderId">
        </div>

        <!-- Teacher Dropdown -->
        <div class="mt-4">
            <label class="block text-gray-700 font-medium mb-1">Select Teacher</label>
            <select id="teacherDropdown" class="border p-2 w-full rounded-md">
                <option value="">Select Teacher</option>
            </select>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between mt-6">
            <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
            <button onclick="confirmAssignment()" class="bg-green-500 text-white px-4 py-2 rounded-md">Confirm</button>
        </div>
    </div>
</div>


                </div>
            </div>

            <!-- Stats and Management Container -->
            <div class="md:col-span-2 space-y-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="stat-card">
                        <div class="stat-header bg-blue-600">
                            <h3 class="text-white font-semibold">Courses</h3>
                        </div>
                        <div class="stat-content">
                            <div class="stat-item bg-blue-50">
                                <p class="stat-label">Offered</p>
                                <p class="stat-value text-blue-700">{{session('offer_count')}}</p>
                            </div>
                            <div class="stat-item bg-blue-50">
                                <p class="stat-label">Total</p>
                                <p class="stat-value text-blue-700">{{session('course_count')}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header bg-blue-600">
                            <h3 class="text-white font-semibold">People</h3>
                        </div>
                        <div class="stat-content">
                            <div class="stat-item bg-blue-50">
                                <p class="stat-label">Students</p>
                                <p class="stat-value text-blue-700">{{session('student_count')}}</p>
                            </div>
                            <div class="stat-item bg-blue-50">
                                <p class="stat-label">Faculty</p>
                                <p class="stat-value text-blue-700">{{session('faculty_count')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-2 bg-white rounded-xl shadow-lg p-6 text-center">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{route('send.notification')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                           Send Notification
                        </a>
                        <a href="{{route('all.student')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Students
                        </a>
                        <a href="{{route('all.course')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Courses
                        </a>
                        <a href="{{route('all.teacher')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Teachers
                        </a>
                        <a href="{{route('show.enrollments')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            Pending Enrollments
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                        <a href="{{route('all.junior')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Junior Lecturers
                        </a>


                        <a href="{{route('temp.enroll')}}" class="btn-action min-h-[50px] sm:min-h-[60px] md:min-h-[70px] w-full sm:w-[160px] md:w-[180px] bg-blue-500 hover:bg-blue-600 text-white flex justify-center items-center py-2 sm:py-3 px-4 rounded-lg shadow-md transition-all text-xs sm:text-sm md:text-base">
                            View Temporary Enrollments
                        </a>
                    </div>
                </div>

                <div class="md:col-span-2 bg-white rounded-xl shadow-lg p-6 mt-6 text-center">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Manage Users</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{route('show.timetable')}}" class="card-button">
                            <span class="card-button-icon">📑</span>
                            <p class="card-button-text">Upload Timetable</p>
                        </a>
                        <a href=" {{ route('full.timetable') }}" class="card-button">
                            <span class="card-button-icon">📅</span>
                            <p class="card-button-text">View Full Timetable</p>
                        </a>
                        <a href="{{route('show.excel_excludedDays')}}" class="card-button">
                            <span class="card-button-icon">📅</span>
                            <p class="card-button-text">Add Excluded Days</p></a>
    <a href=" {{route('show.grader')}}" class="card-button">
        <span class="card-button-icon">📅</span>
        <p class="card-button-text">Assign Grader To Teacher</p>
    </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <section class="button-carousel m-5">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="inline-block w-6 h-6 bg-blue-500 rounded-md mr-2 flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                </svg>
            </span>
            Data Management
        </h2>

        <div class="relative flex items-center">
            <button id="prevBtn" class="nav-button mr-2 md:mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="overflow-hidden flex-1">
                <div id="cardContainer" class="button-container">
                    <a href="{{ route('allcourses') }}" class="card-button">
                        <span class="card-button-icon">📚</span>
                        <p class="card-button-text">All Courses</p>
                    </a>
                    <!-- View Timetable -->
                    <a href="{{ route('full.timetable') }}" class="card-button">
                        <span class="card-button-icon">📊</span>
                        <p class="card-button-text">View Timetable</p>
                    </a>

                    <!-- View Students -->
                    <a href="{{route('datacell.student')}}" class="card-button">
                        <span class="card-button-icon">👨‍🎓</span>
                        <p class="card-button-text">View Students</p>
                    </a>

                    <!-- View Teachers -->
                    <a href="{{ route('all.teacher') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">View Teachers</p>
                    </a>
                    <a href="{{ route('show.offered_Course') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Teacher Offered Courses</p>
                    </a>
                    <a href="{{ route('show.enrollments') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Enrollments</p>
                    </a>

                    <a href="{{ route('all.grader') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Add / Assign Graders</p>
                    </a>

                    <!-- View All Junior Lecturers -->
                    <a href="{{route('all.junior')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Junior Lecturers</p>
                    </a>
                    <!-- Add Section Data -->
                    <a href="{{route('show.excel_sections')}}" class="card-button">
                        <span class="card-button-icon">🔢</span>
                        <p class="card-button-text">Add Section Data</p>
                    </a>

                    <a href="{{route('show.excel_excludedDays')}}" class="card-button">
                        <span class="card-button-icon">🔢</span>
                        <p class="card-button-text">Add Excluded Days</p>
                    </a>

                    <a href="{{route('add.datacell')}}" class="card-button">
                        <span class="card-button-icon">🔢</span>
                        <p class="card-button-text">Add DataCell</p>
                    </a>

                    <a href="{{route('add.admin')}}" class="card-button">
                        <span class="card-button-icon">🔢</span>
                        <p class="card-button-text">Add Admin</p>
                    </a>
                </div>
            </div>

            <button id="nextBtn" class="nav-button ml-2 md:ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="pagination-indicator" id="paginationIndicator">
            <!-- Pagination dots will be added dynamically -->
        </div>
    </section>
    <section class="button-carousel m-5">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="inline-block w-6 h-6 bg-indigo-500 rounded-md mr-2 flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </span>
            View Information
        </h2>

        <div class="relative flex items-center">
            <button id="prevBtnView" class="nav-button mr-2 md:mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="overflow-hidden flex-1">
                <div id="viewCardContainer" class="button-container">
                    <!-- All Courses -->
                    <a href="{{ route('allcourses') }}" class="card-button">
                        <span class="card-button-icon">📚</span>
                        <p class="card-button-text">All Courses</p>
                    </a>
                    <a href="{{ route('allcourses') }}" class="card-button">
                        <span class="card-button-icon">📚</span>
                        <p class="card-button-text">Assign Courses</p>
                    </a>

                    <!-- View Timetable -->
                    <a href="{{ route('full.timetable') }}" class="card-button">
                        <span class="card-button-icon">📊</span>
                        <p class="card-button-text">View Timetable</p>
                    </a>

                    <!-- View Students -->
                    <a href="{{route('datacell.student')}}" class="card-button">
                        <span class="card-button-icon">👨‍🎓</span>
                        <p class="card-button-text">View Students</p>
                    </a>

                    <!-- View Teachers -->
                    <a href="{{ route('all.teacher') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">View Teachers</p>
                    </a>
                    <a href="{{ route('show.offered_Course') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Teacher Offered Courses</p>
                    </a>
                    <a href="{{ route('show.enrollments') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Enrollments</p>
                    </a>

                    <a href="{{ route('all.grader') }}" class="card-button">
                        <span class="card-button-icon">👨‍🏫</span>
                        <p class="card-button-text">Add / Assign Graders</p>
                    </a>

                    <!-- View All Junior Lecturers -->
                    <a href="{{route('all.junior')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Junior Lecturers</p>
                    </a>
                </div>
            </div>

            <button id="nextBtnView" class="nav-button ml-2 md:ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="pagination-indicator" id="viewPaginationIndicator">
            <!-- View pagination dots will be added dynamically -->
        </div>
    </section>


    <section class="button-carousel m-5">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="inline-block w-6 h-6 bg-green-500 rounded-md mr-2 flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </span>
            Additional Information
        </h2>

        <div class="relative flex items-center">
            <button id="prevBtnView3" class="nav-button mr-2 md:mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="overflow-hidden flex-1">
                <div id="viewCardContainer3" class="button-container">
                    <a href="{{route('all.teacher')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Teachers</p>
                    </a>
                    <a href="{{route('all.session')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Session</p>
                    </a>
                    <a href="{{route('all.course')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Courses</p>
                    </a>
                    <a href="{{route('all.archives')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Archives List</p>
                    </a>
                    <a href="{{route('temp.enroll')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">Temporary Enrollments Request</p>
                    </a>
                    <a href="{{route('all.course_allocation')}}" class="card-button">
                        <span class="card-button-icon">👥</span>
                        <p class="card-button-text">View Course Allocations</p>
                    </a>
                </div>
            </div>

            <button id="nextBtnView3" class="nav-button ml-2 md:ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="pagination-indicator" id="viewPaginationIndicator3">
            <!-- View pagination dots will be added dynamically -->
        </div>
    </section>
    </div>


    <footer class="bg-blue-600 p-2 mt-20 shadow-md text-center">
        <h4 class="font-bold text-2xl mb-4 mt-4 text-white">Learning Management System</h4>
        <p class="text-white text-1xl">&copy; 2025 LMS. All Rights Reserved.</p>
        <p class="text-white text-1xl">Sameer | Ali | Sharjeel</p>
    </footer>

    <script>
          let graders = [];
        let filteredGraders = [];
        let API_BASE_URL = "http://127.0.0.1:8000/";
        let itemsToShow = 10;
        let selectedType = "";
        let selectedStatus = "";

        async function getApiBaseUrl() {
            try {
                let response = await fetch('/get-api-url');
                let data = await response.json();
                return data.api_base_url;
            } catch (error) {
                return API_BASE_URL;
            }
        }

        async function loadGraders() {
            try {
                API_BASE_URL = await getApiBaseUrl();
                const response = await fetch(`${API_BASE_URL}api/Admin/grades`);
                const data = await response.json();
                if (data.Grader) {
                    graders = data.Grader;
                    filteredGraders = [...graders];
                    renderGraders();
                }
            } catch (error) {
                console.error("Error fetching graders:", error);
            }
        }

        function searchGraders() {
            const nameSearch = document.getElementById("search-name").value.toLowerCase();
            const teacherSearch = document.getElementById("search-teacher").value.toLowerCase();

            filteredGraders = graders.filter(grader =>
                (grader.name.toLowerCase().includes(nameSearch) || nameSearch === "") &&
                (grader["Grader of Teacher in Current Session"].toLowerCase().includes(teacherSearch) || teacherSearch === "") &&
                (selectedType === "" || grader.type === selectedType) &&
                (selectedStatus === "" || grader.status === selectedStatus)
            );

            renderGraders();
            document.getElementById("table-wrapper").classList.add("search-active");
        }

        function resetSearch() {
            document.getElementById("search-name").value = "";
            document.getElementById("search-teacher").value = "";
            document.getElementById("status-filter").value = "";
            document.querySelectorAll("input[name='type-filter']").forEach(radio => radio.checked = false);
            selectedType = "";
            selectedStatus = "";
            filteredGraders = [...graders];
            renderGraders();
            document.getElementById("table-wrapper").classList.remove("search-active");
        }

        function handleTypeFilter(type) {
            selectedType = type;
            searchGraders();
        }

        function handleStatusFilter(status) {
            selectedStatus = status;
            searchGraders();
        }

        function renderGraders() {
            const tableBody = document.getElementById("grader-table-body");
            tableBody.innerHTML = "";

            if (filteredGraders.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="8" class="text-center py-4 text-gray-500">No graders found.</td></tr>';
                return;
            }

            filteredGraders.forEach(grader => {
                let actionColumn = grader["Grader of Teacher in Current Session"];
                if (grader["Grader of Teacher in Current Session"] === "N/A" && grader.status.toLowerCase() === "in-active") {
                    actionColumn = `<button onclick="assignGrader(${grader.grader_id}, '${grader.name}','${grader.regNo}','${grader.image}')" class="bg-green-500 text-white px-3 py-1 rounded">Assign</button>`;
                }
                const encodedData = btoa(JSON.stringify(grader.student_id)); // Encode student object in Base64
                const studentDetailsUrl = `{{ route('grader.details', ['student_id' => '__PLACEHOLDER__']) }}`.replace('__PLACEHOLDER__', encodedData);
                tableBody.innerHTML += `
                    <tr class="border-b border-gray-300 text-center">
                        <td class="px-4 py-2">
                            <img src="${grader.image ? grader.image : '{{ asset('images/male.png') }}'}" alt="Profile" class="w-12 h-12 rounded-full mx-auto">
                        </td>
                        <td class="px-4 py-2">${grader.name}</td>
                        <td class="px-4 py-2">${grader.regNo}</td>
                        <td class="px-4 py-2">${grader.section}</td>
                        <td class="px-4 py-2">${grader.type}</td>
                        <td class="px-4 py-2">${grader.status}</td>
                        <td class="px-4 py-2">${actionColumn}</td>
                        <td class="px-4 py-2">
                             <a href="${studentDetailsUrl}" class="bg-blue-500 text-white px-4 py-2 rounded">History</a>
                        </td>
                    </tr>`;
            });
        }

        async function confirmAssignment() {
            try {
                let API_BASE_URL = await getApiBaseUrl(); // Await is allowed inside async function
                let graderId = document.getElementById("graderId").value;
                let teacherId = document.getElementById("teacherDropdown").value;

                if (!teacherId) {
                    alert("Please select a teacher.");
                    return;
                }

                let requestData = {
                    grader_id: graderId
                    , teacher_id: teacherId
                };

                let response = await fetch(`${API_BASE_URL}api/Datacells/assign-grader`, {
                    method: "POST"
                    , headers: {
                        "Content-Type": "application/json"
                    }
                    , body: JSON.stringify(requestData)
                });

                let data = await response.json();

                if (data.status === "success") {
                    alert("Grader assigned successfully!");
                    console.log(data);
                    await loadGraders(); // Ensure loadGraders is awaited if it's async
                    closeModal();
                } else {
                    alert("Error: " + data.message);
                    console.error(data);
                }
            } catch (error) {
                alert("An unexpected error occurred: " + error.message);
                console.error(error);
            }
        }

        async function assignGrader(graderId, name, regNo, imageUrl = null) {
            document.getElementById("graderName").innerText = name;
            document.getElementById("graderRegNo").innerText = "RegNo: " + regNo;
            document.getElementById("graderId").value = graderId;

            let imageElement = document.getElementById("graderImage");
            let defaultAvatar = document.getElementById("defaultAvatar");

            if (imageUrl) {
                imageElement.src = imageUrl;
                imageElement.classList.remove("hidden");
                defaultAvatar.classList.add("hidden");
            } else {
                imageElement.classList.add("hidden");
                defaultAvatar.classList.remove("hidden");
            }
            try {
                API_BASE_URL = await getApiBaseUrl();
                let response = await fetch(`${API_BASE_URL}api/Admin/un-assigned/teacher-for-grader`);
                let data = await response.json();

                let teacherDropdown = document.getElementById("teacherDropdown");
                teacherDropdown.innerHTML = `<option value="">Select Teacher</option>`; // Reset options

                if (data["Unassigned Teachers"] && data["Unassigned Teachers"].length > 0) {
                    data["Unassigned Teachers"].forEach(teacher => {
                        let option = document.createElement("option");
                        option.value = teacher.id;
                        option.textContent = teacher.name;
                        teacherDropdown.appendChild(option);
                    });
                } else {
                    teacherDropdown.innerHTML = `<option value="">No Teachers Available</option>`;
                }
            } catch (error) {
                console.error("Error fetching unassigned teachers:", error);
                alert("Failed to load unassigned teachers. Please try again.");
            }

            document.getElementById("assignModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("assignModal").classList.add("hidden");
        }

        document.addEventListener("DOMContentLoaded", loadGraders);
        async function openAddGraderForm() {
            document.getElementById("addGraderForm").classList.remove("hidden");
            await populateDropdowns();
        }

        async function populateDropdowns() {
            let API_BASE_URL = await getApiBaseUrl();

            try {
                let teachersResponse = await fetch(`${API_BASE_URL}api/Dropdown/get-teachers`);
                let teachersData = await teachersResponse.json();
                let teacherDropdown = document.getElementById("teacherDropdown");
                teacherDropdown.innerHTML = '<option value="">Select Teacher</option>';
                teachersData.forEach(teacher => {
                    teacherDropdown.innerHTML += `<option value="${teacher.id}">${teacher.name}</option>`;
                });

                // Fetch students
                let studentsResponse = await fetch(`${API_BASE_URL}api/Dropdown/get-students`);
                let studentsData = await studentsResponse.json();
                let studentDropdown = document.getElementById("studentDropdown");
                studentDropdown.innerHTML = '<option value="">Select Student</option>';
                studentsData.forEach(student => {
                    studentDropdown.innerHTML += `<option value="${student.id}">${student.name}</option>`;
                });

                // Fetch sessions
                let sessionResponse = await fetch(`${API_BASE_URL}api/Dropdown/AllSession`);
                let sessionData = await sessionResponse.json();
                let sessionDropdown = document.getElementById("sessionDropdown");
                sessionData.forEach(student => {
                    sessionDropdown.innerHTML += `<option value="${student.id}">${student.name}</option>`;
                });


            } catch (error) {
                alert("Failed to fetch dropdown data: " + error.message);
            }
        }

        async function addGrader() {
            let API_BASE_URL = await getApiBaseUrl();
            let teacherId = document.getElementById("teacherDropdown").value;
            let studentId = document.getElementById("studentDropdown").value;
            let sessionId = document.getElementById("sessionDropdown").value;
            let type = document.getElementById("typeDropdown").value; // Optional field
            //alert(`Teacher ID: ${teacherId}, Student ID: ${studentId}, Session ID: ${sessionId}, Type: ${type}`);
            if (!teacherId || !studentId || !sessionId) {
                alert("Please fill in all required fields.");
                return;
            }

            let requestData = {
                teacher_id: teacherId
                , grader_id: studentId
                , session_id: sessionId
                , type: type || null
            };

            try {
                let response = await fetch(`${API_BASE_URL}api/Datacells/add-grader`, {
                    method: "POST"
                    , headers: {
                        "Content-Type": "application/json"
                    }
                    , body: JSON.stringify(requestData)
                });

                let data = await response.json();

                if (data.status === "success") {
                    alert("Grader added successfully!");
                    console.log(data);
                    resetAddGraderForm();
                    document.getElementById("addGraderForm").classList.add("hidden");
                   await loadGraders(); // Ensure loadGraders is awaited if it's async
                } else {
                    let error=parseErrorMessage(data.error);
                    alert("Error: " + error);
                    console.error(data);
                }
            } catch (error) {
                let errors=parseErrorMessage(error.error);
                alert("An unexpected error occurred: " + errors);
                console.error(error);
            }
        }

        function parseErrorMessage(error) {
            if (typeof error === 'string') {
                return error; // Return as-is if it's already plain text
            } else if (typeof error === 'object' && error !== null) {
                if (Array.isArray(error)) {
                    return error.join(', '); // Convert array errors to comma-separated text
                } else {
                    let messages = [];
                    for (const key in error) {
                        if (Array.isArray(error[key])) {
                            messages.push(`${key}: ${error[key].join(', ')}`);
                        } else {
                            messages.push(`${key}: ${error[key]}`);
                        }
                    }
                    return messages.join('\n'); // Return as multi-line text
                }
            }
            return "An unexpected error occurred."; // Default fallback
        }

        function resetAddGraderForm() {
            document.getElementById("teacherDropdown").value = "";
            document.getElementById("studentDropdown").value = "";
            document.getElementById("typeDropdown").value = "";
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize both carousels
            initializeCarousel('cardContainer', 'prevBtn', 'nextBtn', 'paginationIndicator');
            initializeCarousel('viewCardContainer', 'prevBtnView', 'nextBtnView', 'viewPaginationIndicator');
            initializeCarousel('viewCardContainer3', 'prevBtnView3', 'nextBtnView3', 'viewPaginationIndicator3');

            function initializeCarousel(containerId, prevBtnId, nextBtnId, paginationId) {
                const container = document.getElementById(containerId);
                const prevBtn = document.getElementById(prevBtnId);
                const nextBtn = document.getElementById(nextBtnId);
                const paginationContainer = document.getElementById(paginationId);

                const cards = container.querySelectorAll('.card-button');
                const totalCards = cards.length;

                // Determine how many cards to show based on screen size
                let cardsPerPage = getCardsPerPage();
                let currentPage = 0;
                let totalPages = Math.ceil(totalCards / cardsPerPage);

                // Create pagination dots
                createPaginationDots();

                function createPaginationDots() {
                    paginationContainer.innerHTML = '';
                    for (let i = 0; i < totalPages; i++) {
                        const dot = document.createElement('div');
                        dot.classList.add('pagination-dot');
                        if (i === 0) dot.classList.add('active');
                        paginationContainer.appendChild(dot);
                    }
                }

                // Update pagination dots
                function updatePagination() {
                    const dots = paginationContainer.querySelectorAll('.pagination-dot');
                    dots.forEach((dot, index) => {
                        if (index === currentPage) {
                            dot.classList.add('active');
                        } else {
                            dot.classList.remove('active');
                        }
                    });
                }

                // Show cards for current page
                function showCurrentPage() {
                    cards.forEach((card, index) => {
                        const startIndex = currentPage * cardsPerPage;
                        const endIndex = startIndex + cardsPerPage;

                        if (index >= startIndex && index < endIndex) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Update button states
                    prevBtn.disabled = currentPage === 0;
                    nextBtn.disabled = currentPage >= totalPages - 1;

                    // Update visual feedback for disabled buttons
                    prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
                    nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';

                    updatePagination();
                }

                // Previous button click
                prevBtn.addEventListener('click', () => {
                    if (currentPage > 0) {
                        currentPage--;
                        showCurrentPage();
                    }
                });

                // Next button click
                nextBtn.addEventListener('click', () => {
                    if (currentPage < totalPages - 1) {
                        currentPage++;
                        showCurrentPage();
                    }
                });

                // Handle pagination dot clicks
                paginationContainer.addEventListener('click', (e) => {
                    if (e.target.classList.contains('pagination-dot')) {
                        const dots = Array.from(paginationContainer.querySelectorAll('.pagination-dot'));
                        const clickedIndex = dots.indexOf(e.target);

                        if (clickedIndex !== -1 && clickedIndex !== currentPage) {
                            currentPage = clickedIndex;
                            showCurrentPage();
                        }
                    }
                });

                // Handle window resize
                window.addEventListener('resize', () => {
                    const newCardsPerPage = getCardsPerPage();

                    if (newCardsPerPage !== cardsPerPage) {
                        cardsPerPage = newCardsPerPage;
                        totalPages = Math.ceil(totalCards / cardsPerPage);

                        // Recreate pagination dots
                        createPaginationDots();

                        // Adjust current page if needed
                        if (currentPage >= totalPages) {
                            currentPage = totalPages - 1;
                        }

                        showCurrentPage();
                    }
                });

                function getCardsPerPage() {
                    if (window.innerWidth < 480) return 3;
                    if (window.innerWidth < 768) return 4;
                    if (window.innerWidth < 1024) return 5;
                    return 5;
                }

                // Initial setup
                showCurrentPage();
            }
        });

    </script>
    @include('components.loader')
    @include('components.alert')
</body>

</html>