<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spot;

class SpotController extends Controller
{
    // Show Create Form
    public function create() {
        return view("spots.create");
    }

    // Store Spot Data
    public function store(Request $request) {

//        dd($request->all());

        // Validate form fields
        $formFields = $request->validate([
            "activation_callsign" => "required",
            "location" => "required",
            "frequency" => "required",
            "mode" => "required|not_in:''",
            "time" => "required|not_in:''",
            "type" => "required|not_in:''",
        ]);

        // Optionally add comments
        if ($request->has('comments')) {
            $formFields["comments"] = $request->input("comments");
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
}
