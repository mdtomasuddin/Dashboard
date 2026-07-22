<!--begin::Sidebar-->
<aside role="navigation" aria-label="Main navigation" x-cloak
    class="fixed top-0 left-0 z-50 h-full flex flex-col bg-white dark:bg-sidebar-dark border-r border-gray-200 dark:border-gray-800 sidebar-transition shadow-lg"
    :class="{
        'w-[260px]': isSidebarExpanded(),
        'w-[72px]': !isSidebarExpanded(),
        'translate-x-0': mobileSidebarOpen,
        '-translate-x-full lg:translate-x-0': !mobileSidebarOpen
    }"
    @mouseenter="sidebarHover = true" @mouseleave="sidebarHover = false">

    <!--begin::BrandLogo-->
    <div class="flex-shrink-0 flex items-center h-16 px-4 border-b border-gray-200 dark:border-gray-800"
        :class="isSidebarExpanded() ? 'justify-between' : 'justify-center'">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 overflow-hidden">
            <div
                class="flex-shrink-0 w-9 h-9 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center shadow-lg shadow-primary-500/20">
                <span class="text-white font-extrabold text-sm">TF</span>
            </div>
            <div x-show="isSidebarExpanded()" x-cloak x-transition.opacity class="whitespace-nowrap">
                <span class="text-sm font-bold text-gray-800 dark:text-white">Tabassum</span>
                <span class="text-sm font-bold text-primary-600">Fashion</span>
            </div>
        </a>
        <button @click="mobileSidebarOpen = false"
            class="lg:hidden text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-1">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
    </div>
    <!--end::BrandLogo-->

    <!--begin::SidebarNav-->
    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-2 px-3" id="sidebar-menu">
        <ul class="flex flex-col" id="sideNavbar">

            <!--begin::OverviewHeading-->
            <li class="nav-item">
                <div
                    class="navbar-heading px-3 pt-4 pb-1.5 text-[10px] font-semibold uppercase tracking-widest text-gray-400 dark:text-gray-500">
                    Overview</div>
            </li>
            <!--end::OverviewHeading-->

            <!--begin::DashboardLink-->
            <li class="nav-item">
                <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-chart-pie nav-icon"></i>Dashboard
                </a>
            </li>
            <!--end::DashboardLink-->

            <!--begin::UserManagementHeading-->
            <li class="nav-item">
                <div
                    class="navbar-heading px-3 pt-4 pb-1.5 text-[10px] font-semibold uppercase tracking-widest text-gray-400 dark:text-gray-500">
                    User Management</div>
            </li>
            <!--end::UserManagementHeading-->

            @php
                $usersOpen = request()->routeIs('users.*');
            @endphp
            <!--begin::UsersDropdown-->
            <li class="nav-item" x-data="{ open: {{ $usersOpen ? 'true' : 'false' }} }">
                <button @click="open = !open" class="nav-link nav-toggle w-full text-left"
                    :class="open ? 'active' : ''">
                    <i class="fa-solid fa-users nav-icon"></i>
                    <span class="flex-1 text-left">Users</span>
                    <i class="fa-solid fa-chevron-down nav-arrow" :class="open ? 'rotated' : ''"></i>
                </button>
                <!--begin::UsersSubmenu-->
                <div x-show="open" x-collapse.duration.200ms class="nav-submenu">
                    <ul class="flex flex-col">
                        <li class="nav-item">
                            <a class="nav-link nav-sub-link {{ request()->routeIs('users.index') ? 'active' : '' }}"
                                href="{{ route('users.index') }}"><i class="fa-solid fa-list sub-icon"></i>All Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-sub-link {{ request()->routeIs('users.create') ? 'active' : '' }}"
                                href="{{ route('users.create') }}"><i class="fa-solid fa-user-plus sub-icon"></i>Add
                                New</a>
                        </li>
                    </ul>
                </div>
                <!--end::UsersSubmenu-->
            </li>
            <!--end::UsersDropdown-->


            <!--begin::SystemSettingsHeading-->
            <li class="nav-item">
                <div
                    class="navbar-heading px-3 pt-4 pb-1.5 text-[10px] font-semibold uppercase tracking-widest text-gray-400 dark:text-gray-500">
                    System Settings</div>
            </li>
            <!--end::SystemSettingsHeading-->

            @php
                $settingsOpen =
                    request()->routeIs('mail-setting.*') ||
                    request()->routeIs('database.export') ||
                    request()->routeIs('social-links.*') ||
                    request()->routeIs('integration.setting') ||
                    request()->routeIs('*.update');
            @endphp
            <!--begin::SettingsDropdown-->
            <li class="nav-item" x-data="{ open: {{ $settingsOpen ? 'true' : 'false' }} }">
                <button @click="open = !open" class="nav-link nav-toggle w-full text-left"
                    :class="open ? 'active' : ''">
                    <i class="fa-solid fa-gear nav-icon"></i>
                    <span class="flex-1 text-left">Settings</span>
                    <i class="fa-solid fa-chevron-down nav-arrow" :class="open ? 'rotated' : ''"></i>
                </button>
                <!--begin::SettingsSubmenu-->
                <div x-show="open" x-collapse.duration.200ms class="nav-submenu">
                    <ul class="flex flex-col">
                        <li class="nav-item">
                            <a class="nav-link nav-sub-link {{ Route::is('mail-setting.*') ? 'active' : '' }}"
                                href="{{ route('mail-setting.index') }}">
                                <i class="fa-solid fa-envelope sub-icon"></i>Mail Configuration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-sub-link {{ request()->routeIs('database.export') ? 'active' : '' }}"
                                href="{{ route('database.export') }}">
                                <i class="fa-solid fa-database sub-icon"></i>Database Backup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-sub-link {{ request()->routeIs('social-links.*') ? 'active' : '' }}"
                                href="{{ route('social-links.index') }}">
                                <i class="fa-solid fa-link sub-icon"></i>Social Links</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-sub-link {{ request()->routeIs('integration.setting') ? 'active' : '' }}"
                                href="{{ route('integration.setting') }}">
                                <i class="fa-solid fa-plug sub-icon"></i>Integrations</a>
                        </li>
                    </ul>
                </div>
                <!--end::SettingsSubmenu-->
            </li>
            <!--end::SettingsDropdown-->
        </ul>
    </nav>
    <!--end::SidebarNav-->
</aside>
<!--end::Sidebar-->
