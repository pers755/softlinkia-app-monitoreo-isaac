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
        return view('profile.edit', [
            'user' => $request->user(),
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

        // REGISTRO EN BITÁCORA (logs)
    \App\Models\Log::create([
        'user_id'     => auth()->id(), 
        'action'      => 'Actualización de Perfil',
        'description' => "Se actualizó el perfil del usuario: {$request->user()->name} con ID: {$request->user()->id} con IP: {$request->ip()}",
        'module'      => 'Perfiles'
    
    ]);
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

          // REGISTRO EN BITÁCORA (logs)
    \App\Models\Log::create([
        'user_id'     => auth()->id(), 
        'action'      => 'Eliminación de Perfil',
        'description' => "Se eliminó el perfil del usuario: {$request->user()->name} con ID: {$request->user()->id} con IP: {$request->ip()}",
        'module'      => 'Perfiles'
    
    ]);
        return Redirect::to('/');
    }
}
