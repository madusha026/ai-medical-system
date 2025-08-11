<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>AI Medical System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- Simple Flat Navbar -->
<nav class="bg-blue-800 text-white shadow-md fixed top-0 left-0 w-full z-50">
  <div class="container mx-auto px-6 py-8 flex justify-between items-center">
    <div class="text-2xl font-bold">AI Medical System</div>
    
    <ul class="flex gap-6 items-center text-md font-medium">
      <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition">Home</a></li>
      <li><a href="{{ route('detect') }}" class="hover:text-blue-400 transition">Detect</a></li>
      <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition">About</a></li>
      <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition">Contact</a></li>

      @auth
        <li>
          <a href="{{ route('profile.edit') }}" class="bg-green-500 hover:bg-green-600 px-3 py-1 rounded text-white text-sm transition">
            Profile
          </a>
        </li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-white text-sm transition">
              Logout
            </button>
          </form>
        </li>
      @endauth

      @guest
        <li><a href="{{ route('login') }}" class="hover:text-blue-400 transition">Login</a></li>
      @endguest
    </ul>
  </div>
</nav>

<!-- Padding for fixed navbar -->
{{-- <div class="pt-24"></div> --}}

</body>
</html>
