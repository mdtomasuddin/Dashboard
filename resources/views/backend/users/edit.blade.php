@extends('backend.master')

@section('title')
    {{ config('app.name') }} || Edit User
@endsection

@section('content')
    <!--begin: Page Header Wrapper-->
    <div class="w-11/12 mx-auto flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <!--begin: Page Title Area-->
        <div>
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-gray-400 dark:text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Dashboard</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <a href="{{ route('users.index') }}" class="hover:text-primary-600 transition-colors">Users</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-gray-600 dark:text-gray-300 font-medium">Edit</span>
            </nav>
            <!-- Page Description (Optional) -->
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-2">
                Update the information and settings for this user.
            </p>
        </div>
        <!--end: Page Title Area-->
        <!--begin: Page Actions-->
        <div class="flex items-center gap-2">
            <a href="{{ route('users.index') }}"
                class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to Users</span>
            </a>
        </div>
        <!--end: Page Actions-->
    </div>
    <!--end: Page Header Wrapper-->

    <!--begin: Edit User Form Card-->
    <div
        class="w-11/12 mx-auto bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-card">

        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
            class="p-5 lg:p-6">
            @csrf
            @method('PUT')

            <!--begin: Name Row-->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6 mb-5">
                <!--begin: First Name-->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        First Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="first_name" name="first_name"
                        value="{{ old('first_name', $user->first_name) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all @error('first_name') border-red-500 @enderror"
                        placeholder="Enter first name" required>
                </div>
                <!--end: First Name-->

                <!--begin: Last Name-->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Last Name
                    </label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                        placeholder="Enter last name">
                </div>
                <!--end: Last Name-->
            </div>
            <!--end: Name Row-->

            <!--begin: Email & Phone Row-->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6 mb-5">
                <!--begin: Email-->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all @error('email') border-red-500 @enderror"
                        placeholder="user@example.com" required>
                </div>
                <!--end: Email-->

                <!--begin: Phone-->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Phone Number
                    </label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                        placeholder="+8801XXXXXXXXX">
                </div>
                <!--end: Phone-->
            </div>
            <!--end: Email & Phone Row-->

            <!--begin: Status & Birthday Row-->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6 mb-5">
                <!--begin: Status-->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Status
                    </label>
                    <select id="status" name="status"
                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all">
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active
                        </option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>
                            Inactive</option>
                        <option value="suspended" {{ old('status', $user->status) == 'suspended' ? 'selected' : '' }}>
                            Suspended</option>
                    </select>
                </div>
                <!--end: Status-->

                <!--begin: Birthday-->
                <div>
                    <label for="birthday" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Birthday
                    </label>
                    <input type="date" id="birthday" name="birthday"
                        value="{{ old('birthday', $user->birthday?->format('Y-m-d')) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all">
                </div>
                <!--end: Birthday-->
            </div>
            <!--end: Status & Birthday Row-->

            <!--begin: Form Actions-->
            <div class="flex items-center justify-end gap-3 pt-5 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ route('users.index') }}"
                    class="px-6 py-2.5 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl text-sm font-medium transition-all">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl text-sm font-medium transition-all shadow-lg shadow-primary-600/20">
                    <i class="fa-solid fa-floppy-disk mr-1.5"></i>
                    Update User
                </button>
            </div>
            <!--end: Form Actions-->
        </form>
    </div>
    <!--end: Edit User Form Card-->

    @push('scripts')
        <script>
            // Toggle password visibility
            function togglePassword(inputId, btn) {
                const input = document.getElementById(inputId);
                const icon = btn.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        </script>
    @endpush
@endsection
