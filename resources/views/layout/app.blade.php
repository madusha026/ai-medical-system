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

    @yield('notify')

    <a href="{{ url('/chatbot') }}" class="fixed bottom-4 right-6 z-50 group">
        <div class="w-14 h-14 mb-20 bg-[#ffffff] border-4 border-[#0F172A] rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-all duration-300 animate-bounce">
            <i class="fas fa-robot text-[#0F172A] text-xl"></i>
        </div>
    </a>

    
    <!-- Page content -->
    <main class="flex-1 mt-20 w-full">
        @yield('content')
    </main>

    

    @include('components.footer')

    
</body>
</html>
