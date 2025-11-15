<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        
        // Safe counts with fallback
        $stats = [
            'orders_count' => 0,
            'tickets_count' => 0,
            'reward_points' => $user->reward_points ?? 0,
        ];

        // Try to get orders count safely
        try {
            if (method_exists($user, 'orders') && class_exists('App\Models\Order')) {
                $stats['orders_count'] = $user->orders()->count();
            }
        } catch (\Exception $e) {
            $stats['orders_count'] = 0;
        }

        // Try to get tickets count safely
        try {
            if (method_exists($user, 'tickets') && class_exists('App\Models\SupportTicket')) {
                $stats['tickets_count'] = $user->tickets()->count();
            }
        } catch (\Exception $e) {
            $stats['tickets_count'] = 0;
        }

        return view('profile.edit', [
            'user' => $user,
            'stats' => $stats
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}