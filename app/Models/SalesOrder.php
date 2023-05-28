<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    /**
     *
     */
    protected $fillable = [
        'order_number',
        'total_amount',
        'customer_id',
        'placed_at',
    ];

    /**
     *
     */
    protected $hidden = [
        'placed_at',
        'created_at',
        'updated_at'
    ];

    /**
     *
     */
    protected $casts = [
        'placed_at' => 'datetime',
    ];

    /**
     * 
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
