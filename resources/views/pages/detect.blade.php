@extends('layout.app')

@section('content')
<section class="max-w-5xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-10 text-center">Disease Prediction System</h1>

    <form id="predictionForm" class="space-y-12">
        @csrf

        <!-- Symptom Selection -->
        <div>
            <label for="symptoms" class="block mb-3 text-lg font-medium text-gray-700">Select Your Symptoms</label>
            <select id="symptoms" name="symptoms[]" multiple
                class="w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 px-4 py-3 text-gray-800"
                style="min-height: 180px;">
                <!-- AJAX loaded options -->
            </select>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit"
                class="inline-block bg-blue-800 text-white font-semibold px-10 py-3 rounded-lg hover:bg-blue-900 transition-shadow shadow-md">
                Predict Disease
            </button>
        </div>
    </form>

    <!-- Selected Symptoms Tags -->
    <div id="selectedSymptoms" class="mt-12 hidden">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Selected Symptoms</h2>
        <div id="symptomTags" class="flex flex-wrap gap-3"></div>
    </div>

    <!-- Prediction Results -->
    <div id="predictionResult" class="mt-12 hidden">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Prediction Results</h2>

        <div id="predictions" class="space-y-5"></div>

        <div class="text-center mt-8">
            <button id="getRemedy" type="button"
                class="hidden bg-green-600 text-white font-semibold px-8 py-3 rounded-lg hover:bg-green-700 transition-shadow shadow-md">
                Get Remedy Recommendation
            </button>
        </div>

        <!-- Remedy Box -->
        <div id="remedyResult" class="mt-8 hidden">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Recommended Remedies</h3>
            <div class="bg-green-50 border border-green-300 rounded-lg p-6 text-gray-800 whitespace-pre-line shadow-inner"></div>
        </div>
    </div>
</section>

<!-- Select2 CSS + JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    function titleCase(str) {
        return str.replace(/_/g, ' ')
            .split(' ')
            .map(w => w.charAt(0).toUpperCase() + w.slice(1))
            .join(' ');
    }

    let mostProbableDisease = "";

    $(document).ready(function () {
        // Load symptoms via AJAX
        $.get('http://127.0.0.1:5000/symptoms', function (response) {
            if (response.status === 'success') {
                const select = $('#symptoms');
                response.symptoms.forEach(symptom => {
                    select.append(`<option value="${symptom}">${titleCase(symptom)}</option>`);
                });
                $('#symptoms').select2({
                    placeholder: "Select symptoms",
                    allowClear: true,
                    width: '100%'
                });
            } else {
                alert('Failed to load symptoms.');
            }
        });

        // Show selected symptom tags
        $('#symptoms').on('change', function () {
            const selected = $(this).val();
            const tags = $('#symptomTags');
            tags.empty();
            if (selected && selected.length > 0) {
                $('#selectedSymptoms').removeClass('hidden');
                selected.forEach(sym => {
                    tags.append(`<span class="bg-indigo-100 text-indigo-800 rounded-full px-4 py-1 text-sm font-medium">${titleCase(sym)}</span>`);
                });
            } else {
                $('#selectedSymptoms').addClass('hidden');
            }
        });

        // Form submit: Predict disease
        $('#predictionForm').on('submit', function (e) {
            e.preventDefault();
            const selectedSymptoms = $('#symptoms').val();
            if (!selectedSymptoms || selectedSymptoms.length === 0) {
                alert('Please select at least one symptom.');
                return;
            }

            $.ajax({
                url: 'http://127.0.0.1:5000/predict',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.status === 'success') {
                        $('#predictionResult').removeClass('hidden');
                        const container = $('#predictions').empty();

                        let highestProb = -1;
                        mostProbableDisease = null;

                        response.top_predictions.forEach(pred => {
                            const prob = (pred.probability * 100).toFixed(1);
                            container.append(`
                                <div class="bg-indigo-50 rounded-lg p-4 shadow">
                                    <div class="flex justify-between font-semibold text-indigo-900 mb-2">
                                        <span>${titleCase(pred.disease)}</span>
                                        <span>${prob}%</span>
                                    </div>
                                    <div class="w-full bg-indigo-200 rounded-full h-3">
                                        <div class="bg-indigo-600 h-3 rounded-full" style="width: ${prob}%"></div>
                                    </div>
                                </div>
                            `);

                            if (pred.probability > highestProb) {
                                highestProb = pred.probability;
                                mostProbableDisease = pred.disease;
                            }
                        });

                        if (mostProbableDisease) {
                            $('#getRemedy').removeClass('hidden');
                        }
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function () {
                    alert('Error occurred while making prediction.');
                }
            });
        });

        // Remedy recommendation
        $('#getRemedy').on('click', function () {
            if (!mostProbableDisease) {
                alert("No disease prediction available.");
                return;
            }

            $.ajax({
                url: 'http://127.0.0.1:8080/get',
                type: 'POST',
                data: { msg: mostProbableDisease },
                success: function (data) {
                    if (data.status === 'success') {
                        $('#remedyResult > div').text(data.remedy);
                        $('#remedyResult').removeClass('hidden');
                    } else {
                        alert("Error: " + data.message);
                    }
                },
                error: function () {
                    alert('Failed to retrieve remedy recommendation.');
                }
            });
        });
    });
</script>
@endsection
