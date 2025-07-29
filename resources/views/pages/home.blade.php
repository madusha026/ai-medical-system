@extends('layout.app')

@section('content')
<div class="container w-full px-4 py-12 items-center">
    <div class="text-center flex items-center flex-col justify-center">
        <h1 class="text-4xl md:text-5xl font-bold text-blue-600 mb-4">Welcome to AI Medical System</h1>
        <p class="text-gray-700 max-w-xl mx-auto mb-6">
            Empowering your health decisions with intelligent, accurate, and fast disease detection.
        </p>
        <a href="{{ url('/detect') }}"
           class="inline-block bg-blue-600 text-white px-6 py-3 rounded-full font-medium hover:bg-blue-700 transition">
            Start Detection
        </a>
    </div>

    <!-- Features Section -->
    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="bg-white shadow-lg p-6 rounded-xl text-center">
            <h3 class="text-lg font-semibold mb-2 text-blue-600">AI-Powered Diagnosis</h3>
            <p class="text-gray-600">Leverage machine learning to detect health conditions based on your symptoms.</p>
        </div>
        <div class="bg-white shadow-lg p-6 rounded-xl text-center">
            <h3 class="text-lg font-semibold mb-2 text-blue-600">Remedy Suggestions</h3>
            <p class="text-gray-600">Receive personalized remedies and preventive suggestions from AI algorithms.</p>
        </div>
        <div class="bg-white shadow-lg p-6 rounded-xl text-center">
            <h3 class="text-lg font-semibold mb-2 text-blue-600">Secure and Private</h3>
            <p class="text-gray-600">Your data is encrypted and protected to ensure complete confidentiality.</p>
        </div>
    </div>
</div>
@endsection
