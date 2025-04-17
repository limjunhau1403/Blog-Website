<link href="{{ asset('css/components/alertbox.css') }}" rel="stylesheet">
<div>
    @if (session('success'))
        <div id="alert-box" class="alert-box success">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                const alertBox = document.getElementById('alert-box');
                if (alertBox) {
                    alertBox.style.display = 'none';
                }
            }, 3000);
        </script>
    @endif

    @if (session('error'))
        <div id="error-alert-box" class="alert-box error">
            {{ session('error') }}
        </div>
        <script>
            setTimeout(() => {
                const alertBox = document.getElementById('error-alert-box');
                if (alertBox) {
                    alertBox.style.display = 'none';
                }
            }, 3000);
        </script>
    @endif
</div>
