{{-- <div class="flex items-center bg-white p-4 shadow-md relative z-50 sticky top-0 w-full">
    <div class="flex items-center space-x-3">
        <button onclick="toggleMenu()" class="text-blue-500 text-2xl md:hidden">&#9776;</button>
        <a href="{{ session('userType') == 'Admin' ? route('admin.dashboard') : route('datacell.dashboard') }}" 
           class="font-bold text-blue-600 text-xl lg:text-4xl">LMS</a>
    </div>
    <div class="hidden md:flex space-x-10 ml-auto mr-5">
        <a href="{{ session('userType') == 'Admin' ? route('admin.dashboard') : route('datacell.dashboard') }}" class="nav-item">Home</a>
        <a href="{{ route('send.notification') }}" class="nav-item">Send Notification</a>
        <a href="#" class="nav-item">Courses</a>
        <a href="#" class="nav-item">Teachers</a>
        <a href="#" class="nav-item">Enrollments</a>
        <a href="#" onclick="document.getElementById('logout-form').submit();" class="nav-item text-red-500">Logout</a>
    </div>
    <div class="ml-auto md:ml-5 flex items-center space-x-3">
        <a href="{{ route('profile') }}" class="flex items-center space-x-3 cursor-pointer">
            <img src="{{ session('profileImage', asset('images/male.png')) }}" 
                 alt="Profile Image" 
                 class="w-11 h-10 rounded-full border border-gray-300">
            <div class="flex flex-col">
                <span class="text-gray-600 font-semibold">{{ session('username', 'Guest') }}</span>
                <span class="text-sm text-gray-400">{{ session('designation', 'N/A') }}</span>
            </div>
        </a>
    </div>
</div>
<div id="mobileMenu" class="hidden fixed inset-0 bg-white z-50 shadow-lg p-4 md:hidden min-h-screen">
    <button onclick="toggleMenu()" class="text-gray-500 text-2xl absolute top-4 right-4">✖</button>
    <div class="flex flex-col space-y-4 mt-10">
        <a href="{{ session('userType') == 'Admin' ? route('admin.dashboard') : route('datacell.dashboard') }}" class="block py-2 px-4 text-gray-600 font-semibold hover:bg-gray-100">Home</a>
        <a href="{{ route('send.notification') }}" class="block py-2 px-4 text-gray-600 font-semibold hover:bg-gray-100">Send Notification</a>
        <a href="#" class="block py-2 px-4 text-gray-600 font-semibold hover:bg-gray-100">Courses</a>
        <a href="#" class="block py-2 px-4 text-gray-600 font-semibold hover:bg-gray-100">Teachers</a>
        <a href="#" class="block py-2 px-4 text-gray-600 font-semibold hover:bg-gray-100">Enrollments</a>
        <a href="#" onclick="document.getElementById('logout-form').submit();" 
           class="block py-2 px-4 text-red-500 font-semibold hover:bg-gray-100">Logout</a>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
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
</style> --}}
<div class="flex items-center bg-white p-4 shadow-md relative z-50 sticky top-0 w-full">
    <div class="flex items-center space-x-3">
        <button onclick="toggleMenu()" class="text-blue-500 text-2xl md:hidden">&#9776;</button>
        <a href="{{ session('userType') == 'Admin' ? route('admin.dashboard') : route('datacell.dashboard') }}"
           class="font-bold text-blue-600 text-xl lg:text-4xl">LMS</a>
    </div>
    <div class="hidden md:flex space-x-10 ml-auto mr-5">
        <a href="{{ session('userType') == 'Admin' ? route('admin.dashboard') : route('datacell.dashboard') }}" class="nav-item">Home</a>
        <a href="{{ route('send.notification') }}" class="nav-item">Send Notification</a>
        <a href="#" class="nav-item">Courses</a>
        <a href="#" class="nav-item">Teachers</a>
        <a href="#" class="nav-item">Enrollments</a>
        <a href="#" onclick="document.getElementById('logout-form').submit();" class="nav-item text-red-500">Logout</a>
    </div>
    <div class="ml-auto md:ml-5 flex items-center space-x-3">
        <a href="{{ route('profile') }}" class="flex items-center space-x-3 cursor-pointer">
            <img src="{{ session('profileImage', asset('images/male.png')) }}"
                 alt="Profile Image"
                 class="w-11 h-10 rounded-full border border-gray-300">
            <div class="flex flex-col">
                <span class="text-gray-600 font-semibold">{{ session('username', 'Guest') }}</span>
                <span class="text-sm text-gray-400">{{ session('designation', 'N/A') }}</span>
            </div>
        </a>
    </div>
</div>

<div id="mobileMenu" class="hidden fixed inset-0 bg-white z-50 shadow-lg p-4 md:hidden min-h-screen">
    <button onclick="toggleMenu()" class="text-gray-500 text-2xl absolute top-4 right-4">✖</button>
    <div class="flex flex-col space-y-4 mt-10">
        <a href="{{ session('userType') == 'Admin' ? route('admin.dashboard') : route('datacell.dashboard') }}" class="block py-2 px-4 text-gray-600 font-semibold hover:bg-gray-100">Home</a>
        <a href="{{ route('send.notification') }}" class="block py-2 px-4 text-gray-600 font-semibold hover:bg-gray-100">Send Notification</a>
        <a href="#" class="block py-2 px-4 text-gray-600 font-semibold hover:bg-gray-100">Courses</a>
        <a href="#" class="block py-2 px-4 text-gray-600 font-semibold hover:bg-gray-100">Teachers</a>
        <a href="#" class="block py-2 px-4 text-gray-600 font-semibold hover:bg-gray-100">Enrollments</a>
        <a href="#" onclick="document.getElementById('logout-form').submit();"
           class="block py-2 px-4 text-red-500 font-semibold hover:bg-gray-100">Logout</a>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

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