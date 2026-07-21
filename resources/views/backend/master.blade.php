<!DOCTYPE html>
<!--begin:html-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{
    sidebarOpen: true,
    sidebarHover: false,
    darkMode: localStorage.getItem('darkMode') === 'true' ? true : (localStorage.getItem('darkMode') === 'false' ? false : window.matchMedia('(prefers-color-scheme: dark)').matches),
    mobileSidebarOpen: false,
    profileDropdownOpen: false,
    notificationsOpen: false,
    searchOpen: false,
    init() {
        this.$watch('darkMode', val => {
            localStorage.setItem('darkMode', val);
            val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark');
        });
        if (this.darkMode) document.documentElement.classList.add('dark');
        if (window.innerWidth < 1024) this.sidebarOpen = false;
        window.addEventListener('resize', () => {
            window.innerWidth < 1024 ? this.sidebarOpen = false : this.sidebarOpen = true;
        });
    },
    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
        localStorage.setItem('sidebarCollapsed', !this.sidebarOpen);
    },
    toggleDarkMode() {
        this.darkMode = !this.darkMode;
        window.dispatchEvent(new CustomEvent('darkModeChange'));
    },
    isSidebarExpanded() {
        return this.sidebarOpen || this.sidebarHover;
    }
}" x-init="init()">


<!--begin::Head-->

<head>
    <!--begin::Dark Mode Script-->
    <script>
        (function() {
            var darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'true' || (darkMode === null && window.matchMedia('(prefers-color-scheme: dark)')
                    .matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    <!--end::Dark Mode Script-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @include('backend.layouts.partials.style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/backend.css') }}">
    @include('backend.layouts.partials.favicon')
</head>
<!--end::Head-->

<!--begin::Body-->

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 overflow-hidden">

    <!--begin::Mobile Sidebar Overlay-->
    <div x-show="mobileSidebarOpen" x-cloak x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="mobileSidebarOpen = false"
        class="sidebar-overlay fixed inset-0 z-40 bg-black/50 backdrop-blur-sm lg:hidden">
    </div>
    <!--end::Mobile Sidebar Overlay-->

    <!-- Sidebar -->
    @include('backend.layouts.partials.sidebar')

    <!-- Main Wrapper -->
    <div class="transition-all duration-300" x-cloak :class="isSidebarExpanded() ? 'lg:ml-[260px]' : 'lg:ml-[72px]'">

        <!-- Header -->
        @include('backend.layouts.partials.header')

        <!-- Main Content -->
        <main class="h-[calc(100vh-8rem)] overflow-y-auto p-4 lg:p-6">
            <!--begin::exam-->
            @yield('content')
            <!--end::exam-->
            <!-- Footer -->
            @include('backend.layouts.partials.footer')
        </main>
    </div>

    <!-- Scripts -->
    @include('backend.layouts.partials.scripts')
</body>
<!--end::Body-->

</html>
<!--end:html-->
