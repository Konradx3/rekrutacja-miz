<?php

namespace App\Models\Api\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'release_date',
        'publishing_house',
        'is_borrowed',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'release_date' => 'date',
        'is_borrowed' => 'boolean',
    ];

    /**
     * Get the user that owns the book.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
