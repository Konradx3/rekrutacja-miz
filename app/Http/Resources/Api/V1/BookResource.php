<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            $this->mergeWhen($request->routeIs('book-show', 'book-store'), [
                'author' => $this->author,
                'release_date' => $this->release_date,
                'publishing_house' => $this->publishing_house,
            ]),
            'is_borrowed' => $this->is_borrowed,
            'borrowed_by' => $this->is_borrowed ? [
                'name' => $this->user->name,
                'email' => $this->user->email,
            ] : null,
        ];
    }
}
