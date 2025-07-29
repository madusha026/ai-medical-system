<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>AI Medical System</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
<nav class="h-20 bg-[#0F172A] text-white shadow-md flex items-center fixed w-screen px-6 z-50 top-0">
  <ul class="flex justify-center items-center gap-40 container mx-auto">

    <!-- Reusable Dropdown Menu -->
    @php
        $navItems = [
            'Home' => [
                'icon' => 'home.png',
                'links' => [['label' => 'Home', 'route' => 'home']]
            ],
            'Detect' => [
                'icon' => 'detect.png',
                'links' => [
                    ['label' => 'Disease Detection', 'route' => 'Detect Symptoms']
                ]
            ],
        ];
    @endphp

    @foreach($navItems as $label => $item)
      <li class="relative dropdown">
        <button class="flex items-center gap-2 dropdown-toggle focus:outline-none hover:text-blue-400">
          <img src="{{ asset('icons/' . $item['icon']) }}" alt="{{ $label }}" class="w-5 h-5" />
          <span class="text-base">{{ $label }}</span>
        </button>

        <!-- Dropdown Items -->
        <ul class="dropdown-menu hidden absolute top-full left-0 mt-2 bg-white text-black shadow-lg rounded-md w-56 z-50 py-2">
            @foreach ($item['links'] as $link)
                <li>
                    @if (is_array($link))
                        <a href="{{ route($link['route']) }}"
                        class="block px-4 py-2 text-sm hover:bg-blue-100 border-b last:border-b-0">
                            {{ $link['label'] }}
                        </a>
                    @else
                        <span class="block px-4 py-2 text-sm text-gray-700 border-b last:border-b-0">
                            {{ $link }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ul>
      </li>
    @endforeach

  </ul>
</nav>
</body>
</html>
