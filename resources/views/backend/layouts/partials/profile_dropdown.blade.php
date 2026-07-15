<!--begin: Profile Dropdown Container-->
<div x-show="profileDropdownOpen" x-cloak @click.outside="profileDropdownOpen = false"
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
    class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-900 rounded-2xl shadow-dropdown border border-gray-200 dark:border-gray-700 overflow-hidden origin-top-right z-50">
    <!--begin: Profile Header-->
    <div class="p-4 border-b border-gray-100 dark:border-gray-800">
        <!--begin: Profile Info Wrapper-->
        <div class="flex items-center gap-3">
            <!--begin: Profile Avatar-->
            <div
                class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white font-bold shadow-md">
                {{ substr(Auth::user()->first_name ?? 'U', 0, 1) }}
            </div>
            <!--end: Profile Avatar-->
            <!--begin: Profile Name & Email-->
            <div>
                <p class="text-sm font-bold text-gray-800 dark:text-white">
                    {{ trim((Auth::user()->first_name ?? 'User') . ' ' . (Auth::user()->last_name ?? '')) }}</p>
                <p class="text-xs text-gray-400 dark:text-gray-500">{{ Auth::user()->email ?? 'user@example.com' }}</p>
            </div>
            <!--end: Profile Name & Email-->
        </div>
        <!--end: Profile Info Wrapper-->
    </div>
    <!--end: Profile Header-->
    <!--begin: Profile Menu Items-->
    <div class="p-1.5">
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white transition-all">
            <i class="fa-solid fa-user w-5 text-center text-gray-400"></i><span>My Profile</span>
        </a>
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white transition-all">
            <i class="fa-solid fa-gear w-5 text-center text-gray-400"></i><span>Account Settings</span>
        </a>
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white transition-all">
            <i class="fa-solid fa-shield-halved w-5 text-center text-gray-400"></i><span>Security</span>
        </a>
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white transition-all">
            <i class="fa-solid fa-key w-5 text-center text-gray-400"></i><span>Change Password</span>
        </a>
        <hr class="my-1 border-gray-100 dark:border-gray-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i><span>Logout</span>
            </button>
        </form>
    </div>
    <!--end: Profile Menu Items-->
</div>
<!--end: Profile Dropdown Container-->
