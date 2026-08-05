<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Verify Email - T Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script>tailwind.config={theme:{extend:{colors:{primary:{'50':'#fff7ed','100':'#ffedd5','200':'#fed7aa','300':'#fdba74','400':'#fb923c','500':'#f97316','600':'#ea580c','700':'#c2410c','800':'#9a3412','900':'#7c2d12'}}}}}</script>
  <style>*{font-family:'Inter',system-ui,-apple-system,sans-serif}
    .auth-bg{background:linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.8)),url('https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=1920&q=80') center/cover fixed}
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
        <div class="text-center mb-6">
          <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-envelope-circle-check text-3xl text-primary-600"></i>
          </div>
          <h1 class="text-2xl font-extrabold">Verify Your Email</h1>
          <p class="text-gray-500 mt-2">Thanks for signing up! Before getting started, please verify your email address.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
          <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm mb-4">
            <i class="fa-solid fa-check-circle mr-1"></i> A new verification link has been sent to your email.
          </div>
        @endif

        <div class="flex items-center justify-between mt-6">
          <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-full font-semibold text-sm transition flex items-center gap-2 shadow-lg shadow-primary-600/25">
              <i class="fa-solid fa-paper-plane"></i> Resend Verification Email
            </button>
          </form>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-gray-500 hover:text-gray-700 text-sm flex items-center gap-1.5 px-4 py-3 rounded-xl hover:bg-gray-100 transition">
              <i class="fa-solid fa-right-from-bracket"></i> Log Out
            </button>
          </form>
        </div>
      </div>

      <p class="text-center mt-6"><a href="{{ route('login') }}" class="text-gray-400 hover:text-white text-sm"><i class="fa-solid fa-arrow-left mr-1"></i> Back to Login</a></p>
    </div>
  </div>

</body>
</html>
