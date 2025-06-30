<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// datoteka narejena v terminalu s pomočjo php artisan make:model Listing
class Listing extends Model
{
    use HasFactory;

    // zahtevano, sicer dobimo Add [title] to fillable property to allow mass assignment on [App\Models\Listing] error
    // protected $fillable = ["title", "company", "location", "website", "email", "description", "tags"];
    // ali pa dodamo kodo znotraj public function boot() v AppServiceProvider.php znotraj /app/Providers

    // kreiramo filter za filtriranje rezultatov
    public function scopeFilter($query, array $filters) {
        // Filter po Tagih
//        if($filters["tag"] ?? false) {
//            $query->where("My_Callsign", "like", "%" . request("tag") . "%")
//                  ->orWhere("Their_Callsign", "like", "%" . request("tag") . "%");
//        }

        // Filter po Search Fieldu
        if($filters["search"] ?? false) {
            $query->where("My_Callsign", "like", "%" . request("search") . "%")
                  ->orWhere("Their_Callsign", "like", "%" . request("search") . "%");
//                  ->orWhere("tags", "like", "%" . request("search") . "%");
        }
    }


    // Relationship To User: Listing belongs to User
    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }
}
// na tej točki v firefox dodamo extension Clockwork, ki nam prikaže querije, ki runnajo, zdaj pa installamo še v projekt:
// ukaz v terminalu: composer require itsgoingd/clockwork
// do clockwork prikaza dostopamo z F12->Clockwork, query je prikazan v podzavihku Database

