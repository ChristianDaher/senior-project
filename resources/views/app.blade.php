<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Terra - AI') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="/logo-bg.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead

    <!-- Light mode Dark mode -->
    <script>
        if (
            localStorage.getItem('data-theme') === 'dark' ||
            (!('data-theme' in localStorage) &&
                window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.setAttribute("data-theme", "dark");
        } else {
            document.documentElement.setAttribute("data-theme", "light");
        }
    </script>
</head>

<body class="font-primary antialiased">
    @inertia
</body>

</html>