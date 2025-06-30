<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Storage; // Uporabi za shranjevanje profilnih slik

class GoogleController extends Controller
{
    // Shows google select account page
    public function googlePage() {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account']) // Prisili Google, da vedno vpraša za izbiro računa
            ->redirect();
    }

    public function googleCallback() {
        try {
            // Pridobi podatke uporabnika iz Google API
            $user = Socialite::driver('google')->user();

            // Preveri, ali uporabnik obstaja glede na google_id ali email
            $finduser = User::where('email', $user->email)->orWhere('google_id', $user->id)->first();

            if ($finduser) {
                // Če najdemo uporabnika, ga prijavimo
                if (!$finduser->google_id) {
                    $finduser->google_id = $user->id;
                }

                // Shranimo profilno sliko, če obstaja
                if ($user->avatar) {
                    $avatarContents = file_get_contents($user->avatar); // Prenos slike z URL
                    $filename = 'profile_photos/' . $user->id . '_google_profile.jpg';
                    Storage::disk('public')->put($filename, $avatarContents); // Shranimo sliko v disk 'public'
                    $finduser->profile_photo_path = $filename; // Posodobimo pot v bazi
                }

                $finduser->save();
                Auth::login($finduser);
                return redirect()->intended('/')->with("message", "User logged in!");
            } else {
                // Če uporabnika ni, ustvarimo novega
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => bcrypt('123456dummy'),
                ]);

                // Shranimo profilno sliko, če obstaja
                if ($user->avatar) {
                    $avatarContents = file_get_contents($user->avatar);
                    $filename = 'profile_photos/' . $user->id . '_google_profile.jpg';
                    Storage::disk('public')->put($filename, $avatarContents); // Shranimo sliko v disk 'public'
                    $newUser->profile_photo_path = $filename; // Posodobimo pot v bazi
                }

                $newUser->save();
                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            return redirect("/login")->with("message", "Login cancelled!");
        }
    }

    // Funkcija za prenos in shranjevanje profilne slike
    private function saveProfilePhoto($avatarUrl, $user) {
        try {
            // Prenesi sliko z uporabo file_get_contents (ali uporabi Guzzle, če želiš)
            $imageContents = file_get_contents($avatarUrl);

            // Ustvari unikatno ime datoteke
            $filename = 'profile_photos/' . $user->id . '_google_profile.jpg';

            // Shrani datoteko v lokalno shrambo (storage/app/profile_photos/)
            Storage::put($filename, $imageContents);

            // Posodobi pot do slike v bazi (uporabiš lahko `profile_photo_path`, ki je v modelu User)
            $user->profile_photo_path = $filename;
            $user->save();
        } catch (Exception $e) {
            // Logiraj napako, če pride do težave pri prenosu ali shranjevanju slike
            \Log::error('Profile photo saving failed: ' . $e->getMessage());
        }
    }
}
