<?php

namespace Database\Seeders;

use App\Models\Api\V1\Book;
use App\Models\Api\V1\Client;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Book::factory()->count(60)->create();
        Client::factory(10)->create();
    }
}
