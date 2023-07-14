<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

    @if(isset($exception))
        <title>
            {{ $exception->getStatusCode() }} | {{ config('app.name') }}
        </title>
    @endif

    {{--    <title>{!! \Artesaos\SEOTools\Facades\SEOMeta::getTitle() !!}</title>--}}
    <meta name="description" content="{!! \Artesaos\SEOTools\Facades\SEOMeta::getDescription() !!}"/>
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon" media="(prefers-color-scheme: light)"/>
    <link rel="icon" href="{{ url('favicon-white.ico') }}" type="image/x-icon" media="(prefers-color-scheme: dark)"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css"/>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @include('partials.meta.icons')
    @include('partials.meta.pwa')

    <script defer data-domain="{{ App\Services\Helpers::getDomain(config('app.url')) }}" src="https://plausible.io/js/script.tagged-events.js"></script>

    <script>
		window.plausible = window.plausible || function () {
			(window.plausible.q = window.plausible.q || []).push(arguments)
		}
    </script>

    <script data-name="BMC-Widget" data-cfasync="false" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js" data-id="captenmasin" data-description="Support me on Buy me a coffee!" data-message="" data-color="#5F7FFF" data-position="Right" data-x_margin="18" data-y_margin="18"></script>

    @routes
    <script>
		Ziggy.url = '{{ config('app.url') }}'
    </script>
</head>
