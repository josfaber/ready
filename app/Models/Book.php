<?php

namespace App\Models;

use App\Enums\BookStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author',
        'publication_year',
        'status',
        'ranking',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'publication_year' => 'integer',
        'genre' => 'array',
        'status' => BookStatus::class,
    ];

    /**
     * The user that owns the book.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The genres that belong to the book.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'books_genres');
    }
}
