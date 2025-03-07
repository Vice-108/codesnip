<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnippetView extends Model
{
    use HasFactory;

    protected $fillable = [
        'snippet_id',
        'viewed_at',
        'viewer_ip',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function snippet()
    {
        return $this->belongsTo(Snippet::class);
    }
}
