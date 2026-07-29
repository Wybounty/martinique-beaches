<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $fillable = [
        'nom',
        'code_postal',
        'code_insee',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
        ];
    }

    public function beaches(): HasMany
    {
        return $this->hasMany(Beach::class);
    }
}
