<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\book;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = book::class;
    public function definition(): array
    {
        $this->faker=\Faker\Factory::create('hu_HU');
        $current_year=now()->year;
        return [
            'author'=>$this->faker->name,
            'title'=>$this->faker->sentence(1),
            'publisher'=>$this->faker->company,
            'publishyear'=>$this->faker->numberBetween(1900,$current_year),
            'edition'=>$this->faker->numberBetween(1,5),
            'isbn'=>$this->faker->randomNumber(3,true),
            'borrowable'=>$this->faker->boolean()
        ];
    }
}
