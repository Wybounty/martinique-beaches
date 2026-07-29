<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Beach extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'commune_id',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'commune_id' => 'integer',
        ];
    }

    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class);
    }
}
