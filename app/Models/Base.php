<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Base extends Model
{
    use HasFactory;

    protected $guarded = [];

     /**
     * Get the comments for the blog post.
     */
    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }
}
