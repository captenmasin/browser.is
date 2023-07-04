<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>
        {{ config('app.name') }}
    </title>
    <meta name="description" content="Get details about your browser/device/location for easier site checking and bug replicability">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:image" content="{{ config('app.url') }}/images/social.png">

    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#428DFF">
    <link rel="manifest" href="site.webmanifest">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" data-turbolinks-track="reload"/>
    @include('partials.analytics')
    @include('partials.ads')
</head>

<body class="antialiased font-sans" style="background-color: #F4F4F5">
@yield('body')
<script src="{{ mix('/js/app.js') }}" async></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
