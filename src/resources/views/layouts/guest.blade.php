<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    {{-- 上：白（タイトル） --}}
    <header class="bg-white py-6">
        <div class="relative mx-auto max-w-6xl px-6 text-center">
            <h1 class="text-5xl font-serif tracking-wide text-flbrown">FashionablyLate</h1>
            <p class="mt-2 text-2xl text-flbrown">
                {{ request()->routeIs('register') ? 'Register' : 'Login' }}
            </p>


            {{-- 右上 register（ログイン画面のときだけ表示） --}}
            @if (Route::has('register') && request()->routeIs('login'))
            <div class="absolute right-6 top-6">
                <a href="{{ route('register') }}"
                    class="border border-flbrown px-4 py-1 text-sm text-flbrown">
                    register
                </a>
            </div>
            @endif
        </div>
    </header>

    {{-- 下：ベージュ（フォーム領域） --}}
    <main class="min-h-screen bg-flbeige flex justify-center pt-24">
        {{ $slot }}
    </main>
</body>



</html>