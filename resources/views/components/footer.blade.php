<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<!-- Footer -->
<footer class="bg-blue-800 text-white py-10 ">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- About -->
        <div>
            <h3 class="text-lg font-bold mb-4">About</h3>
            <p class="text-sm leading-relaxed text-gray-300">
                AI Medical System empowers health decisions through intelligent disease detection and remedy recommendations, making healthcare accessible and smarter.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-lg font-bold mb-4">Quick Links</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/') }}" class="hover:text-blue-400 transition">Home</a></li>
                <li><a href="{{ url('/detect') }}" class="hover:text-blue-400 transition">Detect</a></li>
                <li><a href="{{ url('/about') }}" class="hover:text-blue-400 transition">About</a></li>
                <li><a href="{{ url('/contact') }}" class="hover:text-blue-400 transition">Contact</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h3 class="text-lg font-bold mb-4">Contact</h3>
            <p class="text-sm text-gray-300">Email: <a href="mailto:support@aimedical.com" class="hover:text-blue-400">support@aimedical.com</a></p>
            <p class="text-sm text-gray-300">Phone: +94 77 123 4567</p>
        </div>
    </div>

    <div class="border-t border-gray-700 mt-10 pt-6 text-center text-xs text-gray-400">
        © {{ date('Y') }} AI Medical System. All rights reserved.
    </div>
</footer>

</body>
</html>
