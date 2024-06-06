<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="canonical" href="{{ request()->url() }}" />
    {{ csrf_field() }}

    @if(isset($exception))
        <title>
            {{ $exception->getStatusCode() }} | {{ config('app.name') }}
        </title>
    @endif

    <meta name="description" content="{!! \Artesaos\SEOTools\Facades\SEOMeta::getDescription() !!}"/>
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon" media="(prefers-color-scheme: light)"/>
    <link rel="icon" href="{{ url('favicon-white.ico') }}" type="image/x-icon" media="(prefers-color-scheme: dark)"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css"/>

    <script defer src="https://api.pirsch.io/pa.js" id="pianjs" data-code="{{ config('analytics.id') }}"></script>

    <script data-name="BMC-Widget" data-cfasync="false" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js" data-id="captenmasin" data-description="Support me on Buy me a coffee!" data-message="" data-color="#5F7FFF" data-position="Right" data-x_margin="18" data-y_margin="18"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9293785362154547" crossorigin="anonymous"></script>

    @routes
    <script>
		Ziggy.url = '{{ config('app.url') }}'
    </script>
</head>
