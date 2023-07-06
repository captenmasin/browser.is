<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta property="fb:app_id" content="{{ config('myboard.social_media.facebook.app_id') }}"/>
    <meta name="facebook-domain-verification" content="{{ config('myboard.social_media.facebook.domain_verification') }}"/>

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

    <link rel="icon" href="{{ url('favicon.ico?v=2') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ url('favicon.ico?v=2') }}" type="image/x-icon"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css"/>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @include('partials.meta.icons')
    @include('partials.meta.pwa')

    <script defer data-domain="{{ getDomain(config('app.url')) }}" src="https://plausible.io/js/script.tagged-events.js"></script>

    <script>
		window.plausible = window.plausible || function () {
			(window.plausible.q = window.plausible.q || []).push(arguments)
		}
    </script>

    @routes
    <script>
		Ziggy.url = '{{ config('app.url') }}'
    </script>
</head>
