
<?php
//Tu naložimo viewe in kontrolerje
//Preden lahko dostopamo do naše spletne strani, moramo zagnati php artisan serve
// S klikom na CTRL + Route nas popelje do razreda Route, ki razširja fasado Facades
use App\Http\Controllers\ListingController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// youtube tutorial added!
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
 *  Workflow: Rad bi naredil Register form:
 *      1. Začnem v web.php, naredim Route::get('kam_želim_da_me_preusmeri', ['ime_razreda::class', 'ime_funkcije_v_tem_razredu']])
 *      2. Če razreda 'ime_razreda::class' še nimam, ga naredim v mapi Controllers: php artisan make:controller 'ime_razreda'
 *      3. Razred 'ime_razreda' uvozim sem z import class hintom
 *      4. V layoutu oziroma htmlju podstani/layouta spremenim link za npr. gumb, da matcha Route::get('kam_želim_da_me_preusmeri', ...)
 *      5. V razredu 'ime_razreda' naredim funkcijo ime_funkcije_v_tem_razredu'
 *      6. V razredu 'ime_razreda' pod funkcijo ime_funkcije_v_tem_razredu' vrnem pogled na html kodo za prikaz: return view('pot_do_viewa'). Pot je lahko 'users.register', to pomeni v mapi resources/views najdi pogled register. Če mape, ki bi združevala podobne poglede še ni, jo v views kreiram
 *      7. V mapi /resources/views/'ime_podmape'/ naredim novo datoteko za pogled/prikaz z imenom 'ime_datoteke'.blade.php
 *      8. V to novo datoteko 'ime_datoteke' lahko importam moj layout(to je lahko ogrodje strani, prikazano na vsaki npr. orodna vrstica, footer itd.) z <x-'ime_carda'> 'poljuben html...' </x-'ime_carda'>
 *      9. V tem htmlju znotraj <x-layout></x-layout> imamo lahko form. Določimo action: <form method="POST/GET" action='ime_actiona'>... npr. POST, /users
 *     10. Pod začetkom form moramo vedno dati @csrf, da preprečimo cross-site scripting napade
 *     11. Inputi v form morajo imeti name='ime', da bomo lahko brali/zapisovali v polja
 *     12. V input fielde lahko damo izpis errorjev z @error 'logika' @enderror npr. @error('name_polja') <p class="text-red-500 text-xs mt-1">{{$message}}</p> @enderror
 *     13. Sem nazaj v web.php. Naredim funkcionalnost, da hendlamo POST request na /users: npr. Route::post("/users", [UserController::class, "store"]);
 *     14. V razredu UserController naredim funkcijo store, imena taka kot sem jih določil v Route::post... public function store(Request $request)
 *     15. V tej funkciji store naredim validation vnosnih polj, ki ga priredim neki spremenljivki: $formFields = $request->validate(['ime_polja' => ['required/etc.'], ...]);
 *     16. S to funkcijo na koncu lahko naredimo redirect in pošljemo sporočilo. Import razredov tam, kjer je to potrebno in nam zateži da ne prepozna razreda
 *     17. V form pri vnosnem polju <input value="{{old("name")}}">, lahko damo ta value="{{old("name")}}" v input, da se pri napaki na strani avtomatsko izpolenjo polja na prejšno vrednost
 *     18. V layoutu (layout.blade.php) spremenim, da se po loginu spremeni orodna vrstica v headerju, torej iz logina v logout itd.
 *     19. Terminal: php artisan tinker nam odpre terminal za poizvedovanje po DB, če damo npr. \App\Models\Listing::first() nam vrne prvi listing v bazi
 *     20. Tinker: \App\Models\Listing::find(3), nam vrne listing z id=3, Tinker: \App\Models\Listing::find(3)->user nam vrne userja, ki ga je naredil
 *     21. Tinker: $user = \App\Models\User::first(), $user->listings nam vrne njegove listinge
 * */

// GET, POST HTTP metoda
// get(endpoint, funkcija)
// funkcija vrne pogled "welcome" iz resources/views/welcome.blade.php
//Route::get('/', function () {
//    return view('welcome');
//});

// response(content, status, headers), kako vem kakšna je oblika funkcije? Dokumentacija ali CTRL + klik na funkcijo response
//Route::get('hello', function() {
////    return response('Hello World');
////    dodamo lahko html
////    ta get poizvedba se prikaže na spletni strani pod F12->Omrežje(potreben reload strani F5)->klik na hello, dobimo podatke o statusu, responsu itd.
////    z ->header smo dodali header, spet CTRL + klik na header ali dokumentacija za obliko. S tem smo deklarirali, naj se file obravnava kot "text/plain" CSS, drugi header je narejen custom
//      return response("<h1>Hello World</h1>", 200)
//          ->header("Content-Type", "text/plain")
//          ->header("foo", "bar");
//});
//
//// zdaj bomo lahko dostopali do /posts/"vrednost id". Vrednost označena z {}, združevanje Post in $id isto kot v PHP -> "Post" . $id
//// ->where za določanje omejitev. V tem primeru smo omejili zaznavanje vrednosti id vnosa na številke kot $id pri "/posts/id" (regex?)
//// dd je die dump, kot neke vrste console.log, na tem mestu ustavi program in izpiše vrednost, ddd je die dump debug, je debug mode
//Route::get("/posts/{id}", function ($id){
////    dd($id);
////    ddd($id);
//    return response("Post " . $id);
//})->where("id", "[0-9]+");
//
//// prišli smo do razreda, ki ni importan (Request). Kot vidimo v terminalu, nam tu vrže napako, ki jo lahko popravimo z žarnico(hints), izbiro razreda Request, klik in import class: Illuminate\http\Request (verjetno bi se dalo tudi automatsko?)
//// pri dd($request) vidimo parametre vnosa (Brad, Boston) preko iskalne vrstice brskalnika http://127.0.0.1:8000/search?name=Brad&city=Boston v query->parameters (klikni na puščico za odpret podmeni)
//Route::get("/search", function(Request $request) {
////    dd($request);
////    bolj natančen dd
////    dd($request->name . " " . $request->city);
////    vrne (torej tu izpiše) vrednosti name in city
//    return $request->name . " " . $request->city;
//});


