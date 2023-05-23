<?php

namespace App\Traits;

use App\Follow;
use Illuminate\Database\Eloquent\Relations\morphMany;

trait Followable
{
    // Booting method of the trait.
    protected static function bootFollowable() : void
    {
        static::deleting(function ($resource) {
            return $resource->follows->each->delete();
        });
    }

    // Get all of the resource's follows.
    public function follows() : morphMany
    {
        return $this->morphMany(Follow::class, 'followable');
    }

    // Create a follow if it does not exist yet.
    public function follow()
    {
        if ($this->follow()->where('user_id', auth()->id())->doesntExist()) {
            return $this->follow()->create(['user_id' => auth()->id()]);
        }
    }

    // Check if the resource is followed by the current user.
    public function isFollowed() : bool
    {
        return $this->follows->where('user_id', auth()->id())->isNotEmpty();
    }

    // Delete a follow for a resource.
    public function unfollow()
    {
        return $this->follows()->where('user_id', auth()->id())->get()->each->delete();
    }
}
