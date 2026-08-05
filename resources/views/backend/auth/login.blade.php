<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login - T Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script>tailwind.config={theme:{extend:{colors:{primary:{'50':'#fff7ed','100':'#ffedd5','200':'#fed7aa','300':'#fdba74','400':'#fb923c','500':'#f97316','600':'#ea580c','700':'#c2410c','800':'#9a3412','900':'#7c2d12'}}}}}</script>
  <style>*{font-family:'Inter',system-ui,-apple-system,sans-serif}
    .auth-bg{background:linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.8)),url('https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=1920&q=80') center/cover fixed}
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
        <h1 class="text-2xl font-extrabold text-center">Welcome Back!</h1>
        <p class="text-gray-500 text-center mt-2">Sign in to your account</p>

        <!-- Session Status -->
        @if (session('status'))
          <div class="mt-4 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm">
            <i class="fa-solid fa-check-circle mr-1"></i>{{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
          @csrf

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-medium mb-1.5">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
              class="w-full border-2 @error('email') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-3.5 focus:border-primary-600 focus:outline-none"
              placeholder="your@email.com">
            @error('email')
              <p class="text-red-500 text-xs mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
            @enderror
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="block text-sm font-medium mb-1.5">Password</label>
            <div class="relative">
              <input type="password" id="password" name="password" required
                class="w-full border-2 @error('password') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-3.5 focus:border-primary-600 focus:outline-none pr-12"
                placeholder="••••••••">
              <button type="button" onclick="togglePassword('password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"><i class="fa-regular fa-eye"></i></button>
            </div>
            @error('password')
              <p class="text-red-500 text-xs mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
            @enderror
          </div>

          <!-- Remember Me & Forgot Password -->
          <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="checkbox" name="remember" class="accent-primary-600 w-4 h-4"> <span class="text-sm text-gray-600">Remember me</span>
            </label>
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:underline">Forgot Password?</a>
            @endif
          </div>

          <!-- Submit -->
          <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white py-3.5 rounded-full font-bold text-lg transition flex items-center justify-center gap-2">
            <i class="fa-solid fa-arrow-right-to-bracket"></i> Sign In
          </button>
        </form>

        <!-- Register Link -->
        <div class="mt-6 text-center">
          <p class="text-gray-500">Don't have an account? <a href="{{ route('register') }}" class="text-primary-600 font-semibold hover:underline">Register</a></p>
        </div>

        <!-- Divider -->
        <div class="mt-6 flex items-center gap-4">
          <hr class="flex-1 border-gray-200">
          <span class="text-gray-400 text-sm">or continue with</span>
          <hr class="flex-1 border-gray-200">
        </div>

        <!-- Social Buttons -->
        <div class="mt-6 grid grid-cols-2 gap-3">
          <button class="border-2 border-gray-200 rounded-xl py-3 flex items-center justify-center gap-2 hover:border-gray-400 transition font-medium">
            <i class="fa-brands fa-google text-red-500"></i> Google
          </button>
          <button class="border-2 border-gray-200 rounded-xl py-3 flex items-center justify-center gap-2 hover:border-gray-400 transition font-medium">
            <i class="fa-brands fa-facebook text-blue-600"></i> Facebook
          </button>
        </div>
      </div>

      <p class="text-center mt-6"><a href="{{ route('login') }}" class="text-gray-400 hover:text-white text-sm"><i class="fa-solid fa-arrow-left mr-1"></i> Back to Home</a></p>
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
