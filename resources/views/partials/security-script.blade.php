<script>
    // Disable Right Click
    document.addEventListener('contextmenu', event => event.preventDefault());

    // Disable Shortcuts for DevTools
    document.onkeydown = function (e) {
        if (e.keyCode == 123) { // F12
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) { // Ctrl+Shift+I
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) { // Ctrl+Shift+J
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) { // Ctrl+U
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) { // Ctrl+Shift+C
            return false;
        }
    }

    // Disable Selection
    document.onselectstart = function () {
        return false;
    }

    // --- 🛡️ MACHINE LOCK & TRACKING SYSTEM ---
    const getGPU = () => {
        const canvas = document.createElement('canvas');
        const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
        if (!gl) return 'GPU N/A';
        const debugInfo = gl.getExtension('WEBGL_debug_renderer_info');
        return debugInfo ? gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL) : 'Unknown GPU';
    };

    const generateFingerprint = () => {
        const fp = btoa([
            navigator.userAgent,
            screen.width,
            screen.height,
            screen.colorDepth,
            navigator.hardwareConcurrency,
            getGPU()
        ].join('|')).substring(0, 32);

        // Save to cookie for middleware to see immediately
        document.cookie = "device_fingerprint=" + fp + "; path=/; max-age=" + (60 * 60 * 24 * 365);
        return fp;
    };

    @auth
        (function () {
            const trackingData = {
                screen_resolution: window.screen.width + 'x' + window.screen.height,
                browser_fingerprint: generateFingerprint(),
                cpu_cores: navigator.hardwareConcurrency || 'N/A',
                gpu_info: getGPU(),
                timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
                language: navigator.language,
                ipv4: null
            };

            // First Sync (Hardware Only)
            syncTracking(trackingData);

            // Fetch IPv4
            fetch('https://api.ipify.org?format=json')
                .then(res => res.json())
                .then(data => {
                    trackingData.ipv4 = data.ip;
                    syncTracking(trackingData);
                }).catch(() => { });

            function syncTracking(payload) {
                fetch("{{ route('dashboard.location') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(payload)
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.error === 'multi_device') {
                            window.location.href = "{{ route('device.blocked') }}";
                        }
                    }).catch(() => { });
            }
        })();
    @endauth
</script>