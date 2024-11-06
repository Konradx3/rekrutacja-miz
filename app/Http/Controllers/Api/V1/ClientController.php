<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreClientRequest;
use App\Http\Resources\Api\V1\ClientResource;
use App\Models\Api\V1\Client;
use Exception;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => ClientResource::collection(Client::all()),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        try
        {
            $client = Client::create($request->validated());

            return response()->json([
                'status' => 201,
                'data' => new ClientResource($client),
            ], 201);

        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while creating the client',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try
        {
            $client = Client::with('books')->findOrFail($id);

            if (!$client)
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Client not found',
                ], 404);
            }

            return response()->json([
                'status' => 200,
                'data' => new ClientResource($client),
            ], 200);

        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while retrieving the client',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try
        {
            $client = Client::find($id);

            if (!$client)
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Client not found',
                ], 404);
            }

            $client->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Client deleted successfully',
            ], 200);

        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while deleting the client',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
