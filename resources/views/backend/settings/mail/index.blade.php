@extends('backend.master')

@section('title')
    {{ config('app.name') }} || Mail Settings
@endsection

@section('content')
    <!--begin: Page Header-->
    <div class="page-header">
        <!--begin: Page Title-->
        <div class="page-title">
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <a href="{{ route('mail-setting.index') }}" class="breadcrumb-link">Settings</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <span class="breadcrumb-active">Mail Configuration</span>
            </nav>
            <p class="page-description">
                Configure SMTP settings to enable email delivery for system notifications, password resets, and other
                transactional emails.
            </p>
        </div>
        <!--end: Page Title-->

    </div>
    <!--end: Page Header-->

    <!--begin: Mail Configuration Card-->
    <div class="card">
        <form id="mail-form" action="{{ route('mail-setting.store') }}" method="POST">
            @csrf

            <!--begin: Section Header-->
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
                <div
                    class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-envelope text-primary-600 dark:text-primary-400"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-800 dark:text-white">SMTP Configuration</h3>
                    <p class="text-sm text-gray-400 dark:text-gray-500">Set up your outgoing mail server details</p>
                </div>
            </div>
            <!--end: Section Header-->

            <!--begin: Form Fields-->
            <div class="grid grid-cols-12 gap-5">

                <!--begin: Mailer-->
                <div class="col-span-12 md:col-span-6 lg:col-span-4 flex flex-col gap-1.5">
                    <label for="mail_mailer" class="form-label">
                        Mail Driver <span class="text-red-500">*</span>
                    </label>
                    <select name="mail_mailer" id="mail_mailer"
                        class="form-input @error('mail_mailer') is-invalid @enderror">
                        <option value="smtp" {{ config('mail.default') === 'smtp' ? 'selected' : '' }}>SMTP</option>
                        <option value="sendmail" {{ config('mail.default') === 'sendmail' ? 'selected' : '' }}>Sendmail
                        </option>
                        <option value="mailgun" {{ config('mail.default') === 'mailgun' ? 'selected' : '' }}>Mailgun
                        </option>
                        <option value="postmark" {{ config('mail.default') === 'postmark' ? 'selected' : '' }}>Postmark
                        </option>
                        <option value="ses" {{ config('mail.default') === 'ses' ? 'selected' : '' }}>Amazon SES</option>
                        <option value="log" {{ config('mail.default') === 'log' ? 'selected' : '' }}>Log (Local Dev)
                        </option>
                    </select>
                    @error('mail_mailer')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!--end: Mailer-->

                <!--begin: Host-->
                <div class="col-span-12 md:col-span-6 lg:col-span-4 flex flex-col gap-1.5">
                    <label for="mail_host" class="form-label">
                        SMTP Host <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="mail_host" id="mail_host"
                        value="{{ old('mail_host', config('mail.mailers.smtp.host') ?? '') }}"
                        class="form-input @error('mail_host') is-invalid @enderror" placeholder="smtp.gmail.com">
                    @error('mail_host')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!--end: Host-->

                <!--begin: Port-->
                <div class="col-span-12 md:col-span-6 lg:col-span-4 flex flex-col gap-1.5">
                    <label for="mail_port" class="form-label">
                        SMTP Port <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="mail_port" id="mail_port"
                        value="{{ old('mail_port', config('mail.mailers.smtp.port') ?? '') }}"
                        class="form-input @error('mail_port') is-invalid @enderror" placeholder="587">
                    @error('mail_port')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!--end: Port-->

                <!--begin: Encryption-->
                <div class="col-span-12 md:col-span-6 lg:col-span-4 flex flex-col gap-1.5">
                    <label for="mail_encryption" class="form-label">Encryption</label>
                    <select name="mail_encryption" id="mail_encryption"
                        class="form-input @error('mail_encryption') is-invalid @enderror">
                        <option value="tls"
                            {{ old('mail_encryption', config('mail.mailers.smtp.encryption')) === 'tls' ? 'selected' : '' }}>
                            TLS</option>
                        <option value="ssl"
                            {{ old('mail_encryption', config('mail.mailers.smtp.encryption')) === 'ssl' ? 'selected' : '' }}>
                            SSL</option>
                        <option value=""
                            {{ empty(old('mail_encryption', config('mail.mailers.smtp.encryption'))) ? 'selected' : '' }}>
                            None</option>
                    </select>
                    @error('mail_encryption')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!--end: Encryption-->

                <!--begin: Username-->
                <div class="col-span-12 md:col-span-6 lg:col-span-4 flex flex-col gap-1.5">
                    <label for="mail_username" class="form-label">SMTP Username</label>
                    <input type="email" name="mail_username" id="mail_username"
                        value="{{ old('mail_username', config('mail.mailers.smtp.username') ?? '') }}"
                        class="form-input @error('mail_username') is-invalid @enderror" placeholder="user@example.com">
                    @error('mail_username')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!--end: Username-->

                <!--begin: Password-->
                <div class="col-span-12 md:col-span-6 lg:col-span-4 flex flex-col gap-1.5">
                    <label for="mail_password" class="form-label">SMTP Password</label>
                    <div class="relative w-full">
                        <input type="password" name="mail_password" id="mail_password"
                            class="form-input pr-10 @error('mail_password') is-invalid @enderror"
                            placeholder="Enter SMTP password"
                            value="{{ old('mail_password', config('mail.mailers.smtp.password') ?? '') }}">
                        <button type="button" onclick="togglePassword('mail_password', this)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none">
                            <i class="fa-solid fa-eye text-sm"></i>
                        </button>
                    </div>
                    @error('mail_password')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!--end: Password-->

                <!--begin: From Address-->
                <div class="col-span-12 md:col-span-6 lg:col-span-4 flex flex-col gap-1.5">
                    <label for="mail_address" class="form-label">
                        From Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="mail_address" id="mail_address"
                        value="{{ old('mail_address', config('mail.from.address') ?? '') }}"
                        class="form-input @error('mail_address') is-invalid @enderror" placeholder="noreply@example.com">
                    @error('mail_address')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
                <!--end: From Address-->

            </div>
            <!--end: Form Fields-->

            {{-- <!--begin: Form Actions-->
            <div class="form-actions">
                <a href="{{ route('dashboard') }}" class="btn-cancel">
                    <i class="fa-solid fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> <span>Save Settings</span>
                </button>
            </div>
            <!--end: Form Actions--> --}}
            <!--begin: Form Actions-->
            <div class="form-actions">
                <a href="{{ route('users.index') }}" class="btn-cancel"> Cancel </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-user-plus text-xs"></i> <span>Save Settings</span>
                </button>
            </div>
            <!--end: Form Actions-->



        </form>
    </div>
    <!--end: Mail Configuration Card-->

    <!--begin: Test Connection Card-->
    <div class="card mt-5">
        <!--begin: Section Header-->
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
            <div
                class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-paper-plane text-green-600 dark:text-green-400"></i>
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-800 dark:text-white">Test Mail Configuration</h3>
                <p class="text-sm text-gray-400 dark:text-gray-500">Send a test email to verify your SMTP settings are
                    working correctly</p>
            </div>
        </div>
        <!--end: Section Header-->

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
            After saving your settings above, you can send a test email to confirm the configuration works.
        </p>
        <!--begin: Test Email Form-->
        <div class="flex items-center gap-3">
            <input type="email" id="test_email" placeholder="Enter recipient email" class="form-input max-w-sm">
            <button type="button" onclick="sendTestMail(this)" class="btn-primary whitespace-nowrap">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Send Test</span>
            </button>
        </div>
    </div>
    <!--end: Test Connection Card-->

    @push('scripts')
        <script>
            // Toggle Password Visibility 
            function togglePassword(inputId, btn) {
                const input = document.getElementById(inputId);
                const icon = btn.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            }

            //Send Test Mail
            function sendTestMail(btn) {
                const email = document.getElementById('test_email').value.trim();
                if (!email) {
                    toastr.warning('Please enter a recipient email address.');
                    return;
                }

                // Email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    toastr.error('Please enter a valid email address.');
                    return;
                }

                const originalHtml = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending...';
                $.ajax({
                    url: '{{ route('mail-setting.test') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: email
                    },
                    success: function(res) {
                        toastr.success(res.message || 'Test email sent successfully!');
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Failed to send test email.';
                        toastr.error(msg);
                    },
                    complete: function() {
                        btn.disabled = false;
                        btn.innerHTML = originalHtml;
                    }
                });
            }
        </script>
    @endpush
@endsection