// začetek youtube tutoriala!
// homepage
// All Listings
Route::get("/", [ListingController::class, "index"]);
////Route::get("/", function () {
////   return view("listings", [
//////     "heading" => "Latest Listings",
////       "listings" => Listing::all()
////   ]);
//});


// Common Resource Routes:
    // index - Show all listings
    // show - Show single listing
    // create - Show form to create new listing
    // store - Store new listing
    // edit - Show form to edit listing
    // update - Update listing
    // destroy - Delete listing


// Show Create Form
// Če imamo naslednji Route pred /create, se zadeva ne bo izvedla, namreč program bo šel gledat v Route::get("/listings/{listing}" namesto Route::get("/listings/create". Torej premaknemo prejšnji Route pod tega
// Route::get("/listings/{listing}", [ListingController::class, "show"]);
// middleware nam omogoča, da neprijavljeni uporabniki ne morejo kreirati gigov
// middleware se nahaja v /app/http/Middleware/Authenticate.php, moramo posodobiti datoteko, sicer error Route[login] not detected!
Route::get("/listings/create", [ListingController::class, "create"])->middleware("auth");


// Store Listing Data
Route::post("/listings", [ListingController::class, "store"])->middleware("auth");


// Show Edit Form
Route::get("/listings/{listing}/edit", [ListingController::class, "edit"])->middleware("auth");


// Update Listing
Route::put("/listings/{listing}", [ListingController::class, "update"])->middleware("auth");


// Delete Listing
Route::delete("/listings/{listing}", [ListingController::class, "destroy"])->middleware("auth");


// Manage Listings
Route::get("/listings/manage", [ListingController::class, "manage"])->middleware("auth");


// Show map of Contacts
Route::get("/listings/map", [ListingController::class, "visualization"])->middleware("auth");


// Test -> Leaflet zemljevid
Route::get("/leaflet", [ListingController::class, "test"])->middleware("auth");


// Show Register/Create Form
// Vidno guestom zaradi ->middleware("guest"), če poskuša auth dostopati do tega, ga preusmeri na stran, ki je definirana v /app/Http/Providers/RouteServiceProvider.php (public const HOME)
Route::get("/register", [UserController::class, "create"])->middleware("guest");


// Create New User
Route::post("/users", [UserController::class, "store"]);


// Log User Out
Route::post("/logout", [UserController::class, "logout"])->middleware("auth");


// Show Login Form
// ->name("login"), da bo middleware pravilno zaznal kam naj ga preusmeri (glej vrstico 114): neprijavljenega uporabnika pri Post Job gumbu preusmeri na /login
Route::get("/login", [UserController::class, "login"])->name("login")->middleware("guest");


// Log In User
Route::post("/users/authenticate", [UserController::class, "authenticate"]);


// Show User Profile
Route::get("/users/{user}/user-profile", [UserController::class, "user_profile"])->middleware("auth");


// Show User Location Form
Route::get("/users/{user}/user-location", [UserController::class, "user_location"])->middleware("auth");


// Update User Location
Route::put("/users/{user}", [UserController::class, "update_location"])->middleware("auth");


// Show User Location
Route::get("/users/get-location", [UserController::class, "getLatLngFromUser"])->name("users.get-location")->middleware("auth");


// Show map of Users
Route::get("/users/map", [UserController::class, "visualization"])->middleware("auth");


//// Single Listing
// [ListingController::class, "show"] je ListingController::class, "imeMetode"
Route::get("/listings/{listing}", [ListingController::class, "show"]);
//Route::get("/listings/{id}", function($id) {
//    $listing = Listing::find($id);
////  če listing obstaja, jo vrnemo
//    if($listing) {
//        return view("listing", [
//            "listing" => $listing
//        ]);
//    }
////  sicer zapišemo error 404
//    else {
//        abort("404");
//    }
//});


// druga ekvivalentna opcija
// listing v "/listings/{listing}" mora biti po imenu enak listingu v "return view("listing",..."
// ima že vgrajeno preverjanje obstoja: 404 ali 200
//Route::get("/listings/{listing}", function(Listing $listing) {
////    return view("listing", [
////        "listing" => $listing
////    ]);
//});


// Show Create Spot Form
Route::get("/spots/create", [SpotController::class, "create"])->middleware("auth");


// Store Spot Data
Route::post("/spots", [SpotController::class, "store"])->middleware("auth");


// Show map of Spots
Route::get("/spots/map", [SpotController::class, "visualization"])->middleware("auth");
