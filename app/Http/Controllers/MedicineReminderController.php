<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicineReminder; // You need this model for the reminders
use Illuminate\Support\Facades\Auth;

class MedicineReminderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return response()->json($user->medicineReminders()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_name' => 'required|string|max:255',
            'time_label' => 'required|string|max:50',
            'exact_time' => 'required|string',
        ]);

        $reminder = Auth::user()->medicineReminders()->create($request->all());

        return response()->json($reminder, 201);
    }

    public function destroyAll()
    {
        $user = Auth::user();
        $user->medicineReminders()->delete();

        return response()->json(['message' => 'All reminders deleted']);
    }
}
