@extends('backend.master')

@section('title')
    {{ config('app.name') }} || Dashboard
@endsection

@section('content')
    <!--begin: Page Header Wrapper-->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <!--begin: Page Title Area-->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard</h2>
            <nav class="flex items-center gap-2 mt-1 text-sm text-gray-400 dark:text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Home</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-gray-600 dark:text-gray-300 font-medium">Dashboard</span>
            </nav>
        </div>
        <!--end: Page Title Area-->
        <!--begin: Page Actions-->
        <div class="flex items-center gap-2">
            <button onclick="window.location.reload()"
                class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-white transition-all shadow-sm">
                <i class="fa-solid fa-rotate"></i>
                <span class="hidden sm:inline">Refresh</span>
            </button>
            <button
                class="flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-xl text-sm font-medium transition-all shadow-lg shadow-primary-600/20">
                <i class="fa-solid fa-plus"></i>
                <span class="hidden sm:inline">New Report</span>
            </button>
        </div>
        <!--end: Page Actions-->
    </div>
    <!--end: Page Header Wrapper-->

    <!--begin: Stats Cards Grid-->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
        <!--begin: Revenue Card-->
        <div
            class="stat-card bg-white dark:bg-gray-900 rounded-2xl p-5 lg:p-6 border border-gray-100 dark:border-gray-800 shadow-card hover:shadow-card-hover cursor-pointer">
            <!--begin: Revenue Card Header-->
            <div class="flex items-center justify-between mb-4">
                <!--begin: Revenue Card Icon-->
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg shadow-green-500/20">
                    <i class="fa-solid fa-dollar-sign text-white text-xl"></i>
                </div>
                <!--end: Revenue Card Icon-->
                <span
                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                    <i class="fa-solid fa-arrow-up text-[10px]"></i> +12.5%
                </span>
            </div>
            <!--end: Revenue Card Header-->
            <h3 class="text-2xl lg:text-3xl font-extrabold text-gray-800 dark:text-white">$45,290</h3>
            <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Total Revenue</p>
            <!--begin: Revenue Progress Bar Wrapper-->
            <div class="mt-3 w-full h-1.5 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
                <!--begin: Revenue Progress Bar Fill-->
                <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500 rounded-full" style="width: 78%"></div>
                <!--end: Revenue Progress Bar Fill-->
            </div>
            <!--end: Revenue Progress Bar Wrapper-->
        </div>
        <!--end: Revenue Card-->

        <!--begin: Orders Card-->
        <div
            class="stat-card bg-white dark:bg-gray-900 rounded-2xl p-5 lg:p-6 border border-gray-100 dark:border-gray-800 shadow-card hover:shadow-card-hover cursor-pointer">
            <!--begin: Orders Card Header-->
            <div class="flex items-center justify-between mb-4">
                <!--begin: Orders Card Icon-->
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <i class="fa-solid fa-cart-shopping text-white text-xl"></i>
                </div>
                <!--end: Orders Card Icon-->
                <span
                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">
                    <i class="fa-solid fa-arrow-up text-[10px]"></i> +8.2%
                </span>
            </div>
            <!--end: Orders Card Header-->
            <h3 class="text-2xl lg:text-3xl font-extrabold text-gray-800 dark:text-white">1,284</h3>
            <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Total Orders</p>
            <!--begin: Orders Status Indicator-->
            <div class="mt-3 flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500">
                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                <span>1,240 completed</span>
            </div>
            <!--end: Orders Status Indicator-->
        </div>
        <!--end: Orders Card-->

        <!--begin: Customers Card-->
        <div
            class="stat-card bg-white dark:bg-gray-900 rounded-2xl p-5 lg:p-6 border border-gray-100 dark:border-gray-800 shadow-card hover:shadow-card-hover cursor-pointer">
            <!--begin: Customers Card Header-->
            <div class="flex items-center justify-between mb-4">
                <!--begin: Customers Card Icon-->
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-violet-600 flex items-center justify-center shadow-lg shadow-purple-500/20">
                    <i class="fa-solid fa-users text-white text-xl"></i>
                </div>
                <!--end: Customers Card Icon-->
                <span
                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400">
                    <i class="fa-solid fa-arrow-up text-[10px]"></i> +5.7%
                </span>
            </div>
            <!--end: Customers Card Header-->
            <h3 class="text-2xl lg:text-3xl font-extrabold text-gray-800 dark:text-white">3,845</h3>
            <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Total Customers</p>
            <!--begin: Customer Avatars-->
            <div class="mt-3 flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500">
                <!--begin: Avatar Stack-->
                <span class="flex -space-x-2">
                    <span
                        class="w-6 h-6 rounded-full bg-gray-300 dark:bg-gray-700 border-2 border-white dark:border-gray-900"></span>
                    <span
                        class="w-6 h-6 rounded-full bg-gray-400 dark:bg-gray-600 border-2 border-white dark:border-gray-900"></span>
                    <span
                        class="w-6 h-6 rounded-full bg-gray-500 dark:bg-gray-500 border-2 border-white dark:border-gray-900"></span>
                    <span
                        class="w-6 h-6 rounded-full bg-primary-500 border-2 border-white dark:border-gray-900 flex items-center justify-center text-[8px] text-white font-bold">+42</span>
                </span>
                <!--end: Avatar Stack-->
                <span>new today</span>
            </div>
            <!--end: Customer Avatars-->
        </div>
        <!--end: Customers Card-->

        <!--begin: Growth Card-->
        <div
            class="stat-card bg-white dark:bg-gray-900 rounded-2xl p-5 lg:p-6 border border-gray-100 dark:border-gray-800 shadow-card hover:shadow-card-hover cursor-pointer">
            <!--begin: Growth Card Header-->
            <div class="flex items-center justify-between mb-4">
                <!--begin: Growth Card Icon-->
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg shadow-amber-500/20">
                    <i class="fa-solid fa-chart-line text-white text-xl"></i>
                </div>
                <!--end: Growth Card Icon-->
                <span
                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400">
                    <i class="fa-solid fa-arrow-up text-[10px]"></i> +23.1%
                </span>
            </div>
            <!--end: Growth Card Header-->
            <h3 class="text-2xl lg:text-3xl font-extrabold text-gray-800 dark:text-white">89.4%</h3>
            <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Growth Rate</p>
            <!--begin: Mini Chart Bars-->
            <div class="mt-3 grid grid-cols-4 gap-1">
                <!--begin: Mini Bar 1-->
                <div class="h-8 rounded bg-gray-100 dark:bg-gray-800 overflow-hidden self-end" style="height: 24px">
                    <div class="h-full w-full bg-gradient-to-t from-primary-500 to-primary-400 rounded" style="height: 60%">
                    </div>
                </div>
                <!--end: Mini Bar 1-->
                <!--begin: Mini Bar 2-->
                <div class="h-8 rounded bg-gray-100 dark:bg-gray-800 overflow-hidden self-end" style="height: 24px">
                    <div class="h-full w-full bg-gradient-to-t from-primary-500 to-primary-400 rounded" style="height: 75%">
                    </div>
                </div>
                <!--end: Mini Bar 2-->
                <!--begin: Mini Bar 3-->
                <div class="h-8 rounded bg-gray-100 dark:bg-gray-800 overflow-hidden self-end" style="height: 24px">
                    <div class="h-full w-full bg-gradient-to-t from-primary-500 to-primary-400 rounded" style="height: 45%">
                    </div>
                </div>
                <!--end: Mini Bar 3-->
                <!--begin: Mini Bar 4-->
                <div class="h-8 rounded bg-gray-100 dark:bg-gray-800 overflow-hidden self-end" style="height: 24px">
                    <div class="h-full w-full bg-gradient-to-t from-primary-500 to-primary-400 rounded" style="height: 90%">
                    </div>
                </div>
                <!--end: Mini Bar 4-->
            </div>
            <!--end: Mini Chart Bars-->
        </div>
        <!--end: Growth Card-->
    </div>
    <!--end: Stats Cards Grid-->

    <!--begin: Charts Row Grid-->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 mb-6">
        <!--begin: Revenue Chart Card-->
        <div
            class="bg-white dark:bg-gray-900 rounded-2xl p-5 lg:p-6 border border-gray-100 dark:border-gray-800 shadow-card">
            <!--begin: Revenue Chart Header-->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                <!--begin: Revenue Chart Title-->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Revenue Overview</h3>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Monthly revenue for the current year</p>
                </div>
                <!--end: Revenue Chart Title-->
                <!--begin: Revenue Chart Filter-->
                <div class="flex items-center gap-2">
                    <select
                        class="text-xs bg-gray-100 dark:bg-gray-800 border-0 rounded-lg px-3 py-2 text-gray-600 dark:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30">
                        <option>This Year</option>
                        <option>Last Year</option>
                        <option>All Time</option>
                    </select>
                </div>
                <!--end: Revenue Chart Filter-->
            </div>
            <!--end: Revenue Chart Header-->
            <!--begin: Revenue Chart Container-->
            <div class="relative" style="height: 280px;">
                <canvas id="revenueChart"></canvas>
            </div>
            <!--end: Revenue Chart Container-->
        </div>
        <!--end: Revenue Chart Card-->

        <!--begin: Sales Chart Card-->
        <div
            class="bg-white dark:bg-gray-900 rounded-2xl p-5 lg:p-6 border border-gray-100 dark:border-gray-800 shadow-card">
            <!--begin: Sales Chart Header-->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                <!--begin: Sales Chart Title-->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Sales Analytics</h3>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Weekly sales performance</p>
                </div>
                <!--end: Sales Chart Title-->
                <!--begin: Sales Chart Legend-->
                <div class="flex items-center gap-2">
                    <span class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-primary-500"></span> Sales
                    </span>
                    <span class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Revenue
                    </span>
                </div>
                <!--end: Sales Chart Legend-->
            </div>
            <!--end: Sales Chart Header-->
            <!--begin: Sales Chart Container-->
            <div class="relative" style="height: 280px;">
                <canvas id="salesChart"></canvas>
            </div>
            <!--end: Sales Chart Container-->
        </div>
        <!--end: Sales Chart Card-->
    </div>
    <!--end: Charts Row Grid-->

    <!--begin: User Growth & Top Products Grid-->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6 mb-6">
        <!--begin: User Growth Card-->
        <div
            class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-2xl p-5 lg:p-6 border border-gray-100 dark:border-gray-800 shadow-card">
            <!--begin: User Growth Header-->
            <div class="flex items-center justify-between mb-4">
                <!--begin: User Growth Title-->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">User Growth</h3>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">New users over time</p>
                </div>
                <!--end: User Growth Title-->
                <!--begin: User Growth Tabs-->
                <div class="flex items-center gap-1 bg-gray-100 dark:bg-gray-800 rounded-lg p-0.5">
                    <button
                        class="px-3 py-1.5 text-xs font-medium rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white shadow-sm">Weekly</button>
                    <button
                        class="px-3 py-1.5 text-xs font-medium rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white">Monthly</button>
                    <button
                        class="px-3 py-1.5 text-xs font-medium rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white">Yearly</button>
                </div>
                <!--end: User Growth Tabs-->
            </div>
            <!--end: User Growth Header-->
            <!--begin: User Growth Chart Container-->
            <div class="relative" style="height: 250px;">
                <canvas id="userGrowthChart"></canvas>
            </div>
            <!--end: User Growth Chart Container-->
        </div>
        <!--end: User Growth Card-->

        <!--begin: Top Products Card-->
        <div
            class="bg-white dark:bg-gray-900 rounded-2xl p-5 lg:p-6 border border-gray-100 dark:border-gray-800 shadow-card">
            <!--begin: Top Products Header-->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">Top Products</h3>
                <a href="#" class="text-xs text-primary-600 hover:text-primary-700 font-medium">View All</a>
            </div>
            <!--end: Top Products Header-->
            <!--begin: Top Products List-->
            <div class="space-y-4">
                @php
                    $products = [
                        [
                            'name' => 'Summer Collection Dress',
                            'sales' => 384,
                            'revenue' => '$12,480',
                            'color' => 'from-primary-500 to-primary-600',
                        ],
                        [
                            'name' => 'Designer Handbag',
                            'sales' => 256,
                            'revenue' => '$8,960',
                            'color' => 'from-blue-500 to-indigo-600',
                        ],
                        [
                            'name' => 'Premium Sneakers',
                            'sales' => 198,
                            'revenue' => '$6,930',
                            'color' => 'from-purple-500 to-violet-600',
                        ],
                        [
                            'name' => 'Classic Watch',
                            'sales' => 147,
                            'revenue' => '$5,145',
                            'color' => 'from-emerald-500 to-green-600',
                        ],
                        [
                            'name' => 'Leather Jacket',
                            'sales' => 112,
                            'revenue' => '$4,480',
                            'color' => 'from-amber-500 to-orange-600',
                        ],
                    ];
                @endphp
                @foreach ($products as $index => $product)
                    <!--begin: Product Item {{ $index + 1 }}-->
                    <div class="flex items-center gap-3">
                        <!--begin: Product Rank Badge-->
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-br {{ $product['color'] }} flex items-center justify-center text-white text-sm font-bold shadow-md">
                            {{ $index + 1 }}</div>
                        <!--end: Product Rank Badge-->
                        <!--begin: Product Info-->
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 dark:text-white truncate">{{ $product['name'] }}
                            </p>
                            <!--begin: Product Stats-->
                            <div class="flex items-center gap-3 mt-1">
                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ $product['sales'] }} sales</p>
                                <p class="text-xs font-semibold text-gray-600 dark:text-gray-300">{{ $product['revenue'] }}
                                </p>
                            </div>
                            <!--end: Product Stats-->
                            <!--begin: Product Progress Bar-->
                            <div class="mt-1.5 w-full h-1.5 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r {{ $product['color'] }}"
                                    style="width: {{ 100 - $index * 15 }}%"></div>
                            </div>
                            <!--end: Product Progress Bar-->
                        </div>
                        <!--end: Product Info-->
                    </div>
                    <!--end: Product Item {{ $index + 1 }}-->
                @endforeach
            </div>
            <!--end: Top Products List-->
        </div>
        <!--end: Top Products Card-->
    </div>
    <!--end: User Growth & Top Products Grid-->

    <!--begin: Activities & Orders Grid-->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6 mb-6">
        <!--begin: Latest Activities Card-->
        <div
            class="bg-white dark:bg-gray-900 rounded-2xl p-5 lg:p-6 border border-gray-100 dark:border-gray-800 shadow-card">
            <!--begin: Activities Header-->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">Latest Activities</h3>
                <a href="#" class="text-xs text-primary-600 hover:text-primary-700 font-medium">View All</a>
            </div>
            <!--end: Activities Header-->
            <!--begin: Activities Content-->
            <div class="space-y-0">
                @php
                    $activities = [
                        [
                            'icon' => 'fa-solid fa-cart-plus',
                            'color' => 'text-blue-500',
                            'bg' => 'bg-blue-100 dark:bg-blue-900/30',
                            'text' => 'New order placed #1234',
                            'time' => '2 min ago',
                        ],
                        [
                            'icon' => 'fa-solid fa-user-plus',
                            'color' => 'text-green-500',
                            'bg' => 'bg-green-100 dark:bg-green-900/30',
                            'text' => 'New user registered',
                            'time' => '15 min ago',
                        ],
                        [
                            'icon' => 'fa-solid fa-file-invoice',
                            'color' => 'text-purple-500',
                            'bg' => 'bg-purple-100 dark:bg-purple-900/30',
                            'text' => 'Invoice generated',
                            'time' => '1 hour ago',
                        ],
                        [
                            'icon' => 'fa-solid fa-circle-check',
                            'color' => 'text-emerald-500',
                            'bg' => 'bg-emerald-100 dark:bg-emerald-900/30',
                            'text' => 'Payment received $299',
                            'time' => '2 hours ago',
                        ],
                        [
                            'icon' => 'fa-solid fa-star',
                            'color' => 'text-yellow-500',
                            'bg' => 'bg-yellow-100 dark:bg-yellow-900/30',
                            'text' => '5-star review received',
                            'time' => '3 hours ago',
                        ],
                        [
                            'icon' => 'fa-solid fa-truck',
                            'color' => 'text-cyan-500',
                            'bg' => 'bg-cyan-100 dark:bg-cyan-900/30',
                            'text' => 'Order #1230 shipped',
                            'time' => '4 hours ago',
                        ],
                    ];
                @endphp
                <!--begin: Activities Timeline-->
                <div class="relative">
                    <!--begin: Timeline Line-->
                    <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-100 dark:bg-gray-800"></div>
                    <!--end: Timeline Line-->
                    @foreach ($activities as $activity)
                        <!--begin: Activity Item-->
                        <div class="relative flex items-start gap-3 py-3">
                            <!--begin: Activity Icon-->
                            <div
                                class="flex-shrink-0 w-10 h-10 rounded-xl {{ $activity['bg'] }} flex items-center justify-center z-10">
                                <i class="{{ $activity['icon'] }} {{ $activity['color'] }} text-sm"></i>
                            </div>
                            <!--end: Activity Icon-->
                            <!--begin: Activity Text-->
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $activity['text'] }}
                                </p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">{{ $activity['time'] }}</p>
                            </div>
                            <!--end: Activity Text-->
                        </div>
                        <!--end: Activity Item-->
                    @endforeach
                </div>
                <!--end: Activities Timeline-->
            </div>
            <!--end: Activities Content-->
        </div>
        <!--end: Latest Activities Card-->

        <!--begin: Recent Orders Card-->
        <div
            class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-2xl p-5 lg:p-6 border border-gray-100 dark:border-gray-800 shadow-card">
            <!--begin: Orders Header-->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">Recent Orders</h3>
                <!--begin: Orders Search-->
                <div class="flex items-center gap-2">
                    <!--begin: Search Input Wrapper-->
                    <div class="relative">
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                        <input type="text" placeholder="Search orders..."
                            class="w-40 lg:w-48 h-9 pl-8 pr-3 bg-gray-100 dark:bg-gray-800 border-0 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-primary-500/30">
                    </div>
                    <!--end: Search Input Wrapper-->
                </div>
                <!--end: Orders Search-->
            </div>
            <!--end: Orders Header-->
            <!--begin: Table Wrapper-->
            <div class="overflow-x-auto -mx-5 lg:-mx-6">
                <!--begin: Table Container-->
                <div class="inline-block min-w-full align-middle px-5 lg:px-6">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-800">
                        <thead>
                            <tr>
                                <th
                                    class="text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider pb-3 pr-4">
                                    Order</th>
                                <th
                                    class="text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider pb-3 pr-4">
                                    Customer</th>
                                <th
                                    class="text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider pb-3 pr-4 hidden sm:table-cell">
                                    Product</th>
                                <th
                                    class="text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider pb-3 pr-4">
                                    Amount</th>
                                <th
                                    class="text-left text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider pb-3">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @php
                                $orders = [
                                    [
                                        'id' => '#ORD-1234',
                                        'customer' => 'Sarah Johnson',
                                        'product' => 'Summer Dress',
                                        'amount' => '$129.00',
                                        'status' => 'Completed',
                                        'color' => 'green',
                                    ],
                                    [
                                        'id' => '#ORD-1233',
                                        'customer' => 'Michael Chen',
                                        'product' => 'Designer Bag',
                                        'amount' => '$450.00',
                                        'status' => 'Processing',
                                        'color' => 'blue',
                                    ],
                                    [
                                        'id' => '#ORD-1232',
                                        'customer' => 'Emily Davis',
                                        'product' => 'Sneakers',
                                        'amount' => '$89.00',
                                        'status' => 'Pending',
                                        'color' => 'amber',
                                    ],
                                    [
                                        'id' => '#ORD-1231',
                                        'customer' => 'James Wilson',
                                        'product' => 'Leather Jacket',
                                        'amount' => '$299.00',
                                        'status' => 'Completed',
                                        'color' => 'green',
                                    ],
                                    [
                                        'id' => '#ORD-1230',
                                        'customer' => 'Lisa Anderson',
                                        'product' => 'Classic Watch',
                                        'amount' => '$199.00',
                                        'status' => 'Cancelled',
                                        'color' => 'red',
                                    ],
                                ];
                                $statusColors = [
                                    'green' => 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400',
                                    'blue' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
                                    'amber' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400',
                                    'red' => 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400',
                                ];
                                $statusDots = [
                                    'green' => 'bg-green-500',
                                    'blue' => 'bg-blue-500',
                                    'amber' => 'bg-amber-500',
                                    'red' => 'bg-red-500',
                                ];
                            @endphp
                            @foreach ($orders as $order)
                                <tr class="table-row-hover transition-colors">
                                    <td class="py-3.5 pr-4"><span
                                            class="text-sm font-semibold text-gray-800 dark:text-white">{{ $order['id'] }}</span>
                                    </td>
                                    <td class="py-3.5 pr-4">
                                        <!--begin: Customer Info-->
                                        <div class="flex items-center gap-2.5">
                                            <div
                                                class="w-7 h-7 rounded-full bg-gradient-to-br from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center text-white text-[10px] font-bold">
                                                {{ substr($order['customer'], 0, 1) }}</div>
                                            <span
                                                class="text-sm text-gray-600 dark:text-gray-400">{{ $order['customer'] }}</span>
                                        </div>
                                        <!--end: Customer Info-->
                                    </td>
                                    <td class="py-3.5 pr-4 hidden sm:table-cell"><span
                                            class="text-sm text-gray-600 dark:text-gray-400">{{ $order['product'] }}</span>
                                    </td>
                                    <td class="py-3.5 pr-4"><span
                                            class="text-sm font-semibold text-gray-800 dark:text-white">{{ $order['amount'] }}</span>
                                    </td>
                                    <td class="py-3.5">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColors[$order['color']] }}">
                                            <span
                                                class="w-1.5 h-1.5 rounded-full {{ $statusDots[$order['color']] }}"></span>
                                            {{ $order['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end: Table Container-->
            </div>
            <!--end: Table Wrapper-->
            <!--begin: Pagination Wrapper-->
            <div
                class="flex flex-col sm:flex-row items-center justify-between gap-3 mt-4 pt-4 border-t border-gray-100 dark:border-gray-800">
                <p class="text-xs text-gray-400 dark:text-gray-500">Showing 1 to 5 of 125 orders</p>
                <!--begin: Pagination Buttons-->
                <div class="flex items-center gap-1">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-xs text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all"><i
                            class="fa-solid fa-chevron-left"></i></button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-medium bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400">1</button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-xs text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">2</button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-xs text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">3</button>
                    <span class="text-xs text-gray-400 dark:text-gray-500 px-1">...</span>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-xs text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">12</button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-xs text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all"><i
                            class="fa-solid fa-chevron-right"></i></button>
                </div>
                <!--end: Pagination Buttons-->
            </div>
            <!--end: Pagination Wrapper-->
        </div>
        <!--end: Recent Orders Card-->
    </div>
    <!--end: Activities & Orders Grid-->
    <!-- begin:Chart Scripts -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const isDark = document.documentElement.classList.contains('dark');
                const textColor = isDark ? '#94a3b8' : '#64748b';
                const gridColor = isDark ? '#1e293b' : '#f1f5f9';
                const borderColor = isDark ? '#334155' : '#e2e8f0';

                function getCtx(id) {
                    const c = document.getElementById(id);
                    return c ? c.getContext('2d') : null;
                }

                const revCtx = getCtx('revenueChart');
                if (revCtx) {
                    new Chart(revCtx, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                                'Nov', 'Dec'
                            ],
                            datasets: [{
                                label: 'Revenue',
                                data: [18500, 22500, 19800, 26500, 24200, 28900, 31200, 29800, 34500,
                                    38200, 41200, 45290
                                ],
                                borderColor: '#f97316',
                                backgroundColor: ctx => {
                                    const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 250);
                                    g.addColorStop(0, 'rgba(249,115,22,0.2)');
                                    g.addColorStop(1, 'rgba(249,115,22,0)');
                                    return g;
                                },
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#f97316',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                borderWidth: 3,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: isDark ? '#1e293b' : '#fff',
                                    titleColor: isDark ? '#f1f5f9' : '#1e293b',
                                    bodyColor: textColor,
                                    borderColor,
                                    borderWidth: 1,
                                    padding: 12,
                                    cornerRadius: 12,
                                    displayColors: false,
                                    callbacks: {
                                        label: ctx => '$' + ctx.parsed.y.toLocaleString()
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        color: gridColor,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: textColor,
                                        font: {
                                            size: 11
                                        }
                                    }
                                },
                                y: {
                                    grid: {
                                        color: gridColor,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: textColor,
                                        font: {
                                            size: 11
                                        },
                                        callback: v => '$' + (v / 1000) + 'k'
                                    }
                                }
                            }
                        }
                    });
                }
                const salesCtx = getCtx('salesChart');
                if (salesCtx) {
                    new Chart(salesCtx, {
                        type: 'bar',
                        data: {
                            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                            datasets: [{
                                    label: 'Sales',
                                    data: [42, 58, 45, 72, 68, 95, 82],
                                    backgroundColor: '#f97316',
                                    borderRadius: 6,
                                    borderSkipped: false
                                },
                                {
                                    label: 'Revenue',
                                    data: [3800, 5200, 4100, 6800, 6200, 8900, 7600],
                                    backgroundColor: '#3b82f6',
                                    borderRadius: 6,
                                    borderSkipped: false
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: isDark ? '#1e293b' : '#fff',
                                    titleColor: isDark ? '#f1f5f9' : '#1e293b',
                                    bodyColor: textColor,
                                    borderColor,
                                    borderWidth: 1,
                                    padding: 12,
                                    cornerRadius: 12
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        color: textColor,
                                        font: {
                                            size: 11
                                        }
                                    }
                                },
                                y: {
                                    grid: {
                                        color: gridColor,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: textColor,
                                        font: {
                                            size: 11
                                        },
                                        callback: v => v >= 1000 ? '$' + (v / 1000) + 'k' : v
                                    }
                                }
                            }
                        }
                    });
                }
                const growthCtx = getCtx('userGrowthChart');
                if (growthCtx) {
                    new Chart(growthCtx, {
                        type: 'line',
                        data: {
                            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7',
                                'Week 8'
                            ],
                            datasets: [{
                                label: 'New Users',
                                data: [120, 185, 145, 220, 198, 275, 240, 312],
                                borderColor: '#8b5cf6',
                                backgroundColor: ctx => {
                                    const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 200);
                                    g.addColorStop(0, 'rgba(139,92,246,0.2)');
                                    g.addColorStop(1, 'rgba(139,92,246,0)');
                                    return g;
                                },
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#8b5cf6',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                borderWidth: 3,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: isDark ? '#1e293b' : '#fff',
                                    titleColor: isDark ? '#f1f5f9' : '#1e293b',
                                    bodyColor: textColor,
                                    borderColor,
                                    borderWidth: 1,
                                    padding: 12,
                                    cornerRadius: 12,
                                    displayColors: false
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        color: textColor,
                                        font: {
                                            size: 11
                                        }
                                    }
                                },
                                y: {
                                    grid: {
                                        color: gridColor,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: textColor,
                                        font: {
                                            size: 11
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
                document.addEventListener('darkModeChange', () => location.reload());
            });
        </script>
    @endpush
@endsection
