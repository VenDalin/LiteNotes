<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const themeToggleBtn = document.getElementById('theme-toggle');
                const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
                const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

                // Check the initial theme preference
                if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                    themeToggleLightIcon.classList.remove('hidden');
                } else {
                    document.documentElement.classList.remove('dark');
                    themeToggleDarkIcon.classList.remove('hidden');
                }

                themeToggleBtn.addEventListener('click', function () {
                    // Toggle icons inside the button
                    themeToggleDarkIcon.classList.toggle('hidden');
                    themeToggleLightIcon.classList.toggle('hidden');

                    // If theme is set in localStorage
                    if (localStorage.getItem('theme')) {
                        if (localStorage.getItem('theme') === 'light') {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('theme', 'dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('theme', 'light');
                        }
                    // If theme is NOT set in localStorage
                    } else {
                        if (document.documentElement.classList.contains('dark')) {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('theme', 'light');
                        } else {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('theme', 'dark');
                        }
                    }
                });
            });
        </script>
    </body>
</html>
