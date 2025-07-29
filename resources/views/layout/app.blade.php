<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
   <title>AI MEDICAL SYSTEM</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-gray-800 flex flex-col w-full min-h-screen font-sans">

    @include('components.navabar')

    
    <!-- Page content -->
    <main class="flex-1 mt-20 w-full">
        @yield('content')
    </main>

    @include('components.footer')

    
</body>
</html>
