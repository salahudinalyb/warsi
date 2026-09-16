<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50 dark:bg-gray-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Rimbawan' }} | Rimbawan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>[x-cloak]{display:none!important;}</style>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                theme: 'light',
                init() {
                    const saved = localStorage.getItem('theme');
                    this.theme = saved === 'dark' ? 'dark' : 'light';
                    this.updateTheme();
                },
                toggle() {
                    this.theme = this.theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.theme);
                    this.updateTheme();
                },
                updateTheme() {
                    document.documentElement.classList.toggle('dark', this.theme === 'dark');
                }
            });
        });
    </script>
    <script>
        (function() {
            const saved = localStorage.getItem('theme');
            if (saved === 'dark') document.documentElement.classList.add('dark');
        })();
    </script>
</head>

<body class="flex min-h-full flex-col bg-gray-50 dark:bg-gray-900" x-data>
    @include('components.public.navbar')

    <main class="flex-1">
        @yield('content')
    </main>

    @yield('footer')
</body>

@stack('scripts')

</html>
