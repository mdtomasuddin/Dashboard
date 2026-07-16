<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tabassum Fashion</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind + Icons -->
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
                    },
                    fontFamily: {
                        sans: ['Figtree', 'Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Figtree', 'Inter', system-ui, -apple-system, sans-serif; }
        .hero-bg {
            background: linear-gradient(135deg, #1a0a00 0%, #2d1400 30%, #1a0a00 70%, #0d0500 100%);
            position: relative;
        }
        .hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=1920&q=80') center/cover fixed;
            opacity: 0.15;
            z-index: 0;
        }
        .hero-content { position: relative; z-index: 1; }
        .glow { box-shadow: 0 0 40px rgba(249, 115, 22, 0.15); }
        .float-anim { animation: float 3s ease-in-out infinite; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 dark:bg-gray-950/90 backdrop-blur-md border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center gap-1">
                    <span class="text-2xl font-extrabold text-primary-600">Tabassum</span>
                    <span class="text-2xl font-extrabold text-gray-900 dark:text-white">Fashion</span>
                </a>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary-600 font-medium transition">
                            <i class="fa-solid fa-gauge-high mr-1"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary-600 font-medium transition">
                            <i class="fa-solid fa-arrow-right-to-bracket mr-1"></i> Sign In
                        </a>
                        <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2.5 rounded-full font-semibold text-sm transition flex items-center gap-2 shadow-lg shadow-primary-600/25">
                            <i class="fa-solid fa-user-plus"></i> Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg min-h-screen flex items-center justify-center py-24 px-4">
        <div class="hero-content max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 bg-primary-600/10 border border-primary-600/20 rounded-full px-4 py-1.5 mb-6">
                <span class="w-2 h-2 bg-primary-500 rounded-full animate-pulse"></span>
                <span class="text-primary-400 text-sm font-medium">Premium Fashion Destination</span>
            </div>
            
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white leading-tight mb-6">
                Elevate Your
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-primary-600">Style</span>
                <br>With Confidence
            </h1>
            
            <p class="text-gray-400 text-lg sm:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
                Discover the latest trends in fashion. From casual elegance to bold statements — 
                Tabassum Fashion brings you the finest collection curated just for you.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-8 py-4 rounded-full font-bold text-lg transition flex items-center gap-3 shadow-xl shadow-primary-600/30 glow">
                        <i class="fa-solid fa-gauge-high"></i> Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-8 py-4 rounded-full font-bold text-lg transition flex items-center gap-3 shadow-xl shadow-primary-600/30 glow">
                        <i class="fa-solid fa-user-plus"></i> Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="border-2 border-gray-600 hover:border-primary-600 text-gray-300 hover:text-white px-8 py-4 rounded-full font-bold text-lg transition flex items-center gap-3">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Sign In
                    </a>
                @endauth
            </div>

            <!-- Stats -->
            <div class="mt-16 grid grid-cols-3 gap-8 max-w-lg mx-auto">
                <div class="text-center">
                    <div class="text-3xl font-extrabold text-white">10K+</div>
                    <div class="text-gray-500 text-sm mt-1">Happy Customers</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-extrabold text-white">500+</div>
                    <div class="text-gray-500 text-sm mt-1">Products</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-extrabold text-white">99%</div>
                    <div class="text-gray-500 text-sm mt-1">Satisfaction</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-20 px-4 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-14">
                <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">Why Choose <span class="text-primary-600">Tabassum</span>?</h2>
                <p class="text-gray-500 max-w-xl mx-auto">Experience the perfect blend of quality, style, and convenience.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:border-primary-200 dark:hover:border-primary-700 transition-all duration-300">
                    <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-truck-fast text-primary-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Free Shipping</h3>
                    <p class="text-gray-500 text-sm">Free delivery on all orders above $50. Fast and reliable shipping worldwide.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:border-primary-200 dark:hover:border-primary-700 transition-all duration-300">
                    <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-rotate-left text-primary-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Easy Returns</h3>
                    <p class="text-gray-500 text-sm">30-day hassle-free return policy. We make sure you love your purchase.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:border-primary-200 dark:hover:border-primary-700 transition-all duration-300">
                    <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-shield-halved text-primary-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Secure Payment</h3>
                    <p class="text-gray-500 text-sm">100% secure checkout. Your payment information is always protected.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-950 text-gray-400 py-10 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <div class="flex items-center justify-center gap-1 mb-4">
                <span class="text-xl font-extrabold text-primary-500">Tabassum</span>
                <span class="text-xl font-extrabold text-white">Fashion</span>
            </div>
            <p class="text-sm">&copy; {{ date('Y') }} Tabassum Fashion. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
