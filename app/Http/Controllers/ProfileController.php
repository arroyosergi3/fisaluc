<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Specialist;
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function storeSpecialist(Request $request)
{
    $request->validate([
        'physio_id' => 'required|exists:users,id',
        'treatment_id' => 'required|exists:treatments,id',
    ]);

    $alreadyExists = \App\Models\Specialist::where('physio', $request->physio_id)
        ->where('treatment', $request->treatment_id)
        ->exists();

    if (!$alreadyExists) {
        \App\Models\Specialist::create([
            'physio' => $request->physio_id,
            'treatment' => $request->treatment_id,
        ]);
    }

    return redirect()->back()->with('success', 'Especialidad añadida correctamente.');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
               $user = $request->user();

       if (!$user->google_access_token) {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
    }


        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

      public function spcialistDestroy(Specialist $specialist)
    {
        $specialist->delete();
        return redirect()->back()->with('success', 'Especialidad eliminada correctamente.');
    }

}
