@extends('backend.master')

@section('title')
    {{ config('app.name') }} || Database Backup
@endsection

@section('content')
    <!--begin: Page Header-->
    <div class="page-header">
        <!--begin: Page Title-->
        <div class="page-title">
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <a href="{{ route('database.export') }}" class="breadcrumb-link">Settings</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <span class="breadcrumb-active">Database Backup</span>
            </nav>
            <p class="page-description">
                Create a complete backup of your database. The exported SQL file contains all tables, structure, and data
                for safekeeping or migration.
            </p>
        </div>
        <!--end: Page Title-->
    </div>
    <!--end: Page Header-->

    <!--begin: Database Info Card-->
    <div class="card mb-5">
        <!--begin: Card Header-->
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
            <div
                class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-database text-blue-600 dark:text-blue-400"></i>
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-800 dark:text-white">Database Information</h3>
                <p class="text-sm text-gray-400 dark:text-gray-500">Current database connection details</p>
            </div>
        </div>
        <!--end: Card Header-->

        <!--begin: DB Info Grid-->
        <div class="grid grid-cols-12 gap-4">
            <!--begin: DB Name-->
            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-4 border border-gray-100 dark:border-gray-800">
                    <div
                        class="flex items-center gap-2 text-gray-400 dark:text-gray-500 text-xs font-medium uppercase tracking-wider mb-1">
                        <i class="fa-solid fa-server"></i>
                        <span>Database Name</span>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 dark:text-white truncate">
                        {{ config('database.connections.mysql.database') }}
                    </p>
                </div>
            </div>
            <!--end: DB Name-->

            <!--begin: Host-->
            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-4 border border-gray-100 dark:border-gray-800">
                    <div
                        class="flex items-center gap-2 text-gray-400 dark:text-gray-500 text-xs font-medium uppercase tracking-wider mb-1">
                        <i class="fa-solid fa-network-wired"></i>
                        <span>Host</span>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 dark:text-white">
                        {{ config('database.connections.mysql.host') }}:{{ config('database.connections.mysql.port') }}
                    </p>
                </div>
            </div>
            <!--end: Host-->

            <!--begin: Engine-->
            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-4 border border-gray-100 dark:border-gray-800">
                    <div
                        class="flex items-center gap-2 text-gray-400 dark:text-gray-500 text-xs font-medium uppercase tracking-wider mb-1">
                        <i class="fa-solid fa-gear"></i>
                        <span>Engine</span>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 dark:text-white capitalize">
                        {{ config('database.connections.mysql.driver') }}
                    </p>
                </div>
            </div>
            <!--end: Engine-->

            <!--begin: Charset-->
            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-4 border border-gray-100 dark:border-gray-800">
                    <div
                        class="flex items-center gap-2 text-gray-400 dark:text-gray-500 text-xs font-medium uppercase tracking-wider mb-1">
                        <i class="fa-solid fa-font"></i>
                        <span>Charset</span>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 dark:text-white">
                        {{ config('database.connections.mysql.charset') ?? 'utf8mb4' }}
                    </p>
                </div>
            </div>
            <!--end: Charset-->
        </div>
        <!--end: DB Info Grid-->
    </div>
    <!--end: Database Info Card-->

    <!--begin: Export Card-->
    <div class="card">
        <!--begin: Card Header-->
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
            <div
                class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-download text-green-600 dark:text-green-400"></i>
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-800 dark:text-white">Export Database</h3>
                <p class="text-sm text-gray-400 dark:text-gray-500">Download a complete SQL backup of your database</p>
            </div>
        </div>
        <!--end: Card Header-->

        <div class="space-y-5">
            <!--begin: Export Info-->
            <div
                class="flex flex-col sm:flex-row items-start gap-4 p-4 bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-900/30 rounded-xl">
                <div
                    class="flex-shrink-0 w-9 h-9 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                    <i class="fa-solid fa-circle-info text-amber-600 dark:text-amber-400 text-sm"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-amber-800 dark:text-amber-300">Before You Export</p>
                    <p class="text-xs text-amber-600 dark:text-amber-400 mt-0.5">
                        The export may take a few moments depending on your database size.
                        A <code class="px-1 py-0.5 bg-amber-100 dark:bg-amber-900/40 rounded text-[11px]">.sql</code> file
                        will be downloaded automatically once ready.
                        Large databases may take longer to generate.
                    </p>
                </div>
            </div>
            <!--end: Export Info-->

            <!--begin: Export Details-->
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 md:col-span-4">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800/50 rounded-xl">
                        <i class="fa-solid fa-table text-gray-400 text-lg"></i>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Format</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">SQL Dump</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-4">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800/50 rounded-xl">
                        <i class="fa-solid fa-layer-group text-gray-400 text-lg"></i>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Includes</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">All Tables + Data</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-4">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800/50 rounded-xl">
                        <i class="fa-solid fa-clock text-gray-400 text-lg"></i>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Generated</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">On Demand</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Export Details-->

            <!--begin: Download Button-->
            <div class="flex flex-col sm:flex-row items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ url('database/export/download') }}" id="backup-btn" onclick="handleBackup(event)"
                    class="inline-flex items-center gap-3 px-8 py-3.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-xl text-sm font-semibold transition-all shadow-lg shadow-green-600/20 hover:shadow-green-600/30 active:scale-[0.98]">
                    <i id="backup-icon" class="fa-solid fa-download text-base"></i>
                    <span id="backup-text">Download Backup</span>
                    <span class="px-2 py-0.5 bg-white/20 rounded-lg text-[10px] font-medium">.sql</span>
                </a>
                <p class="text-xs text-gray-400 dark:text-gray-500">
                    <i class="fa-solid fa-shield-halved mr-1"></i>
                    Your data is exported securely via server-side processing
                </p>
            </div>
            <!--end: Download Button-->
        </div>
    </div>
    <!--end: Export Card-->

    @push('scripts')
        <script>
            function handleBackup(e) {
                const icon = document.getElementById('backup-icon');
                const text = document.getElementById('backup-text');

                // Show loading spinner
                icon.className = 'fa-solid fa-circle-notch fa-spin text-base';
                text.textContent = 'Generating Backup...';

                // Prevent double clicks
                const btn = document.getElementById('backup-btn');
                btn.style.pointerEvents = 'none';
                btn.classList.add('opacity-80');
            }
        </script>
    @endpush
@endsection
