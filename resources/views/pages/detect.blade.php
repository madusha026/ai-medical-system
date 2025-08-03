@extends('layout.app')

@section('content')
<section class="max-w-3xl mx-auto px-6 py-12">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
        <div class="bg-[#0F172A] text-white px-6 py-5 text-center">
            <h2 class="text-2xl font-bold">Disease Prediction System</h2>
        </div>

        <div class="p-6">
            <form id="predictionForm">
                @csrf
                <div class="mb-6">
                    <label for="symptoms" class="block mb-2 font-medium text-gray-700">Select Symptoms:</label>
                    <select id="symptoms" name="symptoms[]" multiple
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-4 focus:ring-indigo-200">
                        <!-- Options will be loaded via AJAX -->
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit"
                            class="bg-[#0F172A] text-white font-semibold px-8 py-3 rounded-xl shadow hover:bg-[#07090d] transition">
                        Predict Disease
                    </button>
                </div>
            </form>

            <div id="selectedSymptoms" class="mt-8 hidden">
                <h5 class="text-lg font-semibold mb-3 text-gray-700">Selected Symptoms:</h5>
                <div id="symptomTags" class="flex flex-wrap gap-2"></div>
            </div>

            <div id="predictionResult" class="mt-10 hidden">
                <h5 class="text-lg font-semibold mb-3 text-gray-700">Prediction Results:</h5>
                <div id="predictions" class="space-y-4"></div>

                <div class="text-center mt-6">
                    <button type="button"
                            id="getRemedy"
                            class="mt-4 bg-green-600 text-white font-semibold px-6 py-2 rounded-xl hover:bg-green-700 transition hidden">
                        Get Remedy Recommendation
                    </button>
                </div>

                <!-- Remedy Display Box -->
                <div id="remedyResult" class="mt-6 hidden">
                    <h5 class="text-lg font-semibold mb-3 text-gray-700">Recommended Remedies:</h5>
                    <div id="remedyContent" class="bg-green-50 text-gray-800 p-4 rounded-xl border border-green-400 shadow-inner whitespace-pre-line"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery + Select2 -->
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
        // Load symptoms from Flask
        $.get('http://127.0.0.1:5000/symptoms', function(response) {
            if (response.status === 'success') {
                const select = $('#symptoms');
                response.symptoms.forEach(symptom => {
                    select.append(`<option value="${symptom}">${titleCase(symptom)}</option>`);
                });
                $('#symptoms').select2({ placeholder: "Select symptoms", allowClear: true, width: '100%' });
            } else {
                alert('Failed to load symptoms.');
            }
        });

        // Show selected symptoms
        $('#symptoms').on('change', function () {
            const selected = $(this).val();
            const tags = $('#symptomTags');
            tags.empty();
            if (selected && selected.length > 0) {
                $('#selectedSymptoms').removeClass('hidden');
                selected.forEach(sym => {
                    tags.append(`<span class="bg-gray-200 text-sm rounded-full px-4 py-1">${titleCase(sym)}</span>`);
                });
            } else {
                $('#selectedSymptoms').addClass('hidden');
            }
        });

        // Predict disease
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
                            const prob = (pred.probability * 100).toFixed(2);
                            container.append(`
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <div class="flex justify-between font-semibold text-gray-800 mb-1">
                                        <span>${titleCase(pred.disease)}</span>
                                        <span>${prob}%</span>
                                    </div>
                                    <div class="w-full h-2 bg-black rounded-full">
                                        <div class="h-2 bg-indigo-600 rounded-full" style="width: ${prob}%"></div>
                                    </div>
                                </div>
                            `);

                            // Find top predicted disease
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

        // Remedy button click
        $('#getRemedy').on('click', function () {
            console.log("mostProbableDisease:", mostProbableDisease);

            if (!mostProbableDisease) {
                alert("No disease prediction available.");
                return;
            }

            $.ajax({
                url: 'http://127.0.0.1:8080/get',
                type: 'POST',
                data: { msg: mostProbableDisease },
                success: function (data) {
                    console.log("Remedy Response:", data);
                    if (data.status === 'success') {
                        $('#remedyContent').text(data.remedy);
                        $('#remedyResult').removeClass('hidden');
                    } else {
                        alert("Error: " + data.message);
                    }
                },
                error: function (xhr) {
                    console.log("Remedy Error:", xhr.responseText);
                    alert('Failed to retrieve remedy recommendation.');
                }
            });
        });
    });
</script>
@endsection
