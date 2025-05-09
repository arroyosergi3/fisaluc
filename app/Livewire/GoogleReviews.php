<?php

namespace App\Livewire;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class GoogleReviews extends Component
{
    public $reviews = [];
    public $debugData = [];

    public function mount()
    {
        try {

            if (request()->has('nocache')) {
                Cache::forget('google_reviews');
            }

            $this->reviews = Cache::remember('google_reviews', 3600, function () {
                $apiKey = env('GOOGLE_API_KEY');

                $businessName = 'Clínica Fisioterapia Lucena | Fisaluc, Lucena'; // Cambia esto si es necesario
                $apiKey = config('services.google.api_key');
                // Obtener el place_id
                $findResponse = Http::get('https://maps.googleapis.com/maps/api/place/findplacefromtext/json', [
                    'input' => $businessName,
                    'inputtype' => 'textquery',
                    'fields' => 'place_id',
                    'key' => $apiKey,
                ]);


                $placeId = $findResponse['candidates'][0]['place_id'] ?? null;
                //$placeId = "ChIJnW5q28BxbQ0RWemHJpD1kuk";
                if (!$placeId) {
                    Log::debug('Error: No se encontró el place_id');
                    return [];
                }

                // Obtener las reseñas
                $detailsResponse = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
                    'place_id' => $placeId,
                    'fields' => 'reviews',
                    'language' => 'es',
                    'key' => $apiKey,
                ]);


                $reviews = $detailsResponse['result']['reviews'] ?? [];
                if (empty($reviews)) {
                    Log::debug('Error: No se encontraron reseñas');
                }

                $detailsData = $detailsResponse->json();
                $reviews = $detailsData['result']['reviews'] ?? [];
                shuffle($reviews);
                return $reviews;
            });
        } catch (RequestException $e) {
            Log::error('Error al hacer la solicitud a la API de Google: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.google-reviews');
    }
}
