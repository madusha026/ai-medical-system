<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationPromptController
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(Auth::user()->home() ?? '/dashboard')
                    : view('auth.verify-email');
    }
}
