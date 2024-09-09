<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

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
                "name" => ["required", "min:3"],
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
        return redirect("/")->with("message", "You have been logged out!");
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


    // Show User Location Form
    public function user_location(User $user) {
        // Make sure logged in user is owner of the Account
        if ($user->id != auth()->id()) {
            abort(403, "Unauthorized action");
        }
        return view("users.user_location", ["user" => $user]);
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
}
