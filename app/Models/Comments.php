<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'news';

    protected $fillable = [
        'user_id',
        'title',
        'link',
        'upvotes'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class, 'id');
    }
}
