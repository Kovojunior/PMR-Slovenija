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

        return [
            "activation_callsign" => $this->faker->name(),
            "location" => "$myLatitude, $myLongitude",
            "frequency" => $this->faker->randomFloat(5, 446, 446.2),
            "mode" => $this->faker->randomElement(['fm', 'am', 'ssb', 'digital', 'other']),
            "time" => $this->faker->randomElement(['15min', '1h', '1day', 'infinite', 'alert']),
            "type" => $this->faker->randomElement(['portable', 'mobile', 'qth', 'other']),
            "comments" => $this->faker->optional()->text(50),
        ];
    }
}
