<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Google\Service\Calendar;
use Illuminate\Support\Facades\Http;

class GoogleController extends Controller
{
    public function googlepage()
    {
        /** @disregard */
        return Socialite::driver('google')
            ->scopes([
                'profile',
                'email',
                'https://www.googleapis.com/auth/user.birthday.read',  // Fecha de nacimiento
                'https://www.googleapis.com/auth/user.phonenumbers.read', // Número de teléfono
                Calendar::CALENDAR
                ])
            ->with(['access_type' => 'offline', 'prompt' => 'consent']) // ✅ Esto es necesario para obtener refresh_token
            ->redirect();
    }

   public function googlecallback()
{
    try {
        $googleUser = Socialite::driver('google')->user();

        // Obtén los tokens de Google
        $tokens = $googleUser->token;
        $refreshToken = $googleUser->refreshToken;  // Obtén el refresh token

        $existingUser = User::where('email', $googleUser->email)->first();

        if ($existingUser) {
            // Si el usuario existe, guarda los tokens en la base de datos
            $existingUser->google_access_token = $tokens;
            $existingUser->google_refresh_token = $refreshToken;  // Guarda el refresh token

            $existingUser->save();

            Auth::login($existingUser);

            return redirect()->route('dashboard');
        } else {
            // Si el usuario no existe, crea uno nuevo y guarda los tokens
            $newUser = User::create([
                'name' => $googleUser->user['given_name'],
                'surname' => $googleUser->user['family_name'] ?? '',
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'google_access_token' => $tokens,
                'google_refresh_token' => $refreshToken,
                'role' => 'basic',
                'password' => bcrypt('password'),
            ]);

            Auth::login($newUser);
            return redirect()->route('dashboard');
        }

    } catch (Exception $e) {
            //dd($e->getMessage()); // Muestra el mensaje de la excepción
        return redirect('/')->with('error', 'Error autenticando con Google');
    }
}


public function storeMissingData(Request $request)
{
    $request->validate([
    'phone' => 'required|numeric|digits:9',
        'birthdate' => 'required|date|after:1900-01-01|',
    ]);
    $user = Auth::user(); // Obtener el usuario autenticado

    if ($user) {
        $user->phone = $request->input('phone');
        $user->birthday = $request->input('birthdate');
        /** @disregard */
        $user->save();
        /** @disregard */
Auth::setUser($user->fresh());

        return redirect()->route('dashboard');
    } else {
        return redirect('/')->with('error', 'Usuario no autenticado.');
    }
}

public function calendarCallback(Request $request)
{
    $client = new \Google_Client();
    $client->setClientId(config('services.google.client_id'));
    $client->setClientSecret(config('services.google.client_secret'));
    $client->setRedirectUri(route('google.calendar.callback'));

    $client->fetchAccessTokenWithAuthCode($request->code);

    $tokens = $client->getAccessToken();

    $user = Auth::user();
    $user->google_access_token = $tokens;
    $user->google_refresh_token = $tokens['refresh_token'] ?? $user->google_refresh_token;
/** @disregard */
    $user->save();

    return redirect()->route('dashboard')->with('message', 'Cuenta de Google conectada correctamente.');
}



}
