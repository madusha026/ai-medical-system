<?php

use App\Http\Controllers\Auth\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineReminderController;



// Redirect '/' to '/home' if authenticated, otherwise to login
Route::get('/', function () {
    return auth()->check() ? redirect()->route('home') : redirect()->route('login');
});

// Home route after login
Route::get('/home', function () {
    return view('pages.home');
})->middleware(['auth'])->name('home');

// Other pages accessible after login or publicly (add middleware if needed)
Route::get('/detect', function () {
    return view('pages.detect');
})->middleware(['auth'])->name('detect');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/chatbot', function () {
    return view('pages.chatbot');
})->middleware(['auth'])->name('chatbot');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/medicine-reminders', [MedicineReminderController::class, 'index'])->name('medicine-reminders.index');
    Route::post('/medicine-reminders', [MedicineReminderController::class, 'store'])->name('medicine-reminders.store');
    Route::delete('/medicine-reminders', [MedicineReminderController::class, 'destroyAll'])->name('medicine-reminders.destroyAll');
});



require __DIR__.'/auth.php';
