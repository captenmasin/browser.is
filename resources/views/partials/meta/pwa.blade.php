<meta name="theme-color" content="{{ config('pwa.manifest.background_color') }}">

<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="{{ config('app.name') }}">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="{{ config('pwa.manifest.status_bar') }}">
<meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
<meta name="msapplication-TileImage" content="/images/pwa/icons/512x512.png">

<link rel="manifest" href="{{ url('manifest.json') }}" crossorigin="use-credentials">


<script type="text/javascript">
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js', {
            scope: '.'
        }).then(async () => {
            const registration = navigator.serviceWorker.ready;
            if ('periodicSync' in registration) {
                const status = await navigator.permissions.query({
                    name: 'periodic-background-sync',
                });
                if (status.state === 'granted') {
                    try {
                        await registration.periodicSync.register('all', {
                            minInterval: 24 * 60 * 60 * 1000
                        });
                        console.log('Periodic background sync registered!');
                    } catch (e) {
                        console.error(`Periodic background sync failed:\n${e}`);
                    }
                }
            }
        });

        self.addEventListener('periodicsync', (event) => {
           console.log('Periodicsync')
        });
    }
</script>
