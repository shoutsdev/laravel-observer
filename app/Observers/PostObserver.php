<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
    public function creating(Post $post)
    {
        $post->slug = Str::slug($post->name);
    }

    public function created(Post $post)
    {
        $post->unique_id = $post->slug.'-'.$post->id;
        $post->save();
    }

    public function updated(Post $post)
    {
        //
    }

    public function deleted(Post $post)
    {
        //
    }

    public function restored(Post $post)
    {
        //
    }

    public function forceDeleted(Post $post)
    {
        //
    }
}
