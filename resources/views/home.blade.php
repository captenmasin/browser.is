<link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
<script src="{{ mix('/js/app.js') }}"></script>


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