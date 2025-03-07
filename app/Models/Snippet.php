<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Snippet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'code',
        'language',
        'is_public',
        'user_id',
        'views_count',    // Add this
        'favorites_count', // Add this
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'views_count' => 'integer',     // Add this
        'favorites_count' => 'integer'  // Add this
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'snippet_favorites')
            ->withTimestamps();
    }
}
