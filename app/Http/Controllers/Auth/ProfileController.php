<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class ProfileController
{
    /**
     * Show the form for editing the user's profile.
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $request->user()->update($request->only('name', 'email'));

        return back()->with('status', 'profile-updated');
    }
}
