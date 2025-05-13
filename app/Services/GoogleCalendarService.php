<?php

namespace App\Services;

use App\Models\Treatment;
use Google_Client;
use Google\Service\Calendar\Event;
use Google\Service\Calendar;
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

    public function getAccessToken($user)
    {
        $client = new \Google_Client();

        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(route('google.calendar.callback'));

        $client->setScopes([
            Calendar::CALENDAR,
            'email',
            'profile',
            'openid',
        ]);

        $client->setAccessType('offline');
        $client->setPrompt('consent');

        $client->setAccessToken($user->google_access_token);


        // Si el access token ha expirado
        if ($client->isAccessTokenExpired()) {
            // Verifica si el refresh token existe
            if ($user->google_refresh_token) {
                try {
                    // Intenta refrescar el access token con el refresh token
                    $newToken = $client->fetchAccessTokenWithRefreshToken($user->google_refresh_token);
                    if (!isset($newToken['error'])) {
                        // Si no hay error, guarda el nuevo access token
                        $user->update([
                            'google_access_token' => json_encode($client->getAccessToken()),
                        ]);
                        return $client;
                    } else {
                        throw new \Exception('No se pudo refrescar el token de Google: ' . $newToken['error_description']);
                    }
                } catch (\Exception $e) {
                    // Si ocurre un error, el refresh token puede haber caducado o no ser válido
                    throw new \Exception('Error al refrescar el token de Google: ' . $e->getMessage());
                }
            } else {
                // Si no hay refresh token, redirige para volver a conectar la cuenta de Google
                return redirect()->route('googlepage');  // Redirige a la página de login de Google para reautorizar

                //throw new \Exception('No hay refresh token disponible. Vuelve a conectar tu cuenta de Google.');
            }
        }

        return $client;
    }


    public function addEvent($user, $appointment)
    {
        // Usa el cliente autenticado
        $client = $this->getAccessToken($user); // Asegúrate de usar getAccessToken
        //dd($client); // Agrega esta línea para depurar


        $service = new Calendar($client);

        $start = Carbon::parse("{$appointment->date} {$appointment->time}", 'Europe/Madrid');
        $end = $start->copy()->addMinutes(45);

        /** @disregard  */
        $event = new Event([
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

        // Inserta el evento y obtén el ID
        $createdEvent = $service->events->insert('primary', $event);

        // Guarda el ID del evento en tu modelo (asumo que tienes una columna `google_event_id`)
        $appointment->update([
            'google_event_id' => $createdEvent->getId(),
        ]);
    }



    public function getGoogleClient($user)
    {
        $client = new \Google_Client();

        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(route('google.calendar.callback'));

        $client->setScopes([
            Calendar::CALENDAR,
            'email',
            'profile',
            'openid',
        ]);

        $client->setAccessType('offline');
        $client->setPrompt('consent');

        $client->setAccessToken($user->google_access_token);


        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $newToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());

                if (!isset($newToken['error'])) {
                    $user->update([
                        'google_access_token' => $client->getAccessToken(),
                    ]);
                } else {
                    throw new \Exception('No se pudo refrescar el token: ' . $newToken['error_description']);
                }
            } else {
                return redirect()->route('googlepage');  // Redirige a la página de login de Google para reautorizar

                throw new \Exception('No hay refresh token. Reconecta tu cuenta de Google.');
            }
        }

        return $client;
    }

    public function deleteEvent($user, $eventId)
    {
        $client = $this->getGoogleClient($user);

        /** @disregard  */
        $service = new Calendar($client);

        try {
            $service->events->delete('primary', $eventId);
            return true;
        } catch (\Google_Service_Exception $e) {
            Log::error('Error al eliminar evento de Google: ' . $e->getMessage());
            return false;
        }
    }
}
