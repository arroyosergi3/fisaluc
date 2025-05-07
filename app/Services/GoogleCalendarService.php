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

    public function getAccessToken($user)
    {
        $client = new \Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(route('google.calendar.callback'));

        $client->setAccessToken($user->google_access_token);

        // Refrescar el token si ha expirado
        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $newToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());

                if (!isset($newToken['error'])) {
                    // Guardamos el nuevo token
                    $user->update([
                        'google_access_token' => json_encode($client->getAccessToken())
                    ]);
                } else {
                    throw new \Exception('No se pudo refrescar el token de Google: ' . $newToken['error_description']);
                }
            } else {
                throw new \Exception('No hay refresh token disponible. Vuelve a conectar tu cuenta de Google.');
            }
        }

        return $client; // 👈 Esto debe ser una instancia válida de Google_Client
    }

    public function addEvent($user, $appointment)
    {
        // Usa el cliente autenticado
        $client = $this->getGoogleClient($user);

/** @disregard  */
        $service = new Google_Service_Calendar($client);

        $start = Carbon::parse("{$appointment->date} {$appointment->time}", 'Europe/Madrid');
        $end = $start->copy()->addMinutes(45);

/** @disregard  */
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

        // Inserta el evento y obtén el ID
        $createdEvent = $service->events->insert('primary', $event);

        // Guarda el ID del evento en tu modelo (asumo que tienes una columna `google_event_id`)
        $appointment->update([
            'google_event_id' => $createdEvent->getId(),
        ]);
    }



public function getGoogleClient($user)
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(route('google.calendar.callback'));

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
                throw new \Exception('No hay refresh token. Reconecta tu cuenta de Google.');
            }
        }

        return $client;
    }

    public function deleteEvent($user, $eventId)
    {
        $client = $this->getGoogleClient($user);

/** @disregard  */
        $service = new Google_Service_Calendar($client);

        try {
            $service->events->delete('primary', $eventId);
            return true;
        } catch (\Google_Service_Exception $e) {
            Log::error('Error al eliminar evento de Google: ' . $e->getMessage());
            return false;
        }
    }


}


