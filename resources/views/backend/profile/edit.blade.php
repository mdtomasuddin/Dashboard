@extends('backend.master')

@section('title')
    {{ config('app.name') }} || Edit Profile
@endsection

@section('content')
    @php
        $user = Auth::user();
        $activeTab = old('_tab', request('tab', 'personal')); // personal | media | password | sessions | danger
    @endphp

    <div class="w-11/12 mx-auto">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-400 dark:text-gray-500 mb-6">
            <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <a href="{{ route('profile.edit') }}" class="hover:text-primary-600 transition-colors">Profile</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-gray-600 dark:text-gray-300 font-medium">Edit</span>
        </nav>

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800 dark:text-white">Account Settings</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Review and manage your personal details, security preferences, and active sessions
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span class="hidden sm:inline">Back to Dashboard</span>
                </a>
            </div>
        </div>

        <!-- Tab Wrapper -->
        <div class="mb-6" x-data="{ tab: '{{ $activeTab }}' }">

            <!-- Navigation Tabs -->
            <div class="flex flex-wrap items-center gap-1 p-1 bg-gray-100 dark:bg-gray-800 rounded-xl w-fit">
                <button @click="tab = 'personal'"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
                    :class="tab === 'personal' ? 'bg-white dark:bg-gray-700 text-gray-800 dark:text-white shadow-sm' :
                        'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'">
                    <i class="fa-solid fa-user"></i>
                    <span class="hidden sm:inline">Personal Info</span>
                </button>
                <button @click="tab = 'media'"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
                    :class="tab === 'media' ? 'bg-white dark:bg-gray-700 text-gray-800 dark:text-white shadow-sm' :
                        'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'">
                    <i class="fa-solid fa-image"></i>
                    <span class="hidden sm:inline">Profile Media</span>
                </button>
                <button @click="tab = 'password'"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
                    :class="tab === 'password' ? 'bg-white dark:bg-gray-700 text-gray-800 dark:text-white shadow-sm' :
                        'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'">
                    <i class="fa-solid fa-key"></i>
                    <span class="hidden sm:inline">Password</span>
                </button>
                <button @click="tab = 'sessions'"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
                    :class="tab === 'sessions' ? 'bg-white dark:bg-gray-700 text-gray-800 dark:text-white shadow-sm' :
                        'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'">
                    <i class="fa-solid fa-laptop"></i>
                    <span class="hidden sm:inline">Sessions</span>
                </button>
                <button @click="tab = 'danger'"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
                    :class="tab === 'danger' ? 'bg-white dark:bg-gray-700 text-red-600 dark:text-red-400 shadow-sm' :
                        'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span class="hidden sm:inline">Danger Zone</span>
                </button>
            </div>

            <!-- Tab Contents -->
            <div class="mt-6">

                <!-- Profile Update Form (Personal Info & Media) -->
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_tab" x-model="tab">

                    <!-- Tab 1: Personal Information -->
                    <div x-show="tab === 'personal'" x-cloak x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div
                            class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-card overflow-hidden">
                            <div class="p-5 lg:p-6 border-b border-gray-100 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-user text-primary-600 dark:text-primary-400"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-gray-800 dark:text-white">Personal Information
                                        </h3>
                                        <p class="text-sm text-gray-400 dark:text-gray-500">Manage your personal profile and
                                            contact details</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5 lg:p-6 space-y-5">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">
                                    <div>
                                        <label for="first_name"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            First Name <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="first_name" name="first_name"
                                            value="{{ old('first_name', $user->first_name) }}"
                                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                                            placeholder="John" required>
                                        @error('first_name')
                                            <span class="input-error mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="last_name"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            Last Name
                                        </label>
                                        <input type="text" id="last_name" name="last_name"
                                            value="{{ old('last_name', $user->last_name) }}"
                                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                                            placeholder="Doe">
                                        @error('last_name')
                                            <span class="input-error mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">
                                    <div>
                                        <label for="email"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            Email Address <span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" id="email" name="email"
                                            value="{{ old('email', $user->email) }}"
                                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                                            placeholder="john@example.com" required>
                                        @error('email')
                                            <span class="input-error mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="phone"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            Phone Number
                                        </label>
                                        <input type="tel" id="phone" name="phone"
                                            value="{{ old('phone', $user->phone) }}"
                                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                                            placeholder="+880 1XXX-XXXXXX">
                                        @error('phone')
                                            <span class="input-error mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">
                                    <div>
                                        <label for="birthday"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            Date of Birth
                                        </label>
                                        <div class="relative">
                                            <i
                                                class="fa-solid fa-calendar absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                            <input type="date" id="birthday" name="birthday"
                                                value="{{ old('birthday', $user->birthday?->format('Y-m-d')) }}"
                                                class="w-full pl-9 pr-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all">
                                        </div>
                                        @error('birthday')
                                            <span class="input-error mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="location"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            Location
                                        </label>
                                        <div class="relative">
                                            <i
                                                class="fa-solid fa-location-dot absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                            <input type="text" id="location" name="location"
                                                value="{{ old('location', $user->location) }}"
                                                class="w-full pl-9 pr-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                                                placeholder="Dhaka, Bangladesh">
                                        </div>
                                        @error('location')
                                            <span class="input-error mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div
                                    class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                                    <button type="submit"
                                        class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl text-sm font-medium transition-all shadow-lg shadow-primary-600/20">
                                        <i class="fa-solid fa-floppy-disk mr-1.5"></i>
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Profile Media -->
                    <div x-show="tab === 'media'" x-cloak x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div
                            class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-card overflow-hidden">
                            <div class="p-5 lg:p-6 border-b border-gray-100 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-image text-primary-600 dark:text-primary-400"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-gray-800 dark:text-white">Profile Media</h3>
                                        <p class="text-sm text-gray-400 dark:text-gray-500">Update your visual identity and
                                            public biography</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5 lg:p-6 space-y-6">
                                <!-- Avatar Upload -->
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Avatar</label>
                                    <div class="flex items-start gap-5">
                                        <div class="flex-shrink-0">
                                            <div id="avatar_preview_container"
                                                class="w-28 h-28 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center overflow-hidden relative group cursor-pointer"
                                                onclick="document.getElementById('avatar_input').click()">
                                                @if ($user->avatar)
                                                    <img id="avatar_preview" src="{{ $user->avatar }}"
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <i id="avatar_placeholder_icon"
                                                        class="fa-solid fa-user text-4xl text-gray-400"></i>
                                                    <img id="avatar_preview" class="w-full h-full object-cover"
                                                        style="display:none;" />
                                                @endif
                                                <div
                                                    class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <i class="fa-solid fa-camera text-white text-xl"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <input type="file" id="avatar_input" name="avatar" accept="image/*"
                                                class="hidden"
                                                onchange="previewImage(this, 'avatar_preview', 'avatar_placeholder_icon')">
                                            <div class="mt-1 flex items-center gap-2">
                                                <label for="avatar_input"
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-white transition-all cursor-pointer shadow-sm">
                                                    <i class="fa-solid fa-upload"></i> Choose
                                                </label>
                                                @if ($user->avatar)
                                                    <button type="button" onclick="removeAvatar()"
                                                        class="px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-all">Remove</button>
                                                @endif
                                            </div>
                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                                <i class="fa-solid fa-circle-info mr-1"></i> JPG, PNG, WebP. Max 2MB.
                                                Square image recommended.
                                            </p>
                                            @error('avatar')
                                                <span class="input-error mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Cover Upload -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cover
                                        Photo</label>
                                    <div class="relative">
                                        <div id="cover_preview_container"
                                            class="w-full h-36 sm:h-44 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 border-2 border-dashed border-gray-300 dark:border-gray-600 overflow-hidden relative group cursor-pointer"
                                            onclick="document.getElementById('cover_input').click()">
                                            @if ($user->cover)
                                                <img id="cover_preview" src="{{ $user->cover }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div id="cover_placeholder_icon"
                                                    class="absolute inset-0 flex flex-col items-center justify-center text-gray-400">
                                                    <i class="fa-solid fa-image text-4xl mb-2"></i>
                                                    <p class="text-sm">Click to upload cover photo</p>
                                                    <p class="text-xs mt-1">16:9 ratio recommended</p>
                                                </div>
                                                <img id="cover_preview" class="w-full h-full object-cover"
                                                    style="display:none;" />
                                            @endif
                                            <div
                                                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <i class="fa-solid fa-camera text-white text-2xl"></i>
                                            </div>
                                        </div>
                                        <input type="file" id="cover_input" name="cover" accept="image/*"
                                            class="hidden"
                                            onchange="previewImage(this, 'cover_preview', 'cover_placeholder_icon')">
                                        @if ($user->cover)
                                            <button type="button" onclick="removeCover()"
                                                class="absolute top-3 right-3 w-8 h-8 bg-black/50 hover:bg-black/70 text-white rounded-lg flex items-center justify-center transition-all z-10">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                        <i class="fa-solid fa-circle-info mr-1"></i> JPG, PNG, WebP. Max 5MB.
                                    </p>
                                    @error('cover')
                                        <span class="input-error mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Bio -->
                                <div>
                                    <label for="bio"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Bio</label>
                                    <textarea id="bio" name="bio" rows="4" maxlength="500"
                                        oninput="updateCharCount(this, 'bio_count', 500)"
                                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all resize-none"
                                        placeholder="Tell us a little about yourself...">{{ old('bio', $user->bio) }}</textarea>
                                    <div class="flex items-center justify-between mt-1.5">
                                        <p class="text-xs text-gray-400 dark:text-gray-500">Share your story, interests, or
                                            expertise.</p>
                                        <span id="bio_count" class="text-xs text-gray-400 dark:text-gray-500">
                                            {{ strlen(old('bio', $user->bio ?? '')) }}/500
                                        </span>
                                    </div>
                                    @error('bio')
                                        <span class="input-error mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div
                                    class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                                    <button type="submit"
                                        class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl text-sm font-medium transition-all shadow-lg shadow-primary-600/20">
                                        <i class="fa-solid fa-floppy-disk mr-1.5"></i> Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Tab 3: Change Password -->
                <div x-show="tab === 'password'" x-cloak x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div
                        class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-card overflow-hidden">
                        <div class="p-5 lg:p-6 border-b border-gray-100 dark:border-gray-800">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-key text-primary-600 dark:text-primary-400"></i>
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-gray-800 dark:text-white">Account Security</h3>
                                    <p class="text-sm text-gray-400 dark:text-gray-500">Maintain account security by
                                        regularly updating your password</p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('profile.password') }}" method="POST" class="p-5 lg:p-6">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="_tab" x-model="tab">

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6 mb-5">
                                <div>
                                    <label for="current_password"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                        Current Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="password" id="current_password" name="current_password"
                                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                                            placeholder="Enter current password" required>
                                        <button type="button" onclick="togglePassword('current_password', this)"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <span class="input-error mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                        New Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password"
                                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                                            placeholder="Min 8 characters" required>
                                        <button type="button" onclick="togglePassword('password', this)"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="input-error mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                        Confirm Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                                            placeholder="Re-enter new password" required>
                                        <button type="button" onclick="togglePassword('password_confirmation', this)"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="input-error mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                                <button type="submit"
                                    class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl text-sm font-medium transition-all shadow-lg shadow-primary-600/20">
                                    <i class="fa-solid fa-key mr-1.5"></i> Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tab 4: Active Sessions -->
                <div x-show="tab === 'sessions'" x-cloak x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="space-y-6">
                        <div
                            class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-card overflow-hidden">
                            <div class="p-5 lg:p-6 border-b border-gray-100 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-laptop text-primary-600 dark:text-primary-400"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-gray-800 dark:text-white">Session Management
                                        </h3>
                                        <p class="text-sm text-gray-400 dark:text-gray-500">Review and control active
                                            device connections to your account</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5 lg:p-6">
                                @if ($sessions->count() > 0)
                                    <div class="space-y-3">
                                        @foreach ($sessions as $session)
                                            @php
                                                $userAgent = $session->user_agent ?? '';
                                                $isCurrent = $session->id === session()->getId();
                                                $browser = 'Unknown';
                                                $platform = 'Unknown';
                                                if (preg_match('/Chrome\/([\d]+)/', $userAgent)) {
                                                    $browser = 'Chrome';
                                                } elseif (preg_match('/Firefox\/([\d]+)/', $userAgent)) {
                                                    $browser = 'Firefox';
                                                } elseif (
                                                    preg_match('/Safari\/([\d]+)/', $userAgent) &&
                                                    !preg_match('/Chrome/', $userAgent)
                                                ) {
                                                    $browser = 'Safari';
                                                } elseif (preg_match('/Edge\/([\d]+)/', $userAgent)) {
                                                    $browser = 'Edge';
                                                }
                                                if (preg_match('/Windows NT/', $userAgent)) {
                                                    $platform = 'Windows';
                                                } elseif (preg_match('/Mac OS X/', $userAgent)) {
                                                    $platform = 'macOS';
                                                } elseif (preg_match('/Linux/', $userAgent)) {
                                                    $platform = 'Linux';
                                                } elseif (preg_match('/Android/', $userAgent)) {
                                                    $platform = 'Android';
                                                } elseif (preg_match('/iPhone|iPad/', $userAgent)) {
                                                    $platform = 'iOS';
                                                }
                                            @endphp
                                            <div
                                                class="flex items-center justify-between p-3 rounded-xl {{ $isCurrent ? 'bg-primary-50 dark:bg-primary-900/10 border border-primary-200 dark:border-primary-800' : 'bg-gray-50 dark:bg-gray-800' }}">
                                                <div class="flex items-center gap-3 min-w-0">
                                                    <div
                                                        class="w-9 h-9 rounded-lg bg-white dark:bg-gray-700 flex items-center justify-center flex-shrink-0 shadow-sm">
                                                        <i
                                                            class="fa-solid fa-{{ $platform === 'Windows' ? 'windows' : ($platform === 'macOS' ? 'apple' : ($platform === 'Android' || $platform === 'iOS' ? 'mobile-screen-button' : 'globe')) }} text-gray-500"></i>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                            {{ $browser }} on {{ $platform }}
                                                            @if ($isCurrent)
                                                                <span
                                                                    class="ml-1.5 inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-semibold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">Current</span>
                                                            @endif
                                                        </p>
                                                        <p class="text-xs text-gray-400">
                                                            IP: {{ $session->ip_address }} ·
                                                            {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($sessions->count() > 1)
                                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-800">
                                            <form action="{{ route('profile.sessions.logout') }}" method="POST"
                                                onsubmit="event.preventDefault(); confirmLogoutSessions(this);">
                                                @csrf
                                                @method('DELETE')
                                                <div class="flex items-center gap-3">
                                                    <input type="password" name="password"
                                                        placeholder="Enter your password to confirm"
                                                        class="flex-1 px-4 py-2 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-700 dark:text-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                                                        required>
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-sm font-medium transition-all shadow-lg shadow-red-600/20 whitespace-nowrap">
                                                        <i class="fa-solid fa-right-from-bracket mr-1.5"></i> Logout Others
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center py-6 text-gray-400">
                                        <i class="fa-solid fa-laptop text-3xl mb-2"></i>
                                        <p class="text-sm">No active sessions found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 5: Danger Zone -->
                <div x-show="tab === 'danger'" x-cloak x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div
                        class="bg-white dark:bg-gray-900 rounded-2xl border border-red-200 dark:border-red-900/50 shadow-card overflow-hidden">
                        <div class="p-5 lg:p-6 border-b border-red-100 dark:border-red-900/30">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-triangle-exclamation text-red-600 dark:text-red-400"></i>
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-red-600 dark:text-red-400">Account Deletion</h3>
                                    <p class="text-sm text-gray-400 dark:text-gray-500">Permanently remove your account and
                                        associated data</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-5 lg:p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Delete Account</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500">Permanently delete your account and
                                        all associated data</p>
                                </div>
                                <button type="button" disabled
                                    class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-400 rounded-xl text-sm font-medium cursor-not-allowed">
                                    <i class="fa-solid fa-trash-can mr-1.5"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Toggle Password Visibility
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

            // Image Preview
            function previewImage(input, previewId, placeholderId) {
                const preview = document.getElementById(previewId);
                const placeholder = document.getElementById(placeholderId);
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                        if (placeholder) placeholder.style.display = 'none';
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Character Counter
            function updateCharCount(textarea, countId, max) {
                const count = document.getElementById(countId);
                const len = textarea.value.length;
                count.textContent = len + '/' + max;
                count.classList.toggle('text-red-500', len > max - 50);
                count.classList.toggle('dark:text-red-400', len > max - 50);
            }

            // Remove Avatar
            function removeAvatar() {
                const preview = document.getElementById('avatar_preview');
                const icon = document.getElementById('avatar_placeholder_icon');
                const input = document.getElementById('avatar_input');
                preview.style.display = 'none';
                if (icon) icon.style.display = 'block';
                input.value = '';
            }

            // Remove Cover
            function removeCover() {
                const preview = document.getElementById('cover_preview');
                const icon = document.getElementById('cover_placeholder_icon');
                const input = document.getElementById('cover_input');
                preview.style.display = 'none';
                if (icon) {
                    icon.style.display = 'flex';
                }
                input.value = '';
            }

            // Confirm Logout Sessions with SweetAlert
            function confirmLogoutSessions(form) {
                Swal.fire({
                    title: 'Log out other sessions?',
                    text: 'All other active sessions will be terminated. You will need to log in again on those devices.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74a3b',
                    cancelButtonColor: '#858796',
                    confirmButtonText: 'Yes, log them out!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }

            // Init character counter on load
            document.addEventListener('DOMContentLoaded', function() {
                const bio = document.getElementById('bio');
                if (bio) {
                    updateCharCount(bio, 'bio_count', 500);
                }
            });
        </script>
    @endpush
@endsection
