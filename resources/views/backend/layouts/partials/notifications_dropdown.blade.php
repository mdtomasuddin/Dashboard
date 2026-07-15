<!--begin: Notifications Dropdown Container-->
<div x-show="notificationsOpen" x-cloak @click.outside="notificationsOpen = false"
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
    class="absolute right-0 mt-2 w-80 sm:w-96 bg-white dark:bg-gray-900 rounded-2xl shadow-dropdown border border-gray-200 dark:border-gray-700 overflow-hidden origin-top-right">
    <!--begin: Notifications Header-->
    <div class="p-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
        <h3 class="font-bold text-gray-800 dark:text-white">Notifications</h3>
        <button class="text-xs text-primary-600 hover:text-primary-700 font-medium">Mark all read</button>
    </div>
    <!--end: Notifications Header-->
    <!--begin: Notifications List-->
    <div class="max-h-80 overflow-y-auto">
        @php
            $notifications = [
                [
                    'icon' => 'fa-solid fa-cart-plus',
                    'color' => 'text-blue-500',
                    'bg' => 'bg-blue-100 dark:bg-blue-900/30',
                    'title' => 'New order received',
                    'desc' => 'Order #1234 from Sarah Johnson',
                    'time' => '2 min ago',
                    'unread' => true,
                ],
                [
                    'icon' => 'fa-solid fa-user-plus',
                    'color' => 'text-green-500',
                    'bg' => 'bg-green-100 dark:bg-green-900/30',
                    'title' => 'New user registered',
                    'desc' => 'John Doe created an account',
                    'time' => '15 min ago',
                    'unread' => true,
                ],
                [
                    'icon' => 'fa-solid fa-file-invoice',
                    'color' => 'text-purple-500',
                    'bg' => 'bg-purple-100 dark:bg-purple-900/30',
                    'title' => 'Invoice generated',
                    'desc' => 'Invoice #INV-2024-089',
                    'time' => '1 hour ago',
                    'unread' => true,
                ],
                [
                    'icon' => 'fa-solid fa-circle-check',
                    'color' => 'text-emerald-500',
                    'bg' => 'bg-emerald-100 dark:bg-emerald-900/30',
                    'title' => 'Payment successful',
                    'desc' => 'Payment of $299.00 received',
                    'time' => '2 hours ago',
                    'unread' => false,
                ],
                [
                    'icon' => 'fa-solid fa-exclamation-triangle',
                    'color' => 'text-amber-500',
                    'bg' => 'bg-amber-100 dark:bg-amber-900/30',
                    'title' => 'Low stock alert',
                    'desc' => 'Product "Summer Dress" is running low',
                    'time' => '3 hours ago',
                    'unread' => false,
                ],
                [
                    'icon' => 'fa-solid fa-star',
                    'color' => 'text-yellow-500',
                    'bg' => 'bg-yellow-100 dark:bg-yellow-900/30',
                    'title' => 'New review',
                    'desc' => '5-star review on your product',
                    'time' => '5 hours ago',
                    'unread' => false,
                ],
            ];
        @endphp
        @foreach ($notifications as $notif)
            <!--begin: Notification Item-->
            <div
                class="flex items-start gap-3 px-4 py-3 {{ $notif['unread'] ? 'bg-primary-50/50 dark:bg-primary-900/10' : '' }} hover:bg-gray-50 dark:hover:bg-gray-800/60 cursor-pointer transition-colors border-b border-gray-100 dark:border-gray-800 last:border-0">
                <!--begin: Notification Icon-->
                <div class="flex-shrink-0 w-9 h-9 rounded-xl {{ $notif['bg'] }} flex items-center justify-center">
                    <i class="{{ $notif['icon'] }} {{ $notif['color'] }} text-sm"></i>
                </div>
                <!--end: Notification Icon-->
                <!--begin: Notification Text-->
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ $notif['title'] }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $notif['desc'] }}</p>
                    <p class="text-[11px] text-gray-400 dark:text-gray-500 mt-1">{{ $notif['time'] }}</p>
                </div>
                <!--end: Notification Text-->
                @if ($notif['unread'])
                    <span class="flex-shrink-0 w-2 h-2 rounded-full bg-primary-500 mt-2"></span>
                @endif
            </div>
            <!--end: Notification Item-->
        @endforeach
    </div>
    <!--end: Notifications List-->
    <!--begin: Notifications Footer-->
    <div class="p-3 border-t border-gray-100 dark:border-gray-800 text-center">
        <a href="#" class="text-sm text-primary-600 hover:text-primary-700 font-medium">View all notifications</a>
    </div>
    <!--end: Notifications Footer-->
</div>
<!--end: Notifications Dropdown Container-->
