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
        /* Add Tailwind CSS classes here */
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');

        /* Additional custom styles */
        body {
            font-family: 'Figtree', sans-serif;
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        .max-w-7xl {
            max-width: 80rem;
        }

        .mt-16 {
            margin-top: 4rem;
        }

        .p-6 {
            padding: 1.5rem;
        }

        .text-center {
            text-align: center;
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem;
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .leading-relaxed {
            line-height: 1.625;
        }

        .text-gray-600 {
            color: #4b5563;
        }

        .text-gray-900 {
            color: #1a202c;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        .underline {
            text-decoration-line: underline;
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>

<body class="antialiased bg-yellow-100 text-black flex flex-col min-h-screen">

    <div class="min-h-screen bg-gray-100 text-black flex flex-col">
        <div class="flex items-center space-x-2 ml-6 mt-6">
            {{-- Idiomas --}}
            <a href="/locale/es" id="setLocaleEs">
                <img src="{{ asset('images/flag-es.png') }}" alt="English" class="h-4 w-4">
            </a>
            <a href="/locale/pt" id="setLocaleEn">
                <img src="{{ asset('images/flag-pt.png') }}" alt="English" class="h-4 w-4">
            </a>
            <a href="/locale/en" id="setLocaleEn">
                <img src="{{ asset('images/flag-en.png') }}" alt="English" class="h-4 w-4">
            </a>

        </div>
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 flex-col">
                @auth
                    <a href="{{ url('/blog') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Ornithology</a>
                @else
                <a href="{{ route('login') }}"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('Log in') }}</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('Register') }}</a>
                @endif
                @endauth

            </div>
        @endif

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center text-6xl flex-col">
                <x-application-logo class="block h-14 w-auto fill-current text-gray-800 mr-8" />
                <h1>{{ __('Ornithology Blog') }}</h1>
            </div>

            <div class="mt-16">
                <div class="flex flex-col items-center gap-6 lg:gap-8 justify-center">
                    @foreach ($posts['posts'] as $post)
                        <div class="m-5">
                            <h3 class="text-3xl text-black-600">{{ $post['title'] }}</h3>

                            <a class="font-bold text-blue-600 no-underline hover:underline"
                            href="{{ route('posts.show', $post['slug']) }}">{{ __('Read more') }}</a></p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-center mt-16 sm:items-center sm:justify-between">
                <div class="ml-4 text-center text-sm text-black-500 dark:text-black-400 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>

            {{-- <div>
            <h3>{{ __('Posts json') }}</h3>
            @dd($posts)
        </div> --}}
        </div>

</body>

</html>
