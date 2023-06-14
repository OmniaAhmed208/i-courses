@if (session('success'))
    <script>
        setTimeout(function () {
            new Noty({
                type: 'success',
                layout: '{{ app()->getLocale() == 'ar' ? 'topLeft' : 'topRight' }}',
                text: "{{ session('success') }}",
                timeout: 5000,
                killer: true
            }).show();
        }, 1000);
    </script>
@endif

@if (session('status'))
    <script>
        setTimeout(function () {
            new Noty({
                type: 'success',
                layout: '{{ app()->getLocale() == 'ar' ? 'topLeft' : 'topRight' }}',
                text: "{{ session('status') }}",
                timeout: 5000,
                killer: true
            }).show();
        }, 1000);
    </script>
@endif

@if (session('error'))
    <script>
        setTimeout(function () {
            new Noty({
                type: 'error',
                layout: '{{ app()->getLocale() == 'ar' ? 'topLeft' : 'topRight' }}',
                text: "{{ session('error') }}",
                timeout: 5000,
                killer: true
            }).show();
        }, 1000);
    </script>
@endif
