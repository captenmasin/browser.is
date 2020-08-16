@extends('layouts.default')

@section('body')
    <div class="max-w-7xl mx-auto sm:py-12 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Browser.is
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                        <a href="{{ route('home', ['type' => null]) }}" class="text-blue-500 hover:underline {{ $type == null ? 'font-bold' : '' }}">All</a>
                        <span> / </span>
                        <a href="{{ route('home', ['type' => 'device']) }}" class="text-blue-500 hover:underline {{ $type == 'device' ? 'font-bold' : '' }}">Device</a>
                        <span> / </span>
                        <a href="{{ route('home', ['type' => 'browser']) }}" class="text-blue-500 hover:underline {{ $type == 'browser' ? 'font-bold' : '' }}">Browser</a>
                        <span> / </span>
                        <a href="{{ route('home', ['type' => 'location']) }}" class="text-blue-500 hover:underline {{ $type == 'location' ? 'font-bold' : '' }}">Location</a>
                    </p>
                </div>
                @foreach($data as $title => $values)
                    @if(!$type)
                    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ $title }}
                        </h3>
                    </div>
                    @endif
                    <div>
                        <dl>
                            @foreach($values as $key => $value)
                                <div class="bg-gray-50 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-gray-200 border-b">
                                    <dt class="text-sm leading-5 font-medium text-gray-500">
                                        {{ $key }}
                                    </dt>
                                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
                                        id="{{ \Illuminate\Support\Str::slug($key, '_') }}">
                                        {!! $value !!}
                                    </dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection