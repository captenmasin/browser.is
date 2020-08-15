@extends('layouts.default')

@section('body')
<ul>
    @foreach($data as $key => $value)
    <li>
        <strong>
            {{ $key }}:
        </strong>
        <span>
            {!! $value !!}
        </span>
    </li>
    @endforeach
</ul>
@endsection