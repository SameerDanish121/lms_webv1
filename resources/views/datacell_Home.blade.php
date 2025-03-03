<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>LMS Dashboard</title>
     @vite('resources/css/app.css')
     <script>
         function toggleMenu() {
             document.getElementById("mobileMenu").classList.toggle("hidden");
         }
     </script>
     <style>
         @keyframes marquee {
             from { transform: translateX(0); }
             to { transform: translateX(-100%); }
         }
         .marquee-container {
             display: flex;
             min-width: 200%;
             animation: marquee 50s linear infinite;
         }
         .relative:hover .marquee-container {
             animation-play-state: paused;
         }
         .btn-hover:hover {
             transform: scale(1.05);
             transition: transform 0.3s ease-in-out;
         }
         .fade-in {
             animation: fadeIn 1s ease-in-out;
         }
         @keyframes fadeIn {
             from { opacity: 0; }
             to { opacity: 1; }
         }
         .nav-item {
             position: relative;
             color: #4b5563;
             font-weight: 600;
             transition: color 0.3s ease-in-out;
         }
         .nav-item:hover {
             color: #1d4ed8;
         }
         .nav-item::after {
             content: "";
             position: absolute;
             left: 50%;
             bottom: -2px;
             width: 0;
             height: 2px;
             background-color: #1d4ed8;
             transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
         }
         .nav-item:hover::after {
             width: 100%;
             left: 0;
   }
     </style>
 </head>
 @php
 $profileImage = session('profileImage', asset('images/male.png'));
 $userName = session('username', 'Guest');
 $designation = session('designation', 'N/A');
 $type=session('userType', 'User');
 $imagePath = asset('images/male.png');
 @endphp
 <body class="bg-gradient-to-r from-blue-300 via-blue-200 to-blue-100 min-h-screen p-0 m-0">
     @include('components.navbar', [
         'username' => session('username', 'Guest'),
         'profileImage' => session('profileImage', asset('images/male.png')),
         'designation' => session('designation', 'N/A'),
         'type' => session('userType', 'User')
     ])
     <div class="max-w-6xl mx-auto mb-1 mt-6 p-6 rounded-2xl shadow-lg text-center fade-in backdrop-blur-lg border border-white/10" style="background: linear-gradient(to bottom right, rgba(0, 198, 255, 0.8), rgba(0, 114, 255, 0.8), rgba(30, 61, 143, 0.8));">
         <img src="{{$profileImage}}" alt="{{$imagePath}}" class="mx-auto rounded-full border-4 border-white shadow-lg w-24 h-24 object-cover">
         <h2 class="text-white text-2xl font-bold mt-3">{{ $userName }}</h2>
         <p class="text-white opacity-80">{{ $type}}</p>
         <form action="{{ route('profile') }}" method="GET">
             <button type="submit" class="account-btn text-white px-6 py-3 mt-4 rounded-full bg-white/20 hover:bg-white/30 transition-all duration-300 shadow-lg">
                 Go to Profile
             </button>
         </form>
         
     </div>
     <div class="relative w-full max-w-8xl overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-800 text-white shadow-lg rounded-lg border border-white/10 mx-auto py-4">
         <div class="marquee-container flex space-x-16 whitespace-nowrap text-lg font-semibold tracking-wide">
             <div class="marquee flex space-x-20">
                 <span>🚀 Semester Registrations Open</span>
                 <span>🏛️ Fee Deadline: 15 Feb 2025</span>
                 <span>🎓 Convocation: 20 March 2025</span>
                 <span>📢 Students Week Soon</span>
                 <span>📝 Mids : 25 March 2025</span>
             </div>
             <div class="marquee flex space-x-16">
                 <span>🚀 Semester Registrations Open</span>
                 <span>🏛️ Fee Deadline: 15 Feb 2025</span>
                 <span>🎓 Convocation: 20 March 2025</span>
                 <span>📢 New Student Portal Launched!</span>
                 <span>📝 Exam Forms Submission Ends Soon</span>
             </div>
         </div> </div> </div>
      
 <!-- Original buttons section -->
 <div class="max-w-5xl mx-auto mt-6 flex items-center">
    <button id="prevBtn" class="bg-white p-3 md:p-4 rounded-lg shadow-md text-center btn-hover mr-2 md:mr-5">⬅️</button>
     <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 flex-1" id="cardContainer">
         <!-- Button 1 -->
         <a href="{{route('show.timetable')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">📑</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Upload Timetable</p>
         </a>
        
         <!-- Button 2 -->
         <a href="{{route('show.student_upload')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👨‍🎓</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Add Students</p>
         </a>
         <a href="{{route ('show.excel_teacher')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👨‍🏫</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Add Teachers</p>
         </a>
         <a href="{{route ('show.excel_junior')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👨‍🏫</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Add Junior Lecturer</p>
         </a>
         <a href="{{route ('show.excel_venue')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👨‍🏫</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Add Venue</p>
         </a>
         <a href="{{route ('show.excel_course')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👨‍🏫</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Add Course</p>
         </a>
         <a href="{{route ('show.excel_session')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👨‍🏫</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Add Session</p>
         </a>
         <a href="{{route ('show.excel_excludedDays')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👨‍🏫</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Add Excluded Days</p>
         </a>
         <a href="{{route ('show.excel_sections')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👨‍🏫</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Add Section Data</p>
         </a>
 
        
         <!-- Button 3 -->
         <a href="{{ route('allcourses') }}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">📚</span>
             <p class="mt-2 font-bold text-xs md:text-sm">All Courses</p>
         </a>
         <a href="{{ route('full.timetable') }}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">📚</span>
             <p class="mt-2 font-bold text-xs md:text-sm">All Courses</p>
         </a>
         <!-- Button 4 -->
         <a href="" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">🎓</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Assign Courses</p>
         </a>
 
         <!-- Button 5 -->
         <a href="" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👨‍🏫</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Teachers</p>
         </a>
         <!-- Button 6 -->
         <a href="{{route('allstudents')}}" class="btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👨‍🎓</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Students</p>
         </a>
     </div>
     <!-- Next Button: Positioned to the right outside the card with margin -->
     <button id="nextBtn" class="bg-white p-3 md:p-4 rounded-lg shadow-md text-center btn-hover ml-2 md:ml-5">
         <span>➡️</span>
     </button>
 </div>
 
 <!-- NEW SECTION: View Functionality Buttons -->
 <div class="max-w-5xl mx-auto mt-10 flex items-center">
    <button id="prevBtnView" class="bg-white p-3 md:p-4 rounded-lg shadow-md text-center btn-hover mr-2 md:mr-5">⬅️</button>
     <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 flex-1" id="viewCardContainer">
         <!-- View Button 1 -->
         <a href="{{ route('full.timetable') }}" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">📅</span>
             <p class="mt-2 font-bold text-xs md:text-sm">View Timetable</p>
         </a>
         <a href="" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">🔍</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Search Students</p>
         </a>
         
        
        
    
         <a href="{{ route('allcourses') }}" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">📚</span>
             <p class="mt-2 font-bold text-xs md:text-sm">View Courses</p>
         </a>
         
         <!-- View Button 4 -->
         <a href="" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👨‍🏫</span>
             <p class="mt-2 font-bold text-xs md:text-sm">View Teachers</p>
         </a>
 
         <!-- View Button 5 -->
         <a href="" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">🏢</span>
             <p class="mt-2 font-bold text-xs md:text-sm">View Venues</p>
         </a>
         
         <!-- View Button 6 -->
         <a href="" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👥</span>
             <p class="mt-2 font-bold text-xs md:text-sm">View Sections</p>
         </a>
         <a href="{{ route('allstudents') }}" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">👨‍🎓</span>
             <p class="mt-2 font-bold text-xs md:text-sm">View Students</p>
         </a>
         
      
         <a href="" class="view-btn-card bg-white p-6 rounded-xl shadow-md text-center hover:scale-105 transition-transform">
             <span class="text-4xl">📊</span>
             <p class="mt-2 font-bold text-xs md:text-sm">Reports</p>
         </a>
     </div>
     <!-- Next Button for View section -->
     <button id="nextBtnView" class="bg-white p-3 md:p-4 rounded-lg shadow-md text-center btn-hover ml-2 md:ml-5">
         <span>➡️</span>
     </button>
 </div>
 <br/>
 <br/>
 <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Card 1 -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Full Timetable</h2>
        <p class="text-gray-600 mt-2">Click below to View Full Timetable.</p>
        <a href="{{ route('full.timetable') }}" class="mt-4 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition">
            Click Me ➡️
        </a>
    </div>

    <!-- Card 2 -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Teacher</h2>
        <p class="text-gray-600 mt-2">Click below to Add New Teacher</p>
        <a href="{{route('add.teacher')}}" class="mt-4 inline-block bg-green-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-600 transition">
            Click Me ➡️
        </a>
    </div>

    <!-- Card 3 -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Junior Lecturer</h2>
        <p class="text-gray-600 mt-2">Click below to Add New Junior Lecturer</p>
        <a href="{{route('add.junior')}}" class="mt-4 inline-block bg-red-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-red-600 transition">
            Click Me ➡️
        </a>
    </div>

    <!-- Card 4 -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Datacell</h2>
        <p class="text-gray-600 mt-2">Click below to Add New Datacell</p>
        <a href="{{route('add.datacell')}}" class="mt-4 inline-block bg-yellow-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-yellow-600 transition">
            Click Me ➡️
        </a>
    </div>

    <!-- Card 5 -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Admin</h2>
        <p class="text-gray-600 mt-2">Click below to Add New Admin</p>
        <a href="{{route('add.admin')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Student</h2>
        <p class="text-gray-600 mt-2">Click below to Add New Student</p>
        <a href="{{route('add.student')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Teacher Offered Course</h2>
        <p class="text-gray-600 mt-2">Click below to Upload Course for Session with Teacher Allocation</p>
        <a href="{{route('show.offered_Course')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Enrollments</h2>
        <p class="text-gray-600 mt-2">Click below to Upload Student Enrollments is a Session</p>
        <a href="{{route('show.enrollments')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Grader and Assign to Teacher</h2>
        <p class="text-gray-600 mt-2">Click below to Upload Student Grader Assign </p>
        <a href="{{route('show.grader')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Junior Course Allocaion List </h2>
        <p class="text-gray-600 mt-2">Click below to Junior Course Allocation List </p>
        <a href="{{route('show.junior_courseAllocation')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Topic For A Course Per Week </h2>
        <p class="text-gray-600 mt-2">Click below to Add Topics</p>
        <a href="{{route('show.topic_coursePerWeek')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">Add Full Subject Result List </h2>
        <p class="text-gray-600 mt-2">Click below to Add Full Award List of A Section and Subject (MID/FINAL/LAB/INTERNAL/GRADE)</p>
        <a href="{{route('show.subject_result')}}" class="mt-4 inline-block bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition">
            Click Me ➡️
        </a>
    </div>
   
</div>
 
 
         <div class=" max-w-6xl mx-auto grid grid-cols-2 gap-4 mt-4">
             <button class="btn-hover bg-blue-600 text-white p-6 rounded-lg text-center">
                 <p class="font-bold">Offered Courses</p>
                 <p class="text-3xl font-bold">33</p>
             </button>
             <button class="btn-hover bg-blue-600 text-white p-6 rounded-lg text-center">
                 <p class="font-bold">Total Courses</p>
                 <p class="text-3xl font-bold">60</p>
             </button>
         </div>
     </div>
     <div class="max-w-6xl mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
         <div class="bg-white text-black p-6 rounded-lg">
             <h3 class="text-lg font-bold ">Students</h3>
             <div class="grid grid-cols-2 gap-4 mt-4">
                 <button class="bg-blue-600 p-6 rounded-lg text-center text-white btn-hover">
                     <p class="font-bold">Graduate</p>
                     <p class="text-3xl font-bold">700</p>
                 </button>
                 <button class="bg-blue-600 p-6 rounded-lg text-white text-center btn-hover">
                     <p class="font-bold">Under-Graduate</p>
                     <p class="text-3xl font-bold">2056</p>
                 </button>
             </div>
         </div>
         <div class="bg-white text-black p-6 rounded-lg">
             <h3 class="text-lg font-bold">Teachers</h3>
             <div class="grid grid-cols-2 gap-4 mt-4">
                 <button class="bg-blue-600 p-6 rounded-lg text-center btn-hover">
                     <p class="font-bold text-white">Lecturer</p>
                     <p class="text-3xl font-bold text-white">26</p>
                 </button>
                 <button class="bg-blue-600 p-6 rounded-lg text-center btn-hover">
                     <p class="font-bold text-white">Junior Lecturer</p>
                     <p class="text-3xl font-bold text-white">12</p>
                 </button>
             </div>
         </div>
     </div>
     <footer class="bg-blue-600 p-2 mt-20 shadow-md text-center">
         <h4 class=" font-bold text-2xl mb-4 mt-4 text-white">Learning Management System</h4>
         <p class="text-white text-1xl">&copy; 2025 LMS. All Rights Reserved.</p>
         <p class="text-white text-1xl">Sameer  |  Ali  | Sharjeel</p>
     </footer>
 </body>
 <script>
   
     let currentIndex = 0;
     const buttons = document.querySelectorAll(".btn-card");
     const visibleCount = 4;
 
     function updateVisibility() {
         buttons.forEach((btn, index) => {
             btn.classList.toggle("hidden", index < currentIndex || index >= currentIndex + visibleCount);
         });
     }
 
     document.getElementById("prevBtn").addEventListener("click", () => {
         if (currentIndex > 0) {
             currentIndex -= 1;
             updateVisibility();
         }
     });
 
     document.getElementById("nextBtn").addEventListener("click", () => {
         if (currentIndex + visibleCount < buttons.length) {
             currentIndex += 1;
             updateVisibility();
         }
     });
 
     updateVisibility();
 
    
     let currentViewIndex = 0;
     const viewButtons = document.querySelectorAll(".view-btn-card");
     const viewVisibleCount = 4;
 
     function updateViewVisibility() {
         viewButtons.forEach((btn, index) => {
             btn.classList.toggle("hidden", index < currentViewIndex || index >= currentViewIndex + viewVisibleCount);
         });
     }
 
     document.getElementById("prevBtnView").addEventListener("click", () => {
         if (currentViewIndex > 0) {
             currentViewIndex -= 1;
             updateViewVisibility();
         }
     });
 
     document.getElementById("nextBtnView").addEventListener("click", () => {
         if (currentViewIndex + viewVisibleCount < viewButtons.length) {
             currentViewIndex += 1;
             updateViewVisibility();
         }
     });
 
     updateViewVisibility();
 </script>
 </html>