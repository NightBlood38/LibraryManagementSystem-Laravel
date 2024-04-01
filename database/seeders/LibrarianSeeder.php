<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Librarian;
class LibrarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Librarian::factory()->create();
        // gives error due to the constraint that password should be unique, since LibrarianFactory generates the same password for each librarian: Librarian::factory(3)->create();
    }
}
