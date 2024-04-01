<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Loan;
use App\Models\member;
use App\Models\book;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Loan::class;
    public function definition(): array
    {
        $faker = \Faker\Factory::create('hu_HU');
        return [
            'book_id'=>book::inRandomOrder()->first()->id,
            'member_id'=>member::inRandomOrder()->first()->id,
            'loan_date'=>$faker->dateTimeThisDecade()
        ];
    }
}
