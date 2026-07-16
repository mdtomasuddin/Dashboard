<!--begin: Header-->
<header role="banner"
    class="sticky top-0 z-30 bg-white/80 dark:bg-gray-950/80 backdrop-blur-xl border-b border-gray-200 dark:border-gray-800 shadow-sm">
    <!--begin: Header Inner Wrapper-->
    <div class="flex items-center justify-between h-16 px-4 lg:px-6">
        <!--begin: Header Left Section-->
        <div class="flex items-center gap-3">
            <button @click="toggleSidebar()"
                class="hidden lg:flex w-10 h-10 items-center justify-center rounded-xl text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-200 transition-all duration-200"
                :title="sidebarOpen ? 'Collapse Sidebar' : 'Expand Sidebar'" :aria-expanded="sidebarOpen">
                <i class="fa-solid fa-bars-staggered text-lg"></i>
            </button>
            <button @click="mobileSidebarOpen = true"
                class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200"
                aria-label="Open sidebar" :aria-expanded="mobileSidebarOpen">
                <i class="fa-solid fa-bars text-lg"></i>
            </button>
        </div>
        <!--end: Header Left Section-->

        <!--begin: Header Right Section-->
        <div class="flex items-center gap-1 sm:gap-2">
            <!--begin: Desktop Search Wrapper-->
            <div class="hidden md:flex items-center relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3 text-gray-400 text-sm"></i>
                <input type="text" aria-label="Search" placeholder="Search anything..."
                    class="w-48 lg:w-64 h-10 pl-9 pr-4 bg-gray-100 dark:bg-gray-800 border-0 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:bg-white dark:focus:bg-gray-800 transition-all">
                <kbd
                    class="absolute right-3 hidden lg:inline-flex items-center gap-0.5 text-[10px] text-gray-400 bg-gray-200 dark:bg-gray-700 px-1.5 py-0.5 rounded font-mono">⌘K</kbd>
            </div>
            <!--end: Desktop Search Wrapper-->
            <button @click="searchOpen = !searchOpen"
                class="md:hidden w-10 h-10 flex items-center justify-center rounded-xl text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <button onclick="toggleFullscreen()"
                class="hidden sm:flex w-10 h-10 items-center justify-center rounded-xl text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200"
                title="Fullscreen">
                <i class="fa-solid fa-expand text-lg"></i>
            </button>
            <button @click="toggleDarkMode()"
                class="w-10 h-10 flex items-center justify-center rounded-xl text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200"
                :title="darkMode ? 'Light Mode' : 'Dark Mode'">
                <i x-show="!darkMode" class="fa-solid fa-moon text-lg"></i>
                <i x-show="darkMode" class="fa-solid fa-sun text-lg text-yellow-400"></i>
            </button>
            <a href="#"
                class="relative w-10 h-10 flex items-center justify-center rounded-xl text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                <i class="fa-solid fa-message text-lg"></i>
                <span
                    class="absolute top-1.5 right-1.5 w-2 h-2 bg-green-500 rounded-full ring-2 ring-white dark:ring-gray-950"></span>
            </a>
            <!--begin: Notifications Dropdown Wrapper-->
            <div class="relative" @click.outside="notificationsOpen = false">
                <button @click="notificationsOpen = !notificationsOpen"
                    class="relative w-10 h-10 flex items-center justify-center rounded-xl text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                    <i class="fa-solid fa-bell text-lg"></i>
                    <span
                        class="absolute top-1.5 right-1.5 min-w-[18px] h-[18px] flex items-center justify-center bg-red-500 text-white text-[9px] font-bold rounded-full ring-2 ring-white dark:ring-gray-950 badge-pulse">5</span>
                </button>
                @include('backend.layouts.partials.notifications_dropdown')
            </div>
            <!--end: Notifications Dropdown Wrapper-->
            <!--begin: Profile Dropdown Wrapper-->
            <div class="relative" @click.outside="profileDropdownOpen = false">
                <button @click="profileDropdownOpen = !profileDropdownOpen"
                    class="flex items-center gap-2 px-2 py-1.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 group">
                    <!--begin: Profile Avatar-->
                    <div
                        class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white text-sm font-bold shadow-md ring-2 ring-white dark:ring-gray-950">
                        {{ substr(Auth::user()->first_name ?? 'U', 0, 1) }}
                    </div>
                    <!--end: Profile Avatar-->
                    <!--begin: Profile Name Area-->
                    <div class="hidden lg:block text-left">
                        <p class="text-sm font-semibold text-gray-800 dark:text-white leading-tight">
                            {{ trim((Auth::user()->first_name ?? 'User') . ' ' . (Auth::user()->last_name ?? '')) }}</p>
                        <p class="text-[10px] text-gray-400 dark:text-gray-500 leading-tight">Admin</p>
                    </div>
                    <!--end: Profile Name Area-->
                    <i
                        class="hidden lg:block fa-solid fa-chevron-down text-[10px] text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors"></i>
                </button>
                @include('backend.layouts.partials.profile_dropdown')
            </div>
            <!--end: Profile Dropdown Wrapper-->
        </div>
        <!--end: Header Right Section-->
    </div>
    <!--end: Header Inner Wrapper-->

    <!--begin: Mobile Search Bar-->
    <div x-show="searchOpen" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden px-4 pb-3">
        <!--begin: Mobile Search Input Wrapper-->
        <div class="relative">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" placeholder="Search anything..."
                class="w-full h-10 pl-9 pr-4 bg-gray-100 dark:bg-gray-800 border-0 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/30 transition-all">
        </div>
        <!--end: Mobile Search Input Wrapper-->
    </div>
    <!--end: Mobile Search Bar-->
</header>
<!--end: Header-->
