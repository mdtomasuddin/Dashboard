@extends('backend.master')

@section('title')
    {{ config('app.name') }} || Edit User
@endsection

@section('content')
    <!--begin: Page Header-->
    <div class="page-header">
        <!--begin: Page Title-->
        <div class="page-title">
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <span class="breadcrumb-active">Edit User</span>
            </nav>
            <p class="page-description">
                Update the user's information by filling out the form below. Ensure all required fields are completed before
                submission.
            </p>
        </div>
        <!--end: Page Title-->
        <!--begin: Actions-->
        <div class="page-actions">
            <a href="{{ route('users.index') }}" class="btn-primary">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to Users</span>
            </a>
        </div>
        <!--end: Actions-->
    </div>
    <!--end: Page Header-->


    <!--begin: Card-->
    <div class="card">
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- begin:form-fields -->
            <div class="grid grid-cols-12 gap-5">
                <!-- begin:first_name -->
                <div class="col-span-12 flex flex-col gap-1.5">
                    <label for="first_name" class="form-label"> First Name <span class="text-red-500">*</span> </label>
                    <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                        class="form-input @error('first_name') is-invalid @enderror" placeholder="Enter first name">
                    @error('first_name')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- end:first_name -->

                <!-- begin:last_name -->
                <div class="col-span-12 flex flex-col gap-1.5">
                    <label for="last_name" class="form-label"> Last Name </label>
                    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                        class="form-input @error('last_name') is-invalid @enderror" placeholder="Enter last name">
                    @error('last_name')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- end:last_name -->

                <!-- begin:email -->
                <div class="col-span-12 flex flex-col gap-1.5">
                    <label for="email" class="form-label"> Email Address <span class="text-red-500">*</span> </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="form-input @error('email') is-invalid @enderror" placeholder="user@example.com">
                    @error('email')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- end:email -->

                <!-- begin:phone -->
                <div class="col-span-12 flex flex-col gap-1.5">
                    <label for="phone" class="form-label"> Phone Number </label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="form-input @error('phone') is-invalid @enderror" placeholder="+8801XXXXXXXXX">
                    @error('phone')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- end:phone -->

                <!--begin:password--->
                <div class="col-span-12 md:col-span-6 flex flex-col gap-1.5">
                    <label for="password" class="form-label"> Password <span class="text-red-500">*</span> </label>
                    <div class="relative w-full">
                        <input type="password" name="password"
                            class="form-input pr-10 @error('password') is-invalid @enderror" placeholder="Min 8 characters">
                        <button type="button" onclick="togglePassword('password', this)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none">
                            <i class="fa-solid fa-eye text-sm"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!--end:password--->
                <!--begin:birthday--->
                <div class="col-span-12 md:col-span-6 flex flex-col gap-1.5">
                    <label for="birthday" class="form-label"> Birthday </label>
                    <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}"
                        class="form-input @error('birthday') is-invalid @enderror">
                    @error('birthday')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!--end:birthday--->

            </div>
            <!-- end:form-fields -->

            <!--begin: Form Actions-->
            <div class="form-actions">
                <a href="{{ route('users.index') }}" class="btn-cancel"> Cancel </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-user-edit text-xs"></i> <span>Update User</span>
                </button>
            </div>
            <!--end: Form Actions-->
        </form>
    </div>
    <!--end: Card-->

    @push('scripts')
        <script>
            // Toggle password visibility
            function togglePassword(inputName, btn) {
                const input = document.querySelector(`input[name="${inputName}"]`);
                const icon = btn.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            }
        </script>
    @endpush
@endsection
