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
            $newToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            $user->update([
                'google_access_token' => $newToken['access_token'],
            ]);
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


