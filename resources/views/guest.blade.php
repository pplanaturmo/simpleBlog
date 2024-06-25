<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Styles for login/register buttons */
        .login-register {
            position: fixed;
            top: 0;
            right: 0;
            padding: 1rem;
            display: flex;
            gap: 1rem;
        }

        /* Styles for posts container */
        .posts-container {
            margin-top: 8rem; /* Adjust as needed */
        }
    </style>
</head>
<body class="antialiased">
    <div class="login-register">
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/blog') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <div class="max-w-7xl mx-auto p-6 lg:p-8 posts-container">
        <!-- Your existing code for the logo and posts goes here -->
        <div class="flex justify-center">
            <!-- Your existing SVG logo code -->
        </div>

        <div class="mt-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <!-- Your existing code for the posts goes here -->
            </div>
        </div>
    </div>
</body>
</html>
