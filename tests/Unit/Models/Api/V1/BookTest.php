<?php

namespace Tests\Unit\Models\Api\V1;

use App\Models\Api\V1\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BookTest extends TestCase
{
    use DatabaseTransactions;

    protected User $user;
    protected Book $book;
    protected array $bookData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->bookData = [
            'title' => 'Sample Book Title',
            'author' => 'John Doe',
            'release_date' => '2023-01-01',
            'publishing_house' => 'Sample Publishing House',
            'is_borrowed' => false,
            'user_id' => $this->user->id,
        ];

        $this->book = Book::create($this->bookData);
    }

    public function test_it_can_create_a_book_with_valid_attributes()
    {
        $this->assertInstanceOf(Book::class, $this->book);
        $this->assertEquals('Sample Book Title', $this->book->title);
        $this->assertEquals('John Doe', $this->book->author);
        $this->assertEquals('2023-01-01', $this->book->release_date->format('Y-m-d'));
        $this->assertEquals('Sample Publishing House', $this->book->publishing_house);
        $this->assertFalse($this->book->is_borrowed);
        $this->assertEquals($this->user->id, $this->book->user_id);
    }

    public function test_it_casts_attributes_to_native_types()
    {
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $this->book->release_date);
        $this->assertIsBool($this->book->is_borrowed);
    }

    public function test_it_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->book->user);
        $this->assertEquals($this->user->id, $this->book->user->id);
    }
}
