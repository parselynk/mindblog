<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-grey-lightest h-screen antialiased">
    <div id="app">
        <nav class="bg-blue-darkest shadow mb-8 py-6">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-start">
                    <div class="mr-6">
                        <a href="{{ url('/articles') }}" class="text-lg font-semibold text-white no-underline">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="section">
            <main class="container mx-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
