<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
use App\Models\Spot;
use Database\Factories\ListingFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// ta datoteka se izvede, ko v terminalu zaženemo ukaz php artisan db:seed
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected static ?string $password;

    public function run(): void
    {
//      kreira 10 dummy userjev po funkciji iz datoteke /database/factories/UserFactory.php
//      factory(št.fake userjev)
//      zadevo undo-jamo z ukazom php artisan migrate:refresh, refresh + seed: php artisan migrate:refresh --seed
         // \App\Models\User::factory(10)->create();
         // kreira enega userja
//         $user = User::factory(10)->create([
//             "name" => "S57KZ",
//             "email" => "test@gmail.com",
//         ]);

        // Kreiraj 10 dummy userjev po funkciji iz datoteke /database/factories/UserFactory.php
        $users = User::factory(10)->create();

        // Za vsakega uporabnika ustvari listing
        $users->each(function ($user) {
            Listing::factory(10)->create([
                'user_id' => $user->id,
            ]);
            Spot::factory(1)->create([
                'spotter_id' => $user->id,
            ]);
        });

//         Listing::create([
//             'title' => 'Laravel Senior Developer',
//             'tags' => 'laravel, javascript',
//             'company' => 'Acme Corp',
//             'location' => 'Boston, MA',
//             'email' => 'email1@email.com',
//             'website' => 'https://www.acme.com',
//             'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
//         ],);
//
//         Listing::create([
//             'title' => 'Full-Stack Engineer',
//             'tags' => 'laravel, backend ,api',
//             'company' => 'Stark Industries',
//             'location' => 'New York, NY',
//             'email' => 'email2@email.com',
//             'website' => 'https://www.starkindustries.com',
//             'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
//         ],);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
