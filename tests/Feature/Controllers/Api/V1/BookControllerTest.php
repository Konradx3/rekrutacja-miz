<?php

namespace Tests\Feature\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BookController;
use App\Http\Requests\Api\V1\StoreBookRequest;
use App\Models\Api\V1\Book;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The object under test.
     * @var BookController
     */
    private $bookController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bookController = new BookController();
    }

    /**
     * Tests the 'store' method of the BookController class.
     */
    public function testStore()
    {
        $bookData = [
            'title' => 'Test Book',
            'author' => 'Test Author',
            'release_date' => '2020-01-01',
            'publishing_house' => 'Test Publishing House',
        ];

        $storeBookRequest = Mockery::mock(StoreBookRequest::class);
        $storeBookRequest->shouldReceive('validated')->andReturn($bookData);

        $response = $this->bookController->store($storeBookRequest);

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals(201, $response->getStatusCode());

        $responseData = $response->getData(true);

        $this->assertEquals(201, $responseData['status']);
        $this->assertEquals('Book created successfully', $responseData['message']);
        $this->assertEquals($bookData['title'], $responseData['data']['title']);
        $this->assertFalse($responseData['data']['is_borrowed']);

    }

    /**
     * Tests the 'store' method of the BookController class with a general exception.
     */
    public function testStoreWithGeneralException()
    {
        $storeBookRequest = Mockery::mock(StoreBookRequest::class);
        $storeBookRequest->shouldReceive('validated')
            ->andThrow(new \Exception());

        $response = $this->bookController->store($storeBookRequest);

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals(500, $response->getStatusCode());

        $responseData = $response->getData(true);
        $this->assertEquals(500, $responseData['status']);
        $this->assertEquals('An error occurred while creating the book', $responseData['message']);
    }

    /**
     * Tests the 'show' method of the BookController class.
     */
    public function testShow()
    {
        $book = Book::factory(Book::class)->create();

        $response = $this->bookController->show($book->id);

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals(200, $response->getStatusCode());

        $responseData = $response->getData(true);

        $this->assertEquals(200, $responseData['status']);
        $this->assertEquals($book->title, $responseData['data']['title']);
        $this->assertFalse($responseData['data']['is_borrowed']);
    }

    /**
     * Tests the 'show' method of the BookController class with a ModelNotFoundException.
     */
    public function testShowWithModelNotFoundException()
    {
        $response = $this->bookController->show(9999);

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals(404, $response->getStatusCode());

        $responseData = $response->getData(true);

        $this->assertEquals(404, $responseData['status']);
        $this->assertEquals('Book cannot be found', $responseData['message']);
    }
}
