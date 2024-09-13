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
    private function degreesToRadians($degrees) {
        return $degrees * M_PI / 180;
    }
    private function distanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
        $a = 6378137; // polosem velike osi elipsoida v metrih
        $f = 1 / 298.257223563; // sploščenje elipsoida
        $b = (1 - $f) * $a; // polosem male osi elipsoida v metrih

        $phi1 = $this->degreesToRadians($lat1);
        $phi2 = $this->degreesToRadians($lat2);
        $lambda1 = $this->degreesToRadians($lon1);
        $lambda2 = $this->degreesToRadians($lon2);

        $U1 = atan((1 - $f) * tan($phi1));
        $U2 = atan((1 - $f) * tan($phi2));
        $L = $lambda2 - $lambda1;

        $lambda = $L;
        $lambda_old = 0;
        $sigma = 0;
        $sin_sigma = 0;
        $cos_sigma = 0;
        $cos2_alpha = 0;
        $cos2_sigma_m = 0;

        // Iterativni postopek
        do {
            $lambda_old = $lambda;
            $sin_lambda = sin($lambda);
            $cos_lambda = cos($lambda);

            $sin_sigma = sqrt(pow(cos($U2) * $sin_lambda, 2) + pow(cos($U1) * sin($U2) - sin($U1) * cos($U2) * $cos_lambda, 2));
            $cos_sigma = sin($U1) * sin($U2) + cos($U1) * cos($U2) * $cos_lambda;
            $sigma = atan2($sin_sigma, $cos_sigma);

            $sin_alpha = cos($U1) * cos($U2) * $sin_lambda / $sin_sigma;
            $cos2_alpha = 1 - pow($sin_alpha, 2);
            $cos2_sigma_m = $cos_sigma - 2 * sin($U1) * sin($U2) / $cos2_alpha;

            $C = $f / 16 * $cos2_alpha * (4 + $f * (4 - 3 * $cos2_alpha));
            $lambda = $L + (1 - $C) * $f * $sin_alpha * ($sigma + $C * $sin_sigma * ($cos2_sigma_m + $C * $cos_sigma * (-1 + 2 * pow($cos2_sigma_m, 2))));
        } while (abs($lambda - $lambda_old) > 1e-12);

        $u2 = $cos2_alpha * (pow($a, 2) - pow($b, 2)) / pow($b, 2);
        $A = 1 + $u2 / 16384 * (4096 + $u2 * (-768 + $u2 * (320 - 175 * $u2)));
        $B = $u2 / 1024 * (256 + $u2 * (-128 + $u2 * (74 - 47 * $u2)));

        $delta_sigma = $B * $sin_sigma * ($cos2_sigma_m + $B / 4 * ($cos_sigma * (-1 + 2 * pow($cos2_sigma_m, 2)) - $B / 6 * $cos2_sigma_m * (-3 + 4 * pow($sin_sigma, 2)) * (-3 + 4 * pow($cos2_sigma_m, 2))));
        $s = $b * $A * ($sigma - $delta_sigma);

        return $s; // Razdalja v metrih
    }
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

        // Generiraj naključno frekvenco za Freq
        $freqType = $this->faker->randomElement(['PMR446', 'CB', 'Ham']); // Izberemo vrsto

        // Glede na izbrano vrsto generiramo ustrezno vrednost
        switch ($freqType) {
            case 'PMR446':
                // PMR frekvenca: naključna cela števila med 1 in 16
                $freqValue = $this->faker->numberBetween(1, 16);
                break;

            case 'CB':
                // CB frekvenca: niz "CB" z naključno številko med 1 in 40
                $cbChannel = $this->faker->numberBetween(1, 40);
                $freqValue = "CB" . $cbChannel;
                break;

            case 'Ham':
                // HAM frekvenca: naključni float med 144-146 ali 430-440
                if ($this->faker->boolean()) {
                    // Generiraj naključni float med 144 in 146
                    $freqValue = $this->faker->randomFloat(5, 144, 146);
                } else {
                    // Generiraj naključni float med 430 in 440
                    $freqValue = $this->faker->randomFloat(5, 430, 440);
                }
                break;
        }

        // Pridobi razdaljo
        $distance = $this->distanceBetweenPoints($myLatitude, $myLongitude, $theirLatitude, $theirLongitude); // Razdalja v metrih

        // Pretvori v kilometre
        $distanceInKm = $distance / 1000;

        return [
            "My_Callsign" => $this->faker->name(),
            "Their_Callsign" => $this->faker->name(),
            "RST_Sent" => $this->faker->numberBetween(11, 59),
            "RST_Rcvd" => $this->faker->numberBetween(11, 59),
            "My_Grid" => "$myLatitude, $myLongitude",
            "Their_Grid" => "$theirLatitude, $theirLongitude",
            "Date_Time" => $this->faker->dateTime(),
            "Freq" => $freqValue, // Uporabi generirano frekvenco
            "Notes" => $this->faker->optional()->text(50),
            "QSO_Range" => $distanceInKm,
            "Event_type" => $this->faker->randomElement(['classic', 'simplex_window', 'weekly_net', 'sota']),
            "QSO_Type" => $freqType, // Zgoraj definirana logika za QSO Type
        ];
    }
}

