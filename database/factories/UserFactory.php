<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

//    kreira fake userja za lažje testiranje tabele
    public function definition(): array
    {
        // Generiraj naključne koordinate v Sloveniji
        $myLatitude = $this->faker->latitude(45.42, 46.88);
        $myLongitude = $this->faker->longitude(13.38, 16.61);

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'nickname' => fake()->name(),
            'lat_lng' => "$myLatitude, $myLongitude",
            "grid" => "JN75IV",
            'city' => $this->faker->city(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
