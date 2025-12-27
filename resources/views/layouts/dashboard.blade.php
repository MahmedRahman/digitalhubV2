<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(app()->environment('local', 'development'))
    <meta http-equiv="Content-Security-Policy" content="default-src * 'unsafe-inline' 'unsafe-eval' data: blob:; script-src * 'unsafe-inline' 'unsafe-eval'; style-src * 'unsafe-inline'; img-src * data: blob:; font-src * data:; connect-src * ws: wss:; frame-src *;">
    @endif

    <title>@yield('title', 'لوحة التحكم') - Digital Hub Academy</title>
    <meta name="description" content="@yield('description', 'لوحة تحكم إدارة المحتوى')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="antialiased bg-bgSoft">
    <div class="min-h-screen">
        <!-- Dashboard Layout -->
        <div class="flex">
            <!-- Sidebar -->
            @include('dashboard.partials.sidebar')

            <!-- Main Content -->
            <div class="flex-1 lg:mr-64">
                <!-- Top Navigation -->
                @include('dashboard.partials.navbar')

                <!-- Page Content -->
                <main class="p-6 lg:p-8">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>

