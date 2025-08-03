<?php

use Illuminate\Support\Facades\Route;



Route::get('/',function() {
        return view('pages.home');
})->name('home');


Route::get('/detect',function() {
        return view('pages.detect');
})->name('Detect Symptoms');


Route::get('/chatbot', function () {
    return view('pages.chatbot');
})->name('Chatbot');


