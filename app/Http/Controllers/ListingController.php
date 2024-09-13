<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use MongoDB\Driver\Session;
use function Symfony\Component\String\b;

// datoteka narejena v terminalu s pomočjo php artisan make:controller ListingController ukaza
// premikamo viewe iz web.phpja
class ListingController extends Controller
{
    // Show all listings
    public function index() {
        // dd(request()->tag);
        // paginate vrne rezultate razporejene v strani, paginate(št.elem. na stran)
        // dd(Listing::latest()->filter(request(["tag", "search"]))->paginate(2));
        // če bi želeli spremeniti stile paginationa stran od tailwinda, moramo najprej zadevo publishati:
        // ukaz v terminalu: php artisan vendor:publish, iz drop down menija najdemo PaginationServiceProvider (verjetno št 5), vtipkamo 5 in enter
        // naredila se bo mapa vendor s templati
        return view("listings.index", [
            "listings" => Listing::latest()->filter(request(["tag", "search"]))->paginate(6)
        ]);
    }



    // Show single listing
    public function show(Listing $listing)
    {
        return view("listings.show", [
            "listing" => $listing
        ]);
    }



    // Show Create Form
    public function create() {
        return view("listings.create");
    }



    // Store Listing Data
    public function store(Request $request) {
        // po defaultu grejo naložene datoteke na /storage/app/, to lahko nastavljamo v /config/filesystems.php
        // dd($request->file("logo")->store());
        // dd($request->all()); // nam vrne vsa polja iz forme za dodajanje listinga
        $formFields = $request->validate(
            [
//                "title" => "required",
//                "company" => ["required", Rule::unique("listings")],
//                "location" => "required",
//                "website" => "required",
//                "email" => ["required", "email"],
//                "tags" => "required",
//                "description" => "required"
                "My_Callsign" => "required",
                "Their_Callsign" => "required",
                "RST_Sent" => "required",
                "RST_Rcvd" => "required",
                "My_Grid" => "required",
                "Their_Grid" => "required",
                "Date_Time" => "required",
                "Freq" => "required",
                "QSO_Range" => "required",
                "QSO_Type" => "required",
                "Event_type" => "required",
            ]
        );

        // zadeva še ni čisto javno dostopne, rabimo naredit simlink iz /storage/app/public/logos v /public, ker so v /public direktno dostopne
        // to naredimo z ukazom v terminalu: php artisan storage:link
        if($request->hasFile("Upload_Pic")) {
            // ->store("logos"), povemo mu da želimo vse naložene slike logo shraniti v mapo logos in naj bodo public
            $formFields["Upload_Pic"] = $request->file("Upload_Pic")->store("logos", "public");
        }

        // Če je bilo vneseno besedilo v polju Notes, ki ni zahtevano
        if ($request->has('Notes')) {
            $formFields["Notes"] = $request->input("Notes");
        }

        $formFields["user_id"] = auth()->id();

        Listing::create($formFields);
        // dodajanje flash message popupa, ki nas obvesti, da se je zadeva pravilno dodala
        // Session::flash("message", "Listing created");
        // ali pa dodamo ->with("message", "Listing created") pri redirectu
        return redirect("/")->with("message", "Listing created successfully!");
    }



    // Show Edit Form
    public function edit(Listing $listing) {
        return view("listings.edit", ["listing" => $listing]);
    }



    // Update Listing Data
    public function update(Request $request, Listing $listing) {

        // Make sure logged in user is owner of the Listing
        if ($listing->user_id != auth()->id()) {
            abort(403, "Unauthorized action");
        }

        $formFields = $request->validate(
            [
//                "title" => "required",
//                "company" => ["required"],
//                "location" => "required",
//                "website" => "required",
//                "email" => ["required", "email"],
//                "tags" => "required",
//                "description" => "required"
                "My_Callsign" => "required",
                "Their_Callsign" => "required",
                "RST_Sent" => "required",
                "RST_Rcvd" => "required",
                "My_Grid" => "required",
                "Their_Grid" => "required",
                "Date_Time" => "required",
                "Freq" => "required",
            ]
        );

        if($request->hasFile("Upload_Pic")) {
            // ->store("logos"), povemo mu da želimo vse naložene slike logo shraniti v mapo logos in naj bodo public
            $formFields["Upload_Pic"] = $request->file("Upload_Pic")->store("logos", "public");
        }

        if ($request->has('Notes')) {
            $formFields["Notes"] = $request->input("Notes");
        }

        $listing->update($formFields);

        // gremo nazaj + flash message
        return redirect("/listings/manage")->with("message", "Listing updated successfully!");
    }



    // Delete Listing
    public function destroy(Listing $listing) {

        // Make sure logged in user is owner of the Listing
        if ($listing->user_id != auth()->id()) {
            abort(403, "Unauthorized action");
        }

        $listing->delete();
        return redirect("/")->with("message", "Listing deleted successfully!");
    }


    // Manage Listing
    public function manage() {
        return view("listings.manage", ["listings" => auth()->user()->listings()->get()]);
    }


    // Listing Visualization
    public function visualization() {
        return view("listings.map", [
            "listings" => Listing::all(),
            "total" => Listing::all()->count()
        ]);
    }


    // Test
    public function test() {
        return view("listings.test", [
            "listings" => Listing::all(),
            "total" => Listing::all()->count()
        ]);
    }

}
