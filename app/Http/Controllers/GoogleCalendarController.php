<?php

namespace App\Http\Controllers;

use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Google_Service_Calendar_Event;
use Google_Service_Calendar;



class GoogleCalendarController extends Controller
{
    public function redirect()
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(route('google.calendar.callback'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->addScope(Google_Service_Calendar::CALENDAR);

        $authUrl = $client->createAuthUrl();

        return redirect($authUrl);
    }

    public function callback(Request $request)
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(route('google.calendar.callback'));

        $client->fetchAccessTokenWithAuthCode($request->code);

        $tokens = $client->getAccessToken();

        $user = Auth::user();
        $user->google_access_token = $tokens['access_token'];
        $user->google_refresh_token = $tokens['refresh_token'] ?? $user->google_refresh_token;
        $user->save();

        return redirect()->route('dashboard')->with('message', 'Cuenta de Google conectada correctamente.');
    }
}
