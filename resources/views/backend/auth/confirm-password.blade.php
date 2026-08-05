<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Confirm Password - T Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            '50': '#fff7ed',
                            '100': '#ffedd5',
                            '200': '#fed7aa',
                            '300': '#fdba74',
                            '400': '#fb923c',
                            '500': '#f97316',
                            '600': '#ea580c',
                            '700': '#c2410c',
                            '800': '#9a3412',
                            '900': '#7c2d12'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif
        }

        .auth-bg {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url('https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=1920&q=80') center/cover fixed
        }
    </style>
</head>

<body>

    <div class="min-h-screen auth-bg flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-1">
                    <span class="text-3xl font-extrabold text-primary-500">T</span>
                    <span class="text-3xl font-extrabold text-white">Dashboard</span>
                </a>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-2xl">
                <h1 class="text-2xl font-extrabold text-center">Confirm Password</h1>
                <p class="text-gray-500 text-center mt-2">This is a secure area. Please confirm your password before
                    continuing.</p>

                <form method="POST" action="{{ route('password.confirm') }}" class="mt-8 space-y-5">
                    @csrf

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium mb-1.5">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                autocomplete="current-password"
                                class="w-full border-2 @error('password') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-3.5 focus:border-primary-600 focus:outline-none pr-12"
                                placeholder="Enter your password">
                            <button type="button" onclick="togglePassword('password', this)"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"><i
                                    class="fa-regular fa-eye"></i></button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1.5"><i
                                    class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full bg-primary-600 hover:bg-primary-700 text-white py-3.5 rounded-full font-bold transition flex items-center justify-center gap-2 shadow-lg shadow-primary-600/25">
                        <i class="fa-solid fa-lock"></i> Confirm
                    </button>
                </form>

                <p class="text-center mt-6"><a href="{{ route('login') }}"
                        class="text-gray-400 hover:text-gray-600 text-sm"><i class="fa-solid fa-arrow-left mr-1"></i>
                        Back to Login</a></p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
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
</body>

</html>
