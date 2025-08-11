@extends('layout.app')

@section('content')
<section class="relative py-16 px-6 overflow-hidden" style="min-height: 100vh;">
    <!-- Background Image (blurred, full) -->
    <div 
        class="absolute inset-0 bg-cover bg-center filter blur-sm opacity-40 -z-10"
        style="background-image: url('/images/medical.jpg');">
    </div>

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Contact Form -->
        <div class="bg-gradient-to-tr from-blue-900/95 to-indigo-900/95 rounded-3xl shadow-2xl p-10 border border-gray-800">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Let’s get in touch</h2>
            <p class="text-gray-500 mb-8">Have a question or want to work together? Send us a message and we’ll get back to you as soon as possible.</p>

            <form action="#" method="POST" class="space-y-6">
                @csrf

                <div class="relative">
                    <input type="text" id="name" name="name" required
                        class="peer w-full px-4 pt-6 pb-2 border border-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <label for="name"
                        class="absolute left-4 top-2 text-gray-500 text-sm peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 transition-all duration-200">
                        Your Name
                    </label>
                </div>

                <div class="relative">
                    <input type="email" id="email" name="email" required
                        class="peer w-full px-4 pt-6 pb-2 border border-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <label for="email"
                        class="absolute left-4 top-2 text-gray-500 text-sm peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 transition-all duration-200">
                        Email Address
                    </label>
                </div>

                <div class="relative">
                    <textarea id="message" name="message" rows="5" required
                        class="peer w-full px-4 pt-6 pb-2 border border-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                    <label for="message"
                        class="absolute left-4 top-2 text-gray-500 text-sm peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 transition-all duration-200">
                        Your Message
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Send Message
                </button>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="relative rounded-3xl overflow-hidden h-full bg-gradient-to-tr from-blue-900/95 to-indigo-900/95  text-black p-10 shadow-lg z-10 border border-gray-800">
            <h3 class="text-3xl font-semibold">Contact Details</h3>
            <p class="text-lg mb-6">Reach out to us via the details below or fill out the form to get started.</p>
            <div class="space-y-3 text-lg">
                <p>📧 <span class="font-medium">support@aimedical.com</span></p>
                <p>📞 <span class="font-medium">+94 77 123 4567</span></p>
                <p>🏢 <span class="font-medium">214, Lotus Avenue, Malabe Tech City</span></p>
            </div>
        </div>
    </div>
</section>
@endsection
