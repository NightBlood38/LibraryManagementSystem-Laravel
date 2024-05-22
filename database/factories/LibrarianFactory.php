<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Librarian;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Librarian>
 */
class LibrarianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static ?string $password;
    protected $model = Librarian::class;
     
    public function definition(): array
    {    
        return [
            'username' => $this->faker->userName,
            'password' => static::$password ??= Hash::make('password')
        ];
    }
}
