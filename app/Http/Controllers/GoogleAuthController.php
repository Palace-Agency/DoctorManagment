<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    // public function redirect(){
    //     return Socialite::driver('google')->redirect();
    // }
    // public function callbackGoogle(){
    //     try {
    //         $google_user = Socialite::driver('google')->user();
    //         $user = User::where('google_id',$google_user->getId())->first();
    //         if(!$user){
    //             $fullName = $google_user->getName();

    //             // Split the full name into first and last name
    //             $nameParts = explode(' ', $fullName);

    //             // Assuming the name has at least two parts (first and last)
    //             $firstName = $nameParts[0];
    //             $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

    //             // Handle cases where the name might be more than two parts
    //             if (count($nameParts) > 2) {
    //                 $lastName = implode(' ', array_slice($nameParts, 1));
    //             }
    //             // Additional information (if available)
    //             $gender = $google_user->user['gender'] ?? null; // Not typically provided by Google
    //             $phoneNumber = $google_user->user['phoneNumber'] ?? null; // May require additional permissions
    //             $city = $google_user->user['address']['city'] ?? null; // Address info may not be provided
    //             $city_id = City::where('nom_city',$city)->first()->id;
    //             $birthday = $google_user->user['birthday'] ?? null; // May require additional permissions
    //             $new_user = User::create([
    //                 'fname' => $firstName,
    //                 'lname' => $lastName,
    //                 'email' => $google_user->getEmail(),
    //                 'gender' => $gender,
    //                 'phone' => $phoneNumber,
    //                 'city' => $city_id,
    //                 'date_naissance' => $birthday,
    //                 'google_id' => $google_user->getId(),
    //             ]);
    //             Auth::login($new_user);
    //         }
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }
    // }
}
