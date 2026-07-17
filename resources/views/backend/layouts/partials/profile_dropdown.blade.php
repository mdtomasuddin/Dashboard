<!-- begin:profile-dropdown-container -->
@php
    $currentUser = Auth::user();
    $fullName = trim(($currentUser->first_name ?? 'User') . ' ' . ($currentUser->last_name ?? ''));
    $initial = strtoupper(substr($currentUser->first_name ?? 'U', 0, 1));
    $avatarUrl = $currentUser->avatar;
    $hasAvatar = !is_null($avatarUrl);
@endphp
<!--end:profile-dropdown-container -->

<!-- begin:profile-dropdown-container -->
<div x-show="profileDropdownOpen" x-cloak @click.outside="profileDropdownOpen = false"
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
    class="absolute right-0 mt-2 w-72 bg-white dark:bg-gray-900 rounded-2xl shadow-dropdown border border-gray-200 dark:border-gray-700 overflow-hidden origin-top-right z-50">


    <!-- begin:dropdown-menu-items -->
    <div class="p-1.5 border-t border-gray-100 dark:border-gray-800">

        <!-- begin:profile-link -->
        <a href="{{ route('profile.edit') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white transition-all">
            <i class="fa-solid fa-user w-5 text-center text-gray-400"></i><span>My Profile</span>
        </a>
        <!-- end:profile-link -->

        <!-- begin:dropdown-divider -->
        <hr class="my-1 border-gray-100 dark:border-gray-800">
        <!-- end:dropdown-divider -->

        <!-- begin:logout-form -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <!-- begin:logout-button -->
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i><span>Logout</span>
            </button>
            <!-- end:logout-button -->
        </form>
        <!-- end:logout-form -->

    </div>
    <!-- end:dropdown-menu-items -->

</div>
<!-- end:profile-dropdown-container -->
