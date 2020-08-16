<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>
        {{ config('app.name') }}
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" data-turbolinks-track="reload"/>

    <meta name="theme-color" content="#fafafa">
</head>

<body class="antialiased font-sans bg-gray-200">

@yield('body')

@if(!config('general.is_staging'))
    <script async src="https://www.google-analytics.com/analytics.js"></script>
    <script>
        window.ga = function () {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', '{{ config('general.ga.id') }}', 'auto');
        ga('set', 'anonymizeIp', true);
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview')
    </script>
@endif
<script src="{{ mix('/js/app.js') }}" async data-turbolinks-track="reload"></script>
</body>

</html>
