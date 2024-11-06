<?php

namespace Database\Factories\Api\V1;

use App\Models\Api\V1\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name,
            'release_date' => $this->faker->date,
            'publishing_house' => $this->faker->company,
            'is_borrowed' => false,
            'client_id' => null,
        ];
    }
}
