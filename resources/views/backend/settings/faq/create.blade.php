@extends('backend.master')

@section('title')
    {{ config('app.name') }} || Create FAQ
@endsection

@section('content')
    <!--begin: Page Header-->
    <div class="page-header">
        <!--begin: Page Title-->
        <div class="page-title">
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <a href="{{ route('faqs.index') }}" class="breadcrumb-link">FAQs</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <span class="breadcrumb-active">Create FAQ</span>
            </nav>
            <p class="page-description">
                Create a new FAQ by filling out the form below. Ensure all required fields are completed before submission.
            </p>
        </div>
        <!--end: Page Title-->
        <!--begin: Actions-->
        <div class="page-actions">
            <a href="{{ route('faqs.index') }}" class="btn-primary">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to FAQs</span>
            </a>
        </div>
        <!--end: Actions-->
    </div>
    <!--end: Page Header-->

    <!--begin: Card-->
    <div class="card">
        <form action="{{ route('faqs.store') }}" method="POST">
            @csrf
            <!-- begin:form-fields -->
            <div class="grid grid-cols-12 gap-5">
                <!-- begin:question -->
                <div class="col-span-12 flex flex-col gap-1.5">
                    <label for="question" class="form-label"> Question <span class="text-red-500">*</span> </label>
                    <input type="text" name="question" value="{{ old('question') }}"
                        class="form-input @error('question') is-invalid @enderror" placeholder="Enter question"
                        required>
                    @error('question')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- end:question -->

                <!-- begin:status -->
                <div class="col-span-12 flex flex-col gap-1.5">
                    <label for="status" class="form-label"> Status <span class="text-red-500">*</span> </label>
                    <select name="status" id="status" class="form-input @error('status') is-invalid @enderror" required>
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- end:status -->

                <!-- begin:answer -->
                <div class="col-span-12 flex flex-col gap-1.5">
                    <label for="summernote" class="form-label"> Answer <span class="text-red-500">*</span> </label>
                    <textarea class="form-input @error('answer') is-invalid @enderror" id="summernote" name="answer"
                        placeholder="Enter answer details...">{{ old('answer') }}</textarea>
                    @error('answer')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- end:answer -->
            </div>
            <!-- end:form-fields -->

            <!--begin: Form Actions-->
            <div class="form-actions">
                <a href="{{ route('faqs.index') }}" class="btn-cancel"> Cancel </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk text-xs"></i> <span>Create FAQ</span>
                </button>
            </div>
            <!--end: Form Actions-->
        </form>
    </div>
    <!--end: Card-->

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 250
                });
            });
        </script>
    @endpush
@endsection

