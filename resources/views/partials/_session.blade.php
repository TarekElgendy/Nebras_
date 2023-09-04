{{--check this url for more options  https://notifyjs.jpillora.com/ --}}

@if (session('success'))

    <script>
        new Noty({
            type: 'success', //success error warning  info
            layout: 'topRight',
            text: "{{ session('success') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif


@if (session('error'))

    <script>
        new Noty({
            type: 'error', //success error warning  info
            layout: 'topRight',
            text: "{{ session('error') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif
@if (session('warning'))

    <script>
        new Noty({
            type: 'warning',//success error warning  info
            layout: 'topRight',
            text: "{{ session('warning') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif
@if (session('info'))

    <script>
        new Noty({
            type: 'info',//success error warning  info
            layout: 'topRight',
            text: "{{ session('info') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif
