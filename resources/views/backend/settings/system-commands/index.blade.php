@extends('backend.master')

@section('title')
    {{ config('app.name') }} || System Commands
@endsection

@section('content')
    <div class="w-full space-y-6">
        <!--begin: Page Header-->
        <div class="page-header">
            <div class="page-title">
                <nav class="breadcrumb flex flex-wrap items-center gap-1.5 sm:gap-2 text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-2">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-link hover:text-primary-600 transition-colors">Dashboard</a>
                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                    <a href="{{ route('system-setting.index') }}" class="breadcrumb-link hover:text-primary-600 transition-colors">Settings</a>
                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                    <span class="breadcrumb-active font-semibold text-gray-800 dark:text-white">System Commands</span>
                </nav>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-white">
                            System Commands & Maintenance Console
                        </h1>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Execute automated Artisan utility tasks, optimize application cache, manage storage links, and maintain database infrastructure with real-time CLI output.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--end: Page Header-->

        <!--begin: Command Tags Card-->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-4 sm:p-6 border border-gray-200 dark:border-gray-800 shadow-sm">
            <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-gray-800">
                <div class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400 flex-shrink-0">
                    <i class="fa-solid fa-tags text-base"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-800 dark:text-white">System Utility Operations</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Select an optimization or maintenance task tag below to execute instantly.</p>
                </div>
            </div>

            <!-- Command Tags List (Responsive Grid) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4">
                @foreach ($commands as $cmdKey => $cmdInfo)
                    <form action="{{ route('system.commands.run') }}" method="POST" class="h-full">
                        @csrf
                        <input type="hidden" name="command" value="{{ $cmdKey }}">
                        <button type="button" onclick="confirmRun('{{ $cmdKey }}', this.form)"
                            class="w-full h-full p-3.5 sm:p-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950/40 hover:bg-white dark:hover:bg-gray-800/80 hover:border-primary-500/50 hover:shadow-md transition-all duration-200 text-left flex items-start justify-between gap-3 group">
                            
                            <div class="flex items-start gap-3 flex-1 min-w-0">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-primary-600 dark:text-primary-400 group-hover:scale-105 transition-transform flex-shrink-0">
                                    <i class="fa-solid {{ $cmdInfo['icon'] }} text-xs sm:text-sm"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-1.5 flex-wrap mb-1">
                                        <span class="font-mono font-bold text-xs text-gray-800 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors break-all">
                                            {{ $cmdInfo['display'] }}
                                        </span>
                                        @if(!empty($cmdInfo['requires_relogin']))
                                            <span class="px-1.5 py-0.5 text-[9px] font-bold rounded bg-rose-500 text-white whitespace-nowrap">Login Redirect</span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] text-gray-500 dark:text-gray-400 truncate">
                                        {{ $cmdInfo['title'] }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex-shrink-0 pt-0.5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-primary-50 dark:bg-primary-950/50 border border-primary-100 dark:border-primary-900/40 text-primary-600 dark:text-primary-400 group-hover:bg-primary-600 group-hover:border-primary-600 group-hover:text-white text-[11px] font-semibold transition-all shadow-sm">
                                    <span>Run</span>
                                    <i class="fa-solid fa-chevron-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                                </span>
                            </div>
                        </button>
                    </form>
                @endforeach
            </div>
        </div>
        <!--end: Command Tags Card-->

        <!--begin: Live Terminal Console Section-->
        @if (isset($lastRun))
            <div id="terminal-section" class="w-full">
                <div class="rounded-2xl overflow-hidden bg-slate-100 dark:bg-gray-950 border border-slate-300 dark:border-gray-800 shadow-xl dark:shadow-2xl font-mono text-xs text-slate-800 dark:text-gray-200">
                    <!-- Terminal Top Bar -->
                    <div class="bg-slate-200/90 dark:bg-gray-900/90 px-3.5 sm:px-4 py-2.5 sm:py-3 border-b border-slate-300 dark:border-gray-800 flex flex-wrap items-center justify-between gap-2">
                        <div class="flex items-center gap-2 min-w-0">
                            <div class="flex items-center gap-1.5 flex-shrink-0">
                                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-rose-500"></div>
                                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-amber-500"></div>
                                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-emerald-500"></div>
                            </div>
                            <span class="ml-1 sm:ml-2 text-slate-600 dark:text-gray-400 text-[10px] sm:text-[11px] truncate">
                                bash - {{ auth()->user()->first_name ?? 'artisan' }}@volgenteam ~ {{ $lastRun['command'] }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold {{ $lastRun['status'] === 'success' ? 'bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 border border-emerald-500/30' : 'bg-rose-500/20 text-rose-700 dark:text-rose-400 border border-rose-500/30' }}">
                                EXIT CODE {{ $lastRun['exit_code'] }}
                            </span>
                            <span class="text-slate-500 dark:text-gray-500 text-[10px] sm:text-[11px]">
                                <i class="fa-regular fa-clock mr-1"></i>{{ $lastRun['execution_time'] }}
                            </span>
                            <button type="button" onclick="document.getElementById('terminal-section').remove()"
                                class="text-slate-500 hover:text-slate-900 dark:text-gray-400 dark:hover:text-white transition-colors p-1"
                                aria-label="Close terminal">
                                <i class="fa-solid fa-xmark text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Terminal Output Window -->
                    <div class="p-4 sm:p-5 overflow-x-auto text-slate-800 dark:text-gray-200 leading-relaxed max-h-[350px] overflow-y-auto space-y-2">
                        <div class="flex items-center gap-2 text-emerald-700 dark:text-emerald-400 font-semibold flex-wrap">
                            <span>$</span>
                            <span class="break-all">{{ $lastRun['command'] }}</span>
                            <span class="text-slate-500 dark:text-gray-500 text-[10px]">[{{ $lastRun['executed_at'] }}]</span>
                        </div>
                        <div class="text-slate-700 dark:text-gray-300 whitespace-pre-wrap pl-3 border-l-2 border-primary-500/50 my-2 font-mono text-[11px] sm:text-xs leading-relaxed">{{ $lastRun['output'] }}</div>
                        <div class="text-emerald-700 dark:text-emerald-500 font-semibold flex items-center gap-1.5 pt-2 text-[11px] sm:text-xs">
                            <i class="fa-solid fa-check text-[10px]"></i>
                            <span>Process completed in {{ $lastRun['execution_time'] }}.</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!--end: Live Terminal Console Section-->
    </div>
@endsection

@push('scripts')
    <script>
        const commandsMap = @json($commands);

        function confirmRun(cmdKey, formElement) {
            const cmdInfo = commandsMap[cmdKey];
            if (!cmdInfo || !formElement) return;

            const textMsg = cmdInfo.requires_relogin
                ? `Running 'php artisan ${cmdInfo.display}' will drop all tables, re-run migrations, and seed fresh data. You will be logged out!`
                : `Are you sure you want to run 'php artisan ${cmdInfo.display}'?`;

            Swal.fire({
                title: 'Execute Command?',
                text: textMsg,
                icon: cmdInfo.danger ? 'warning' : 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, execute it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: cmdInfo.danger ? '#e11d48' : '#4f46e5',
                cancelButtonColor: '#6b7280',
            }).then((result) => {
                if (result.isConfirmed) {
                    formElement.submit();
                }
            });
        }
    </script>
@endpush
