<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Http;

class GoogleController extends Controller
{
    public function googlepage()
    {
        return Socialite::driver('google')
        ->scopes([
            'profile',
            'email',
            'https://www.googleapis.com/auth/user.birthday.read',  // Fecha de nacimiento
            'https://www.googleapis.com/auth/user.phonenumbers.read' // Número de teléfono
        ])
        ->redirect();
    }

    public function googlecallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Llamar a Google People API para obtener más datos
            $googleData = Http::withToken($user->token)->get("https://people.googleapis.com/v1/people/me?personFields=birthdays,phoneNumbers")->json();

            // Extraer datos adicionales
            $birthdate = $googleData['birthdays'][0]['date'] ?? null;
            $phone = $googleData['phoneNumbers'][0]['value'] ?? null;

            // Formatear fecha de nacimiento en YYYY-MM-DD
            if ($birthdate) {
                $birthdate = "{$birthdate['year']}-{$birthdate['month']}-{$birthdate['day']}";
            }

            // Buscar usuario en la base de datos
            $existingUser = User::where('email', $user->email)->first();

            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                // Crear nuevo usuario
                $newUser = User::create([
                    'name' => $user->user['given_name'],
                    'surname' => $user->user['family_name'] ?? '',
                    'phone' => $phone,
                    'birthdate' => $birthdate,
                    'email' => $user->email,
                    'role' => 'basic',
                    'google_id' => $user->id,
                    'password' => bcrypt('password'),
                ]);

                Auth::login($newUser);
            }

            return redirect()->route('dashboard');

        } catch (Exception $e) {
            //dd($e->getMessage());
        }
    }
}
