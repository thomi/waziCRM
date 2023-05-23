<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'phone_number',
    ];

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
