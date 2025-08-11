@extends('layout.app')

@section('content')
<section 
    class="relative min-h-screen w-full bg-cover bg-center bg-no-repeat py-16 px-6"
    style="background-image: url('/images/medical.jpg');"
>
    <!-- Overlay -->
    <div class="absolute inset-0 bg-white/30 backdrop-blur-sm"></div>

    <!-- Content Card -->
    <div class="max-w-md mx-auto bg-white bg-opacity-80 rounded-3xl p-10 backdrop-blur-sm mt-20 shadow-xl border border-gray-200 relative z-10">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Patient Registration</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-6">
                <label for="name" class="block font-semibold text-gray-700 mb-2">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            </div>

            <div class="mb-6">
                <label for="email" class="block font-semibold text-gray-700 mb-2">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            </div>

            <div class="mb-6">
                <label for="phone" class="block font-semibold text-gray-700 mb-2">Phone Number</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            </div>

            <div class="mb-6">
                <label for="address" class="block font-semibold text-gray-700 mb-2">Address</label>
                <textarea id="address" name="address" rows="2"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('address') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="password" class="block font-semibold text-gray-700 mb-2">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            </div>

            <div class="mb-8">
                <label for="password_confirmation" class="block font-semibold text-gray-700 mb-2">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            </div>

            <button type="submit"
                class="w-full bg-[#0F172A] text-white font-bold text-xl py-4 rounded-xl shadow-lg hover:brightness-110 transition">
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-gray-700">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-[#193984] font-bold hover:underline">Login here</a>
        </p>
    </div>
</section>
@endsection
