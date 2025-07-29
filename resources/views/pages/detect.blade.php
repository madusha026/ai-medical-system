@extends('layout.app')

@section('content')
<section class="max-w-4xl mx-auto px-6">
    <h2 class="text-4xl font-extrabold mb-10 text-center text-indigo-700 tracking-tight">
        Symptom Detection
    </h2>

    <form id="symptomForm" method="POST" action="{{ url('/detect-result') }}" 
          class="space-y-10 bg-white p-10 rounded-3xl shadow-xl border border-gray-200">
        @csrf

        {{-- Predefined Symptoms --}}
        <fieldset>
            <legend class="text-xl font-semibold mb-6 text-gray-900">Select your symptoms:</legend>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @for ($i = 1; $i <= 10; $i++)
                    <label class="flex items-center space-x-4 cursor-pointer rounded-lg p-3
                                  hover:bg-indigo-50 transition duration-300">
                        <input
                            type="checkbox"
                            name="symptoms[]"
                            value="Symptom {{ $i }}"
                            class="form-checkbox h-6 w-6 text-indigo-600 rounded focus:ring-2 focus:ring-indigo-400"
                        />
                        <span class="text-gray-800 font-medium select-none">Symptom {{ $i }}</span>
                    </label>
                @endfor
            </div>
        </fieldset>

        {{-- Search Additional Symptoms --}}
        <div>
            <label for="additionalSymptom" class="block mb-3 font-semibold text-gray-900">Search and add more symptoms:</label>
            <input
                type="text"
                id="additionalSymptom"
                name="additional_symptom"
                placeholder="Type symptom name..."
                class="w-full border border-gray-300 rounded-xl px-5 py-4
                       focus:outline-none focus:ring-4 focus:ring-indigo-300 focus:border-indigo-600
                       transition shadow-sm"
            />
        </div>

        {{-- Buttons --}}
        <div class="flex justify-center space-x-8 mt-6">
            <button
                type="submit"
                class="bg-indigo-600 text-white font-semibold px-12 py-4 rounded-xl shadow-lg
                       hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:-translate-y-1"
            >
                Detect
            </button>

            <button
                type="button"
                id="getRemediesBtn"
                class="bg-green-600 text-white font-semibold px-12 py-4 rounded-xl shadow-lg
                       hover:bg-green-700 transition duration-300 ease-in-out transform hover:-translate-y-1"
            >
                Get Remedies
            </button>
        </div>
    </form>
</section>
@endsection
