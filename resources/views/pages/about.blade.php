@extends('layout.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-cover bg-center" style="background-image: url('/images/medical.jpg');">
    <div class="bg-[#193984cc] w-full h-full py-20">
        <div class="max-w-4xl mx-auto px-6 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">About AI Medical System</h1>
            <p class="text-lg md:text-xl font-light">Empowering health decisions with AI technology</p>
        </div>
    </div>


<!-- About Content Section -->
<section class="max-w-6xl mx-auto px-6 py-16">
    <div class="bg-white shadow-xl rounded-3xl p-10 space-y-10">
        <p class="text-lg leading-relaxed text-gray-700">
            The <strong>AI Medical System</strong> is a cutting-edge web platform designed to assist individuals in identifying potential diseases based on symptoms and receiving smart remedy suggestions powered by Artificial Intelligence.
        </p>

        <p class="text-lg leading-relaxed text-gray-700">
            Our mission is to make healthcare assistance accessible, fast, and reliable through innovative digital solutions. The system integrates powerful machine learning models trained on real-world medical datasets to enhance early detection and personalized care recommendations.
        </p>

        <p class="text-lg leading-relaxed text-gray-700">
            Whether you're experiencing common symptoms or seeking preventative advice, our system aims to provide intelligent insights to support your health journey — all in just a few clicks.
        </p>

        <div>
            <h2 class="text-2xl font-semibold text-[#0F172A] mb-4">Key Features</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li>Symptom-based disease prediction</li>
                <li>Remedy recommendations powered by AI</li>
                <li>Fast, user-friendly, and mobile-responsive interface</li>
                <li>Secure and privacy-conscious system</li>
            </ul>
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-[#0F172A] mb-4">Our Vision</h2>
            <p class="text-lg leading-relaxed text-gray-700">
                We envision a future where technology and healthcare work hand-in-hand to provide accurate, timely, and accessible care to everyone — regardless of geography or socioeconomic status.
            </p>
        </div>
    </div>
</section>

</section>
@endsection
