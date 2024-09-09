<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */

// narejeno v terminalu z ukazom php artisan make:factory ListingFactory
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        s tem naredimo custom obrazec za poljenje Listinga
//        faker ima vnaprej pripravljene metode za random besede
//        paragraph vrne daljše besedilo, v tem primeru 5 povedi
//        pazi!¨ "tags" => "laravel, api, backend" bo zaradi presledkov pred api in backend te presledke vključil v izpis!

        // Generiraj naključne koordinate v Sloveniji
        $myLatitude = $this->faker->latitude(45.42, 46.88);
        $myLongitude = $this->faker->longitude(13.38, 16.61);
        $theirLatitude = $this->faker->latitude(45.42, 46.88);
        $theirLongitude = $this->faker->longitude(13.38, 16.61);

        return [
//            "title" => $this->faker->sentence(),
//            "tags" => "laravel,api,backend",
//            "company" => $this->faker->company(),
//            "email" => $this->faker->companyEmail(),
//            "website" => $this->faker->url(),
//            "location" => $this->faker->city(),
//            "description" => $this->faker->paragraph(5),

            "My_Callsign" => $this->faker->name(),
            "Their_Callsign" => $this->faker->name(),
            "RST_Sent" => $this->faker->numberBetween(11, 59),
            "RST_Rcvd" => $this->faker->numberBetween(11, 59),
            // Združi latitude in longitude v obliko 'latitude, longitude'
            "My_Grid" => "$myLatitude, $myLongitude",
            "Their_Grid" => "$theirLatitude, $theirLongitude",
            "Date_Time" => $this->faker->dateTime(),
            "Freq" => $this->faker->randomFloat(5, 446, 446.2),
            "Notes" => $this->faker->optional()->text(50),
        ];
    }
}


