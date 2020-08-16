@if(!config('general.is_staging'))
    <script async src="https://www.google-analytics.com/analytics.js"></script>
    <script>
        window.ga = function () {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', '{{ config('general.ga.id') }}', 'auto');
        ga('set', 'anonymizeIp', true);
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview')
    </script>
@endif