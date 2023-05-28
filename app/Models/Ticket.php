<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    /**
     *
     */
    protected $fillable = [
        'title',
        'status',
        'lead_id'
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * 
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
