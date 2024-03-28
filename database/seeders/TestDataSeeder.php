<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Member;
use App\Models\Librarian;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Book::create([
            'title' => 'Example Book 7',
            'author' => 'Author Name 6',
            'publisher' => 'Publisher 3',
            'isbn' => '456',

        ]);

        Librarian::create([
             'username' => 'Librarian 4',
             'password' => '123',
        ]);

        Member::create([
            'nev' => 'polgar',
            'emailcim' => 'pp@nyaloka.com',
            'lakcim' => '1111 budapest valami utca 20.',
            'tipus' => 'mp',
        ]);


    }
}

