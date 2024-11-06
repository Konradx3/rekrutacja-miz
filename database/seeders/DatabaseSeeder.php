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
    public function run()
    {
        $clients = Client::factory(10)->create();

        $books = Book::factory(60)->make();

        $books->each(function ($book) use ($clients)
        {
            if (rand(0, 1) === 1)
            {
                $client = $clients->random();

                $book->is_borrowed = true;
                $book->client_id = $client->id;
            }

            $book->save();
        });
    }
}
