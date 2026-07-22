@extends('backend.master')

@section('title')
    {{ config('app.name') }} || Integration Settings
@endsection

@section('content')
    @php
        $activeTab = session('active_tab', old('_tab', 'google'));
        if ($errors->has('FACEBOOK_CLIENT_ID') || $errors->has('FACEBOOK_CLIENT_SECRET')) {
            $activeTab = 'facebook';
        } elseif ($errors->has('APPLE_CLIENT_ID') || $errors->has('APPLE_TEAM_ID') || $errors->has('APPLE_KEY_ID')) {
            $activeTab = 'apple';
        } elseif (
            $errors->has('TWILIO_SID') ||
            $errors->has('TWILIO_AUTH_TOKEN') ||
            $errors->has('TWILIO_PHONE_NUMBER')
        ) {
            $activeTab = 'twilio';
        } elseif (
            $errors->has('STRIPE_KEY') ||
            $errors->has('STRIPE_SECRET') ||
            $errors->has('STRIPE_WEBHOOK_SECRET')
        ) {
            $activeTab = 'stripe';
        }
    @endphp

    <!--begin: Page Header-->
    <div class="page-header">
        <!--begin: Page Title-->
        <div class="page-title">
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <a href="{{ route('integration.setting') }}" class="breadcrumb-link">Settings</a>
                <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                <span class="breadcrumb-active">Integration Settings</span>
            </nav>
            <p class="page-description">
                Configure third-party integrations for authentication, SMS, and payment services used across your
                application.
            </p>
        </div>
        <!--end: Page Title-->
    </div>
    <!--end: Page Header-->

    <!--begin: Integration Card-->
    <div class="card">
        <!--begin: Card Header-->
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
            <div
                class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-plug text-purple-600 dark:text-purple-400"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-base font-bold text-gray-800 dark:text-white">Third-Party Integrations</h3>
                <p class="text-sm text-gray-400 dark:text-gray-500">Manage API keys and credentials for external services
                </p>
            </div>
        </div>
        <!--end: Card Header-->

        <!--begin: Tabs-->
        <div class="border-b border-gray-100 dark:border-gray-800 mb-6">
            <ul class="flex flex-wrap gap-1" id="integrationTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button
                        class="px-5 py-2.5 text-sm font-medium rounded-t-lg transition-all border-b-2 {{ $activeTab === 'stripe' ? 'active-tab text-primary-600 border-primary-500' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 border-transparent hover:border-gray-300 dark:hover:border-gray-600' }}"
                        id="stripe-tab" type="button" role="tab" aria-controls="stripe"
                        aria-selected="{{ $activeTab === 'stripe' ? 'true' : 'false' }}"
                        onclick="switchTab('stripe', this)">
                        <i class="fa-brands fa-stripe me-1.5"></i>Stripe
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="px-5 py-2.5 text-sm font-medium rounded-t-lg transition-all border-b-2 {{ $activeTab === 'google' ? 'active-tab text-primary-600 border-primary-500' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 border-transparent hover:border-gray-300 dark:hover:border-gray-600' }}"
                        id="google-tab" type="button" role="tab" aria-controls="google"
                        aria-selected="{{ $activeTab === 'google' ? 'true' : 'false' }}"
                        onclick="switchTab('google', this)">
                        <i class="fa-brands fa-google me-1.5"></i>Google
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="px-5 py-2.5 text-sm font-medium rounded-t-lg transition-all border-b-2 {{ $activeTab === 'facebook' ? 'active-tab text-primary-600 border-primary-500' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 border-transparent hover:border-gray-300 dark:hover:border-gray-600' }}"
                        id="facebook-tab" type="button" role="tab" aria-controls="facebook"
                        aria-selected="{{ $activeTab === 'facebook' ? 'true' : 'false' }}"
                        onclick="switchTab('facebook', this)">
                        <i class="fa-brands fa-facebook me-1.5"></i>Facebook
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="px-5 py-2.5 text-sm font-medium rounded-t-lg transition-all border-b-2 {{ $activeTab === 'apple' ? 'active-tab text-primary-600 border-primary-500' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 border-transparent hover:border-gray-300 dark:hover:border-gray-600' }}"
                        id="apple-tab" type="button" role="tab" aria-controls="apple"
                        aria-selected="{{ $activeTab === 'apple' ? 'true' : 'false' }}" onclick="switchTab('apple', this)">
                        <i class="fa-brands fa-apple me-1.5"></i>Apple
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="px-5 py-2.5 text-sm font-medium rounded-t-lg transition-all border-b-2 {{ $activeTab === 'twilio' ? 'active-tab text-primary-600 border-primary-500' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 border-transparent hover:border-gray-300 dark:hover:border-gray-600' }}"
                        id="twilio-tab" type="button" role="tab" aria-controls="twilio"
                        aria-selected="{{ $activeTab === 'twilio' ? 'true' : 'false' }}"
                        onclick="switchTab('twilio', this)">
                        <i class="fa-solid fa-comment-sms me-1.5"></i>Twilio
                    </button>
                </li>
            </ul>
        </div>
        <!--end: Tabs-->

        <!--begin: Tab Content-->
        <div class="tab-content" id="integrationTabContent">

            <!--begin: Google Tab-->
            <div class="tab-pane fade {{ $activeTab === 'google' ? 'show active' : 'hidden' }}" id="google"
                role="tabpanel" aria-labelledby="google-tab">
                <div>
                    <div class="flex items-center gap-3 mb-5 pb-3 border-b border-gray-100 dark:border-gray-800">
                        <div
                            class="w-8 h-8 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="fa-brands fa-google text-red-600 dark:text-red-400 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800 dark:text-white">Google OAuth Settings</h4>
                            <p class="text-xs text-gray-400 dark:text-gray-500">Configure Google Sign-In credentials</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('google.update') }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="_tab" value="google">

                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 md:col-span-6 flex flex-col gap-1.5">
                                <label for="GOOGLE_CLIENT_ID" class="form-label">Google Client ID</label>
                                <input type="text" name="GOOGLE_CLIENT_ID" id="GOOGLE_CLIENT_ID"
                                    class="form-input @error('GOOGLE_CLIENT_ID') is-invalid @enderror"
                                    placeholder="Enter your Google Client ID"
                                    value="{{ old('GOOGLE_CLIENT_ID', env('GOOGLE_CLIENT_ID')) }}">
                                @error('GOOGLE_CLIENT_ID')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-12 md:col-span-6 flex flex-col gap-1.5">
                                <label for="GOOGLE_CLIENT_SECRET" class="form-label">Google Client Secret</label>
                                <input type="text" name="GOOGLE_CLIENT_SECRET" id="GOOGLE_CLIENT_SECRET"
                                    class="form-input @error('GOOGLE_CLIENT_SECRET') is-invalid @enderror"
                                    placeholder="Enter your Google Client Secret"
                                    value="{{ old('GOOGLE_CLIENT_SECRET', env('GOOGLE_CLIENT_SECRET')) }}">
                                @error('GOOGLE_CLIENT_SECRET')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">
                                <i class="fa-solid fa-floppy-disk"></i> <span>Save Google Settings</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end: Google Tab-->

            <!--begin: Facebook Tab-->
            <div class="tab-pane fade {{ $activeTab === 'facebook' ? 'show active' : 'hidden' }}" id="facebook"
                role="tabpanel" aria-labelledby="facebook-tab">
                <div>
                    <div class="flex items-center gap-3 mb-5 pb-3 border-b border-gray-100 dark:border-gray-800">
                        <div
                            class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="fa-brands fa-facebook text-blue-600 dark:text-blue-400 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800 dark:text-white">Facebook OAuth Settings</h4>
                            <p class="text-xs text-gray-400 dark:text-gray-500">Configure Facebook Login credentials</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('facebook.update') }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="_tab" value="facebook">

                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 md:col-span-6 flex flex-col gap-1.5">
                                <label for="FACEBOOK_CLIENT_ID" class="form-label">Facebook Client ID</label>
                                <input type="text" name="FACEBOOK_CLIENT_ID" id="FACEBOOK_CLIENT_ID"
                                    class="form-input @error('FACEBOOK_CLIENT_ID') is-invalid @enderror"
                                    placeholder="Enter your Facebook Client ID"
                                    value="{{ old('FACEBOOK_CLIENT_ID', env('FACEBOOK_CLIENT_ID')) }}">
                                @error('FACEBOOK_CLIENT_ID')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-12 md:col-span-6 flex flex-col gap-1.5">
                                <label for="FACEBOOK_CLIENT_SECRET" class="form-label">Facebook Client Secret</label>
                                <input type="text" name="FACEBOOK_CLIENT_SECRET" id="FACEBOOK_CLIENT_SECRET"
                                    class="form-input @error('FACEBOOK_CLIENT_SECRET') is-invalid @enderror"
                                    placeholder="Enter your Facebook Client Secret"
                                    value="{{ old('FACEBOOK_CLIENT_SECRET', env('FACEBOOK_CLIENT_SECRET')) }}">
                                @error('FACEBOOK_CLIENT_SECRET')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">
                                <i class="fa-solid fa-floppy-disk"></i> <span>Save Facebook Settings</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end: Facebook Tab-->

            <!--begin: Apple Tab-->
            <div class="tab-pane fade {{ $activeTab === 'apple' ? 'show active' : 'hidden' }}" id="apple"
                role="tabpanel" aria-labelledby="apple-tab">
                <div>
                    <div class="flex items-center gap-3 mb-5 pb-3 border-b border-gray-100 dark:border-gray-800">
                        <div
                            class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center flex-shrink-0">
                            <i class="fa-brands fa-apple text-gray-700 dark:text-gray-300 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800 dark:text-white">Apple Sign-In Settings</h4>
                            <p class="text-xs text-gray-400 dark:text-gray-500">Configure Apple Sign-In credentials</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('apple.update') }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="_tab" value="apple">

                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 md:col-span-4 flex flex-col gap-1.5">
                                <label for="APPLE_CLIENT_ID" class="form-label">Apple Client ID <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="APPLE_CLIENT_ID" id="APPLE_CLIENT_ID"
                                    class="form-input @error('APPLE_CLIENT_ID') is-invalid @enderror"
                                    placeholder="Enter your Apple Client ID"
                                    value="{{ old('APPLE_CLIENT_ID', env('APPLE_CLIENT_ID')) }}">
                                @error('APPLE_CLIENT_ID')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-12 md:col-span-4 flex flex-col gap-1.5">
                                <label for="APPLE_TEAM_ID" class="form-label">Apple Team ID <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="APPLE_TEAM_ID" id="APPLE_TEAM_ID"
                                    class="form-input @error('APPLE_TEAM_ID') is-invalid @enderror"
                                    placeholder="Enter your Apple Team ID"
                                    value="{{ old('APPLE_TEAM_ID', env('APPLE_TEAM_ID')) }}">
                                @error('APPLE_TEAM_ID')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-12 md:col-span-4 flex flex-col gap-1.5">
                                <label for="APPLE_KEY_ID" class="form-label">Apple Key ID <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="APPLE_KEY_ID" id="APPLE_KEY_ID"
                                    class="form-input @error('APPLE_KEY_ID') is-invalid @enderror"
                                    placeholder="Enter your Apple Key ID"
                                    value="{{ old('APPLE_KEY_ID', env('APPLE_KEY_ID')) }}">
                                @error('APPLE_KEY_ID')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">
                                <i class="fa-solid fa-floppy-disk"></i> <span>Save Apple Settings</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end: Apple Tab-->

            <!--begin: Twilio Tab-->
            <div class="tab-pane fade {{ $activeTab === 'twilio' ? 'show active' : 'hidden' }}" id="twilio"
                role="tabpanel" aria-labelledby="twilio-tab">
                <div>
                    <div class="flex items-center gap-3 mb-5 pb-3 border-b border-gray-100 dark:border-gray-800">
                        <div
                            class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-comment-sms text-green-600 dark:text-green-400 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800 dark:text-white">Twilio SMS Settings</h4>
                            <p class="text-xs text-gray-400 dark:text-gray-500">Configure Twilio SMS service credentials
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('twilio.update') }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="_tab" value="twilio">

                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 md:col-span-4 flex flex-col gap-1.5">
                                <label for="TWILIO_SID" class="form-label">Twilio SID <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="TWILIO_SID" id="TWILIO_SID"
                                    class="form-input @error('TWILIO_SID') is-invalid @enderror"
                                    placeholder="Enter your Twilio SID"
                                    value="{{ old('TWILIO_SID', env('TWILIO_SID')) }}">
                                @error('TWILIO_SID')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-12 md:col-span-4 flex flex-col gap-1.5">
                                <label for="TWILIO_AUTH_TOKEN" class="form-label">Twilio Auth Token <span
                                        class="text-red-500">*</span></label>
                                <div class="relative w-full">
                                    <input type="password" name="TWILIO_AUTH_TOKEN" id="TWILIO_AUTH_TOKEN"
                                        class="form-input pr-10 @error('TWILIO_AUTH_TOKEN') is-invalid @enderror"
                                        placeholder="Enter your Twilio Auth Token"
                                        value="{{ old('TWILIO_AUTH_TOKEN', env('TWILIO_AUTH_TOKEN')) }}">
                                    <button type="button" onclick="togglePassword('TWILIO_AUTH_TOKEN', this)"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none">
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </button>
                                </div>
                                @error('TWILIO_AUTH_TOKEN')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-12 md:col-span-4 flex flex-col gap-1.5">
                                <label for="TWILIO_PHONE_NUMBER" class="form-label">Twilio Phone Number <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="TWILIO_PHONE_NUMBER" id="TWILIO_PHONE_NUMBER"
                                    class="form-input @error('TWILIO_PHONE_NUMBER') is-invalid @enderror"
                                    placeholder="Enter your Twilio Phone Number"
                                    value="{{ old('TWILIO_PHONE_NUMBER', env('TWILIO_PHONE_NUMBER')) }}">
                                @error('TWILIO_PHONE_NUMBER')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">
                                <i class="fa-solid fa-floppy-disk"></i> <span>Save Twilio Settings</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end: Twilio Tab-->

            <!--begin: Stripe Tab-->
            <div class="tab-pane fade {{ $activeTab === 'stripe' ? 'show active' : 'hidden' }}" id="stripe"
                role="tabpanel" aria-labelledby="stripe-tab">
                <div>
                    <div class="flex items-center gap-3 mb-5 pb-3 border-b border-gray-100 dark:border-gray-800">
                        <div
                            class="w-8 h-8 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="fa-brands fa-stripe text-indigo-600 dark:text-indigo-400 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800 dark:text-white">Stripe Payment Settings</h4>
                            <p class="text-xs text-gray-400 dark:text-gray-500">Configure Stripe API keys for payments</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('stripe.update') }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="_tab" value="stripe">

                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 md:col-span-4 flex flex-col gap-1.5">
                                <label for="STRIPE_KEY" class="form-label">Stripe Publishable Key</label>
                                <input type="text" name="STRIPE_KEY" id="STRIPE_KEY"
                                    class="form-input @error('STRIPE_KEY') is-invalid @enderror"
                                    placeholder="Enter your Stripe Publishable Key"
                                    value="{{ old('STRIPE_KEY', env('STRIPE_KEY')) }}">
                                @error('STRIPE_KEY')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-12 md:col-span-4 flex flex-col gap-1.5">
                                <label for="STRIPE_SECRET" class="form-label">Stripe Secret Key</label>
                                <div class="relative w-full">
                                    <input type="password" name="STRIPE_SECRET" id="STRIPE_SECRET"
                                        class="form-input pr-10 @error('STRIPE_SECRET') is-invalid @enderror"
                                        placeholder="Enter your Stripe Secret Key"
                                        value="{{ old('STRIPE_SECRET', env('STRIPE_SECRET')) }}">
                                    <button type="button" onclick="togglePassword('STRIPE_SECRET', this)"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none">
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </button>
                                </div>
                                @error('STRIPE_SECRET')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-12 md:col-span-4 flex flex-col gap-1.5">
                                <label for="STRIPE_WEBHOOK_SECRET" class="form-label">Stripe Webhook Secret</label>
                                <div class="relative w-full">
                                    <input type="password" name="STRIPE_WEBHOOK_SECRET" id="STRIPE_WEBHOOK_SECRET"
                                        class="form-input pr-10 @error('STRIPE_WEBHOOK_SECRET') is-invalid @enderror"
                                        placeholder="Enter your Stripe Webhook Secret"
                                        value="{{ old('STRIPE_WEBHOOK_SECRET', env('STRIPE_WEBHOOK_SECRET')) }}">
                                    <button type="button" onclick="togglePassword('STRIPE_WEBHOOK_SECRET', this)"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none">
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </button>
                                </div>
                                @error('STRIPE_WEBHOOK_SECRET')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">
                                <i class="fa-solid fa-floppy-disk"></i> <span>Save Stripe Settings</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end: Stripe Tab-->

        </div>
        <!--end: Tab Content-->
    </div>
    <!--end: Integration Card-->

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

            // Tab switching function
            function switchTab(tabId, btn) {
                // Save selected tab in localStorage
                localStorage.setItem('activeIntegrationTab', tabId);

                // Remove active state from all tabs
                document.querySelectorAll('#integrationTabs button').forEach(t => {
                    t.classList.remove('active-tab', 'text-primary-600', 'border-primary-500');
                    t.classList.add('text-gray-500', 'border-transparent');
                    t.setAttribute('aria-selected', 'false');
                });

                // Hide all tab panes
                document.querySelectorAll('#integrationTabContent .tab-pane').forEach(p => {
                    p.classList.add('hidden');
                    p.classList.remove('show', 'active');
                });

                // Activate clicked tab
                btn.classList.remove('text-gray-500', 'border-transparent');
                btn.classList.add('active-tab', 'text-primary-600', 'border-primary-500');
                btn.setAttribute('aria-selected', 'true');

                // Show target tab pane
                const target = document.getElementById(tabId);
                if (target) {
                    target.classList.remove('hidden');
                    target.classList.add('show', 'active');
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const hasSessionTab = @json(session()->has('active_tab'));
                const activeTabPhp = "{{ $activeTab }}";

                let tabToActivate = activeTabPhp;
                if (!hasSessionTab && localStorage.getItem('activeIntegrationTab')) {
                    tabToActivate = localStorage.getItem('activeIntegrationTab');
                }

                const btn = document.getElementById(tabToActivate + '-tab');
                if (btn) {
                    switchTab(tabToActivate, btn);
                }
            });
        </script>
    @endpush
@endsection
