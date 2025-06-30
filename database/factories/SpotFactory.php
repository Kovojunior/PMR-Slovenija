<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spot>
 */
class SpotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generiraj naključne koordinate v Sloveniji
        $myLatitude = $this->faker->latitude(45.42, 46.88);
        $myLongitude = $this->faker->longitude(13.38, 16.61);

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

        return [
            "activation_callsign" => $this->faker->name(),
            "location" => "$myLatitude, $myLongitude",
            "frequency" => $freqValue,
            "mode" => $this->faker->randomElement(['fm', 'am', 'ssb', 'digital', 'other']),
            "time" => $this->faker->randomElement(['15min', '1h', '1day', 'infinite', 'alert']),
            "type" => $this->faker->randomElement(['portable', 'mobile', 'qth', 'other']),
            "comments" => $this->faker->optional()->text(25),
            "Qso_type" => $freqType,
        ];
    }
}
