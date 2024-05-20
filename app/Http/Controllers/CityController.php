<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
    public function store(Request $request)
    {



        $response = Http::withHeaders([
            'X-CSCAPI-KEY' => 'Z2NYdzNleDdWaTYyZkZGSGhJSksyZFV5bXRWR0pGT3VNMHh5N1dXeg=='
        ])->get('https://api.countrystatecity.in/v1/countries/MA/cities');

        // dd($response);
        $cities = $response->json();
          // dd($cities);
        foreach ($cities as $city) {
            // Check if the city already exists in the database
            $existingCity = City::where('nom_city', $city['name'])->first();

            // If the city doesn't exist, create a new city record in the database
            if (!$existingCity) {
                City::create([
                    'nom_city' => $city['name'],
                ]);
            }
        }


        return response()->json(['message' => 'Cities stored successfully'], 200);
    }
}
