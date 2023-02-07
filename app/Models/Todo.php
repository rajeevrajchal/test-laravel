<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;

    protected $table = 'todos';

    protected $fillable = [
        "name",
        "completed",
        "user_id"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
