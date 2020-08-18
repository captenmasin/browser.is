@if(is_staging())
    <script src="https://cdn.usefathom.com/script.js" site="{{ config('general.fathom.live_id') }}" defer></script>
@else
    <script src="https://cdn.usefathom.com/script.js" site="{{ config('general.fathom.staging_id') }}" defer></script>
@endif