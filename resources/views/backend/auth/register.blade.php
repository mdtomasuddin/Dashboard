<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Register - T Dashboard</title>
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
        <h1 class="text-2xl font-extrabold text-center">Create Account</h1>
        <p class="text-gray-500 text-center mt-2">Join T Dashboard today</p>

        <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
          @csrf

          <!-- First Name & Last Name -->
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="first_name" class="block text-sm font-medium mb-1.5">First Name *</label>
              <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required
                class="w-full border-2 @error('first_name') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-3.5 focus:border-primary-600 focus:outline-none"
                placeholder="First">
              @error('first_name')
                <p class="text-red-500 text-xs mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
              @enderror
            </div>
            <div>
              <label for="last_name" class="block text-sm font-medium mb-1.5">Last Name</label>
              <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                class="w-full border-2 @error('last_name') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-3.5 focus:border-primary-600 focus:outline-none"
                placeholder="Last">
              @error('last_name')
                <p class="text-red-500 text-xs mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Phone -->
          <div>
            <label for="phone" class="block text-sm font-medium mb-1.5">Phone Number *</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
              class="w-full border-2 @error('phone') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-3.5 focus:border-primary-600 focus:outline-none"
              placeholder="01XXXXXXXXX">
            @error('phone')
              <p class="text-red-500 text-xs mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
            @enderror
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-medium mb-1.5">Email Address *</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
              class="w-full border-2 @error('email') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-3.5 focus:border-primary-600 focus:outline-none"
              placeholder="your@email.com">
            @error('email')
              <p class="text-red-500 text-xs mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
            @enderror
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="block text-sm font-medium mb-1.5">Password *</label>
            <div class="relative">
              <input type="password" id="password" name="password" required minlength="8"
                class="w-full border-2 @error('password') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-3.5 focus:border-primary-600 focus:outline-none pr-12"
                placeholder="Minimum 8 characters">
              <button type="button" onclick="togglePassword('password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"><i class="fa-regular fa-eye"></i></button>
            </div>
            @error('password')
              <p class="text-red-500 text-xs mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
            @enderror
          </div>

          <!-- Terms -->
          <label class="flex items-start gap-3 cursor-pointer">
            <input type="checkbox" required class="accent-primary-600 w-5 h-5 mt-0.5">
            <span class="text-sm text-gray-600">I agree to the <a href="#" class="text-primary-600 hover:underline">Terms of Service</a> & <a href="#" class="text-primary-600 hover:underline">Privacy Policy</a></span>
          </label>

          <!-- Submit -->
          <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white py-3.5 rounded-full font-bold text-lg transition flex items-center justify-center gap-2">
            <i class="fa-solid fa-user-plus"></i> Create Account
          </button>
        </form>

        <!-- Login Link -->
        <div class="mt-6 text-center">
          <p class="text-gray-500">Already have an account? <a href="{{ route('login') }}" class="text-primary-600 font-semibold hover:underline">Sign In</a></p>
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
