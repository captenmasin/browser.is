@extends('layouts.default')

@section('body')
    <div class="max-w-7xl mx-auto pt-6 px-6 lg:px-8" x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-cloak>
        <header class="flex justify-between flex-col md:flex-row">
            <div class="flex flex-col mb-2 md:mb-8 text-center md:text-left">
                <h1>
                    <a href="/">
                        <img src="/images/logo.svg" width="200" alt="Browser.is SVG logo" class="mx-auto md:mx-0"/>
                    </a>
                </h1>
                <small>
                    Quick and easy information
                </small>
            </div>
        </header>


        <main class="max-w-4xl mx-auto">
            <div class="bg-white border border-black/25 overflow-hidden sm:rounded-sm" id="data">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6 bg-gray-100 bg-opacity-75">
                    <nav class="max-w-2xl text-sm leading-5 text-gray-600" id="nav-links">
                        <a href="{{ route('home', ['type' => null]) }}"
                           class="text-primary hover:underline {{ $type == null ? 'font-black' : '' }}">All</a>
                        <span> / </span>
                        <a href="{{ route('home', ['type' => 'device']) }}"
                           class="text-primary hover:underline {{ $type == 'device' ? 'font-black' : '' }}">Device</a>
                        <span> / </span>
                        <a href="{{ route('home', ['type' => 'browser']) }}"
                           class="text-primary hover:underline {{ $type == 'browser' ? 'font-black' : '' }}">Browser</a>
                        <span> / </span>
                        <a href="{{ route('home', ['type' => 'location']) }}"
                           class="text-primary hover:underline {{ $type == 'location' ? 'font-black' : '' }}">Location</a>
                    </nav>
                </div>
                @foreach($data as $title => $values)
                    @if(!$type)
                        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                            <h3 class="text-lg leading-6 font-black text-gray-900">
                                {{ $title }}
                            </h3>
                        </div>
                    @endif
                    <div>
                        <dl>
                            @foreach($values as $key => $value)
                                <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-gray-200 @if(!$loop->last) border-b @endif">
                                    <dt class="text-sm leading-5 font-medium text-primary">
                                        {{ $key }}
                                    </dt>
                                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2 font-mono"
                                        id="{{ \Illuminate\Support\Str::slug($key, '_') }}">
                                        {!! $value !!}
                                    </dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                @endforeach
            </div>
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9293785362154547"
                    crossorigin="anonymous"></script>
            <!-- Browser.is - primary -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-9293785362154547"
                 data-ad-slot="5503343588"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
		        (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            <div class="mt-4 flex space-y-4 sm:space-y-0 mb-4 sm:space-x-4 flex-col sm:flex-row w-100 px-4 sm:px-0">
                <button type="button" class="btn btn-primary w-full sm:w-1/2 " x-data="{ clicked:false }" @click="copyClipboard(); clicked=true">
                    <template x-if="!clicked">
                        <span class="flex mx-auto">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="-ml-1 mr-2 h-5 w-5">
                                <path d="M8 2a1 1 0 000 2h2a1 1 0 100-2H8z"></path>
                                <path d="M3 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v6h-4.586l1.293-1.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L10.414 13H15v3a2 2 0 01-2 2H5a2 2 0 01-2-2V5zM15 11h2a1 1 0 110 2h-2v-2z"></path>
                            </svg>
                            Copy to clipboard
                        </span>
                    </template>
                    <template x-if="clicked" class="flex">
                        <span class="flex mx-auto">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="-ml-1 mr-2 h-5 w-5">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd"
                                      d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            Copied
                        </span>
                    </template>
                </button>
                <button type="button" class="btn w-full sm:w-1/2 " x-data="{ clicked:false }"
                        @click="saveImage(); clicked=false">
                    <span class="flex mx-auto">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="-ml-1 mr-2 h-5 w-5">
                            <path fill-rule="evenodd"
                                  d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        Save screenshot
                    </span>
                </button>
            </div>

            <div class="mt-12 text-center">
                <p class="text-2xl font-bold">
                    What is browser.is?
                </p>
                <div class="space-y-4">
                    <p>
                        Browser.is is a quick, easy, accessible way to display and share data about your browser/device/location.
                    </p>
                    <p>
                        It's great for debugging issues on sites or apps and provides a nice friendly UI to share these details with developers or I.T support.
                    </p>
                    <p>
                        No data is ever stored on our server, nor do we share anything with any third parties.
                    </p>
                </div>
            </div>

        </main>
    </div>

    <footer class="mt-16 px-6 py-6 text-xs font-bold">
        © {{ date('Y') }} Browser.is - All rights reserved
    </footer>
@endsection
