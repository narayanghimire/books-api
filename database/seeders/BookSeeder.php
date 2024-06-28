<?php

namespace Database\Seeders;

use App\Models\Books;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Books::create([
            'name' => 'The Great Gatsby',
            'details' => 'A novel written by American author F. Scott Fitzgerald',
            'author' => 'F. Scott Fitzgerald',
        ]);

        Books::create([
            'name' => '1984',
            'details' => 'A novel by George Orwell',
            'author' => 'George Orwell',
        ]);

        Books::create([
            'name' => 'To Kill a Mockingbird',
            'details' => 'A novel by Harper Lee',
            'author' => 'Harper Lee',
        ]);
    }
}
