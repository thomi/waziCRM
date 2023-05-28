<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory, SoftDeletes;

    /**
     *
     */
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date'
    ];

    /**
     *
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     *
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * 
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
