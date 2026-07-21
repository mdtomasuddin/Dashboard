<?php

namespace App\Http\Controllers\Web\V1\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\Profile\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form with all sections.
     */
    public function edit(): View
    {
        $user = Auth::user();

        // Get active sessions for the security section
        $sessions = DB::connection('mysql')->table('sessions')
            ->where('user_id', $user->id)->orderBy('last_activity', 'desc')->get();

        return view('backend.profile.edit', compact('user', 'sessions'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $validated = $request->validated();

        $userData = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? $user->last_name,
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? $user->phone,
            'birthday' => $validated['birthday'] ?? $user->birthday?->format('Y-m-d'),
            'location' => $validated['location'] ?? $user->location,
            'bio' => $validated['bio'] ?? $user->bio,
        ];

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Helper::deleteFile($user->avatar);
            }
            $userData['avatar'] = Helper::uploadFile($request->file('avatar'), 'avatar');
        }
        // Handle cover photo upload
        if ($request->hasFile('cover')) {
            if ($user->cover) {
                Helper::deleteFile($user->cover);
            }
            $userData['cover'] = Helper::uploadFile($request->file('cover'), 'cover_photo');
        }
        $user->update($userData);

        // Determine which tab to redirect back to
        $tab = $request->input('_tab', 'personal');

        return redirect()->route('profile.edit', ['tab' => $tab])->with('t-success', 'Profile updated successfully.');
    }

    /**
     * Update the user's password.
     */
    public function password(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Update the user's password
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile.edit', ['tab' => 'password'])->with('t-success', 'Password changed successfully.');
    }

    /**
     * Log out other browser sessions.
     */
    public function logoutSessions(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        Auth::logoutOtherDevices($request->password);
        // Delete all sessions except current
        DB::connection('mysql')->table('sessions')->where('user_id', Auth::id())->where('id', '!=', session()->getId())->delete();

        return redirect()->route('profile.edit', ['tab' => 'sessions'])->with('t-success', 'All other sessions have been terminated.');
    }
}
