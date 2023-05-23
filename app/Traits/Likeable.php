<?php

namespace App\Traits;

use App\Like;
use Illuminate\Database\Eloquent\Relations\morphMany;

trait Likeable
{
    // booting method of the trait.
    protected static function bootLikeable() : void
    {
        static::deleting(function ($resource) {
            return $resource->likes->each->delete();
        });
    }

    // Get all of the resource's likes.
    public function likes() : morphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    // Create a like if it does not exist yet.
    public function like()
    {
        if ($this->likes()->where('user_id', auth()->id())->doesntExist()) {
            return $this->likes()->create(['user_id' => auth()->id()]);
        }
    }

    // Check if the resource is liked by the current user.
    public function isLiked() : bool
    {
        return $this->likes->where('user_id', auth()->id())->isNotEmpty();
    }

    // Delete like for a resource.
    public function dislike()
    {
        return $this->likes()->where('user_id', auth()->id())->get()->each->delete();
    }
}
