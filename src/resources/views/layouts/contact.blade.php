<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <header class="bg-white py-6">
        <div class="relative mx-auto max-w-6xl px-6 text-center">
            <h1 class="text-5xl font-serif tracking-wide text-flbrown">FashionablyLate</h1>
            <p class="mt-2 text-2xl text-flbrown">Contact</p>
        </div>
    </header>

    <main class="min-h-screen bg-flbeige flex justify-center pt-24">
        @yield('content')
    </main>
</body>

</html>