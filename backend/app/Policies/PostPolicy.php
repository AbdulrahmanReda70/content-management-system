<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine if the given post can be updated by the user.
     */
    public function update($user,  $post): bool
    {
        return $user->id === $post->user_id;
    }
    public function canEdit($user,  $post): bool
    {
        return $user->id === $post->user_id;
    }
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
