<div class="relative z-[51] flex h-[67px] items-center border-b border-slate-200">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="flex -intro-x hidden sm:flex">
        <ol class="flex items-center text-theme-1 dark:text-slate-300">
            <li><a href="">Application</a></li>
            <li class="relative ml-5 text-slate-800 cursor-text dark:text-slate-400">
                <a href="">{{ session('page-name')?? "Dashboard" }}</a>
            </li>
        </ol>
    </nav>
    <!-- END: Breadcrumb -->

    <!-- BEGIN: Account Menu (Moved to Right) -->
    <div class="ml-auto relative">
        <button id="userDropdownButton" class="cursor-pointer image-fit zoom-in block h-8 w-8 overflow-hidden rounded-full shadow-lg">
            <img src="{{ asset('/user/userIcon.png') }}" alt="User Image">
        </button>

        <div id="userDropdown" class="dropdown-menu absolute right-0 z-50 hidden mt-2 w-56 bg-white shadow-lg rounded-md">
            <div class="p-2">
                <div class="text-xs">{{ auth()->user()?->name }}</div>
            </div>
            <div class="h-px my-2 bg-gray-200"></div>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
    

            <form id="logout-form" action="{{ route('logout') }}" method="POST"  class="block px-4 py-2 text-red-600 hover:bg-gray-100">
    @csrf
    <button  class="block px-4 py-2 text-red-600 hover:bg-gray-100">Logout</button>

</form>

        </div>
    </div>
    <!-- END: Account Menu -->
</div>

<!-- JavaScript for Dropdown -->
<script>
    document.getElementById('userDropdownButton').addEventListener('click', function () {
        document.getElementById('userDropdown').classList.toggle('hidden');
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('userDropdown');
        const button = document.getElementById('userDropdownButton');

        if (!dropdown.contains(event.target) && !button.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
