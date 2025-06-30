<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Spot;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        return view("users.register");
    }


    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate(
            [
                // required: polje je potrebno izpolnit, min: minimalno število znakov da se polje validira
                "name" => ["required", "min:3", Rule::unique("users", "name") ],
                // Rule::unique("'ime_tabele', 'ime_stolpca'"): vrednost polja email mora biti unikatna znotraj stolpca email tabele users
                "email" => ["required", "email", Rule::unique("users", "email") ],
                // |: logični or, confirmed: gleda da bo zadeva matchala polju z imenom password_confirmation (to ime password_confirmation mora biti nujno tako, da bo zadeva delovala)
                "password" => "required | confirmed | min:6",
            ]
        );

        // Hash Password hashira password za hranjenje v podatkovni bazi
        $formFields["password"] = bcrypt($formFields["password"]);

        // Kreira userja s pomočjo metode create v razredu User
        $user = User::create($formFields);

        // Lahko nastavimo, da se ob registraciji uporabnik avtomatsko logina
        auth()->login($user);

        // Redirect na index html: '/' s pop up sporočilom
        return redirect("/")->with("message", "User created and logged in!");
    }


    // Log User Out
    public function logout(Request $request) {
        // iz user sessiona odstrani user authentication
        auth()->logout();

        // invalidira session in regenerira token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect na index html: '/' s pop up sporočilom
        return redirect("/login")->with("message", "You have been logged out!");
    }


    // Show Login Form
    public function login(Request $request) {
        return view("users.login");
    }


    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate(
            [
                "email" => ["required", "email"],
                "password" => "required",
            ]
        );

        // Če je bil poskus logina uspešen, generiramo session id
        if(auth()->attempt($formFields)) { // Uspešna prijava
            $request->session()->regenerate();
            // Redirect na homepage
            return redirect("/")->with("message", "You are now logged in!");
        }
        else { // Neuspešna prijava
            // Za polje email izpišemo error Invalid Credentials, samo za email, ne tudi za geslo, sicer secuirty risk če kdo ve da nek email obstaja v bazi!
            return back()->withErrors(["email" => "Invalid Credentials"])->onlyInput("email");
        }
    }


    // Show User Settings Form
    public function user_profile(User $user) {
        // Make sure logged in user is owner of the Account
        if ($user->id != auth()->id()) {
            abort(403, "Unauthorized action");
        }
        return view("users.user_profile", ["user" => $user]);
    }

    public function user_profile2(User $user) {
        if ($user->id != auth()->id()) {
            abort(403, "Unauthorized action");
        }

        // Povečaj število lookupov
        $user->increment('lookups');

        // Pridobi zadnjih 5 listingov uporabnika
        $listings = Listing::where('user_id', $user->id)
            ->orderBy('Date_Time', 'desc')
            ->take(5)
            ->get()
            ->map(function ($listing) {
                // Obdelava frekvence
                if (ctype_digit($listing->Freq) && (int)$listing->Freq >= 1 && (int)$listing->Freq <= 16) {
                    $listing->formatted_freq = "PMR CH" . $listing->Freq;
                } elseif (preg_match('/^cb(\d+)$/', $listing->Freq, $matches) && (int)$matches[1] >= 1 && (int)$matches[1] <= 40) {
                    $listing->formatted_freq = "CB CH" . $matches[1];
                } else {
                    $listing->formatted_freq = $listing->Freq . " MHz";
                }

                // Formatiranje datuma
                $listing->formatted_date = Carbon::parse($listing->Date_Time)->format('d-m-Y, H:i');

                return $listing;
            });

        // Dodatni podatki
        $logged_contacts = Listing::where('My_Callsign', $user->name)->count();
        $spot_count = Spot::where('activation_callsign', $user->name)->count();
        $asv_activator_count = Listing::where('My_Callsign', $user->name)
            ->where('Event_type', 'sota')
            ->count();
        $asv_chaser_count = Listing::where('Their_Callsign', $user->name)
            ->where('Event_type', 'sota')
            ->count();

        return view("users.profile", [
            "user" => $user,
            "listings" => $listings,
            "mapZoom" => 12,
            "markerDraggable" => false,
            "logged_contacts" => $logged_contacts,
            "spot_count" => $spot_count,
            "asv_activator_count" => $asv_activator_count,
            "asv_chaser_count" => $asv_chaser_count
        ]);
    }


    // Show User Location Form
    public function user_location(User $user) {
        // Make sure logged in user is owner of the Account
        if ($user->id != auth()->id()) {
            abort(403, "Unauthorized action");
        }
        return view("users.user_location", ["user" => $user]);
    }
    public function user_location2(User $user) {
        // Make sure logged in user is owner of the Account
        if ($user->id != auth()->id()) {
            abort(403, "Unauthorized action");
        }
        return view("users.location", [
            "user" => $user,
            "mapZoom" => 9,
            "markerDraggable" => true
        ]);
    }


    // Show User Location Form
    public function update_location(Request $request, User $user) {

        // Make sure logged in user is owner of the Account
        if ($user->id != auth()->id()) {
            abort(403, "Unauthorized action");
        }

        $formFields = $request->validate(
            [
                "lat_lng" => "required",
                "grid" => "required",
                "city" => "required",
            ]
        );

        $user->update($formFields);

        // gremo nazaj + flash message
        return redirect("/")->with("message", "User location updated successfully!");
    }


    // Get Location Of User
    public function getLatLngFromUser(Request $request) {

        $validator = Validator::make($request->all(), [
            "name" => "required|exists:users,name"
        ]);

        if($validator->fails()) {
            return response()->json([
                "message" => "This user does not exist!"
            ], 404);
        }

        $data = $request->get("name");
        // Log::info(print_r($validator, true));

        $requestedUser = User::query()->where("name", $data)->first();
        $latLng = $requestedUser->lat_lng;

        // True zapiše log v log in ne v console.log
        // Log::info(print_r($request->get("name"), true));

        $response = [
            "message" => "Successful",
            "lat_lng" => $latLng
        ];
        return response()->json($response);
    }

    // Listing Visualization
    public function visualization() {
        return view("users.map", [
            "users" => User::all(),
            "total" => User::all()->count()
        ]);
    }
    public function map() {
        return view("users.map2", [
            "users" => User::all(),
            "total" => User::all()->count()
        ]);
    }
}
