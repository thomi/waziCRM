<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var @return \App\Models\HasMany
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
