<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- Theme: must run before anything renders to avoid flash --}}
    <script>
        const theme = localStorage.getItem('theme');
        if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />

    {{-- Inertia sets the page title via title() in app.js --}}
    <title inertia>{{ config('app.name', 'Portfolio') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    {{-- Vite compiles app.css + app.js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Inertia head — handles <Head> tags from Vue pages --}}
    @inertiaHead
</head>
<body class="font-sans antialiased">

    {{-- This is the single div Inertia mounts Vue into --}}
    @inertia

</body>
</html>