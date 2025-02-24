<div class="relative inline-block text-left w-48">
    <!-- Button -->
    <button onclick="toggleDropdown('{{ $id }}')" class="w-full flex justify-between items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform transition-all duration-300 hover:scale-105">
        <span id="{{ $id }}_selected">Select</span> 
        <span class="ml-2 transition-transform transform rotate-0" id="{{ $id }}_arrow">&#9662;</span> <!-- Down Arrow -->
    </button>
    
    <!-- Dropdown Menu -->
    <div id="{{ $id }}" class="absolute right-0 mt-2 w-full bg-white/90 backdrop-blur-lg text-blue-700 rounded-lg shadow-xl opacity-0 scale-95 transform transition-all duration-300 ease-out hidden z-50">
        <ul class="py-2">
            
            @foreach ($items as $item)
                <li>
                    <a href="{{ $item['url'] }}" onclick="selectItem('{{ $id }}', '{{ $item['label'] }}')" 
                       class="block px-4 py-2 transition duration-300 ease-in-out hover:bg-gradient-to-r from-blue-500 to-blue-400 hover:text-white rounded-md hover:pl-6">
                        {{ $item['label'] }}
                    
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script>
    function toggleDropdown(id) {
        let dropdown = document.getElementById(id);
        let arrow = document.getElementById(id + "_arrow");

        if (dropdown.classList.contains("hidden")) {
            dropdown.classList.remove("hidden");
            setTimeout(() => {
                dropdown.classList.add("opacity-100", "scale-100");
                dropdown.classList.remove("opacity-0", "scale-95");
            }, 10);
            arrow.classList.add("rotate-180"); // Rotate arrow down
        } else {
            dropdown.classList.add("opacity-0", "scale-95");
            dropdown.classList.remove("opacity-100", "scale-100");
            arrow.classList.remove("rotate-180"); // Rotate arrow up
            setTimeout(() => {
                dropdown.classList.add("hidden");
            }, 300);
        }
    }

    function selectItem(id, label) {
        document.getElementById(id + "_selected").innerText = label;
        toggleDropdown(id);
    }
</script>






{{-- function showLoader() {
    document.getElementById("loader").classList.remove("hidden");
}

function hideLoader() {
    document.getElementById("loader").classList.add("hidden");
} --}}


{{-- <div class="glass text-white flex flex-col items-center">
    <div class="progress-container">
        <div class="progress-line" id="progress-line"></div>
        <div class="progress-bar">
            <div id="step1" class="step active">1</div>
            <div id="step2" class="step">2</div>
            <div id="step3" class="step">3</div>
        </div>
        <div id="loader" class="hidden fixed top-0 left-0 w-full h-full justify-center items-center bg-white bg-opacity-50">
<div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
</div> --}}