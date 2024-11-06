<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\BorrowBookRequest;
use App\Http\Requests\Api\V1\ReturnBookRequest;
use App\Http\Requests\Api\V1\StoreBookRequest;
use App\Http\Resources\Api\V1\BookResource;
use App\Models\Api\V1\Book;
use App\Models\Api\V1\Client;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('client')->paginate(20);

        return response()->json([
            'status' => 200,
            'data' => BookResource::collection($books),
            'meta' => [
                'pagination' => [
                    'total' => $books->total(),
                    'count' => $books->count(),
                    'per_page' => $books->perPage(),
                    'current_page' => $books->currentPage(),
                    'total_pages' => $books->lastPage(),
                ],
            ],
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        try {
            $data = $request->validated();
            $data['is_borrowed'] = false;

            return response()->json([
                'status' => 201,
                'message' => 'Book created successfully',
                'data' => new BookResource(Book::create($data)),
            ], 201);
        }
        catch (ValidationException $e)
        {
            return response()->json([
                'status' => 422,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while creating the book',
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $book = Book::with('client')->findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => new BookResource($book),
            ], 200);
        }
        catch (ModelNotFoundException)
        {
            return response()->json([
                'status' => 404,
                'message' => 'Book cannot be found',
            ], 404);
        }
    }

    public function borrowBook(BorrowBookRequest $request, $bookId)
    {
        try
        {
            $book = Book::findOrFail($bookId);

            if ($book->is_borrowed)
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'The book is already borrowed.'
                ], 400);
            }

            $client = Client::findOrFail($request->client_id);

            $book->is_borrowed = true;
            $book->client_id = $client->id;
            $book->save();

            return response()->json([
                'status' => 200,
                'message' => 'The book has been borrowed.',
                'book' => new BookResource($book),
            ], 200);

        }
        catch (ModelNotFoundException $e)
        {
            return response()->json([
                'status' => 404,
                'message' => 'Book or client not found.'
            ], 404);

        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred, please try again later.'
            ], 500);
        }
    }

    public function returnBook($bookId)
    {
        try
        {
            $book = Book::findOrFail($bookId);

            if (!$book->is_borrowed)
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'The book is not borrowed.'
                ], 400);
            }

            $book->is_borrowed = false;
            $book->client_id = null;
            $book->save();

            return response()->json([
                'status' => 200,
                'message' => 'The book has been returned.',
            ], 200);

        }
        catch (ModelNotFoundException $e)
        {
            return response()->json([
                'status' => 404,
                'message' => 'Book not found.'
            ], 404);

        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred, please try again later.'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
