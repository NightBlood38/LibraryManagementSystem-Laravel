<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\member;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = member::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create('hu_HU');
        return [
            'nev' => fake()->name(),
            'lakcim' => $faker->address,
            'tipus' => $this->faker->randomElement(['eh','eo','mp','mm']),
            'emailcim' => fake()->unique()->safeEmail()
        ];
    }
}
