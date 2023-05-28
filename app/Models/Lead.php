<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    /**
     *
     */
    protected $fillable = [
        'source',
        'status',
        'converted_at',
        'customer_id',
        'campaign_id'
    ];

    /**
     *
     */
    protected $hidden = [
        'converted_at',
        'created_at',
        'updated_at'
    ];

    /**
     *
     */
    protected $casts = [
        'converted_at' => 'datetime',
    ];

    /**
     * 
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * 
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     *
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * 
     */
    public function opportunity()
    {
        return $this->hasOne(Opportunity::class);
    }
}
