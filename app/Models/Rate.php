<?php

namespace App\Models;
use App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'generated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function base(): BelongsTo
    {
        return $this->belongsTo(Base::class);
    }
}
