@extends('layout.app')

@section('content')
<section 
    class="relative min-h-screen w-full bg-cover bg-center bg-no-repeat py-16 px-6"
    style="background-image: url('/images/medical.jpg');"
>
    <!-- Overlay (optional) -->
    <div class="absolute inset-0 bg-white/30 backdrop-blur-sm"></div>

    <!-- Content -->
    <div class="max-w-6xl mx-auto bg-white bg-opacity-80 rounded-3xl p-10 backdrop-blur-sm mt-20">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Welcome to the AI Medical Assistant</h1>
            <p class="text-lg md:text-xl text-gray-700">Your personalized health guidance powered by artificial intelligence</p>
        </div>

        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Chatbot -->
            <a href="{{ url('/chatbot') }}" class="group block bg-white p-8 rounded-3xl shadow-xl border border-gray-200 transition-transform hover:-translate-y-2 hover:shadow-2xl">
                <div class="mb-4">
                    <div class="text-3xl font-semibold text-blue-800 mb-2 group-hover:text-blue-900 transition">Medical Chatbot</div>
                    <p class="text-gray-600 group-hover:text-gray-800">Ask health-related questions like "What is fungal infection?" and get instant AI-powered answers.</p>
                </div>
            </a>

            <!-- Detect -->
            <a href="{{ url('/detect') }}" class="group block bg-white p-8 rounded-3xl shadow-xl border border-gray-200 transition-transform hover:-translate-y-2 hover:shadow-2xl">
                <div class="mb-4">
                    <div class="text-3xl font-semibold text-blue-800 mb-2 group-hover:text-blue-900 transition">Disease Detection</div>
                    <p class="text-gray-600 group-hover:text-gray-800">Select symptoms to predict possible diseases and receive intelligent remedy suggestions.</p>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection
