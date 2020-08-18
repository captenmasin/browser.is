@if(!config('general.is_staging'))
    <!-- Fathom - beautiful, simple website analytics -->
    <script src="https://cdn.usefathom.com/script.js" site="{{ config('general.fathom.live_id') }}" defer></script>
    <!-- / Fathom -->
@else
    <!-- Fathom - beautiful, simple website analytics -->
    <script src="https://cdn.usefathom.com/script.js" site="{{ config('general.fathom.staging_id') }}" defer></script>
    <!-- / Fathom -->
@endif