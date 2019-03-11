<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-grey-lightest h-screen antialiased">
<div class="flex flex-col">
    <div class="min-h-screen flex items-center justify-center">
        <div class="flex flex-col justify-around h-full">
            <div>
                <h1 class="text-grey-darker text-center font-thin tracking-wide text-5xl mb-6">
                    {{ config('app.name', 'Laravel') }}
                </h1>
                <ul class="list-reset">
                    <li class="inline pr-8">
                        <a href="{{url('/articles')}}" class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase" title="Laracasts">View Articles</a>
                    </li>

                    <li class="inline pr-8">
                        <a href="{{url('/admin/articles')}}" class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase" title="Laracasts">Admin Panel</a>
                    </li>

                    <li class="inline pr-8">
                        <a href="https://github.com/parselynk/mindblog" class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase" title="GitHub">Find this project on Github</a>
                    </li>
                    <li class="inline pr-8">
                        <a href="https://www.linkedin.com/in/reza-karkeh-abadi-8bbb8072/" class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase" title="News">Reza's Linkedin</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>
