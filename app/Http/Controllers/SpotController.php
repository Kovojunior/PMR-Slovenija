<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Spot;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SpotController extends Controller
{
    // Show Create Form
    public function create() {
        return view("spots.create");
    }
    public function create2() {
        return view("spots.create2");
    }

    // Store Spot Data
    public function store(Request $request) {

        // dd($request->all());

        // Validate form fields
        $formFields = $request->validate([
            "activation_callsign" => "required",
            "location" => "required",
            "frequency" => "required",
            "mode" => "required",
            "time" => "required",
            "type" => "required",
            "Qso_type" => "required",
        ]);

        // Optionally add comments
        if ($request->has('comments')) {
            $formFields["comments"] = $request->input("comments");
        }

        // Optionally add alert date
        if ($request->has('alert_date')) {
            $formFields["alert_date"] = $request->input("alert_date");
        }

        // Set the user_id to the authenticated user
        $formFields["spotter_id"] = auth()->id();

        // Create the Spot
        Spot::create($formFields);

        // Redirect with a success message
        return redirect("/")->with("message", "Spot created successfully!");
    }


    // Listing Visualization
    public function visualization() {
//        dd(Spot::all());
        return view("spots.map", [
            "spots" => Spot::all(),
            "total" => Spot::all()->count()
        ]);
    }
    public function map() {
//        dd(Spot::all());
        return view("spots.map2", [
            "spots" => Spot::all(),
            "total" => Spot::all()->count()
        ]);
    }

    // Get Location Of User
    public function getProfileFromUser(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => "required|exists:users,name"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "This user does not exist!"
            ], 404);
        }

        $data = $request->get("name");

        // Poišči uporabnika
        $requestedUser = User::query()->where("name", $data)->first();

        // Preveri, ali je uporabnik najden
        if (!$requestedUser) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }

        // Pridobi tri najnovejše spote
        $requestedUserSpots3 = Spot::query()
            ->where("activation_callsign", $data)
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        // Pridobi tri najnovejše kontakte
        $requestedUserContacts3 = Listing::query()
            ->where("My_Callsign", $data)
            ->orderByDesc('Date_Time')
            ->take(3)
            ->get();

        // Število spotov
        $requestedUserSpotCount = Spot::query()
            ->where("activation_callsign", $data)
            ->count();

        // Število kontaktov
        $requestedUserContactCount = Listing::query()
            ->where("My_Callsign", $data)
            ->count();

        // Oblikovanje odgovora
        $response = [
            "message" => "Successful",
            "activator_profile" => [
                'name' => $requestedUser->name,
                'grid' => $requestedUser->grid,
                'city' => $requestedUser->city,
                'profile_photo_path' => Storage::url($requestedUser->profile_photo_path), // Pridobi pravilno pot do slike
            ],
            "spots" => $requestedUserSpots3,
            "contacts" => $requestedUserContacts3,
            "spot_count" => $requestedUserSpotCount,
            "contact_count" => $requestedUserContactCount,
        ];
        return response()->json($response);
    }
}
