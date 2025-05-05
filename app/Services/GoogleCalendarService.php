<?php

namespace App\Services;

use App\Models\Treatment;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GoogleCalendarService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function addEvent($user, $appointment)
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->setAccessToken([
            'access_token' => $user->google_access_token,
            'refresh_token' => $user->google_refresh_token,
            'expires_in' => $user->google_token_expiry,
            'created' => now()->timestamp,
        ]);

        if ($client->isAccessTokenExpired()) {
            // Usa el refresh token si existe
            if ($client->getRefreshToken()) {
                $newToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());

                // Asegura que no hubo error
                if (isset($newToken['access_token'])) {
                    // Guarda el nuevo token
                    $user->update([
                        'google_access_token' => json_encode($client->getAccessToken())
                    ]);
                } else {
                    // Token inválido o revocado → forzar nuevo login
                    return redirect()->route('dashboard')->with('error', 'Tu sesión ha expirado. Inicia sesión nuevamente.');
                }
            } else {
                // No hay refresh token → redirigir a login
                return redirect()->route('google.login')->with('error', 'No hay refresh token disponible.');
            }
        }



        $service = new Google_Service_Calendar($client);
        /*
        dd([
            'fecha cruda' => "{$appointment->date} {$appointment->time}",
            'carbon' => Carbon::parse("{$appointment->date} {$appointment->time}")->toDateTimeString(),
            'rfc3339' => Carbon::parse("{$appointment->date} {$appointment->time}")->toRfc3339String(),
            'timezone' => config('app.timezone')
        ]);
        */

        $start = Carbon::parse("{$appointment->date} {$appointment->time}", 'Europe/Madrid');
        $end = $start->copy()->addMinutes(45);

        $event = new Google_Service_Calendar_Event([
            'summary' => 'Cita de fisioterapia',
            'description' => $appointment->treatment->description,
            'start' => [
    'dateTime' => $start->toRfc3339String(),
    'timeZone' => 'Europe/Madrid',
],
'end' => [
    'dateTime' => $end->toRfc3339String(),
    'timeZone' => 'Europe/Madrid',
],
        ]);

        $service->events->insert('primary', $event);
    }
}


