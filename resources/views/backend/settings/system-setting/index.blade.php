@extends('backend.master')

@section('title')
    {{ config('app.name') }} || System Settings
@endsection

@section('content')
    <!--begin: Page Header-->
    <div class="page-header">
        <div class="page-title">
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <a href="{{ route('system-setting.index') }}" class="breadcrumb-link">Settings</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <span class="breadcrumb-active">System Settings</span>
            </nav>
            <p class="page-description">
                Manage global application settings, identity details, media assets, and maintenance mode parameters.
            </p>
        </div>
    </div>
    <!--end: Page Header-->

    <!--begin: System Settings Card-->
    <div class="card">
        <form id="system-setting-form" action="{{ route('system-setting.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <!--begin: Section Header-->
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
                <div
                    class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-sliders text-primary-600 dark:text-primary-400"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-800 dark:text-white">General Information</h3>
                    <p class="text-sm text-gray-400 dark:text-gray-500">Configure core application title, contact
                        information, and assets</p>
                </div>
            </div>
            <!--end: Section Header-->

            <!--begin: Form Fields-->
            <div class="grid grid-cols-12 gap-5">

                <!-- Title -->
                <div class="col-span-12 md:col-span-6 flex flex-col gap-1.5">
                    <label for="title" class="form-label">Application Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $setting->title ?? '') }}"
                        class="form-input @error('title') is-invalid @enderror" placeholder="T Dashboard">
                    @error('title')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- System Name -->
                <div class="col-span-12 md:col-span-6 flex flex-col gap-1.5">
                    <label for="system_name" class="form-label">System Name</label>
                    <input type="text" name="system_name" id="system_name"
                        value="{{ old('system_name', $setting->system_name ?? '') }}"
                        class="form-input @error('system_name') is-invalid @enderror" placeholder="T Dashboard System">
                    @error('system_name')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-span-12 md:col-span-6 flex flex-col gap-1.5">
                    <label for="email" class="form-label">Support Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $setting->email ?? '') }}"
                        class="form-input @error('email') is-invalid @enderror" placeholder="support@example.com">
                    @error('email')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="col-span-12 md:col-span-6 flex flex-col gap-1.5">
                    <label for="phone" class="form-label">Support Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone ?? '') }}"
                        class="form-input @error('phone') is-invalid @enderror" placeholder="+8801700000000">
                    @error('phone')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Timezone -->
                <div class="col-span-12 md:col-span-6 flex flex-col gap-1.5">
                    <label for="timezone" class="form-label">Timezone</label>
                    <input type="text" name="timezone" id="timezone"
                        value="{{ old('timezone', $setting->timezone ?? 'Asia/Dhaka') }}"
                        class="form-input @error('timezone') is-invalid @enderror" placeholder="Asia/Dhaka">
                    @error('timezone')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Copyright Text -->
                <div class="col-span-12 md:col-span-6 flex flex-col gap-1.5">
                    <label for="copyright_text" class="form-label">Copyright Text</label>
                    <input type="text" name="copyright_text" id="copyright_text"
                        value="{{ old('copyright_text', $setting->copyright_text ?? '') }}"
                        class="form-input @error('copyright_text') is-invalid @enderror"
                        placeholder="© 2026 T Dashboard. All rights reserved.">
                    @error('copyright_text')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address -->
                <div class="col-span-12 flex flex-col gap-1.5">
                    <label for="address" class="form-label">Office Address</label>
                    <input type="text" name="address" id="address"
                        value="{{ old('address', $setting->address ?? '') }}"
                        class="form-input @error('address') is-invalid @enderror" placeholder="Dhaka, Bangladesh">
                    @error('address')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-span-12 flex flex-col gap-1.5">
                    <label for="summernote" class="form-label">System Description</label>
                    <textarea name="description" id="summernote" rows="3"
                        class="form-input @error('description') is-invalid @enderror" placeholder="Enter system description">{{ old('description', $setting->description ?? '') }}</textarea>
                    @error('description')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- System Logo Upload -->
                <div class="col-span-12 md:col-span-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">System Logo</label>
                    <div class="flex items-start gap-5">
                        <div class="flex-shrink-0">
                            <div id="logo_preview_container"
                                class="w-28 h-28 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center overflow-hidden relative group cursor-pointer"
                                onclick="document.getElementById('logo_input').click()">
                                @if (!empty($setting->logo))
                                    <img id="logo_preview" src="{{ $setting->logo }}"
                                        class="w-full h-full object-cover">
                                    <div
                                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i class="fa-solid fa-camera text-white text-xl"></i>
                                    </div>
                                @else
                                    <i id="logo_placeholder_icon" class="fa-solid fa-image text-4xl text-gray-400"></i>
                                    <img id="logo_preview" class="w-full h-full object-cover" style="display:none;" />
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <input type="file" id="logo_input" name="logo" accept="image/*" class="hidden"
                                onchange="previewImage(this, 'logo_preview', 'logo_placeholder_icon')">
                            <div class="mt-1 flex items-center gap-2">
                                <label for="logo_input"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-white transition-all cursor-pointer shadow-sm">
                                    <i class="fa-solid fa-upload"></i> Choose
                                </label>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                <i class="fa-solid fa-circle-info mr-1"></i> JPG, PNG, WebP, SVG. Max 4MB.
                            </p>
                            @error('logo')
                                <span class="input-error mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Favicon Upload -->
                <div class="col-span-12 md:col-span-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Favicon</label>
                    <div class="flex items-start gap-5">
                        <div class="flex-shrink-0">
                            <div id="favicon_preview_container"
                                class="w-28 h-28 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center overflow-hidden relative group cursor-pointer"
                                onclick="document.getElementById('favicon_input').click()">
                                @if (!empty($setting->favicon))
                                    <img id="favicon_preview" src="{{ $setting->favicon }}"
                                        class="w-full h-full object-cover">
                                    <div
                                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i class="fa-solid fa-camera text-white text-xl"></i>
                                    </div>
                                @else
                                    <i id="favicon_placeholder_icon" class="fa-solid fa-icons text-4xl text-gray-400"></i>
                                    <img id="favicon_preview" class="w-full h-full object-cover" style="display:none;" />
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <input type="file" id="favicon_input" name="favicon" accept="image/*" class="hidden"
                                onchange="previewImage(this, 'favicon_preview', 'favicon_placeholder_icon')">
                            <div class="mt-1 flex items-center gap-2">
                                <label for="favicon_input"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-white transition-all cursor-pointer shadow-sm">
                                    <i class="fa-solid fa-upload"></i> Choose
                                </label>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                <i class="fa-solid fa-circle-info mr-1"></i> ICO, PNG, WebP, SVG. Max 2MB. Square image
                                recommended.
                            </p>
                            @error('favicon')
                                <span class="input-error mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Maintenance Mode Section Header -->
                <div class="col-span-12 mt-4 pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-screwdriver-wrench text-amber-600 dark:text-amber-400"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-800 dark:text-white">Maintenance Mode</h3>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Temporarily restrict public access to the
                            platform during scheduled updates or system upgrades</p>
                    </div>
                </div>

                <!-- Maintenance Mode Toggle Card -->
                <div class="col-span-12">
                    <div
                        class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-200/80 dark:border-gray-700/80 flex items-start justify-between gap-4">
                        <div class="flex flex-col gap-1">
                            <span class="text-sm font-semibold text-gray-800 dark:text-white">Activate System
                                Maintenance</span>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                When enabled, standard visitors will see the maintenance announcement page while
                                administrative access remains available.
                            </p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer flex-shrink-0 mt-0.5">
                            <input type="checkbox" name="maintenance_mode" value="1"
                                {{ old('maintenance_mode', $setting->maintenance_mode ?? false) ? 'checked' : '' }}
                                class="accent-primary-600 w-5 h-5 rounded">
                        </label>
                    </div>
                </div>

                <!-- Maintenance Message -->
                <div class="col-span-12 flex flex-col gap-1.5">
                    <label for="maintenance_message_editor" class="form-label">Maintenance Notice & Announcement</label>
                    <textarea name="maintenance_message" id="maintenance_message_editor" rows="3"
                        class="form-input @error('maintenance_message') is-invalid @enderror">{{ old('maintenance_message', $setting->maintenance_message ?? '') }}</textarea>
                    @error('maintenance_message')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <!--end: Form Fields-->

            <!--begin: Form Actions-->
            <div class="form-actions mt-6">
                <a href="{{ route('dashboard') }}" class="btn-cancel"> Cancel </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk text-xs"></i> <span>Save Settings</span>
                </button>
            </div>
            <!--end: Form Actions-->

        </form>
    </div>
    <!--end: System Settings Card-->

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 100
                });
                $('#maintenance_message_editor').summernote({
                    height: 100
                });
            });

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
        </script>
    @endpush
@endsection
