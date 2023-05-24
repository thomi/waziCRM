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
        'email_address',
        'phone_number',
        'address',
        'user_id'
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

    /**
     * Get the post that owns the comment.
     */
    public function customer()
    {
        return $this->belongsTo(User::class);
    }
}
