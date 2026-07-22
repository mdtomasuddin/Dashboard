@extends('backend.master')

@section('title')
    {{ config('app.name') }} || Terms & Conditions
@endsection

@section('content')
    <!--begin: Page Header-->
    <div class="page-header">
        <div class="page-title">
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <a href="{{ route('terms-and-conditions.index') }}" class="breadcrumb-link">Settings</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <span class="breadcrumb-active">Terms & Conditions</span>
            </nav>
            <p class="page-description">
                Update the Terms & Conditions details below and submit.
            </p>
        </div>
    </div>
    <!--end: Page Header-->

    <!--begin: Content Card-->
    <div class="card">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
            <div
                class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-file-contract text-blue-600 dark:text-blue-400"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-base font-bold text-gray-800 dark:text-white">Terms & Conditions</h3>
                <p class="text-sm text-gray-400 dark:text-gray-500">Manage your Terms & Conditions content</p>
            </div>
        </div>

        <form method="POST" action="{{ route('terms-and-conditions.store') }}" class="form" novalidate="novalidate">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!--begin: Title Field-->
                <div class="form-group">
                    <label for="title" class="form-label mb-2 block">Title</label>
                    <input type="text" class="form-input @error('title') is-invalid @enderror" name="title"
                        id="title" placeholder="Enter title"
                        value="{{ old('title', $terms_and_conditions->title ?? '') }}">
                    @error('title')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!--end: Title Field-->

                <!--begin: Slug Field-->
                <div class="form-group">
                    <label for="disabledInput" class="form-label mb-2 block">Slug</label>
                    <input type="text" class="form-input bg-gray-100 dark:bg-gray-800/50 cursor-not-allowed"
                        id="disabledInput" value="{{ $terms_and_conditions->slug ?? 'Auto-generated on save' }}" disabled>
                </div>
                <!--end: Slug Field-->
            </div>

            <!--begin: Content Field-->
            <div class="form-group mb-4">
                <label for="content" class="form-label mb-2 block">Content</label>
                <textarea class="form-input @error('content') is-invalid @enderror" id="content" name="content"
                    placeholder="Enter content here...">{{ old('content', $terms_and_conditions->content ?? '') }}</textarea>
                @error('content')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>
            <!--end: Content Field-->

            <!--begin: Form Actions-->
            <div class="form-actions">
                <a href="{{ route('dashboard') }}" class="btn-cancel">
                    <i class="fa-solid fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> <span>Update</span>
                </button>
            </div>
            <!--end: Form Actions-->
        </form>
    </div>
    <!--end: Content Card-->

    @push('scripts')
        <script>
            // Start Ckeditor5
            ClassicEditor
                .create(document.querySelector('#content'))
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
@endsection
