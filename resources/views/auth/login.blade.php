@extends('layout.app')

@section('content')
<section
    class="relative min-h-screen w-full bg-cover bg-center flex items-center justify-center px-4"
    style="background-image: url('/images/medical.jpg');"
>
    <!-- Dark Blue Overlay -->
    <div class="absolute inset-0 bg-[#193984cc]"></div>

    <!-- Form Container -->
    <div class="relative w-150 px-20 bg-white rounded-2xl shadow-2xl">
        <h2 class="text-4xl font-extrabold text-[#0F172A] mt-10 mb-10 text-center tracking-tight">Patient Login</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-8">
            @csrf

            <div>
                <label for="email" class="block mb-3 font-semibold text-[#0F172A] uppercase tracking-wide text-lg">
                    Email Address
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="you@example.com"
                    class="w-full border border-gray-300 rounded-xl px-5 py-4 text-lg text-gray-900 placeholder-gray-400 shadow-sm transition focus:outline-none focus:ring-4 focus:ring-[#193984] focus:border-[#193984]"
                />
            </div>

            <div>
                <label for="password" class="block mb-3 font-semibold text-[#0F172A] uppercase tracking-wide text-lg">
                    Password
                </label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    placeholder="Enter your password"
                    class="w-full border border-gray-300 rounded-xl px-5 py-4 text-lg text-gray-900 placeholder-gray-400 shadow-sm transition focus:outline-none focus:ring-4 focus:ring-[#193984] focus:border-[#193984]"
                />
            </div>

            <div class="flex items-center space-x-3">
                <input id="remember" type="checkbox" name="remember" class="h-5 w-5 text-[#193984] focus:ring-[#193984] border-gray-300 rounded" />
                <label for="remember" class="text-[#0F172A] text-lg select-none">Remember Me</label>
            </div>

            <button
                type="submit"
                class="w-full bg-[#0F172A] text-white font-bold text-xl py-4 rounded-xl shadow-lg hover:brightness-110 transition"
            >
                Login
            </button>
        </form>

        <p class="mt-10 mb-10 text-center text-[#0F172A] text-lg">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-[#193984] font-bold hover:underline">Register here</a>
        </p>
    </div>
</section>
@endsection
