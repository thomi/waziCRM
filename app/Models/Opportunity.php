<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    /**
     *
     */
    protected $fillable = [
        'amount',
        'closed_at',
        'lead_id'
    ];

    /**
     *
     */
    protected $casts = [
        'closed_at' => 'datetime',
    ];

    /**
     * 
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
